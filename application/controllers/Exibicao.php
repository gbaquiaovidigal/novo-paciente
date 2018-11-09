<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exibicao extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$sql = "SELECT r.nome_regiao, r.id_regiao, e.sigla_estado 
		FROM regiao r
		INNER JOIN estado e ON (e.id_estado = r.id_estado)
		WHERE r.fg_ativo = 1 ORDER BY 3";
		
		$data['regioes'] = $this->Crud_model->Query($sql);
		//die(var_dump($data['regioes']));
		
		$data['servicos'] = $this->Crud_model->ReadAll('tipo_servico');
		$header['title'] = "Paciente Móvel";
		$this->load->view('index',$data);
	}

	public function Pesquisa()
	{

		//Formulando o algoritmo de pesquisa com as informaçoes do usuario
		//verificando os paramentros passados
		if (($this->input->get('servico') == null) and ($this->input->get('regiao')==null)){
			redirect('http://localhost/novo-paciente');
		}
		
		$id_servico = (int)$this->input->get('servico');
		$id_regiao = (int)$this->input->get('regiao');
		$dia_pesquisa = date('Y-m-d');

		//Buscando dados para formular tela de busca
		
		$par = array('id_regiao' => $id_regiao);
		$data['regiao'] = $this->Crud_model->Read('regiao',$par);
		
		if(($data['regiao'] == false) or $id_servico > 6){
			redirect('http://localhost/novo-paciente');
		}
			
		// Se for informado um servico em particular 
		if ($id_servico > 0):

		// busca o servico pesquisado
		$par = array('id_servico' => $id_servico);
		$servico = $this->Crud_model->Read('tipo_servico',$par);
		// Codigo sql de consulta ao bd
			$sql = "SELECT lc.data, c.nome_cidade, i.ds_igreja, h.horario, a.nome AS anciao, e.nome AS encarregado
				FROM lista_cultos lc
				INNER JOIN lista l ON (l.id_lista = lc.id_lista)
				INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
				INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade)
				INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja)
				INNER JOIN horario h ON (h.id_horario = lc.id_horario)
				INNER JOIN presbitero a ON (a.id_presbitero = lc.id_presbitero)
				INNER JOIN presbitero e ON (e.id_presbitero = lc.id_encarregado)
				WHERE lc.fg_ativo = 1 AND lc.data >= '$dia_pesquisa' AND r.id_regiao = $id_regiao AND lc.id_servico = $id_servico";

		$result = $this->Crud_model->Query($sql);
		if($result){
			$servicos[0] = array('nome_servico' => $servico->nome_servico, 'id_servico' => $id_servico, 0 => $result);
			$data['cultos'] = $servicos;
		}else{
			$servicos[0] = array('nome_servico' => $servico->nome_servico, 'id_servico' => $id_servico, 0 => null);
			$data['cultos'] = $servicos;
		}
		//die(var_dump($data['cultos']));

		// se nao for informado o servico mostra todos os servcos
		else:
			// o id_servico comeca no 1 e sao 6 servicos
			$cont = 1;
			$cont2 = 0;
			while($cont <= 6){ //
				//codigo de consulta
				$sql = "SELECT lc.data, lc.id_servico, c.nome_cidade, i.ds_igreja, h.horario, a.nome AS anciao, e.nome AS encarregado
				FROM lista_cultos lc
				INNER JOIN lista l ON (l.id_lista = lc.id_lista)
				INNER JOIN regiao r ON (r.id_regiao = l.id_regiao)
				INNER JOIN cidade c ON (c.id_cidade = lc.id_cidade)
				INNER JOIN igreja i ON (i.id_igreja = lc.id_igreja)
				INNER JOIN horario h ON (h.id_horario = lc.id_horario)
				INNER JOIN presbitero a ON (a.id_presbitero = lc.id_presbitero)
				INNER JOIN presbitero e ON (e.id_presbitero = lc.id_encarregado)
				WHERE lc.fg_ativo = 1 AND lc.data >= '$dia_pesquisa' AND r.id_regiao = $id_regiao AND lc.id_servico = $cont"; //contador que ira fazer a pesquisa

				$resultado = $this->Crud_model->Query($sql);
				
			if ($resultado) { //se tiver resultado, entao faz a pesquisa do servico de culto, monta o array, sendo q a montagem somente sera realizada com os servicos que tiverem cadastros
					$par = array('id_servico' => $cont);
					$servico = $this->Crud_model->Read('tipo_servico',$par);
					$servicos[$cont2] = array('nome_servico' =>$servico->nome_servico, 'id_servico' => $servico->id_servico, $cont2 => $resultado);
					$cont2++;
				}
				$cont++;
			}

			//die(var_dump($servicos));
			if ($cont2 > 0){
				$data['cultos'] = $servicos;
				//die(var_dump($data['cultos']));
			}else{
				$servicos[0] = array('nome_servico' => 'Listas de Batismo e diversos.', 'id_servico' => 1, 0 => null);
				$data['cultos'] = $servicos;
			}
			endif;
		
		$sql = "SELECT r.nome_regiao, r.id_regiao, e.sigla_estado 
		FROM regiao r
		INNER JOIN estado e ON (e.id_estado = r.id_estado)
		WHERE r.fg_ativo = 1 ORDER BY 3";
		
		$data['regioes'] = $this->Crud_model->Query($sql);
		
		$this->load->view('commons/header'); 
		$this->load->view('page-principal/pesquisa',$data); 
	}

	public function Profile()
	{
		
		if (($this->session->userdata('logged')) and ($this->session->userdata('id_usuario'))): 
		
		$data['permissao'] = $this->session->userdata('id_tipo_usuario');

		$id_user = $this->session->userdata('id_usuario');
		$data['user'] = $this->User_model->GetUser($id_user);
		$data['title'] = "Paciente Móvel"; 
		$data['id_page'] = "1"; 

		$nome_user = explode(" ", $data['user']->nome);
		$data['nome_user'] = $nome_user[0];
		

		//Pesquisar as Listas
		$sql = "SELECT l.id_lista, m.nome_mes, l.data_lista, r.nome_regiao, u.user
				FROM lista l
				INNER JOIN regiao r ON (l.id_regiao = r.id_regiao)
				INNER JOIN mes m ON (m.id_mes = l.mes_lista)
				LEFT OUTER JOIN usuario u ON (l.id_usuario = u.id_usuario)
				WHERE l.fg_ativo = 1 and u.id_usuario = $id_user ORDER BY l.id_lista DESC LIMIT 15";

		//consultando
		$data['listas'] = $this->Crud_model->Query($sql);

		//Pesquisar as Listas Encaminhadas gerais
		$sql = "SELECT l.id_pre_lista, m.nome_mes, l.data_lista, r.nome_regiao, u.user as remetente, l.file_lista
				FROM pre_lista l
				INNER JOIN regiao r ON (l.id_regiao = r.id_regiao)
				INNER JOIN mes m ON (m.id_mes = l.mes_lista)
				LEFT OUTER JOIN usuario u ON (l.id_remetente = u.id_usuario)
				LEFT OUTER JOIN usuario d ON (l.id_destinatario = d.id_usuario)
				WHERE l.fg_ativo = 1 and l.id_destinatario = 0 ORDER BY l.id_pre_lista";
		$data['listasPendentes'] = $this->Crud_model->Query($sql);
		
		//Pesquisar as Listas Encaminhadas ao usuario
		$sql = "SELECT l.id_pre_lista, m.nome_mes, l.data_lista, r.nome_regiao, u.user as remetente, l.file_lista
				FROM pre_lista l
				INNER JOIN regiao r ON (l.id_regiao = r.id_regiao)
				INNER JOIN mes m ON (m.id_mes = l.mes_lista)
				LEFT OUTER JOIN usuario u ON (l.id_remetente = u.id_usuario)
				LEFT OUTER JOIN usuario d ON (l.id_destinatario = d.id_usuario)
				WHERE l.fg_ativo = 1 and d.id_usuario = $id_user ORDER BY l.id_pre_lista";

		$data['listasPendentesUser'] = $this->Crud_model->Query($sql);
		
		//die(var_dump($data['listasPendentesUser']));

		//Contador de listas pendentes ao usuario
		$sql = "SELECT count(*) as qtd
				FROM pre_lista l
				LEFT OUTER JOIN usuario u ON (l.id_destinatario = u.id_usuario)
				WHERE l.fg_ativo = 1  and u.id_usuario = $id_user";

		$data['qtdListasPendentes'] = $this->Crud_model->Query($sql);
		$data['qtdListasPendentes'] = $data['qtdListasPendentes'][0]->qtd;
		
		//buscar historico dos usuarios
		$sql = "SELECT u.nome, u.img_perfil, r.nome_regiao FROM lista l 
			INNER JOIN regiao r ON (l.id_regiao = r.id_regiao) 
			INNER JOIN usuario u ON (l.id_usuario = u.id_usuario)
			where l.fg_ativo = 1 ORDER by l.id_lista desc limit 10";
		$data['noticias'] = $this->Crud_model->Query($sql);	

		$this->load->view('adm/user/profile', $data);
		
		
		else:
			redirect(base_url('login'));
		endif;
	}

	public function Contato()
	{
		
		$header['title'] = "Paciente Móvel | Contato"; 

		$this->load->view('commons/header',$header);
		$this->load->view('page-principal/contato');
		$this->load->view('commons/footer',$header);
		
	}
	
	public function News()
	{

		if($this->input->post() == false) {

			redirect(base_url());

		}

		$dataRegister = $this->input->post();
		$data['error'] = null;
		$data['sucess'] = null;
		$dataModel = array ('nome_contato' => $dataRegister['nome'],'email_contato' => $dataRegister['email'],'id_regiao' => $dataRegister['regiao']);
		$nome = $dataRegister['nome'];
		$data['nome'] = $nome;
		$email = $dataRegister['email'];
		$regiao = $dataRegister['regiao'];
		
		$sql = "SELECT COUNT(1) as i, id_contato, fg_ativo FROM contato WHERE email_contato like '$email'";

		$exist = $this->Crud_model->Query($sql);

		//die(var_dump($exist));
		if($exist[0]->i > 0) {
			
			if($exist[0]->fg_ativo == 0){
				$par = array('id_contato' => $exist[0]->id_contato);
				$dataModel = array('fg_ativo' => 1);
				$res = $this->Crud_model->Update('contato',$dataModel,$par);
				if ($res) {
					$data['sucess'] = "E-mail ".$email." foi cadastrado em nossa base de dados";
				}else{
					$data['error'] = "Erro ao inserrir e-mail";
				}
			}else{
				$data['error'] = "O email '".$email."' já se encontra cadastrado.";
 				}

 		}else{
					
				$this->load->library('myemail');
				$dados = array("nome" => $nome, "email" => $email);
				if($this->myemail->Cadastrar($dados)){
						$result = $this->Crud_model->Insert('contato',$dataModel);
						$data['sucess'] = "Enviamos a Confirmação do seu cadastro em seu e-mail, verifique sua caixa de entrada.";
				 }else {
						$data['error'] = "Não conseguimos enviar confirmação para o e-mail ".$email;
				}

		}

		$header['title'] = "Paciente Móvel | Registro de email";
		$this->load->view('adm/commons/header',$header);
		$this->load->view('adm/mail/confirmacao',$data);
		$this->load->view('adm/commons/footer',$data);		

	}

	public function Cancelar(){
		
		$data['error'] = null;
		$data['sucess'] = null;
		

		$this->form_validation->set_rules('email','E-mail','required|valid_email|trim');
	    
	    if($this->form_validation->run() == FALSE)
	   	{
	      $data['error'] = validation_errors();
	    }
	    else
	    {
	    	$email = $this->input->post('email');

	    	$sql = "SELECT COUNT(1) as i, id_contato FROM contato WHERE email_contato LIKE '$email' and fg_ativo = 1";
	    	$res = $this->Crud_model->Query($sql);

	    	
	    	if($res[0]->i > 0){
	    		$par = array('id_contato' => $res[0]->id_contato);
	    		$dataModel = array('fg_ativo' => 0);
	    		$res = $this->Crud_model->Update('contato',$dataModel,$par);
	    		if($res){
	    			$data['sucess'] = "Cancelamento ocorrido com sucesso";
	    		}else{
	    			$data['error'] = "Erro na solicitação de dados. Envie um email para gbaquiaovidigal@hotmail.com";
	    		}
	    	}else{
	    		$data['error'] = "E-mail não encontrado";
	    	}

	    }

		$this->load->view('commons/header',$data);
		$this->load->view('adm/mail/cancelar-assinatura',$data);
		$this->load->view('commons/footer',$data);
	}



}
