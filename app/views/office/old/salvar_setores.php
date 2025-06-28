<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetID_PRODUTO = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$syscID_CATEGORIA = 0;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : "";

$vformTIPO = isset($_POST["formTIPO"]) ? $_POST["formTIPO"] : "";
$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : "";
$vformEMAIL = isset($_POST["formEMAIL"]) ? $_POST["formEMAIL"] : "";
$vformATIVO = isset($_POST["formATIVO"]) ? $_POST["formATIVO"] : "";

$vDATA_CAD = date("Y-m-d H:i:s"); 

$vSALVAR= false;

if ($vformACAO == "novo") {	
	
	$dbVALORES = "'" . $vformTIPO . "'";
	$dbVALORES .= ",'" . $vformNOME . "'";
	$dbVALORES .= ",0";
	$dbVALORES .= ",'" . $vformATIVO . "'";
	$dbVALORES .= ",'" . $vformEMAIL. "'";
	$dbVALORES .= ",'" . $vDATA_CAD . "'";
  
	$dbCAMPOS = "tipo, cargo, pessoas, ativo, email, data_cad";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_cargos (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());
	
	
	$queryProdutos = $vConexao->query("SELECT * FROM sysc_cargos WHERE cargo='$vformNOME' AND data_cad='$vDATA_CAD'") or die (mysql_error());
	
		$reProdutos = mysqli_fetch_array($queryProdutos);
		
		$vformID_CARGO = $reProdutos['id'];
		
	mysqli_free_result($queryProdutos);	
	
	$vSALVAR= true;
	
} else if ($vformACAO == "alterar") {
	$vformID_CARGO = isset($_POST["formID_CARGO"]) ? $_POST["formID_CARGO"] : NULL;
	$vgetID_PRODUTO = $vformID_CARGO;
	
	$dbALT = "UPDATE sysc_cargos SET ";
	$dbWHERE = " where id=" . $vformID_CARGO;
	
	$vConexao->query($dbALT . "tipo='" . $vformTIPO . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "cargo='" . $vformNOME . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "ativo='" . $vformATIVO . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "email='" . $vformEMAIL . "'" . $dbWHERE) or die (mysql_error());
	
	$vSALVAR= true;
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
				echo 'top.document.frmCadSetores.formNOME.value = "";';
				
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