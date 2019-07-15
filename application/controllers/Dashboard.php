<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

        $this->load->model(["agenda"]);

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            $this->dados["notificacoesAgenda"] = $this->agenda->cobrarAgenda();
            $this->load->view("dashboard/home", $this->dados);
        } else {
            redirect();
        }
    }

}
