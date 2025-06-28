<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetCategorias = isset($_GET["ids"]) ? $_GET["ids"] : NULL;
$vgetSelecao = isset($_GET["sel"]) ? $_GET["sel"] : NULL;

$arrayCategorias = explode("-", $vgetCategorias);

sort($arrayCategorias);

$vSql = "";
$x = 1;

foreach ($arrayCategorias AS $vDados) {
	if ((int)$vDados > 0) {
		if ($x > 1){ $vSql .= " OR "; }
		
		$vSql .= "id_pai=".$vDados;
		
		$x++;
	}
}


$vSql = "(" . str_replace("id_pai", "id", $vSql) . ") OR (" . $vSql . ")";


$queryCategorias = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE ($vSql) ORDER BY nome") or die ("Falha ao tentar conexao com Categorias");
	$arrayCategorias = Array();
	$arraySubCategorias = Array();
	
	$i = 0;
	
	while ($reCategorias = mysqli_fetch_assoc($queryCategorias)) {
		
		if($reCategorias['id_pai'] > 0) {
			$arraySubCategorias[$i] = Array("Id"=>$reCategorias['id'], "IdPai"=>$reCategorias['id_pai'], "Tipo"=>$reCategorias['tipo'], "Nome"=>$reCategorias['nome'], "Itens"=>$reCategorias['itens'], "Link"=>$reCategorias['link']);

			$i++;
			
		} else {
			$vArrayNome = "Cat" . $reCategorias['id'];
			
			$arrayCategorias[$vArrayNome] = Array("Id"=>$reCategorias['id'], "Nome"=>$reCategorias['nome']);

		}

	}
mysqli_free_result($queryCategorias);

sort($arrayCategorias);
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
		$vSubTotal = 0;
		
		for ($i = 0; $i < count($arrayCategorias); $i++) {
			echo '<div style="font-family: arial; font-weight: bold; color: #666666; border-bottom: #999999 2px solid; display: table;margin-top: 10px; margin-bottom: 5px; padding-right: 10px">' . $arrayCategorias[$i]['Nome'] . '</div>';
			
			for ($y = 0; $y < count($arraySubCategorias); $y++) {
				
				if ($arraySubCategorias[$y]['IdPai'] ==  $arrayCategorias[$i]['Id']) {
					$vIdCategoria = $arraySubCategorias[$y]['Id'];
					
					if (strpos("_".$vgetSelecao, '['.$vIdCategoria.']') > 0) {
						echo '<div><input checked="checked" id="fSubCategoria' . ($y+1) .'" type="checkbox" name="formSUBCATEGORIAS' . ($y+1) .'" value="' . $vIdCategoria . '"/> ' . trim($arraySubCategorias[$y]['Nome']) . '</div>';
					
					} else {
						echo '<div><input type="checkbox" id="fSubCategoria' . ($y+1) .'" name="formSUBCATEGORIAS' . ($y+1) .'" value="' . $vIdCategoria . '"/> ' . trim($arraySubCategorias[$y]['Nome']) . '</div>';
					
					}
				}
				
				$vSubTotal++;
				
			}
		}
		
		
		echo '<input type="hidden" name="formSUB_TOTAL" value="' . ($vSubTotal+1) . '" />';
		?>

	</body>
</html>