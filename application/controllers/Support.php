<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function accessToken() {
        echo "<h1>{$this->input->get["access_token"]}</h1>";
    }

    public function getCidadesByEstado() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if (!empty($this->input->post("idEstado")) && is_numeric($this->input->post("idEstado"))) {
                echo json_encode($this->utils->getCidadesByIdEstado($this->input->post("idEstado")));
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
            }
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect();
            }
        }
    }

}
