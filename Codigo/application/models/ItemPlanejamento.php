<?php
class ItemPlanejamento extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function inserir($dados) {
        $this->db->insert('ItemPlanejamento',$dados);
        if($this->db->_error_number() == 0) {
            return 0;
        } else {
            return $this->db->_error_number() . ' - ' .$this->db->_error_message();
        }
    }
}