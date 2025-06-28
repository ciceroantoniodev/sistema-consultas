<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;
$vgetIdCategoria = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$syscID_CATEGORIA = 0;
$vLinkRetorno = "";

$syscTIPOCATEGORIA = 'checked="checked"';
$syscTIPOSUBCATEGORIA = "";

$syscSELECTSUBCATEGORIA = 'disabled="disabled"';

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : "";

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : "";
$vformATIVO = isset($_POST["formATIVO"]) ? $_POST["formATIVO"] : "";
$vformSELECTSUBCATEGORIA = isset($_POST["formSELECTSUBCATEGORIA"]) ? $_POST["formSELECTSUBCATEGORIA"] : "";
$vformTIPO = isset($_POST["formTIPO"]) ? $_POST["formTIPO"] : "";

$vDATA_CAD = date("Y-m-d H:i:s"); 

$syscTITULOSECAO = "Cadastrar Novo Grupo de Produtos";
$vDisplay = "display: none";
$vNomeGrupo = "Nome do Grupo:";

if ($vgetAcao == "alterar") {
	$syscTITULOSECAO = "Altera&ccedil;&atilde;o de Dados em Grupo de Produtos";
	$vDisplay = "display: block";  
	
	$dbSQL = "SELECT * FROM sysc_produtoscategorias WHERE id=" . $vgetIdCategoria;

	$dbQUERY = $vConexao->query($dbSQL) or die (mysql_error());

	while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {		
		$vformID_PAI = $dbRE['id_pai'];
		$vformNOME = $dbRE['nome'];
		$vformATIVO = $dbRE['ativo'];
		
		if ($vformID_PAI > 0) {
			$syscTIPOCATEGORIA = '';
			$syscTIPOSUBCATEGORIA = 'checked="checked"';
			$syscSELECTSUBCATEGORIA = '';
			
			$vNomeGrupo = "Nome do Sub-Grupo:";
			
		}
	}
	
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_categorias.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GRUPOS DE PRODUTOS</a> ';

}

if ($vformATIVO == "S") {
	$syscATIVARSIM = 'checked="checked"';
	$syscATIVARNAO = '';
	
} else {
	$syscATIVARSIM = '';
	$syscATIVARNAO = 'checked="checked"';
	
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
		<?php
		echo '<script language="JavaScript" type="text/javascript">';
			if ($vformACAO == "atualizar") {
				echo 'history.go(-2)';
				
			}
		echo '</script>';

		if ($vformACAO == "" && $vgetIdCategoria == "") {
			$vformACAO = 'novo';
				
		} else {
			$vformACAO = 'atualizar';
			
		}
		?>
		
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-quero-apostas">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno ?>/ GRUPO DE PRODUTOS</div><br /><br />
							
							<div class="Titulo-Interno"><?php echo $syscTITULOSECAO ?></div><br /><br /><br />
							
							<div id="area-cadastro">   

								<form action="salvar_categorias.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmCadCategorias" onSubmit="return fValidaForm(this)">
									<input name="formACAO" type="hidden" value="<?php echo $vformACAO ?>" />
									<input name="formID_PRODUTO" type="hidden" value="<?php echo $vgetIdCategoria ?>" />
									
									<div id="boxEIXO"></div>
									
									<table cellspacing="0" cellpadding="5" border="0" class="letras_">
										<thead></thead>
										<tbody>
											<tr> 
												<td align="right" valign="middle">Tipo:&nbsp;</td>
												<td valign="middle"> 
													<input type="radio" name="formTIPO" value="0" onClick="fGrupoTipo(0)" <?php echo $syscTIPOCATEGORIA ?> /> Categoria Principal&nbsp;&nbsp;&nbsp;
													<input type="radio" name="formTIPO" value="1" onClick="fGrupoTipo(1)" <?php echo $syscTIPOSUBCATEGORIA ?> /> Sub-Categoria
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr> 
											<tr> 
												<td align="right" valign="middle"><?php echo $vNomeGrupo ?></td>
												<td valign="middle"> 
													<input type="text" name="formNOME" size="50" maxlength="100" value="<?php echo $vformNOME ?>" class="form-edit">
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr> 
											</tr>
											<tr> 
												<td align="right" valign="middle"><div id="idSubGrupoA" style="<?php echo $vDisplay ?>">A sub-categoria<br />pertence a <br />qual Categoria?</div></td>
												<td valign="middle"> 
													<div id="idSubGrupoB" style="<?php echo $vDisplay ?>">
														<select name="formSELECTSUBCATEGORIA" size="10" class="form-edit" <?php echo $syscSELECTSUBCATEGORIA ?>>
														<?php
														$dbSQL = "SELECT * FROM sysc_produtoscategorias ORDER BY nome";
														
														$dbQUERY = $vConexao->query($dbSQL) or die("Falha na execução da consulta.");
														
														while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
																	if ($vformACAO == "novo") {
																		echo '<option value="' . $dbRE['id'] . '">' . $dbRE['nome'] . '</option>';
																		
																	} else {
																		if ($vformID_PAI == $dbRE['id']) {
																			echo '<option value="' . $dbRE['id'] . '" selected="selected">' . $dbRE['nome'] . '</option>';
																			
																		} eLse {
																			echo '<option value="' . $dbRE['id'] . '">' . $dbRE['nome'] . '</option>';
																			
																		}
																	}
														}
														?>
														</select>
													</div>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr> 
											<tr> 
												<td align="right" valign="middle">Ativar Categoria?</td>
												<td valign="middle"> 
													<input type="radio" name="formATIVO" value="S" <?php echo $syscATIVARSIM ?> /> SIM&nbsp;&nbsp;
													<input type="radio" name="formATIVO" value="N" <?php echo $syscATIVARNAO ?> /> N&Atilde;O
												</td>
											</tr>
											<tr> 
												<td colspan="2" align="center" valign="middle" height="21">
													<div class="clear"><br /></div>
													
													<div id="area-aviso"></div>
													
													<div class="clear"><br /></div>

													<input type="submit" value="     Salvar     " class="formSUBMIT" onClick="fSalvarOk()">
												</td>
											</tr>
										</tbody>
										<tfoot></tfoot>
									</table>
									
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