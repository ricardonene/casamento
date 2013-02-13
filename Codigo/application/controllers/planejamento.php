<?php

if (!defined('BASEPATH'))
    exit('Não é permitido acesso direto ao código');

class Planejamento extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
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
    
    public function salvar() {
        var_dump($_POST);
    }

}