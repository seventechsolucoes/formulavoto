<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends CI_Controller {

    private $dados = NULL;

    public function __construct() {
        parent::__construct();

//        $this->load->model("auth/usuario");

        $this->dados["csrf"] = [
            "name" => $this->security->get_csrf_token_name(),
            "hash" => $this->security->get_csrf_hash()
        ];
    }

    public function accessToken() {
        echo "<h1>{$this->input->get["access_token"]}</h1>";
    }

}
