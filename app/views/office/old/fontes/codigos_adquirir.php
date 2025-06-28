<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fIdu(0, $_GET["idu"]) : NULL;
$vgetIDFRANQUIA = isset($_GET["idf"]) ? $_GET["idf"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetNIVEL = isset($_GET["n"]) ? $_GET["n"] : NULL;
$vgetIDVENDEDOR = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : NULL;
$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { $vBotaoVoltar = 1; }

if ($vgetTIPO == "franquia") {
	$vSQL = "SELECT * FROM sysc_financeiropedidos WHERE (origem='" . $vgetTIPO . "') AND (id_franquia=" . (int)$vgetIDFRANQUIA . ") AND (pendente='S')";
	
} else {
	$vSQL = "SELECT * FROM sysc_financeiropedidos WHERE (origem='" . $vgetTIPO . "') AND (id_usuario=" . (int)$vgetIDUSUARIO . ") AND (pendente='S')";

}

$vQUERY = $vConexao->query($vSQL) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	if ($vRE != "") {
		header("Location: salvar_codigos.php?local=" . $getLOCAL . "&idu=" . fIdu(1, $vgetIDUSUARIO) . "&idf=" . $vgetIDFRANQUIA . "&n=" . $vgetNIVEL . "&r=" . $vgetROTINAS . "&acao=confirmar&tp=" . $vgetTIPO);

	}
mysqli_free_result($vQUERY);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="../documentos/js/funcoes-geral.js"></script>
	<script type="text/javascript" src="js/menu_redirect.js"></script>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
	
	<?php
	echo '<script type="text/javascript">';
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_produtos WHERE descricao LIKE '%pacote%' ORDER BY descricao") or die("Falha na execução da consulta.");
		echo 'var vProdutoId = [];';
		echo 'var vProdutoDescricao = [];';
		echo 'var vProdutoValor = [];';
		echo 'var vProdutoSigla = [];';
		
		$i = 0;
		
		while ($vRE = mysqli_fetch_assoc($vQUERY)) {
			echo 'vProdutoId[' . $i . '] = "' . $vRE['id'] . '";';
			echo 'vProdutoDescricao[' . $i . '] = "' . $vRE['descricao'] . '";';
			echo 'vProdutoValor[' . $i . '] = "' . $vRE['valor'] . '";';
			echo 'vProdutoSigla[' . $i . '] = "' . $vRE['sigla'] . '";';
			
			$i++;
		}
	mysqli_free_result($vQUERY);

	echo '</script>';
	?>
	
	<script type="text/javascript">
	function fDescricao(vnn) {
		var vIdValor = "valor" + vnn;
		var vItemSel = "item" + vnn;
		var vDescricao = "descricao" + vnn;
		
		var vSelect = "<select name='formPRODUTO" + vnn + "' id='item" + vnn + "' class='form_se' onChange='fAtualizar(this, " + vnn + ")'><option>...</option>";
		
		for (var i = 0; i < vProdutoId.length; i++) {
			 vSelect += "<option value='" + i + "'>" + vProdutoDescricao[i] + "</option>";
		}
		
		vSelect += "</select>&nbsp;&nbsp;&nbsp;<div style='display: inline' id='ok" + vnn + "'></div>";
		
		document.getElementById(vDescricao).innerHTML = vSelect;
	}
	
	function fAtualizar(vthis, vnn) {
		var vIdValor = "valor" + vnn;
		var vItemSel = "item" + vnn;
		var vOk = "ok" + vnn;
		
		document.getElementById(vIdValor).innerHTML = fMoeda(parseInt(vProdutoValor[document.getElementById(vItemSel).value]), 2, ",", ".");
		document.getElementById(vOk).innerHTML = "<input type='button' value='OK' class='botao_ok' onClick='fComprar(" + vnn + ")' />";
	}
	
	function fComprar(vnn) {
		var vIdValor = "valor" + vnn;
		var vQuantidade = "quantidade" + vnn;
		var vItemSel = "item" + vnn;
		var vLinha = "linha" + (vnn+1);
		
		var vCampoDescricao = "IdDescricao" + vnn;
		var vCampoIdProduto = "IdProduto" + vnn;
		var vCampoValores = "IdValores" + vnn;
		
		document.getElementById(vIdValor).innerHTML = fMoeda((parseInt(document.getElementById(vQuantidade).value)*parseInt(vProdutoValor[document.getElementById(vItemSel).value])), 2, ",", ".");
		
		document.getElementById(vLinha).style.display = "block";
		
		document.getElementById(vCampoDescricao).value = vProdutoDescricao[document.getElementById(vItemSel).value];
		document.getElementById(vCampoIdProduto).value = vProdutoId[document.getElementById(vItemSel).value];
		document.getElementById(vCampoValores).value = vProdutoValor[document.getElementById(vItemSel).value];
		
		document.getElementById("botao_submit").style.display = "block";
		fDescricao((vnn+1));
	}
	</script>
	
	<style type="text/css">
	<!--
	.form-listagem {
		border: 1px #ccc solid;
		font-size: 13px;
		display: table;
		background: #fff;
		width: 600px;
	}
	
	.form_  {
			font-family: tahoma, arial; 
			font-size: 22px; 
			color: #104E8B; 
			background: #f9f9f9;
			border: #dddddd 1px solid;
			height: 40px;
	}
	
	.form_se {
			font-family: tahoma, arial; 
			font-size: 22px; 
			color: #104E8B; 
			background: #f9f9f9;
			border: #dddddd 1px solid;
			height: 44px;
			display: inline;
	}
	
	.divTR1 {
		border-bottom: #dddddd 1px solid;
		display: table;
		padding-top: 5px;
		padding-bottom: 5px;
	}
	
	.divTR2 {
		border-bottom: #dddddd 1px solid;
		display: none;
		padding-top: 5px;
		padding-bottom: 5px;
	}
	
	.divTD1 {
		width: 110px;
		float: left;
	}
	
	.divTD2 {
		width: 345px;
		float: left;
	}
	
	.divTD3 {
		width: 120px;
		float: left;
		font-family: tahoma, arial; 
		font-size: 22px; 
		color: #104E8B; 
		height: 32px;
		text-align: right;
		padding-top: 8px;
	}
	
	.botao_ok {
		background: #0080FF;
		font-size: 12px;
		color: #ffffff;
		border: none;
		border-right: #045FB4 1px solid;
		border-bottom: #045FB4 1px solid;
		height: 30px;
		width: 30px;
		text-align: center;
	}
	-->
	</style>

</head>

<body>
<?php
include "_submenus.php";

$vDelTabela = "sysc_usuarios";
$vDelCampo = "nome";

echo '<form action="salvar_codigos.php?local=' . $getLOCAL . '&r=' . $vgetROTINAS. '&n=' . $vgetNIVEL . '&tp=' . $vgetTIPO . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&ida=' . $vgetIDVENDEDOR . '&acao=salvar" method="post" name="frmAdquirirCodigos">';

echo '<br /><br /><div align="center"><div class="form-listagem"><table width="600" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr><td class="form-cadastros-head" colspan="7"><a href="javascript: history.go(-' . $vBotaoVoltar . ')"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center">AQUISIÇÃO DE CÓDIGOS</div></td></tr>';
echo '<tr><td class="area-grid-barra" colspan="7">';

echo '<table width="100%">';
echo '<tr height="30" style="background: #666666; color: #ffffff; font-size: 16px">';
echo '<td align="center" valign="middle" width="110">QUANTIDADE</td>';
echo '<td align="center" valign="middle">DESCRIÇÃO</td>';
echo '<td align="center" valign="middle" width="120">VALOR</td>';
echo '</tr>';
echo '<tr><td colspan="3">';

for ($i = 1; $i <= 10; $i++) {
	if ($i > 1) {
		echo '<div class="divTR2" id="linha' . $i . '">';

	} else {
		echo '<div class="divTR1 id="linha' . $i . '">';

	}
	
	echo '<input type="hidden" name="formDESCRICAO' . $i . '" id="IdDescricao' . $i . '" value="" />';
	echo '<input type="hidden" name="formIDPRODUTO' . $i . '" id="IdProduto' . $i . '" value="" />';
	echo '<input type="hidden" name="formVALORES' . $i . '" id="IdValores' . $i . '" value="" />';
	
	echo '<div class="divTD1"><input type="text" name="formQUANTIDADE' . $i . '" id="quantidade' . $i . '" size="5" class="form_" /></div>';
	echo '<div class="divTD2" id="descricao' . $i . '">&nbsp;</div>';
	echo '<div class="divTD3" id="valor' . $i . '"></div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	
	if ($i == 1) {
		echo '<script type="text/javascript">fDescricao(1);</script>';
	}
}

echo '<div align="center" id="botao_submit" style="display: none"><br /><input type="submit" value="Finalizar" class="submit_codigos" /></div>';
echo '</td></tr>';
echo '</table>';

echo '</td></tr>';
echo '</tbody></tfoot></tfoot></table></div></div><br /><br />';

echo '</form>';
?>
</body>
</html>
