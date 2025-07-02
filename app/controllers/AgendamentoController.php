<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$codigo_usuario = isset($vGet['cod']) ? codigoHash((int)$vGet['cod'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';

$error = "";

$include_onde = "agendamento.php";

include_once(LOCAL . "/app/model/AgendamentoModel.php");

if ($vParameters==="novo") {
    
    $include_onde = "pacientes_editar.php";

} else if ($vParameters==="salvar") {

    if (isset($vAlerta) && !empty($vAlerta)) {
        $include_onde = "pacientes_editar.php";

    }
}

include_once "app/views/office/{$include_onde}";