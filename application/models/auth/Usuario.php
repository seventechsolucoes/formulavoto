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

}
