<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agendas extends CI_Controller {

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
            $this->load->view("agendas/home", $this->dados);
        } else {
            redirect();
        }
    }

    public function get() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            echo json_encode($this->agenda->getAll());
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

    public function vAdicionar() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            $this->load->view("agendas/adicionar", $this->dados);
        } else {
            redirect();
        }
    }

    public function vAtualizar($id) {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            if (!empty($id) && is_numeric($id)) {
                $response = $this->agenda->getById($id);

                if ($response["resultado"]) {
                    if ($response["evento"]->status == "aguardando" || "atrasado") {
                        $this->dados["evento"] = $response["evento"];
                        $this->load->view("agendas/atualizar", $this->dados);
                    } else {
                        redirect("agendas");
                    }
                } else {
                    redirect("agendas");
                }
            } else {
                redirect("agendas");
            }
        } else {
            redirect();
        }
    }

    public function adicionar() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                $this->agenda->preencherDados($this->input->post());
                echo json_encode($this->agenda->adicionar());
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
            }
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

    public function atualizar() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                $this->agenda->preencherDados($this->input->post());
                echo json_encode($this->agenda->atualizar());
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
            }
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

    public function filtrar() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if (!empty($this->input->post("titulo"))) {
                echo json_encode($this->agenda->filtrar($this->input->post("titulo")));
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
            }
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

    public function atualizarStatus() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                echo json_encode($this->agenda->atualizarStatus($this->input->post()));
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
            }
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

    public function excluir() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if (!empty($this->input->post("id")) && is_numeric($this->input->post("id"))) {
                echo json_encode($this->agenda->excluir($this->input->post("id")));
            } else {
                echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
            }
        } else {
            if ($this->input->post("ajax")) {
                echo json_encode(["resultado" => FALSE, "sessaoExpirada" => TRUE]);
            } else {
                redirect("nao-autorizado");
            }
        }
    }

}
