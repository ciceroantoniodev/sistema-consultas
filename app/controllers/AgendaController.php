<?php

$vGet = $_GET;

require_once( LOCAL . '/app/config/includes/funcoes.php');

$id_usuario = isset($vGet['idu']) ? codigoHash((int)$vGet['idu'], "d") : 0;


$include_onde = "agenda.php";


$hoje = date('Y-m-d');
$mes = date('m');
$ano = date('Y');
$diasNoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
$primeiroDiaSemana = date('w', strtotime("$ano-$mes-01")); // 0 (Domingo) a 6 (Sábado)


include_once(LOCAL . "/app/model/AgendaModel.php");


include_once "app/views/office/{$include_onde}";