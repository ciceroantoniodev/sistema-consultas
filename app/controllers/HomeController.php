<?php

$vGet = $_GET;

$codigo = isset($vGet['id']) ? base64_decode(base64_decode($vGet['id'])) : '';

$dados = explode("|", $codigo);

$dados = [
    "Id" => (int)$dados[0], 
    "Nome" => $dados[1], 
    "Email" => $dados[2], 
    "Mestre" => $dados[3], 
    "SuperMestre" => $dados[4], 
    "Revenda" => (int)$dados[5]
];

include_once(LOCAL . "/app/config/includes/funct.php");

include_once "app/views/office/home.php";