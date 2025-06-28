<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetTabela = isset($_GET["t"]) ? $_GET["t"] : NULL;
$vgetCampo = isset($_GET["c"]) ? $_GET["c"] : NULL;
$vgetRegistros = isset($_GET["del"]) ? $_GET["del"] : NULL;

$arrayRegistros = explode("-", $vgetRegistros);

$vSql = "";
$x = 1;

for ($i = 0; $i < count($arrayRegistros); $i++) {
	if ((int)$arrayRegistros[$i] > 0) {
		if ($x > 1) { $vSql .= ' OR '; }
		
		$vSql .= 'id='. $arrayRegistros[$i];
		
		$x++;
	}
}

if ($vgetTabela == "sysc_produtoscategorias") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_categorias.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE CATEGORIAS</a> ';
	
} else if ($vgetTabela == "sysc_produtos") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_produtos.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE PRODUTOS</a> ';
	
} else if ($vgetTabela == "sysc_fornecedores") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_fornecedores.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE FORNECEDORES</a> ';
	
} else if ($vgetTabela == "sysc_links") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_links.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE LINKS</a> ';
	
} else if ($vgetTabela == "sysc_cargos") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_setores.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE SETORES</a> ';
	
} else if ($vgetTabela == "sysc_usuarios") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'usuarios.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE USU&Aacute;RIOS</a> ';
	
} else if ($vgetTabela == "sysc_contatos") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'contatos.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">%%GERENCIAMENTO DE CONTATOS</a> ';
	
}
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
			
		<style type="text/css">
		<!--
		html {height:100%; overflow-y: auto;}

		.table {height:100%;}
		
		td {font-weight: bold; color: #333333; padding: 2px}

		-->
		</style>

	</head>

	<body>
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-quero-apostas">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo str_replace("%%", "", $vLinkRetorno) ?>/ EXCLUS&Atilde;O DE REGISTROS</div><br /><br />
							
							<div class="Titulo-Interno">Exclus&atilde;o de Registros</div><br /><br /><br />
							
							<div id="area-cadastro">   

								<form action="confirmar_exclusao.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmExclusaoRegistros" onSubmit="return fValidaForm(this)">
									<input type="hidden" name="formDELTABELA" value="<?php echo $vgetTabela ?>" />
									<input type="hidden" name="formDEL" value="<?php echo $vgetRegistros ?>" />
									
									<div id="boxEIXO"></div>
									
									<table cellspacing="0" cellpadding="5" border="1" class="letras_">
										<tr style="background: #666666; color: #ffffff"> 
											<td align="center" valign="middle"><span style="color: #ffffff">&nbsp;&nbsp;REGISTRO&nbsp;&nbsp;</span></td>
											<td align="center" valign="middle"><span style="color: #ffffff">DESCRI&Ccedil;&Atilde;O</span></td>
										</tr>
										<?php
										$vQuery = $vConexao->query("SELECT * FROM $vgetTabela WHERE ($vSql)") or die("Falha na execução da consulta.");
										
											while ($reQuery = mysqli_fetch_assoc($vQuery)) {
												echo '<tr>';
												echo '<td align="center" valign="middle">';
												echo $reQuery['id'];
												echo '</td>';
												echo '<td align="left" valign="middle"><div style="padding-left: 10px; padding-right: 10px;">';
												echo $reQuery[$vgetCampo];
												echo '</div></td>';
												echo '</tr>';
											}
											
										mysqli_free_result($vQuery);
										?>
									</table>
									
									<div id="area-confirmacao">
										<div class="clear"><br /><br />Confirma exclus&atilde;o dos registros selecionados?  <input type="radio" name="formCONFIRMAR" value="N" onClick="fExcluirConfirmar(1)" /> N&Atilde;O &nbsp;&nbsp;<input type="radio" name="formCONFIRMAR" value="S"  onClick="fExcluirConfirmar(2)" /> SIM</div>
										
										<div id="ExcluirSim" style="display: none"><div class="clear"><br /><span style="font-style: italic; font-size: 14px; color: #ff0000">( <strong><u>Cuidado!</u></strong> Essa a&ccedil;&atilde;o n&atilde;o poder&aacute; ser desfeita. )</span><br /><br /><br /></div><input type="submit" value="     Confirmar     " class="formSUBMIT" onClick="fSalvarOk()"></div>
										<div id="ExcluirNao" style="display: none; font-weight: bold"><br/><br/><?php echo str_replace(" / ", "", str_replace("%%", "VOLTAR PARA ", $vLinkRetorno)) ?></div>
									</div>
								</form>						

								<iframe src="vazio.php" name="SalvarForm" scrolling="yes" frameborder="0" width="1" height="1"></iframe>

							</div>

							<div id="boxDIALOGO"></div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</body>
</html>