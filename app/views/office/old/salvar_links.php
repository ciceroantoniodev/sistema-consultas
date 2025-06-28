<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetID_PRODUTO = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

$vformID_LINK = isset($_POST["formID_LINK"]) ? $_POST["formID_LINK"] : NULL;

$vformTITULO = isset($_POST["formTITULO"]) ? $_POST["formTITULO"] : NULL;
$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : NULL;
$vformSERVIDOR = isset($_POST["formSERVIDOR"]) ? $_POST["formSERVIDOR"] : NULL;
$vformLINK = isset($_POST["formLINK"]) ? $_POST["formLINK"] : NULL;
$vformORIGEM = isset($_POST["formORIGEM"]) ? $_POST["formORIGEM"] : NULL;

$vSALVAR = false;

$vDATA_CAD = date("Y-m-d H:i:s"); 

if ($vformACAO == "novo") {	

	$dbVALORES = "0" . $vgetIDUSUARIO;
	$dbVALORES .= ",'" . $vformTITULO . "'";
	$dbVALORES .= ",'" . $vformDESCRICAO . "'";
	$dbVALORES .= ",'" . $vformSERVIDOR . "'";
	$dbVALORES .= ",'" . $vformLINK . "'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",'" . $vformORIGEM . "'";
	$dbVALORES .= ",'" . $vDATA_CAD . "'";
	
	$dbCAMPOS = "id_usuario, titulo, descricao, servidor, link, logo, origem, data";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_links (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());

	$vSALVAR = true;

} else if ($vformACAO == "alterar") {
	$dbALT = "UPDATE sysc_links SET ";
	$dbWHERE = " where id=" . $vformID_LINK;
	
	$vConexao->query($dbALT . "titulo='" . $vformTITULO . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "descricao='" . $vformDESCRICAO . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "servidor='" . $vformSERVIDOR . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "link='" . $vformLINK . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "origem='" . $vformORIGEM . "'" . $dbWHERE) or die (mysql_error());
	
	$vSALVAR = true;

}

include "js_.php";
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
		
		<?php
		echo '<script type="text/javascript" src="js/funcoes_geral' . $jsGeral . '.js"></script>';
		?>
	</head>

	<body>
		<?php
		echo '<script type="text/javascript">';

		if ($vSALVAR) {
			echo 'vHTML = "<div align=\'center\' style=\'font-size: 24px; font-weight: bold\'>ATUALIZA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!</div>";';
			
			if ($vformACAO == "novo") {	
				echo 'top.document.frmCadLinks.formTITULO.value = "";';
				echo 'top.document.frmCadLinks.formLINK.value = "";';
				echo 'top.document.frmCadLinks.formORIGEM.value = "";';
				echo 'top.document.frmCadLinks.formDESCRICAO.value = "";';
				
			}
			
		} else {
			echo 'vHTML = "<div align=\'center\'><img src=\'images/alerta_atencao.gif\' /></div><br />";';
			echo 'vHTML += "' . $vMENSAGEM . '";';

		}
		
		echo 'fMostrarAviso(vHTML);';
			
		echo '</script>';
		?>
	</body>
</html>