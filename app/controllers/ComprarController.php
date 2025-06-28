<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funct.php');

$revenda = isset($vGet['rv']) ? codigoHash((int)$vGet['rv'], "d") : 0;
$id_user = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$codigo_usuario = isset($vGet['cod']) ? codigoHash((int)$vGet['cod'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';


include_once(LOCAL . "/app/model/ComprarModel.php");

include_once "app/views/office/comprar.php";