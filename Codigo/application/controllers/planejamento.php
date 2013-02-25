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

        $this->load->model('Categoria_Model');
        $dados['categorias'] = $this->Categoria_Model->listarTodos();

        $this->load->model('Item_Model');
        $itens = $this->Item_Model->listarTodos();
        $lista = NULL;
        if ($itens) {
            foreach ($itens as $item) {
                $lista[$item->idCategoria]['idCategoria'] = $item->idCategoria;
                $lista[$item->idCategoria]['Categoria'] = $item->Categoria;
                $lista[$item->idCategoria]['itens'][] = $item;
            }
            $dados['menuCategorias'] = $lista;
        }
        
        $this->template->load('templates/templatePadrao', 'planejamentoView', $dados);
    }

    public function listarItems($idCategoria = false) {

        $options[''] = 'Selecione o Item';

        if ($idCategoria != false) {
            $this->load->model('Item_Model');
            $dados = $this->Item_Model->listarItemsPorCategoria($idCategoria);

            foreach ($dados as $item) {
                $options[$item['idItem']] = $item['Descricao'];
            }
        }
        echo form_dropdown('items', $options, '', 'id="items"');
    }

    public function listarFornecedores($idCategoria = FALSE, $ultimo = FALSE) {
        $options[''] = 'Selecione o Fornecedor';
        if ($idCategoria != FALSE) {
            $this->load->model('Fornecedor_Model');
            $dados = $this->Fornecedor_Model->listarPorCategoria($idCategoria);
            $selecionado = 0;
            foreach ($dados as $fornecedor) {
                $options[$fornecedor['idFornecedores']] = $fornecedor['Nome'];
                if($ultimo) {
                    if ($selecionado < $fornecedor['idFornecedores']) {
                        $selecionado = $fornecedor['idFornecedores'];
                    }
                }
            }
        }
        echo form_dropdown('fornecedores', $options, $selecionado, 'id="fornecedores"');
    }

    public function checkBoxCategorias($idcategoria = '') {
        $this->load->model('Categoria_Model');
        $dados = $this->Categoria_Model->listarTodos();
        if ($dados) {
            $checado = FALSE;
            $cont = 0;
            $tabela = '<table border="0"> <tr>';
            foreach ($dados as $categoria) {
                $checado = $idcategoria == $categoria->idCategoria ? TRUE : FALSE;
                $idCheck = 'chkCategoria' . $categoria->idCategoria;
                $check = array(
                    'name' => 'chkCategorias[]',
                    'id' => $idCheck,
                    'value' => $categoria->idCategoria,
                    'checked' => $checado
                );
                $tabela .= $cont % 3 == 0 ? '</tr><tr>' : '';
                $tabela .= '<td>';
                $tabela .= form_checkbox($check) . form_label($categoria->Descricao, $idCheck);
                $tabela .= '</td>';
                $cont++;
            }
            $tabela .= '</tr></table>';
            echo $tabela;
        }
    }

    public function calcularDataExecucao($idItem = '') {
        if ($idItem != '') {
            $this->load->model('Item_Model');
            $meses = $this->Item_Model->obterMesesAntes($idItem);
            $dataCasamento = $this->session->userdata('DataCasamento');
            $dataExecucao = subtraiMeses($dataCasamento, $meses);
            $hoje = date('d/m/Y');

            if (dataAMenorDataB($hoje, $dataExecucao)) {
                return $dataExecucao;
            } else {
                return $hoje;
            }
        }
        return '';
    }

    public function listarItensCasamento() {
        $this->load->model('ItemCasamento_Model');
        $itens = $this->ItemCasamento_Model->listarItensCasamento($this->session->userdata('idCasamento'));
        $lista = NULL;
        if ($itens) {
            foreach ($itens as $item) {
                $lista[$item->idCategoria]['idCategoria'] = $item->idCategoria;
                $lista[$item->idCategoria]['Categoria'] = $item->Categoria;
                $lista[$item->idCategoria]['itens'][] = $item;
            }
            $lista['categorias'] = $lista;

            $this->load->view('planejamento/itensCasamentoView', $lista);
        }
    }
    
    public function menuCategoriasItens() {
        $this->load->model('Item_Model');
        $itens = $this->Item_Model->listarTodos();
        $lista = NULL;
        if ($itens) {
            foreach ($itens as $item) {
                $lista[$item->idCategoria]['idCategoria'] = $item->idCategoria;
                $lista[$item->idCategoria]['Categoria'] = $item->Categoria;
                $lista[$item->idCategoria]['itens'][] = $item;
            }
            $lista['categorias'] = $lista;

            $this->load->view('planejamento/menuCategorias', $lista);
        }
    }
    
    public function totalGastos() {
        $this->load->model('ItemCasamento_Model');
        $totais = $this->ItemCasamento_Model->obterTotalGastos($this->session->userdata('idCasamento'));
        if ($totais) {
            $totais[0]['SaldoDevedor'] = $totais[0]['ValorContratado'] - $totais[0]['ValorPago'];
            $totais[0]['PercentualPago'] = ($totais[0]['ValorPago'] / $totais[0]['ValorContratado'] * 100);
            $this->load->view('planejamento/totalGastosView', $totais[0]);
        }
    }
    
    public function addItem($idItem = '', $idCategoria = FALSE, $ultimo = FALSE) {
        
        $dados['DataExecucao'] = $this->calcularDataExecucao($idItem);
        
        $dados['idItem'] = $idItem;
        
        $optionsFornecedor[''] = 'Selecione o Fornecedor';
        if ($idCategoria != FALSE) {
            $this->load->model('Fornecedor_Model');
            $fornecedores = $this->Fornecedor_Model->listarPorCategoria($idCategoria);
            $selecionado = 0;
            foreach ($fornecedores as $fornecedor) {
                $optionsFornecedor[$fornecedor['idFornecedores']] = $fornecedor['Nome'];
                if($ultimo) {
                    if ($selecionado < $fornecedor['idFornecedores']) {
                        $selecionado = $fornecedor['idFornecedores'];
                    }
                }
            }
        }
        $dados['optionsFornecedor'] = $optionsFornecedor;
        
        $this->load->view('planejamento/addItem', $dados);
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

            $this->load->model('ItemCasamento_Model');
            $idItemCasamento = $this->ItemCasamento_Model->inserir($dados);
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

    public function salvarFornecedor() {
        if ($_POST) {
            $dados['Nome'] = $this->input->post('Nome');
            $dados['Responsavel'] = $this->input->post('Responsavel');
            $dados['Telefone'] = $this->input->post('Telefone');
            $dados['Celular'] = $this->input->post('Celular');
            $dados['EMail'] = $this->input->post('EMail');
            $dados['Site'] = $this->input->post('Site');
            $dados['Endereco'] = $this->input->post('Endereco');
            $dados['FK_idCidade'] = $this->input->post('cidade');
            
            $this->load->model('Fornecedor_Model');
            $idFornecedor = $this->Fornecedor_Model->inserir($dados);
            
            if($idFornecedor) {
                $listaCategorias = $this->input->post('chkCategorias');
                foreach ($listaCategorias as $categoria) {
                    $dadosCF['FK_idFornecedores'] = $idFornecedor;
                    $dadosCF['FK_idCategoria'] = $categoria;
                    $idFornecedor = $this->Fornecedor_Model->inserirCategoria($dadosCF);
                }
                echo 'Fornecedor salvo com sucesso!';
            } else {
                echo '<br>Erro: ' . $this->db->_error_number() . ' - ' . $this->db->_error_message();
            }
            
        }
    }

}