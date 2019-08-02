<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

        $this->load->model(["auth/usuario"]);

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            $response = $this->usuario->getById(base64_decode($this->session->fv_cliente_usuario));

            if ($response["resultado"]) {
                $this->dados["usuario"] = $response["usuario"];
                $this->dados["estados"] = $this->utils->getEstados();
                $this->dados["cidades"] = $this->utils->getCidadesByIdEstado($this->dados["usuario"]->idEstado, FALSE);
                $this->load->view("perfil/home", $this->dados);
            } else {
                redirect("dashboard");
            }
        } else {
            redirect();
        }
    }

    public function atualizarDadosPessoais() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                $this->usuario->preencherDados($this->input->post());
                echo json_encode($this->usuario->atualizarDadosPessoais());
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

    public function atualizarDadosAcesso() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                $this->usuario->preencherDados($this->input->post());
                echo json_encode($this->usuario->atualizarDadosAcesso());
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
    
    public function atualizarFotoPerfil() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if (!empty($_FILES["foto"]["name"])) {
                $fileNameFoto = "";
                if (!file_exists("./public/app/img/perfis")) {
                    mkdir("./public/app/img/perfis", 0755);
                }

                $config['upload_path'] = './public/app/img/perfis';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = sha1(date("Y-d-m_H-i-s"));
                $config['file_ext_tolower'] = true;
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload("foto")) {
                    echo json_encode($this->usuario->atualizarFotoPerfil($this->upload->data("file_name")));
                } else {
                    echo json_encode(["resultado" => FALSE, "msg" => "Não foi possível fazer o upload da sua foto de perfil"]);
                }
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
