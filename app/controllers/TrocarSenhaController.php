<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';

$salvo = false;

$include_once = "trocar_senha.php";


require_once( LOCAL . '/app/model/TrocarSenhaModel.php');


include_once "app/views/office/{$include_once}";