<?php

Class Sessao {

    public function isLogado($sessao = "") {
        if ($sessao->userdata("usuario") != NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isAutorizado($sessao = "", $credencial = "") {
        return ($sessao->fv_cliente_usuario != NULL && $sessao->userdata(sha1($credencial)) == TRUE);
    }

}
