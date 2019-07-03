<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

        $this->load->model("auth/usuario");

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            redirect("dashboard");
        } else {
            $this->dados["returnUrl"] = $this->input->get("returnUrl");
            $this->load->view("auth/login", $this->dados);
        }
    }

    public function autenticar() {
        if ($this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                $this->usuario->preencherDados($this->input->post());
                $response = $this->usuario->autenticar();

                if ($response["resultado"]) {
                    $this->session->set_userdata([
                        "fv_cliente_usuario" => $response["dados"]->id,
                        "fv_cliente_nome" => $response["dados"]->nome,
                        "fv_cliente_foto" => $response["dados"]->foto,
                        "fv_cliente_cidade" => $response["dados"]->cidade,
                        "fv_cliente_uf" => $response["dados"]->uf,
                        sha1("fv_cliente") => TRUE
                    ]);

                    unset($response["dados"]);
                    !empty($this->input->post("returnUrl")) ? $response["returnUrl"] = $this->input->post("returnUrl") : NULL;
                }

                echo json_encode($response);
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação de dados"]);
            }
        } else {
            redirect("nao-autorizado");
        }
    }

    public function sair() {
        $this->session->sess_destroy();
        redirect();
    }

}
