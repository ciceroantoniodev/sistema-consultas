<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vformTOTAL = isset($_POST["formTOTAL"]) ? $_POST["formTOTAL"] : "";

if ((int)$vformTOTAL > 1) {
	
	for ($i = 1; $i <= (int)$vformTOTAL; $i++) {

		$vformID = isset($_POST["formID".$i]) ? $_POST["formID".$i] : "";
		$vformARQUIVO = isset($_POST["formARQUIVO".$i]) ? $_POST["formARQUIVO".$i] : "";
		$vformTITULO = isset($_POST["formTITULO".$i]) ? $_POST["formTITULO".$i] : "";
		$vformDESCRICAO = isset($_POST["formDESCRICAO".$i]) ? $_POST["formDESCRICAO".$i] : "";

		if ($vformARQUIVO != "") {
			$vConexao->query("UPDATE sysc_galeriasshow SET titulo='$vformTITULO', descricao='$vformDESCRICAO' WHERE id=$vformID OR arquivo='$vformARQUIVO'") or die ("Falha ao tentar salvar Arquivo de Imagem");
			
		}
		
	}
	
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

		echo 'top.showDIRECT(\'\', \'query_galerias.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaREDIRECT\');';
			
		echo '</script>';
		?>
	</body>
</html>