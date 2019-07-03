<?php

$config = [
    "ci_env" => "development",
    "httpHost" => empty($_SERVER["HTTPS"]) ? "http://{$_SERVER["HTTP_HOST"]}" : "https://{$_SERVER["HTTP_HOST"]}",
    "root" => "",
    "rootAdmin" => "",
    "dbHost" => "br998.hostgator.com.br",
    "dbUser" => "amazo832_fv",
    "dbPass" => "#abcd!0000",
    "database" => "amazo832_db_fvhomolog"
];

switch ($_SERVER["SERVER_ADDR"]) {
    case "127.0.0.1":
        $config["root"] = $config["httpHost"] . "/formula-voto";
        $config["rootAdmin"] = $config["httpHost"] . "/formula-voto/admin";
        break;
    case "::1":
        $config["root"] = $config["httpHost"] . "/formula-voto";
        $config["rootAdmin"] = $config["httpHost"] . "/formula-voto/admin";
        break;
    case "162.241.203.76":
        $config["ci_env"] = "testing";
        $config["root"] = $config["httpHost"];
        $config["rootAdmin"] = $config["httpHost"] . "/admin";
        break;
    default:
        $config["ci_env"] = "production";
        $config["root"] = $config["httpHost"];
        $config["rootAdmin"] = $config["httpHost"] . "/admin";

        $config["dbHost"] = "br420.hostgator.com.br";
        $config["dbUser"] = "amazo832_fv";
        $config["dbPass"] = "#abcd!0000FORMULAVOTO";
        $config["database"] = "amazo832_db_formulavoto";
        break;
}

//AMBIENTE
//DEVELOPMENT | TESTING | PRODUCTION
define("CI_STATUS", $config["ci_env"]);
//VERSÃO SISTEMA
define("VERSAO_SISTEMA", "1.0.0");
//BASE URLs
define("ROOT", $config["root"]);
define("ROOT_ADMIN", $config["rootAdmin"]);
//BANCO DE DADOS
define("DBHOST", $config["dbHost"]);
define("DBUSER", $config["dbUser"]);
define("DBPASS", $config["dbPass"]);
define("DATABASE", $config["database"]);
