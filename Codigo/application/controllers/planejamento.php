<?php

if (!defined('BASEPATH'))
    exit('Não é permitido acesso direto ao código');

class Planejamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dadosSessao = array(
            'idPlanejamento' => 1
        );
        $this->session->set_userdata($dadosSessao);

        $dados['titulo'] = 'Planejamento';

        $this->load->model('Categoria');
        $dados['categorias'] = $this->Categoria->listarTodos();




        $this->template->load('templates/templatePadrao', 'planejamentoView', $dados);
    }

    public function listarItems($idCategoria = false) {

        $options[''] = 'Selecione o Item';
        echo 'idCategoria: ' . $idCategoria;
        if ($idCategoria != false) {
            $this->load->model('Categoria');
            /* @var $Categoria Categoria */
            $dados = $this->Categoria->listarItems($idCategoria);


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

    public function salvar() {
        $sucesso = FALSE;
        if ($_POST) {
            $dados["FK_idPlanejamento"] = $this->session->userdata('idPlanejamento');
            $dados["FK_idItem"] = $this->input->post('items');
            $dados["DataExecucao"] = dataMYSQL($this->input->post('DataExecucao'));
            $dados["ValorPrevisto"] = $this->input->post('ValorPrevisto');
            $dados["ValorContratado"] = $this->input->post('ValorContratado');
            $dados["ValorPago"] = $this->input->post('ValorPago');
            //$dados["Percentual"] = Realizado / Total Realizado
            $dados["SaldoDevedor"] = $dados["ValorContratado"] - $dados["ValorPago"];
            $dados["FK_idFornecedor"] = $this->input->post('fornecedores');
            $dados["FormaPagamento"] = $this->input->post('FormaPagamento');

            $this->load->model('ItemPlanejamento');
            $resultado = $this->ItemPlanejamento->inserir($dados);
            if ($resultado == 0) {
                $sucesso = TRUE;
            } else {
                $msg = '<br>Erro: '.$resultado;
            }

            if ($dados["FormaPagamento"] == "P") {
                $this->load->model('Pagamento');

                $dadosPgto["Valor"] = $this->input->post('parcelaEntrada');
                $dadosPgto["Data"] = dataMYSQL($this->input->post('dataEntrada'));
                $dadosPgto["FK_idPlanejamento"] = $dados["FK_idPlanejamento"];
                $dadosPgto["FK_idItem"] = $dados["FK_idItem"];
                $resultado = $this->Pagamento->inserir($dadosPgto);

                $nroPrestacoes = $this->input->post('nroPrestacoes');
                $parcelas = $this->input->post('parcelas');
                $dataparcelas = $this->input->post('dataParcelas');
                for ($i = 0; $i < $nroPrestacoes; $i++) {
                    $dadosPgto = NULL;
                    $dadosPgto["Valor"] = $parcelas[$i];
                    $dadosPgto["Data"] = dataMYSQL($dataparcelas[$i]);
                    $dadosPgto["FK_idPlanejamento"] = $dados["FK_idPlanejamento"];
                    $dadosPgto["FK_idItem"] = $dados["FK_idItem"];
                    $resultado = $this->Pagamento->inserir($dadosPgto);
                }
            }
        }
        if ($sucesso) {
            echo "Item salvo com sucesso.";
        } else {
            echo "Erro ao salvar item.".$msg;
        }
    }

}