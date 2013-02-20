<?php

class Casamento extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function obterDataCasamento($idCasamento) {
        $this->db->select('DataCasamento');
        $this->db->where('idCasamento',$idCasamento);
        $get = $this->db->get('Casamento');
        if ($get->num_rows > 0) {
            $dados = $get->result();
            return $dados[0]->DataCasamento;
        }
        return FALSE;
    }
    
    function listarItems($idCategoria) {
        $this->db->where('FK_idCategoria', $idCategoria); 
        $get = $this->db->get('Item');
        if ($get->num_rows > 0)
            return $get->result_array();
        return array();
    }

}