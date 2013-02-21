<?php

class Fornecedor_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function inserir($dados) {
        $insert = $this->db->insert('Fornecedor', $dados);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    
    function inserirCategoria($dados) {
        $insert = $this->db->insert('CategoriaFornecedor', $dados);
        if ($insert) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function listarTodos() {
        $get = $this->db->get('Fornecedor');
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }
    
    function listarPorCategoria($idCategoria) {
        $this->db->select('idFornecedores, Nome');
        $this->db->from('Fornecedor');
        $this->db->join('CategoriaFornecedor', 'CategoriaFornecedor.FK_idFornecedores = Fornecedor.idFornecedores');
        $this->db->where('CategoriaFornecedor.FK_idCategoria', $idCategoria); 
        $get = $this->db->get();
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }

}