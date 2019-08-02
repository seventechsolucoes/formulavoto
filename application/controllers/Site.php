<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

//        $this->load->model("auth/usuario");

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
        $this->dados["videos"] = [
            "0" => ["formula-voto-video-01.mp4", "formula-voto-video-destaque.mp4"],
            "1" => ["formula-voto-video-02.mp4", "formula-voto-video-01.mp4"],
            "2" => ["formula-voto-video-destaque.mp4", "formula-voto-video-02.mp4"],
            "3" => ["formula-voto-video-01.mp4", "formula-voto-video-destaque.mp4"],
            "4" => ["formula-voto-video-02.mp4", "formula-voto-video-01.mp4"],
            "5" => ["formula-voto-video-destaque.mp4", "formula-voto-video-02.mp4"],
            "6" => ["formula-voto-video-01.mp4", "formula-voto-video-destaque.mp4"],
        ];
    }

    public function index() {
        if ($this->sessao->isAutorizado($this->session, "fv_cliente")) {
            redirect("dashboard");
        } else {
            $this->load->view('site/home', $this->dados);
        }
    }

    public function download() {
        if ($this->form_validation->run()) {
            echo json_encode($this->utils->adicionarDownload($this->input->post()));
        } else {
            echo json_encode(["resultado" => FALSE, "msg" => "Falha na validação dos dados"]);
        }
    }

    public function baixarMaterial() {
        if (!empty($this->input->get("permissao"))) {
            $response = $this->utils->getPermissaoDownload($this->input->get("permissao"));

            if ($response["resultado"]) {
                $this->load->helper('download');
                force_download("ebook.pdf", file_get_contents("./public/app/arquivos/" . md5($response["conteudo"]) . ($response["conteudo"] == "ebook" ? ".pdf" : ".mp3")));
            } else {
                redirect();
            }
        } else {
            redirect();
        }
    }

}
