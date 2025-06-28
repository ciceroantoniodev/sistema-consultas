<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vformTabela = isset($_POST["formDELTABELA"]) ? $_POST["formDELTABELA"] : NULL;
$vformRegistros = isset($_POST["formDEL"]) ? $_POST["formDEL"] : NULL;

$arrayRegistros = explode("-", $vformRegistros);

$vSql = "";
$x = 1;

for ($i = 0; $i < count($arrayRegistros); $i++) {
	if ((int)$arrayRegistros[$i] > 0) {
		if ($x > 1) { $vSql .= ' OR '; }
		
		$vSql .= 'id='. $arrayRegistros[$i];
		
		$x++;
	}
}

$vConexao->query("DELETE FROM $vformTabela WHERE ($vSql)") or die("Falha na execução da consulta.");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SysControle - Sistema Gerenciador de Conteúdo</title>
		<meta http-equiv="content-language" content="pt-br">
		
		<meta name="robots" content="noindex, nofollow">
		<meta name="author" content="SAMSITE Web Design Sistemas">
		<meta name="reply-to" content="suporte@samsite.com.br">
		
	</head>

	<body>
		<?php
		echo '<script type="text/javascript">';

		echo 'vHTML = "<br/><br/><div style=\'font-size: 24px; color: #ff0000; font-weight: bold\'>FEITO!</div>";';
		echo 'vHTML += "<br/><div style=\'font-size: 18px; font-weight: bold\'>Registros exclu&iacute;dos.</div>";';
		
		echo 'top.document.getElementById("area-confirmacao").innerHTML = vHTML;';

		echo '</script>';
		?>
	</body>
</html>