<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Veiculo extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function Register(){

        $nivel_user = 2; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

            $data['success'] = null;


            $this->form_validation->set_rules('veiculo', 'Descriçao do veículo', 'required|min_length[4]|trim');
            $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[7]|trim');
           // $this->form_validation->set_rules('cidade', 'Cidade', 'required|is_natural_no_zero|trim', array('is_natural_no_zero' => ' Você não selecionou a Cidade'));

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
                if ($data['error'] == NULL) {
                    /* Se a validação do dados ainda nao ocorreu, entao o que retorna
                    no formulario é vazio,*/
                    $data['dataRegister'] = array('veiculo' => '', 'placa' => '');
                } else {

                    $data['dataRegister'] = $this->input->post();
                    //die(var_dump($data['dataRegister']));
                    /* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar
                    tudo novamente no formulario*/
                }
            } else {
                $dataRegister = $this->input->post();

                $dataModel = array(
                    'ds_veiculo' => $dataRegister['veiculo'],
                    'placa' => $dataRegister['placa']);
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
            /*cidades
            $data['cidades'] = $this->Crud_model->ReadAll('cidade');*/
            $header['title'] = "Paciente Móvel | Veículos";
            $this->load->view('adm/commons/header', $header);
            $this->load->view('adm/cadastro/veiculo/cadastro-veiculo', $data);
            $this->load->view('adm/commons/footer');
        else:
            redirect(base_url('login'));
        endif;

    }

    public function Listar(){

        $nivel_user = 1; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)) {

            #veiculos
            $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[7]|trim');

            if ($this->form_validation->run() == FALSE) {

                $sql = "SELECT id_veiculo, ds_veiculo, placa
				FROM veiculo
				WHERE fg_ativo = 1 ORDER BY id_veiculo desc limit 10";

                $data['dataForm'] = ''; //Campo pesqusia vazio

            } else {
                $dataRegister = $this->input->post('placa');

                $sql = "SELECT id_veiculo, ds_veiculo, placa
				FROM veiculo
				WHERE fg_ativo = 1 and ds_veiculo like '%$dataRegister%' ORDER BY id_veiculo desc limit 10";

                $data['dataForm'] = $dataRegister; //Campo pesquisa com o que foi pesquisado
            }

            //consultando
            $data['veiculos'] = $this->Crud_model->Query($sql);

            $header['title'] = "Paciente Móvel | Veículos";
            $this->load->view('adm/commons/header', $header);
            $this->load->view('adm/cadastro/veiculo/veiculo', $data);
            $this->load->view('adm/commons/footer');

        } else {
            redirect(base_url('login'));
        }
    }

    public function Editar(){

        $nivel_user = 1; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tipo_usuario') <= $nivel_user)):

            //validar dados

            $this->form_validation->set_rules('veiculo', 'Descriçao do veículo', 'required|min_length[4]|trim');
            $this->form_validation->set_rules('placa', 'Placa', 'required|min_length[7]|trim');

            // Se ainda não foi inserido o formulario
            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();

                // Verificando se a validação ainda não ocorreu
                if ($data['error'] == NULL) {
                    /* Se a validação do dados ainda nao ocorreu, entao o que retorna
                    no formulario é o que vai ser editado*/

                    // Verificando se a url passada tem o parametro de consulta
                    if ($this->input->get('id') == FALSE) {

                        //Não havendo o parametro, redireciona a pagina
                        redirect(base_url('adm/veiculos'));

                    } else { //Se existir o parametro, faz a consulta no banco de dados
                        $id = (int)$this->input->get('id');
                        //formular consulta
                        $dataModel = array('id_veiculo' => $id);

                        $result = $this->Crud_model->Read('veiculo', $dataModel);

                        // Se houver resultado, devolve o array com dados da consulta
                        if ($result) {
                            $data['dataRegister'] =
                                array(
                                    'id_veiculo' => $result->id_veiculo,
                                    'veiculo' => $result->ds_veiculo,
                                    'placa' => $result->placa);
                            //$data['cidades'] = $this->Crud_model->ReadAll('cidade');
                        }
                        //die(var_dump($data['dataRegister']));
                    }

                    // Se a validação ocorreu e existe erros
                } else {
                    /* Se ocorreu, os dados retorna para os campos, para o usuario nao precisar digitar tudo novamente no formulario*/
                    $result = true;
                    $data['dataRegister'] = $this->input->post();
                    //$data['cidades'] = $this->Crud_model->ReadAll('cidade');
                    //die(var_dump($data['dataRegister']));
                }

                // Se não existir erros na validação, então insere no banco de dados
            } else {

                $dataRegister = $this->input->post();
                $par = array('id_veiculo' => $dataRegister['id_veiculo']);
                $dataModel = array(
                    'ds_veiculo' => $dataRegister['veiculo'],
                    'placa' => $dataRegister['placa']);

                $res = $this->Crud_model->Update('veiculo', $dataModel, $par);
                if ($res) {
                    redirect(base_url('adm/veiculo?cod=1'));
                } else {
                    $data['error'] = "Erro ao inserir no Banco de dados";
                }
            }

            // Exibir telas para o usuario

            //Cabecalho
            $header['title'] = "Paciente Móvel | Veículos";
            $this->load->view('adm/commons/header', $header);

            //Se houver resultados na pesquisa, mostrar a pagina de edicao
            if ($result) {
                $this->load->view('adm/cadastro/veiculo/editar-veiculo', $data);

            } else { // Se não tiver resultado na pesquisa, exibe mensagem de erro (Possivelmente mudou a url)

                $data['mensagem'] = "Não existe dados para essa consulta, verifique o link e tente novamente";
                $data['link'] = "adm/usuarios";
                //Mensagem de erro se a url estiver invalida
                $this->load->view('errors/cli/meu_erro', $data);
            }

            //Rodape
            $this->load->view('adm/commons/footer');

        else: // Se não estiver logado redireciona para tela de login..
            redirect(base_url('login'));
        endif;

        //Fim da função
    }

    public function Remover(){

        $nivel_user = 1; //Nivel requirido para visualizar a pagina

        if (($this->session->userdata('logged')) and ($this->session->userdata('id_tu') <= $nivel_user)) {

            //Se a url nao tiver o parametro de consulta
            if ($this->input->get('id') == FALSE) {

                //redireciona para outra pagina
                redirect(base_url('adm/veiculos'));

            } else { // Se estiver tudo ok

                // Id recebe o paramentro da url
                $id = (int)$this->input->get('id');
                $dataModel = array('fg_ativo' => 0);
                $par = array('id_veiculo' => $id);
                $result = $this->Crud_model->Update('veiculo', $dataModel, $par);

                //Se ocorrer a remocao
                if ($result) {
                    redirect('adm/veiculo?cod=2');
                } else {
                    die('Erro na Remocao');
                }
            }
        } else {
            redirect(base_url('adm/login'));
        }
    }

}
