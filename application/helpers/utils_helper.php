<?php

function getFotoPerfil($foto) {
    if (!empty($foto)) {
        if (file_exists("./public/app/img/perfis/{$foto}")) {
            return base_url("public/app/img/perfis/{$foto}");
        } else {
            return base_url("public/app/img/sistema/sem-foto.png");
        }
    } else {
        return base_url("public/app/img/sistema/sem-foto.png");
    }
}

function getNomePerfil($nome) {
    $nomeSplited = explode(" ", $nome);

    if (count($nomeSplited) <= 2) {
        if (strlen($nomeSplited[1]) > 3) {
            return $nome;
        } else {
            return $nomeSplited[0];
        }
    } else {
        return "{$nomeSplited[0]} " . $nomeSplited[count($nomeSplited) - 1];
    }
}
