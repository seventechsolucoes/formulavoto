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
class Agenda extends CI_Model {

    private $id;
    private $idCliente;
    private $titulo;
    private $descricao;
    private $hora;
    private $data;
    private $observacoes;
    private $status;

    public function preencherDados($dados) {
        $this->id = !empty($dados["id"]) ? $dados["id"] : NULL;
        $this->idCliente = !empty($dados["cliente"]) ? $dados["cliente"] : NULL;
        $this->titulo = !empty($dados["titulo"]) ? $dados["titulo"] : NULL;
        $this->descricao = !empty($dados["descricao"]) ? $dados["descricao"] : NULL;
        $this->hora = !empty($dados["hora"]) ? $dados["hora"] : NULL;
        $this->data = !empty($dados["data"]) ? date("Y-m-d", strtotime(str_replace("/", "-", $dados["data"]))) : NULL;
        $this->observacoes = !empty($dados["observacoes"]) ? $dados["observacoes"] : NULL;
        $this->status = !empty($dados["status"]) ? $dados["status"] : "aguardando";
    }

    public function getById($id, $returnArray = TRUE) {
        $response = $this->db
                        ->order_by("data", "DESC")
                        ->order_by("hora", "ASC")
                        ->where([
                            "id" => $id,
                            "idCliente" => base64_decode($this->session->fv_cliente_usuario)
                        ])
                        ->get("clientes_eventos_lembretes")->row();

        if ($returnArray) {
            if (!empty($response)) {
                return ["resultado" => TRUE, "evento" => $response];
            } else {
                return ["resultado" => FALSE, "msg" => "Nenhum evento encontrado"];
            }
        } else {
            return $response;
        }
    }

    public function getAll($returnArray = TRUE) {
        $response = $this->db
                        ->order_by("data", "DESC")
                        ->order_by("hora", "ASC")
                        ->where("idCliente", base64_decode($this->session->fv_cliente_usuario))
                        ->get("clientes_eventos_lembretes")->result();

        if ($returnArray) {
            if (!empty($response)) {
                return ["resultado" => TRUE, "eventos" => $response];
            } else {
                return ["resultado" => FALSE, "msg" => "Nenhum evento encontrado"];
            }
        } else {
            return $response;
        }
    }

    public function adicionar() {
        $this->db->trans_start();
        $this->db->insert("clientes_eventos_lembretes", $this->toArray());
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return ["resultado" => TRUE, "msg" => "Evento adicionado"];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível adicionar o evento"];
        }
    }

    public function atualizar() {
        $this->db->trans_start();
        $this->db
                ->where("id", $this->id)
                ->update("clientes_eventos_lembretes", $this->toArray());
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return ["resultado" => TRUE, "msg" => "Evento atualizado"];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível atualizar o evento"];
        }
    }

    public function filtrar($dados) {
        $this->db
                ->order_by("data", "DESC")
                ->order_by("hora", "ASC")
                ->group_by("id")
                ->where("idCliente", base64_decode($this->session->fv_cliente_usuario));
        if ($dados["status"] != "todos") {
            $this->db->where("status", $dados["status"]);
        }

        if (!empty($dados["titulo"])) {
            $this->db->like("titulo", $dados["titulo"]);
        }

        if (!empty($dados["dataInicial"]) && !empty($dados["dataFinal"])) {
            $this->db->where("data BETWEEN '" . date("Y-m-d", strtotime(str_replace("/", "-", $dados["dataInicial"]))) . "' AND '" . date("Y-m-d", strtotime(str_replace("/", "-", $dados["dataFinal"]))) . "'");
        } else {
            if (!empty($dados["dataInicial"])) {
                $this->db->where("data BETWEEN '" . date("Y-m-d", strtotime(str_replace("/", "-", $dados["dataInicial"]))) . "' AND '" . date("Y-m-d", strtotime(str_replace("/", "-", $dados["dataInicial"]))) . "'");
            }
            if (!empty($dados["dataFinal"])) {
                $this->db->where("data BETWEEN '" . date("Y-m-d", strtotime(str_replace("/", "-", $dados["dataFinal"]))) . "' AND '" . date("Y-m-d", strtotime(str_replace("/", "-", $dados["dataFinal"]))) . "'");
            }
        }

        $response = $this->db->get("clientes_eventos_lembretes")->result();

        if (!empty($response)) {
            return ["resultado" => TRUE, "eventos" => $response];
        } else {
            return ["resultado" => FALSE, "msg" => "Nenhum evento encontrado"];
        }
    }

    public function atualizarStatus($dados) {
        $this->db->trans_start();
        $this->db
                ->where("id", $dados["id"])
                ->update("clientes_eventos_lembretes", ["status" => $dados["status"]]);
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return ["resultado" => TRUE, "eventos" => $this->getAll(FALSE)];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível atualizar o status"];
        }
    }

    public function excluir($id) {
        $this->db->trans_start();
        $this->db
                ->where("id", $id)
                ->update("clientes_eventos_lembretes", ["status" => "excluido"]);
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return ["resultado" => TRUE, "eventos" => $this->getAll(FALSE)];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível excluir o evento"];
        }
    }

    public function cobrarAgenda() {
        $rangeDatas = [
            date("Y-m-d"),
            date("Y-m-d", strtotime("+1 days", strtotime(date("Y-m-d")))),
            date("Y-m-d", strtotime("+2 days", strtotime(date("Y-m-d")))),
            date("Y-m-d", strtotime("+3 days", strtotime(date("Y-m-d")))),
            date("Y-m-d", strtotime("+4 days", strtotime(date("Y-m-d")))),
            date("Y-m-d", strtotime("+5 days", strtotime(date("Y-m-d")))),
            date("Y-m-d", strtotime("+6 days", strtotime(date("Y-m-d")))),
        ];
        $response = $this->db
                        ->select("COUNT(data) AS total")
                        ->where_in("data", $rangeDatas)
                        ->where([
                            "idCliente" => base64_decode($this->session->fv_cliente_usuario),
                            "status <> " => "excluido",
                        ])
                        ->group_by("data")
                        ->get("clientes_eventos_lembretes")->result();
        if (COUNT($response) >= 5) {
            return NULL;
        } else {
            return [
                [
                    "msg" => "<strong>Atenção</strong>: Atualize a sua agenda de eventos",
                    "tipoNotificacao" => (COUNT($response) > 2 ? "alert-warning" : "alert-danger"),
                    "icone" => (COUNT($response) > 2 ? '<i class="fas fa-bell"></i>' : '<i class="fas fa-exclamation-circle"></i>')
                ]
            ];
        }
    }

    public function toArray() {
        return [
            "idCliente" => $this->idCliente,
            "titulo" => $this->titulo,
            "descricao" => $this->descricao,
            "hora" => $this->hora,
            "data" => $this->data,
            "observacoes" => $this->observacoes,
            "status" => $this->status
        ];
    }

}
