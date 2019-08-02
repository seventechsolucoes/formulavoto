<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//SITE
$route["baixar"] = "site/baixarMaterial";

//AGENDA
$route["agenda/adicionar"] = "agendas/vAdicionar";
$route["agenda/(:num)"] = "agendas/vAtualizar/$1";

//UPLOADS
$route["uploads"] = "ups";
$route["uploads/upload"] = "ups/up";

//CONTEÚDO EXCLUSIVO
$route["conteudo-exclusivo"] = "conteudoExclusivo";
