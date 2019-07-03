<?php

$config = [
    //LOGIN
    "login/autenticar" => [
        [
            'field' => "usuario",
            'label' => "usuario",
            'rules' => "trim|required"
        ],
        [
            'field' => "senha",
            'label' => "senha",
            'rules' => "trim|required"
        ],
    //LOGIN
    ]
];
