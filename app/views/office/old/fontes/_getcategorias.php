<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";

$vgetCATEGORIA = isset($_GET["qry"]) ? $_GET["qry"] : NULL;
$vgetSTRBAIRRO = isset($_GET["idb"]) ? $_GET["idb"] : NULL; 

$vECHO = '<select name="formSUBCATEGORIA" class="form_">';
$vECHO .= '<option value="">...</option>';

$vQUERY = $vConexao->query("SELECT * FROM sysc_categorias WHERE id_pai=" . $vgetCATEGORIA . " ORDER BY nome") or die("Falha na execução da consulta.");
	while ($vRE = mysqli_fetch_assoc($vQUERY)) {
		$vGetBairroID = $vRE['id'];
		$vGetBairroNome = $vRE['nome'];
		
		if ($vRE['id'] == (int)$vgetSTRBAIRRO) {
			$vSelected = ' selected="selected"';
			
		} else {
			$vSelected = '';
			
		}

		$vECHO .= '<option value="' . $vGetBairroID . '"' . $vSelected . '>' . $vGetBairroNome . '</option>';
		
	}
mysqli_free_result($vQUERY);

$vECHO .= '</select>';

echo '<div class="form-campos-texto">Sub-Categoria:</div>';

echo $vECHO;
?>