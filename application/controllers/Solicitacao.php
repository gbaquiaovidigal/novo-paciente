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

            $this->form_validation->set_rules('nome', 'Nome da Solicitação', 'required|min_length[4]|trim');
            $this->form_validation->set_rules('descricao', 'Descrição da Solicitação', 'required|min_length[4]|trim');
            $this->form_validation->set_rules('tipoSolicitacao', 'Tipo da Solicitação', 'required|trim');
            //$this->form_validation->set_rules('dataViagem', 'Data da Viagem', 'required|trim');
            //$this->form_validation->set_rules('origem', 'Local de origem', 'required|min_length[4]|trim');
            //$this->form_validation->set_rules('destino', 'Local de destino', 'required|min_length[4]|trim');
            $this->form_validation->set_rules('acompanhantes', 'Número de Acompanhantes', 'required' );

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
                    'nome_solicitacao' => $dataRegister['nome'],
                    'descricao' => $dataRegister['descricao'],
                    'tipo_solicitacao' => $dataRegister['tipoSolicitacao'],
                    //'data_viagem' => $dataRegister['dataViagem'],
                    //'origem' => $dataRegister['origem'],
                    //'destino' => $dataRegister['destino'],
                    'acompanhantes' => $dataRegister['acompanhantes'],
                );


                $res = $this->Crud_model->Insert('solicitacao', $dataModel);

                if ($res) {
                    $data['error'] = null;
                    // os dados voltam vazios novamente depois da confirmação
                    $data['dataRegister'] = array('nome' => '', 'dataViagem' => '', 'tipoSolicitacao' => '', 'acompanhantes' => 0, 'descricao' => '');
                    $data['success'] = "Solicitação enviada com sucesso";
                } else {
                    $data['error'] = "Não foi possivel criar a solicitação";
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

            #veiculos
            $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[7]|trim');

            if ($this->form_validation->run() == FALSE) {

                $sql = "SELECT id_solicitacao, nome_solicitacao, descricao, tipo_solicitacao, DATE_FORMAT(data_viagem ,'%d %b %Y') as data_viagem, o.nome_cidade as origem, d.nome_cidade as destino, acompanhantes, status, horario_saida, m.nome as motorista, v.ds_veiculo, su.nome as solicitante, au.nome as autorizador, data_autorizacao
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
                $dataRegister = $this->input->post('placa');

                $sql = "SELECT id_veiculo, ds_veiculo, placa
				FROM veiculo
				WHERE fg_ativo = 1 and ds_veiculo like '%$dataRegister%' ORDER BY id_veiculo desc limit 10";

                $data['dataForm'] = $dataRegister; //Campo pesquisa com o que foi pesquisado
            }

            //consultando
            $data['solicitacoes'] = $this->Crud_model->Query($sql);

            $header['title'] = "Paciente Móvel | Solicitações";
            $this->load->view('adm/commons/header', $header);
            $this->load->view('adm/cadastro/solicitacao/solicitacoes',$data);
            $this->load->view('adm/commons/footer');

        } else {
            redirect(base_url('login'));
        }

    }
    
}