<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

        $this->load->model("relatorio");

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            $this->load->view("relatorios/home", $this->dados);
        } else {
            redirect();
        }
    }

    public function getEstatisticas() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            echo json_encode($this->relatorio->getEstatisticasByIdCliente(base64_decode($this->session->fv_cliente_usuario)));
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

}
