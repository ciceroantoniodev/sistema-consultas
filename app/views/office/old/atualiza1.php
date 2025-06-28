<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;

$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios ORDER BY id") or die("Falha na execução da consulta.");

	$dbCAMPOS = "id_usuario, id_indicado, id_plano, id_financeiro, nome_indicado, pendente, valor_plano, comissao, valor_comissao, dt_baixa, dt_cadastro";
	
	while ($vRE = mysqli_fetch_assoc($vQUERY)) {
		if ($vRE['id_patrocinador'] != 0) {

			$dbVALORES = "0" . $vRE['id_patrocinador'];
			$dbVALORES .= ",0" . $vRE['id'];
			$dbVALORES .= ",0" . $vRE['id_plano'];
			$dbVALORES .= ",0";
			$dbVALORES .= ",'" . $vRE['nome'] . "'";
			$dbVALORES .= ",'S'";
			$dbVALORES .= ",0";
			$dbVALORES .= ",0";
			$dbVALORES .= ",0";
			$dbVALORES .= ",'0000-00-00 00:00:00'";
			$dbVALORES .= ",'" . strftime("%Y-%m-%d %H:%M:%S", strtotime($vRE['dt_cadastro'])) . "'";
			
			$dbSALVAR = $vConexao->query("INSERT INTO sysc_comissoes (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());
			
		}
	}
	
mysqli_free_result($vQUERY);

$vQUERY = $vConexao->query("SELECT * FROM sysc_comissoes ORDER BY id") or die("Falha na execução da consulta.");

	while ($vRE = mysqli_fetch_assoc($vQUERY)) {
		
		$vQUERY1 = $vConexao->query("SELECT sysc_financeiro.*, sysc_planos.comissao FROM sysc_financeiro INNER JOIN sysc_planos ON sysc_financeiro.id_plano=sysc_planos.id WHERE (sysc_financeiro.id_usuario=" . $vRE['id_indicado'] . ") AND (sysc_financeiro.comprovante='adesao') AND (sysc_planos.id=" . $vRE['id_plano'] . ")") or die("Falha na execução da consulta.");
			$vRE1 = mysqli_fetch_array($vQUERY1);
			
			$vIdFinanceiro = $vRE1['id'];
			$vValorPlano = $vRE1['valor'];
			$vComissao = $vRE1['comissao'];
			
			$vConexao->query("UPDATE sysc_comissoes SET id_financeiro=0" . $vIdFinanceiro . ", valor_plano=0" . $vValorPlano . ", comissao=0" . $vComissao . ", valor_comissao=0" . ($vValorPlano*($vComissao/100)) . " WHERE id=" . $vRE['id']) or die (mysql_error());
			
		mysqli_free_result($vQUERY1);

	}
	
mysqli_free_result($vQUERY);
?>
