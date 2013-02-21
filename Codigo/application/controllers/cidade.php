<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cidade extends CI_Controller {

    function index() {
        echo 'ok';
    }
    
    function listarUF() {
        $options[''] = 'UF';

        $this->load->model('Cidade_model');
        $dados = $this->Cidade_model->listarUF();
        foreach ($dados as $uf) {
            $options[$uf->UF] = $uf->UF;
        }
        echo form_dropdown('uf', $options, '', 'id="uf"');
    }
    
    function listarCidades($UF) {
        $options[''] = 'Cidade';

        $this->load->model('Cidade_model');
        $dados = $this->Cidade_model->listarCidadesPorUF($UF);
        var_dump($dados);
        foreach ($dados as $cidade) {
            $options[$cidade->idCidade] = $cidade->Nome;
        }
        echo form_dropdown('cidade', $options, '', 'id="cidade"');
    }

}

/* End of file cidade.php */
/* Location: ./application/controllers/cidade.php */