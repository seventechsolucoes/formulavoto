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
class Utils extends CI_Model {

    public function getEstados() {
        return $this->db
                        ->order_by("admin_estados.estado", "ASC")
                        ->get("admin_estados")->result();
    }

    public function getCidadeById($id, $returnArray = TRUE) {
        $response = $this->db
                        ->select("admin_cidades.*, admin_estados.uf")
                        ->join("admin_estados", "admin_estados.id=admin_cidades.idEstado")
                        ->where("admin_cidades.id", $id)
                        ->get("admin_cidades")->row();

        if ($returnArray) {
            if (!empty($response)) {
                return ["resultado" => TRUE, "cidade" => $response];
            } else {
                return ["resultado" => FALSE, "msg" => "Nenhuma cidade encontrada"];
            }
        } else {
            return $response;
        }
    }

    public function getCidadesByIdEstado($id, $returnArray = TRUE) {
        $response = $this->db
                        ->where("idEstado", $id)
                        ->order_by("admin_cidades.cidade", "ASC")
                        ->get("admin_cidades")->result();

        if ($returnArray) {
            if (!empty($response)) {
                return ["resultado" => TRUE, "cidades" => $response];
            } else {
                return ["resultado" => FALSE, "msg" => "Nenhuma cidade encontrada"];
            }
        } else {
            return $response;
        }
    }

    public function adicionarDownload($dados) {
        $this->db->trans_start();
        $this->db
                ->set([
                    "nome" => $dados["nome"],
                    "email" => $dados["email"],
                    "telefone" => $dados["telefone"],
                    "municipio" => $dados["municipio"],
                    "estado" => $dados["estado"],
                    "cargoPretendido" => $dados["cargoPretendido"],
                    "conteudo" => $dados["conteudo"],
                ])
                ->insert("admin_downloads_conteudo");
        $id = $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return [
                "resultado" => TRUE,
                "msg" => "Seu download já está disponível",
                "hash" => base64_encode($id)
            ];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível liberar o seu download, por favor tente novamente"];
        }
    }

    public function getPermissaoDownload($id) {
        $response = $this->db
                        ->where("id", base64_decode($id))
                        ->get("admin_downloads_conteudo")->row();

        if (!empty($response)) {
            return ["resultado" => TRUE, "conteudo" => $response->conteudo];
        } else {
            return ["resultado" => FALSE];
        }
    }

}
