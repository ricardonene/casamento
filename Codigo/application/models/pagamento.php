<?php
class Pagamento extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function inserir($dados) {
        $insert = $this->db->insert('Pagamento',$dados);
    }
}