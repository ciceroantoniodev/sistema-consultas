<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$id_especialidade = isset($vGet['ide']) ? codigoHash((int)$vGet['ide'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';

$error = "";

$include_onde = "especialidades.php";

include_once(LOCAL . "/app/model/EspecialidadeModel.php");

if ($vParameters==="novo" || $vParameters==="editar") {
    
    $include_onde = "especialidades_editar.php";

    
} else if ($vParameters==="salvar") {

    if (isset($vAlerta) && !empty($vAlerta)) {
        $include_onde = "especialidades_editar.php";

    }
}

include_once "app/views/office/{$include_onde}";