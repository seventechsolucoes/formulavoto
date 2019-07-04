<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ConteudoExclusivo extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

//        $this->load->model("post");

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            $this->load->view("conteudo-exclusivo/home", $this->dados);
        } else {
            redirect();
        }
    }

}
