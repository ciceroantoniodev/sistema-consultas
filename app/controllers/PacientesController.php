<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$id_paciente = isset($vGet['idp']) ? codigoHash((int)$vGet['idp'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';

$error = "";

$include_onde = "pacientes.php";


include_once(LOCAL . "/app/model/PacienteModel.php");


if ($vParameters==="novo" || $vParameters==="editar") {
    
    $include_onde = "pacientes_editar.php";

    
} else if ($vParameters==="salvar") {

    if (isset($vAlerta) && !empty($vAlerta)) {
        $include_onde = "pacientes_editar.php";

    }
}


include_once "app/views/office/{$include_onde}";
