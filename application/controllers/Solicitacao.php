<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitacao extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library(['form_validation','upload']);
    } 

    //pre lista
	public function RegisterPreSolicitacao() {
        $nivel_user = 2; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

            $data['success'] = null;

            $this->form_validation->set_rules('veiculo', 'Descriçao do veículo', 'required|min_length[4]|trim');
            $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[7]|trim');

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
                if ($data['error'] == NULL) {

                    $data['dataRegister'] = array('nome' => '', 'dataViagem' => '', 'acompanhantes' => 0, 'descricao' => '');
                } else {

                    $data['dataRegister'] = $this->input->post();
                }
            } else {
                $dataRegister = $this->input->post();

                $dataModel = array(
                    'ds_veiculo' => $dataRegister['nome'],
                    'ds_veiculo' => $dataRegister['veiculo'],
                    'ds_veiculo' => $dataRegister['veiculo'],
                    'ds_veiculo' => $dataRegister['veiculo'],
                    'placa' => $dataRegister['placa']
                );


                $res = $this->Crud_model->Insert('veiculo', $dataModel);

                if ($res) {
                    $data['error'] = null;
                    // os dados voltam vazios novamente depois da confirmação
                    $data['dataRegister'] = array('placa' => '', 'veiculo' => '');
                    $data['success'] = "Veículo inserida com sucesso";
                } else {
                    $data['error'] = "Não foi possivel inserir a veiculo";
                }
            }

            $data['cidades'] = $this->Crud_model->ReadAll('cidade');

            $header['title'] = "Paciente Móvel  | Pré Solicitação";
            $this->load->view('adm/commons/header',$header);
            $this->load->view('adm/cadastro/solicitacao/cadastro-pre-solicitacao',$data);
            $this->load->view('adm/commons/footer');

        else:
            redirect(base_url('login'));
        endif;

    }

    public function Listar()
    {
        $nivel_user = 1; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {

            //$this->form_validation->set_rules('placa', 'Placa', 'required|min_length[7]|trim');

            if ($this->form_validation->run() == FALSE) {

                $sql = "SELECT id_solicitacao, nome_solicitacao, descricao, tipo_solicitacao, DATE_FORMAT(data_viagem ,'%d %b %Y') as data_viagem, 
                      o.nome_cidade as origem, d.nome_cidade as destino, acompanhantes, status, horario_saida, m.nome as motorista, m.id_usuario as id_motorista, v.ds_veiculo, v.id_veiculo, 
                      su.nome as solicitante, au.nome as autorizador, DATE_FORMAT(data_autorizacao ,'%d %b %Y') as data_autorizacao, observacao
                    FROM solicitacao s
                    INNER JOIN usuario su ON (su.id_usuario = s.solicitante)
                    LEFT JOIN usuario au ON (au.id_usuario = s.autorizador)
                    INNER JOIN cidade o ON (o.id_cidade = s.origem)
                    INNER JOIN cidade d ON (d.id_cidade = s.destino)
                    LEFT JOIN veiculo v ON (v.id_veiculo = s.veiculo)
                    LEFT JOIN usuario m ON (m.id_usuario = s.motorista)
                    WHERE s.fg_ativo = 1";

                $data['dataForm'] = ''; //Campo pesqusia vazio

            } else {
                $dataRegister = $this->input->post();

                $sql = "SELECT id_veiculo, ds_veiculo, placa
				FROM veiculo
				WHERE fg_ativo = 1 and ds_veiculo like '%$dataRegister%' ORDER BY id_veiculo desc limit 10";

                $data['dataForm'] = $dataRegister; //Campo pesquisa com o que foi pesquisado
            }

            //consultando
            $data['solicitacoes'] = $this->Crud_model->Query($sql);
            $data['motoristas'] = $this->Crud_model->Query("SELECT * FROM usuario WHERE id_tipo_usuario = 3 AND fg_ativo = 1");
            $data['veiculos'] = $this->Crud_model->Query("SELECT * FROM veiculo WHERE fg_ativo = 1");

            $header['title'] = "Paciente Móvel | Solicitações";
            $this->load->view('adm/commons/header', $header);
            $this->load->view('adm/cadastro/solicitacao/solicitacoes',$data);
            $this->load->view('adm/commons/footer');

        } else {
            redirect(base_url('login'));
        }

    }

    public function AprovarSolicitacao() {

        $nivel_user = 1; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {

            if ($this->input->post()) {

                $dataRegister = $this->input->post();


                $id_solicitacao = $dataRegister['id_solicitacao'];
                $horario_saida = $dataRegister['horario_saida'];
                $motorista = $dataRegister['motorista'];
                $veiculo = $dataRegister['veiculo'];
                $status = $dataRegister['status'];
                $observacao = $dataRegister['observacao'];

                $par = array('id_solicitacao' => $id_solicitacao);

                if ($status == 1) {
                    $dataModel = array(
                        'horario_saida' => $horario_saida,
                        'motorista' => $motorista,
                        'veiculo' => $veiculo,
                        'status' => $status,
                        'observacao' => $observacao,
                        'data_autorizacao' => date("Y-m-d H:i:s"),
                        'autorizador' => $this->session->userdata('id_usuario')
                    );

                } else {
                    $dataModel = array(
                        'status' => $status,
                        'observacao' => $observacao,
                        'data_autorizacao' => date("Y-m-d H:i:s"),
                        'autorizador' => $this->session->userdata('id_usuario')
                    );
                }

                $this->Crud_model->Update('solicitacao', $dataModel, $par);

            }

            redirect(base_url('adm/solicitacoes?cod=1'));

        } else {
            redirect(base_url('login'));
        }
    }
    
}