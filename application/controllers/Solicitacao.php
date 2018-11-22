<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacao extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library(['form_validation','upload']);
    } 

    //pre lista
	public function RegisterPreSolicitacao() {

        $header['title'] = "Paciente Móvel  | Pré Solicitação";
		$this->load->view('adm/commons/header',$header);
	    $this->load->view('adm/cadastro/solicitacao/cadastro-pre-solicitacao');//,$data);
	    $this->load->view('adm/commons/footer');

    }

    public function Listar(){
		
		
        $nivel_user = 1; //Nivel requirido para visualizar a pagina
    
        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {
            
            $header['title'] = "Paciente Móvel | Solicitações";
            $this->load->view('adm/commons/header',$header);
            $this->load->view('adm/cadastro/solicitacao/solicitacoes');//,$data);
            $this->load->view('adm/commons/footer');
            
                }else{
                redirect(base_url('login'));
            }
        }
    
}