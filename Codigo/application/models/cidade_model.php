<?php

class Cidade_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function listarUF() {
        $this->db->select('UF');
        $this->db->distinct();
        $this->db->order_by('UF');
        $get = $this->db->get('Cidade');
        if ($get->num_rows > 0)
            return $get->result();
        return FALSE;
    }

    function listarCidadesPorUF($UF) {
        $this->db->select('idCidade, Nome');
        $this->db->where('UF', $UF);
        $get = $this->db->get('Cidade');
        if ($get->num_rows > 0)
            return $get->result();
        return FALSE;
    }

}