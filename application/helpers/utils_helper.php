<?php

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
