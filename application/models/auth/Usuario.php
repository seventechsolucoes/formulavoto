<?php

Class Usuario extends CI_Model {

    private $id;
    private $nome;
    private $email;
    private $usuario;
    private $senha;
    private $idCidade;
    private $status;

    public function preencherDados($dados) {
        $this->id = !empty($dados["id"]) ? $dados["id"] : null;
        $this->nome = !empty($dados["nome"]) ? $dados["nome"] : null;
        $this->email = !empty($dados["email"]) ? $dados["email"] : null;
        $this->usuario = !empty($dados["usuario"]) ? $dados["usuario"] : null;
        $this->senha = !empty($dados["senha"]) ? sha1($dados["senha"]) : null;
        $this->idCidade = !empty($dados["cidade"]) ? $dados["cidade"] : null;
        $this->status = !empty($dados["status"]) ? $dados["status"] : "ativo";
    }

    public function getById($id, $returnArray = TRUE) {
        $response = $this->db
                        ->select("clientes_clientes.*,"
                                . "admin_cidades.idEstado as idEstado")
                        ->where("clientes_clientes.id", $id)
                        ->join("admin_cidades", "admin_cidades.id=clientes_clientes.idCidade")
                        ->join("admin_estados", "admin_estados.id=admin_cidades.idEstado")
                        ->get("clientes_clientes")->row();

        if ($returnArray) {
            if (!empty($response)) {
                return ["resultado" => TRUE, "usuario" => $response];
            } else {
                return ["resultado" => FALSE, "msg" => "Nenhum usuário encontrado"];
            }
        } else {
            return $response;
        }
    }

    public function atualizarDadosPessoais() {
        $this->db->trans_start();
        $this->db
                ->where("id", base64_decode($this->session->fv_cliente_usuario))
                ->set([
                    "nome" => $this->nome,
                    "email" => $this->email,
                    "idCidade" => $this->idCidade
                ])
                ->update("clientes_clientes");
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            $responseCidade = $this->utils->getCidadeById($this->idCidade, FALSE);

            $this->session->set_userdata([
                "fv_cliente_nome" => $this->nome,
                "fv_cliente_cidade" => $responseCidade->cidade,
                "fv_cliente_uf" => $responseCidade->uf,
            ]);
            return ["resultado" => TRUE, "msg" => "Perfil atualizado"];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível atualizar o seu perfil"];
        }
    }

    public function atualizarDadosAcesso() {
        $responseUsuarioExistente = $this->usuarioExistente($this->usuario);

        if ($responseUsuarioExistente["resultado"]) {
            $this->db->trans_start();
            $this->db
                    ->where("id", base64_decode($this->session->fv_cliente_usuario))
                    ->set([
                        "usuario" => $this->usuario,
                        "senha" => $this->senha,
                    ])
                    ->update("clientes_clientes");
            $this->db->trans_complete();

            if ($this->db->trans_status()) {
                $this->session->set_userdata("fv_cliente_usuario", $this->usuario);
                return ["resultado" => TRUE, "msg" => "Dados de acesso atualizados"];
            } else {
                return ["resultado" => FALSE, "msg" => "Não foi possível atualizar os seus dados de acesso"];
            }
        } else {
            return $responseUsuarioExistente;
        }
    }

    public function atualizarFotoPerfil($filename) {
        $this->db->trans_start();
        $this->db
                ->where("id", base64_decode($this->session->fv_cliente_usuario))
                ->update("clientes_clientes", ["foto" => $filename]);
        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            $this->session->set_userdata("fv_cliente_foto", $filename);
            return ["resultado" => TRUE, "filename" => $filename, "msg" => "Perfil atualizado"];
        } else {
            return ["resultado" => FALSE, "msg" => "Não foi possível atualizar sua foto de perfil"];
        }
    }

    public function autenticar() {
        $response = $this->db
                        ->select("clientes_clientes.*,"
                                . "admin_cidades.cidade,"
                                . "admin_estados.uf")
                        ->where([
                            "usuario" => $this->usuario,
                            "senha" => $this->senha
                        ])
                        ->join("admin_cidades", "admin_cidades.id=clientes_clientes.idCidade")
                        ->join("admin_estados", "admin_estados.id=admin_cidades.idEstado")
                        ->get("clientes_clientes")->row();

        if (!empty($response)) {
            return $this->validarStatus($response);
        } else {
            return ["resultado" => FALSE, "msg" => "Usuário ou senha incorreto"];
        }
    }

    private function validarStatus($usuario) {
        switch ($usuario->status) {
            case "ativo":
                return ["resultado" => TRUE, "dados" => $usuario];
            case "bloqueado":
                return ["resultado" => FALSE, "msg" => "Sua conta está bloqueada"];
            default:
                return ["resultado" => FALSE, "msg" => "Não foi possível determinar o status da sua conta"];
        }
    }

    public function toArray() {
        return [
            "nome" => $this->nome,
            "email" => $this->email,
            "usuario" => $this->usuario,
            "senha" => $this->senha,
            "status" => $this->status,
        ];
    }

    private function usuarioExistente($usuario) {
        $response = $this->db
                        ->where([
                            "usuario" => $usuario,
                            "id <>" => base64_decode($this->session->fv_cliente_usuario)
                        ])
                        ->get("clientes_clientes")->row();

        if (empty($response)) {
            return ["resultado" => TRUE];
        } else {
            return ["resultado" => FALSE, "msg" => "Usuário existente no banco de dados"];
        }
    }

}
