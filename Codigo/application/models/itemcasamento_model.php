<?php

class ItemCasamento_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserir($dados) {
        $insert = $this->db->insert('ItemCasamento', $dados);
        if ($insert) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function listarItensCasamento($idCasamento) {
        $this->db->select('Categoria.idCategoria, Categoria.Descricao as Categoria, 
            Item.Descricao, ItemCasamento.ValorPrevisto, 
            ItemCasamento.ValorContratado, ItemCasamento.ValorPago, ItemCasamento.Percentual, 
            ItemCasamento.SaldoDevedor, ItemCasamento.FK_idFornecedor,Fornecedor.Nome as NomeFornecedor');
        $this->db->from('ItemCasamento');
        $this->db->join('Fornecedor','Fornecedor.idFornecedores = ItemCasamento.FK_idFornecedor','left');
        $this->db->join('Item','Item.idItem = ItemCasamento.FK_idItem');
        $this->db->join('Categoria','Categoria.idCategoria = Item.FK_idCategoria');
        $this->db->where('FK_idCasamento',$idCasamento);
        
        $get = $this->db->get();
        if ($get->num_rows > 0)
            return $get->result();
        return FALSE;
    }
    function obterTotalGastos($idCasamento) {
        //return $this->db->get('ItemCasamento');
        
        $this->db->select_sum('ValorPrevisto');
        $this->db->select_sum('ValorContratado');
        $this->db->select_sum('ValorPago');
        $this->db->where('FK_idCasamento',$idCasamento);
        
        $get = $this->db->get('ItemCasamento');
        if ($get->num_rows > 0)
            return $get->result_array();
        return FALSE;
    }

}