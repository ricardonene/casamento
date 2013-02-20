<?php

class Item extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listarTodos() {
        $get = $this->db->get('Item');
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }

    function listarItemsPorCategoria($idCategoria) {
        $this->db->where('FK_idCategoria', $idCategoria);
        $get = $this->db->get('Item');
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }

    function obterMesesAntes($idItem) {
        $this->db->select('MesesAntes');
        $this->db->where('idItem', $idItem);
        $get = $this->db->get('Item');
        if ($get->num_rows > 0) {
            $dados = $get->result();
            return $dados[0]->MesesAntes;
        }
        return FALSE;
    }

}