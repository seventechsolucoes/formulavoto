<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Post
 *
 * @author Guilherme
 */
class Post extends CI_Model {

    private $id;
    private $idCliente;
    private $idEventoLembrete;
    private $evento;
    private $local;
    private $data;
    private $publicoPresente;
    private $assunto;
    private $autoridades;
    private $observacoes;
    private $status;
    private $dados;

    public function __construct() {
        parent::__construct();
        $this->load->model("uploader");
    }

    public function preencherDados($dados) {
        $this->id = !empty($dados["id"]) ? $dados["id"] : NULL;
        $this->idCliente = base64_decode($this->session->fv_cliente_usuario);
        $this->idEventoLembrete = !empty($dados["lembrete"]) ? $dados["lembrete"] : NULL;
        $this->evento = !empty($dados["evento"]) ? $dados["evento"] : NULL;
        $this->local = !empty($dados["local"]) ? $dados["local"] : NULL;
        $this->data = !empty($dados["data"]) ? date("Y-m-d", strtotime(str_replace("/", "-", $dados["data"]))) : NULL;
        $this->publicoPresente = !empty($dados["publicoPresente"]) ? $dados["publicoPresente"] : NULL;
        $this->assunto = !empty($dados["assunto"]) ? $dados["assunto"] : NULL;
        $this->autoridades = !empty($dados["autoridades"]) ? $dados["autoridades"] : NULL;
        $this->observacoes = !empty($dados["observacoes"]) ? $dados["observacoes"] : NULL;
        $this->status = !empty($dados["status"]) ? $dados["status"] : "aguardando";

        $this->dados = $dados;

        $this->uploader->preencherDados($dados);
    }

    public function getById($id) {
        $response = $this->db
                        ->select("clientes_informacoes_posts.*,"
                                . "clientes_arquivos.status as statusImagem,"
                                . "clientes_arquivos.arquivo")
                        ->join("clientes_informacoes_posts_arquivos", "clientes_informacoes_posts_arquivos.idInformacaoPost=clientes_informacoes_posts.id")
                        ->join("clientes_arquivos", "clientes_arquivos.id=clientes_informacoes_posts_arquivos.idArquivo")
                        ->where("clientes_informacoes_posts.id", $id)
                        ->get("clientes_informacoes_posts")->row();

        if (!empty($response)) {
            return ["resultado" => TRUE, "post" => $response];
        } else {
            return ["resultado" => FALSE, "msg" => "Nenhum post encontrado"];
        }
    }

    public function getByIdCliente($id) {
        $response = $this->db
                        ->select("clientes_informacoes_posts.*, clientes_arquivos.status as statusImagem")
                        ->join("clientes_informacoes_posts_arquivos", "clientes_informacoes_posts_arquivos.idInformacaoPost=clientes_informacoes_posts.id")
                        ->join("clientes_arquivos", "clientes_arquivos.id=clientes_informacoes_posts_arquivos.idArquivo")
                        ->order_by("clientes_informacoes_posts.data", "DESC")
                        ->where("clientes_informacoes_posts.idCliente", $id)
                        ->get("clientes_informacoes_posts")->result();

        if (!empty($response)) {
            return ["resultado" => TRUE, "posts" => $response];
        } else {
            return ["resultado" => FALSE, "msg" => "Nenhum post encontrado"];
        }
    }

    public function adicionar() {
        $this->db->trans_start();
        $this->db->insert("clientes_informacoes_posts", $this->toArray());
        $this->id = $this->db->insert_id();
        $idArquivo = $this->uploader->adicionar()["id"];
        $this->db->insert("clientes_informacoes_posts_arquivos", ["idInformacaoPost" => $this->id, "idArquivo" => $idArquivo]);
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return ["resultado" => TRUE, "msg" => "Informações registradas"];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível registrar as informações"];
        }
    }

    public function toArray() {
        return [
            "idCliente" => $this->idCliente,
            "idEventoLembrete" => $this->idEventoLembrete,
            "evento" => $this->evento,
            "local" => $this->local,
            "data" => $this->data,
            "publicoPresente" => $this->publicoPresente,
            "assunto" => $this->assunto,
            "autoridades" => $this->autoridades,
            "observacoes" => $this->observacoes,
            "status" => $this->status
        ];
    }

}
