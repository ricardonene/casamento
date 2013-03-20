<?php if ( ! defined('BASEPATH')) exit('Não é permitido acesso direto ao código');

class Login extends CI_Controller {

	public function index()
	{
            $this->load->model("Categoria");
            
            $dados["titulo"] = "Planning Life 2 - planninglife2.com.br";
            $dados["texto"] = $this->Categoria->listarTodos();
            $this->load->view("login",$dados);
	}
        
        public function validar() {
            echo 'validar';
        }
}