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
    ],
    //UPLOAD
    "ups/enviar" => [
        [
            'field' => "tipo",
            'label' => "tipo",
            'rules' => "trim|required"
        ],
        [
            'field' => "evento",
            'label' => "evento",
            'rules' => "trim|required"
        ],
        [
            'field' => "local",
            'label' => "local",
            'rules' => "trim|required"
        ],
        [
            'field' => "data",
            'label' => "data",
            'rules' => "trim|required"
        ],
        [
            'field' => "assunto",
            'label' => "assunto",
            'rules' => "trim|required"
        ],
        [
            'field' => "assunto",
            'label' => "assunto",
            'rules' => "trim|required"
        ]
    ]
    //UPLOAD
];
