<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//LOGIN
$route["login/sair"] = "auth/login/sair";

//DASHBOARD
$route["dashboard"] = "dashboard/home";
