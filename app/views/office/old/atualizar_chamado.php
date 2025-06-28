<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";

$vgetIDCHAMADO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vformPENDENTE = isset($_POST["formPENDENTE"]) ? $_POST["formPENDENTE"] : NULL;

$vConexao->query("UPDATE sysc_chamados SET pendente='" . $vformPENDENTE . "', visualizado='S' WHERE id=" . $vgetIDCHAMADO) or die("Falha na execuчуo da consulta.");
?>