<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;
$codigo_usuario = isset($vGet['ida']) ? codigoHash((int)$vGet['ida'], "d") : 0;
$acao = isset($vGet['acao']) ? $vGet['acao'] : 'novo';

$error = "";

$include_once = "usuarios.php";


require_once( LOCAL . '/app/model/UsuarioModel.php');


if ($vParameters==="novo" || $vParameters==="editar") {
    $include_once = "usuarios_editar.php";

} 

if (isset($vAlerta) && !empty($vAlerta)) {
    $include_once = "usuarios_editar.php";

}


include_once "app/views/office/{$include_once}";
