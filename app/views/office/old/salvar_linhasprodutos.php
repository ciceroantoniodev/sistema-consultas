<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetID_PRODUTO = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$syscID_CATEGORIA = 0;

$syscTIPOCATEGORIA = 'checked="checked"';
$syscTIPOSUBCATEGORIA = "";

$syscSELECTSUBCATEGORIA = 'disabled="disabled"';

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : "";

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : "";
$vformATIVO = isset($_POST["formATIVO"]) ? $_POST["formATIVO"] : "";

$vDATA_CAD = date("Y-m-d H:i:s"); 

$vSALVAR= false;

if ($vformACAO == "novo") {	
	
	$dbVALORES = "0" . $vgetIDUSUARIO;
	$dbVALORES .= ",99999";
	$dbVALORES .= ",'linha'";
	$dbVALORES .= ",'" . $vformNOME . "'";
	$dbVALORES .= ",0";
	$dbVALORES .= ",'" . $vformATIVO . "'";
	$dbVALORES .= ",'" . $vDATA_CAD . "'";
  
	$dbCAMPOS = "id_usuario, id_pai, tipo, nome, itens, ativo, data";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_produtoscategorias (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());
	
	
	$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE nome='$vformNOME' AND data='$vDATA_CAD'") or die (mysql_error());
	
		$reProdutos = mysqli_fetch_array($queryProdutos);
		
		$vformID_PRODUTO = $reProdutos['id'];
		
	mysqli_free_result($queryProdutos);	
	
	$vSALVAR= true;
}

if ($vformACAO == "alterar") {
	$vformID_PRODUTO = isset($_POST["formID_PRODUTO"]) ? $_POST["formID_PRODUTO"] : NULL;
	$vgetID_PRODUTO = $vformID_PRODUTO;
	
	$dbALT = "UPDATE sysc_produtoscategorias SET ";
	$dbWHERE = " where id=" . $vformID_PRODUTO;
	
	$vConexao->query($dbALT . "nome='" . $vformNOME . "'" . $dbWHERE) or die (mysql_error());
	$vConexao->query($dbALT . "ativo='" . $vformATIVO . "'" . $dbWHERE) or die (mysql_error());
	
	$vSALVAR= true;
}

$vCategoriasLink = fGerarLink($vformID_PRODUTO . "-" . $vformNOME);

$queryLink = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE id=" . $vformID_PRODUTO) or die ("Falha ao tentar conexão com LINKS DE GRUPOS");
	
	$reLink = mysqli_fetch_array($queryLink);
	
	if (trim($reLink['link']) != trim($vCategoriasLink)) {
		$vConexao->query("UPDATE sysc_produtoscategorias SET link='$vCategoriasLink' WHERE id=" . $vformID_PRODUTO);

	}

mysqli_free_result($queryLink);

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
				echo 'top.document.frmCadLinhas.formNOME.value = "";';
				
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