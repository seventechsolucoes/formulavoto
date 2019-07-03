<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uploader
 *
 * @author Guilherme
 */
class Uploader extends CI_Model {

    private $id;
    private $arquivo;
    private $tipo;

    public function preencherDados($dados) {
        $this->id = !empty($dados["id"]) ? $dados["id"] : NULL;
        $this->arquivo = !empty($dados["arquivo"]) ? $dados["arquivo"] : NULL;
        $this->tipo = !empty($dados["tipo"]) ? $dados["tipo"] : NULL;
    }

    public function adicionar() {
        $this->db->trans_start();
        $this->db->insert("clientes_arquivos", $this->toArray());
        $this->id = $this->db->insert_id();
        $this->db->insert("clientes_clientes_uploads", ["idCliente" => base64_decode($this->session->fv_cliente_usuario), "idUpload" => $this->id]);
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return ["resultado" => FALSE, "msg" => "Arquivo enviado com sucesso", "id" => $this->id];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível fazer o upload do arquivo"];
        }
    }

    public function toArray() {
        return [
            "arquivo" => $this->arquivo,
            "tipo" => $this->tipo
        ];
    }

}
