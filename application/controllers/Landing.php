<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

    public function index()
    {
        $this->load->view('landing');
    }

    public function visitante()
    {
        try {
            $this->form_validation->set_rules('nome', 'Nome', array('trim', 'required', 'max_length[75]'));
            $this->form_validation->set_rules('dataNascimento', 'Data de Nascimento', array('trim', 'required'));
            $this->form_validation->set_rules('email', 'Email', array('trim', 'required', 'max_length[75]', 'valid_email'));
            $this->form_validation->set_rules('telefone', 'Telefone', array('trim', 'required'));
            $this->form_validation->set_rules('regiao', 'Regi&atilde;o', array('trim', 'required', 'max_length[20]'));
            $this->form_validation->set_rules('unidade', 'Unidade', array('trim', 'required', 'max_length[20]'));

            if ($this->form_validation->run() == false) {
                throw new Exception($this->form_validation->error_string(), 400);
            }

            $this->load->model('Visitante', 'objVisitanteModel', true);
            $this->objVisitanteModel->setNome($this->input->post('nome'));
            $this->objVisitanteModel->setDataNascimento($this->input->post('dataNascimento'));
            $this->objVisitanteModel->setEmail($this->input->post('email'));
            $this->objVisitanteModel->setTelefone($this->input->post('telefone'));
            $this->objVisitanteModel->setRegiao($this->input->post('regiao'));
            $this->objVisitanteModel->setUnidade($this->input->post('unidade'));

            $this->objVisitanteModel->manter();

            echo json_encode(
                array(
                    'idVisitante' => $this->objVisitanteModel->getIdVisitante(),
                    'nome' => $this->objVisitanteModel->getNome(),
                    'email' => $this->objVisitanteModel->getEmail(),
                    'telefone' => $this->objVisitanteModel->getTelefone(),
                    'regiao' => $this->objVisitanteModel->getRegiao(),
                    'unidade' => $this->objVisitanteModel->getUnidade(),
                    'dataNascimento' => $this->objVisitanteModel->getDataNascimento(),
                    'score' => $this->objVisitanteModel->getPontuacao(),
                    'token' => $this->objVisitanteModel->getToken()
                )
            );
            http_response_code(200);
        } catch(Exception $e) {
            echo json_encode($e->getMessage());
            http_response_code($e->getCode());
        }
    }

    public function lead()
    {
        try {
            $this->form_validation->set_rules('idVisitante', 'Contato', array('trim', 'required'));

            if ($this->form_validation->run() == false) {
                throw new Exception($this->form_validation->error_string(), 400);
            }

            $this->load->model('Lead', 'objLeadModel', true);
            $this->objLeadModel->setIdVisitante($this->input->post('idVisitante'));
            $this->objLeadModel->setPontuacao($this->input->post('pontuacao'));
            $this->objLeadModel->setEnviado($this->input->post('enviado'));

            $this->objLeadModel->inserir();

            echo json_encode($this->objLeadModel->getIdLead());
            http_response_code(200);
        } catch(Exception $e) {
            echo json_encode($e->getMessage());
            http_response_code($e->getCode());
        }
    }
}
