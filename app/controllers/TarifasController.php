<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funct.php');

$revenda = isset($vGet['rv']) ? codigoHash((int)$vGet['rv'], "d") : 0;
$id_user = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;


require_once( LOCAL . '/app/model/TarifaModel.php');


$include_once = "tarifas.php";

if ($vParameters==="novo") {
    $include_once = "tarifas_novo.php";

} 

include_once "app/views/office/{$include_once}";