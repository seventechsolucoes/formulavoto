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
    ],
    //UPLOAD
    //AGENDAS
    "agendas/adicionar" => [
        [
            'field' => "cliente",
            'label' => "cliente",
            'rules' => "trim|required|integer"
        ],
        [
            'field' => "titulo",
            'label' => "titulo",
            'rules' => "trim|required"
        ],
        [
            'field' => "data",
            'label' => "data",
            'rules' => "trim|required"
        ]
    ],
    "agendas/atualizar" => [
        [
            'field' => "cliente",
            'label' => "cliente",
            'rules' => "trim|required|integer"
        ],
        [
            'field' => "status",
            'label' => "status",
            'rules' => "trim|required"
        ],
        [
            'field' => "titulo",
            'label' => "titulo",
            'rules' => "trim|required"
        ],
        [
            'field' => "data",
            'label' => "data",
            'rules' => "trim|required"
        ]
    ],
    "agendas/atualizarStatus" => [
        [
            'field' => "id",
            'label' => "id",
            'rules' => "trim|required|integer"
        ],
        [
            'field' => "status",
            'label' => "status",
            'rules' => "trim|required"
        ]
    ],
        //AGENDAS
];
