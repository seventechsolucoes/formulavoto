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
    //PERFIL
    "perfil/atualizarDadosPessoais" => [
        [
            'field' => "nome",
            'label' => "nome",
            'rules' => "trim|required"
        ],
        [
            'field' => "email",
            'label' => "email",
            'rules' => "trim|required|valid_email"
        ],
        [
            'field' => "cidade",
            'label' => "cidade",
            'rules' => "trim|required|integer"
        ]
    ],
    "perfil/atualizarDadosAcesso" => [
        [
            'field' => "usuario",
            'label' => "usuario",
            'rules' => "trim|required"
        ],
        [
            'field' => "senha",
            'label' => "senha",
            'rules' => "trim|required"
        ]
    ],
    //PERFIL
    //DOWNLOAD EBOOK/AUDIOBOOK
    "site/download" => [
        [
            'field' => "conteudo",
            'label' => "conteudo",
            'rules' => "trim|required"
        ],
        [
            'field' => "nome",
            'label' => "nome",
            'rules' => "trim|required"
        ],
        [
            'field' => "email",
            'label' => "email",
            'rules' => "trim|required|valid_email"
        ],
        [
            'field' => "telefone",
            'label' => "telefone",
            'rules' => "trim|required"
        ],
        [
            'field' => "municipio",
            'label' => "municipio",
            'rules' => "trim|required"
        ],
        [
            'field' => "estado",
            'label' => "estado",
            'rules' => "trim|required"
        ],
        [
            'field' => "cargoPretendido",
            'label' => "cargoPretendido",
            'rules' => "trim|required"
        ],
        [
            'field' => "conteudo",
            'label' => "conteudo",
            'rules' => "trim|required"
        ]
    ]
        //DOWNLOAD EBOOK/AUDIOBOOK
];
