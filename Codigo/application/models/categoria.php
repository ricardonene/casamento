<?php

class Categoria extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listarTodos() {
        $get = $this->db->get('Categoria');
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }
    
    function listarItems($idCategoria) {
        $this->db->where('FK_idCategoria', $idCategoria); 
        $get = $this->db->get('Item');
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }

}