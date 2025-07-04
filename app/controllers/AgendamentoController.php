<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$codigo_agenda = isset($vGet['ida']) ? codigoHash((int)$vGet['ida'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';

$error = "";

$include_onde = "agendamento.php";

include_once(LOCAL . "/app/model/AgendamentoModel.php");


if (isset($vAlerta)) {
    if (empty($vAlerta)) {
        $acao = "consultar";

    }
}


include_once "app/views/office/{$include_onde}";
