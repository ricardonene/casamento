<?php

if (!defined('BASEPATH'))
    exit('Não é permitido acesso direto ao código');

class Planejamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dadosSessao = array(
            'idCasamento' => 2
        );

        $this->load->model('Casamento');
        $dadosSessao['DataCasamento'] = dataHumano($this->Casamento->obterDataCasamento(2));

        $this->session->set_userdata($dadosSessao);

        $dados['titulo'] = 'Planejamento';

        $this->load->model('Categoria');
        $dados['categorias'] = $this->Categoria->listarTodos();



        $this->template->load('templates/templatePadrao', 'planejamentoView', $dados);
    }

    public function listarItems($idCategoria = false) {

        $options[''] = 'Selecione o Item';

        if ($idCategoria != false) {
            $this->load->model('Item');
            $dados = $this->Item->listarItemsPorCategoria($idCategoria);

            foreach ($dados as $item) {
                $options[$item['idItem']] = $item['Descricao'];
            }
        }
        echo form_dropdown('items', $options, '', 'id="items"');
    }

    public function listarFornecedores($idCategoria = false) {

        $options[''] = 'Selecione o Fornecedor';
        echo 'idCategoria: ' . $idCategoria;
        if ($idCategoria != false) {
            $this->load->model('Fornecedor');

            $dados = $this->Fornecedor->listarPorCategoria($idCategoria);


            foreach ($dados as $fornecedor) {
                $options[$fornecedor['idFornecedores']] = $fornecedor['Nome'];
            }
        }
        echo form_dropdown('fornecedores', $options, '', 'id="fornecedores"');
    }

    public function calcularDataExecucao($idItem = '') {
        if ($idItem != '') {
            $this->load->model('Item');
            $meses = $this->Item->obterMesesAntes($idItem);
            $dataCasamento = $this->session->userdata('DataCasamento');
            $dataExecucao = subtraiMeses($dataCasamento, $meses);
            $hoje = date('d/m/Y');

            if (dataAMenorDataB($hoje, $dataExecucao)) {
                echo $dataExecucao;
            } else {
                echo $hoje;
            }
        }
    }

    public function listarItensCasamento() {
        
        $this->load->model('ItemCasamento');
        $itens = $this->ItemCasamento->listarItensCasamento($this->session->userdata('idCasamento'));
        $lista = NULL;
        if($itens) {
            foreach ($itens as $item) {
                $lista[$item->idCategoria]['idCategoria'] = $item->idCategoria;
                $lista[$item->idCategoria]['Categoria'] = $item->Categoria;
                $lista[$item->idCategoria]['itens'][] = $item;
            }
            $lista['categorias'] = $lista;
            
            $this->load->view('itensCasamentoView',$lista);
        }
    }

    public function salvar() {
        $sucesso = FALSE;
        if ($_POST) {
            $dados["FK_idCasamento"] = $this->session->userdata('idCasamento');
            $dados["FK_idItem"] = $this->input->post('items');
            $dados["DataExecucao"] = dataMYSQL($this->input->post('DataExecucao'));
            $dados["ValorPrevisto"] = mysql_format($this->input->post('ValorPrevisto'));
            $dados["ValorContratado"] = mysql_format($this->input->post('ValorContratado'));
            $dados["ValorPago"] = mysql_format($this->input->post('ValorPago'));
            //$dados["Percentual"] = Realizado / Total Realizado
            $dados["SaldoDevedor"] = mysql_format($dados["ValorContratado"] - $dados["ValorPago"]);
            $dados["FK_idFornecedor"] = $this->input->post('fornecedores');
            $dados["FormaPagamento"] = $this->input->post('FormaPagamento');

            $this->load->model('ItemCasamento');
            $idItemCasamento = $this->ItemCasamento->inserir($dados);
            if ($idItemCasamento) {
                $sucesso = TRUE;
            } else {
                $msg = '<br>Erro: ' . $this->db->_error_number() . ' - ' . $this->db->_error_message();
            }

            if ($dados["FormaPagamento"] == "P") {
                $this->load->model('Pagamento');

                //Inserindo o valor da Entrada
                $dadosPgto["Valor"] = mysql_format($this->input->post('parcelaEntrada'));
                $dadosPgto["Data"] = dataMYSQL($this->input->post('dataEntrada'));
                $dadosPgto["FK_idItemCasamento"] = $idItemCasamento;
                $resultado = $this->Pagamento->inserir($dadosPgto);

                $nroPrestacoes = $this->input->post('nroPrestacoes');
                $parcelas = $this->input->post('parcelas');
                $dataparcelas = $this->input->post('dataParcelas');
                //Inserindo as demais parcelas
                for ($i = 0; $i < $nroPrestacoes; $i++) {
                    $dadosPgto = NULL;
                    $dadosPgto["Valor"] = mysql_format($parcelas[$i]);
                    $dadosPgto["Data"] = dataMYSQL($dataparcelas[$i]);
                    $dadosPgto["FK_idItemCasamento"] = $idItemCasamento;
                    $resultado = $this->Pagamento->inserir($dadosPgto);
                }
            }
        }
        if ($sucesso) {
            echo "Item salvo com sucesso.";
        } else {
            echo "Erro ao salvar item." . $msg;
        }
    }

}