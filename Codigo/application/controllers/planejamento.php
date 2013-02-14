<?php

if (!defined('BASEPATH'))
    exit('Não é permitido acesso direto ao código');

class Planejamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dadosSessao = array (
            'idPlanejamento' => 1
        );
        $this->session->set_userdata($dadosSessao);
        
        $dados['titulo'] = 'Planejamento';
        
        $this->load->model('Categoria');
        $dados['categorias'] = $this->Categoria->listarTodos();




        $this->template->load('templates/templatePadrao', 'planejamentoView', $dados);
    }

    public function listarItems($idCategoria = false) {

        $options[] = 'Selecione o Item';
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

        $options[] = 'Selecione o Fornecedor';
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
        //var_dump($_POST);

        $dados["FK_idPlanejamento"] = $this->session->userdata('idPlanejamento');
        $dados["FK_idItem"] = $this->input->post('items');
        $dados["DataExecucao"] = $this->input->post('DataExecucao');
        $dados["ValorPrevisto"] = $this->input->post('ValorPrevisto');
        $dados["ValorContratado"] = $this->input->post('ValorContratado');
        $dados["ValorPago"] = $this->input->post('ValorPago');
        //$dados["Percentual"] = Realizado / Total Realizado
        $dados["SaldoDevedor"] = $dados["ValorContratado"] - $dados["ValorPago"];
        $dados["FK_idFornecedor"] = $this->input->post('fornecedores');
        $dados["FormaPagamento"] = $this->input->post('FormaPagamento');

        $this->load->model('ItemPlanejamento');
        $r = $this->ItemPlanejamento->inserir($dados);

        if ($dados["FormaPagamento"] == "P") {
            $this->load->model('Pagamento');

            $dadosPgto["Valor"] = $this->input->post('parcelaEntrada');
            $dadosPgto["Data"] = $this->input->post('dataEntrada');
            $dadosPgto["FK_idPlanejamento"] = $dados["FK_idPlanejamento"];
            $dadosPgto["FK_idItem"] = $dados["FK_idItem"];

            $r = $this->Pagamento->inserir($dadosPgto);

            $nroPrestacoes = $this->input->post('nroPrestacoes');
            $parcelas = $this->input->post('parcelas');
            $dataparcelas = $this->input->post('dataParcelas');
            for ($i = 0; $i < $nroPrestacoes; $i++) {
                $dadosPgto = NULL;
                $dadosPgto["Valor"] = $parcelas[$i];
                $dadosPgto["Data"] = $dataparcelas[$i];
                $dadosPgto["FK_idPlanejamento"] = $dados["FK_idPlanejamento"];
                $dadosPgto["FK_idItem"] = $dados["FK_idItem"];
                $r = $this->Pagamento->inserir($dadosPgto);
            }
//            ["parcelas"]=> array(4) { 
//                [0]=> string(4) "1000" 
//                [1]=> string(4) "1000" 
//                [2]=> string(4) "1000" 
//                [3]=> string(4) "1000" } 
//            ["dataParcelas"]=> array(4) { 
//                [0]=> string(10) "02/28/2013" 
//                [1]=> string(10) "03/28/2013" 
//                [2]=> string(10) "04/28/2013" 
//                [3]=> string(10) "05/28/2013" } 
        }
    }

}