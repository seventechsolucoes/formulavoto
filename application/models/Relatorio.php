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
class Relatorio extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model("uploader");
    }

    public function getEstatisticasByIdCliente($id) {
        $return = [
            "resultado" => FALSE,
            "msg" => "Ainda não há estatisticas disponíveis",
            "facebook" => FALSE,
            "instagram" => FALSE,
            "graficos" => []
        ];

        $responseFacebook = $this->db
                        ->select("redeSocial,
                            seguidores,
                            curtidas,
                            alcance,
                            DATE_FORMAT(data,'%d/%m/%Y') as data")
                        ->where([
                            "idCliente" => $id,
                            "redeSocial" => "facebook"
                        ])
                        ->order_by("data", "ASC")
                        ->get("clientes_estatisticas")->result();

        $responseInstagram = $this->db
                        ->select("redeSocial,
                            seguidores,
                            curtidas,
                            alcance,
                            DATE_FORMAT(data,'%d/%m/%Y') as data")
                        ->where([
                            "idCliente" => $id,
                            "redeSocial" => "instagram"
                        ])
                        ->order_by("data", "ASC")
                        ->get("clientes_estatisticas")->result();

        if (!empty($responseFacebook)) {
            $return["resultado"] = TRUE;
            $return["facebook"] = TRUE;
            $return["graficos"]["facebook"] = $responseFacebook;
        }
        if (!empty($responseInstagram)) {
            $return["resultado"] = TRUE;
            $return["instagram"] = TRUE;
            $return["graficos"]["instagram"] = $responseInstagram;
        }

        return $return;
    }

}
