<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route["uploads"] = "ups";
$route["uploads/upload"] = "ups/up";
$route["conteudo-exclusivo"] = "conteudoExclusivo";
