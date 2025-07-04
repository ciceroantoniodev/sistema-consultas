<?php

$vGet = $_GET;

$codigo = isset($vGet['id']) ? base64_decode(base64_decode($vGet['id'])) : '';

$dados = explode("|", $codigo);

$dados = [
    "Id" => (int)$dados[0], 
    "Nome" => $dados[1],
    "Adm" => $dados[2]
];

include_once(LOCAL . "/app/config/includes/funcoes.php");

include_once "app/views/office/home.php";