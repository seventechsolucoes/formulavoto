<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ups extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

        $this->load->model("post");

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            $this->load->view("arquivos/upload", $this->dados);
        } else {
            redirect();
        }
    }

    public function enviar() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente") && $this->input->post("ajax")) {
            if ($this->form_validation->run()) {
                $dados = $this->input->post();
                if (!empty($_FILES["arquivo"]["name"])) {
                    if (!file_exists("./public/app/img/arquivos")) {
                        mkdir("./public/app/img/arquivos", 0755);
                    }
                    $config['upload_path'] = './public/app/img/arquivos';
                    $config['allowed_types'] = 'png|jpg|jpeg|avi|mp4|pdf|doc|docx';
                    $config['file_name'] = sha1(date("Y-d-m_H-i-s"));
                    $config['file_ext_tolower'] = true;
                    $config['overwrite'] = true;

                    $this->load->library('upload', $config);

                    $this->upload->do_upload("arquivo") ? $dados["arquivo"] = $this->upload->data("file_name") : NULL;
                }

                $this->post->preencherDados($dados);
                echo json_encode($this->post->adicionar());
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
