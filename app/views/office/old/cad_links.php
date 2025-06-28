<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;
$vgetIdLink = isset($_GET["ida"]) ? $_GET["ida"] : NULL;


$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_links.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE LINKS</a> ';


$vformTITULO = "";
$vformDESCRICAO = "";
$vformTIPO = "";
$vformLINK = "";
$vformORIGEM = "";
$vformIMAGEM = "";

$vDATA_CAD = date("Y-m-d H:i:s"); 

$syscTITULOSECAO = "Cadastrar Novo Link";

if ($vgetAcao == "") {
	$vgetAcao = "novo";
	
}

if ($vgetAcao == "alterar") {
	$syscTITULOSECAO = "Altera&ccedil;&atilde;o de Dados em Links";
  
	$dbSQL = "SELECT * FROM sysc_links WHERE id=" . $vgetIdLink;

	$queryLinks = $vConexao->query($dbSQL) or die (mysql_error());

	while ($reLinks = mysqli_fetch_assoc($queryLinks)) {
		$vformTITULO = $reLinks['titulo'];
		$vformDESCRICAO = $reLinks['descricao'];
		$vformTIPO = $reLinks['servidor'];
		$vformLINK = $reLinks['link'];
		$vformORIGEM = $reLinks['origem'];
		$vformIMAGEM = $reLinks['logo'];

	}
	mysqli_free_result($queryLinks);
	
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
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno ?>/ <?php echo $syscTITULOSECAO ?></div><br /><br />
							
							<div class="Titulo-Interno"><?php echo $syscTITULOSECAO ?></div><br /><br /><br />
							
							<div id="area-cadastro">   

								<form action="salvar_links.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmCadLinks" onSubmit="return fValidaForm(this)">
									<input name="formACAO" type="hidden" value="<?php echo $vgetAcao ?>" />
									<input name="formID_LINK" type="hidden" value="<?php echo $vgetIdLink ?>" />
									
									<div id="boxEIXO"></div>
									
									<table class="letras_" border="0">
										<thead></thead>
										<tbody>
											<tr height="40">
												<td height="28" align="right" valign="middle" class="align_">T&iacute;tulo do Link:</td>
												<td height="28" valign="middle"><input type="text" tabindex="1" name="formTITULO" size="40" maxlength="150" value="<?php echo $vformTITULO ?>" class="form-edit" /></td>
												<td width="20" rowspan="10" style="background: url(./documentos/images/divisor.gif) repeat-y center">&nbsp;</td>
												<td valign="middle" rowspan="10">
													<strong>IMAGEM:</strong><br /><br />
													<?php
													if ($vgetIdLink != "") {
														if (fSeImagem($vformIMAGEM) && file_exists("../docs/logos/" . $vformIMAGEM)) {	
															echo '<div style="border: #dddddd 1px solid; padding: 20px">';
															echo '<img src="../docs/logos/' . $vformIMAGEM . '" border="0" hspace="10" vspace="10" alt="' . $vformIMAGEM . '" />';
															echo '</div>';

														} else {
															echo '<div style="width: 150px; height: 75px; background: #f1f1f1; text-align: center; padding-top: 60px"><em>sem imagem</em></div>';
															echo '<input type="hidden" name="formEXCLUIRCAPA" value="" />';
														}

													} else {
														echo '<div style="width: 150px; height: 75px; background: #f1f1f1; text-align: center; padding-top: 60px"><em>sem imagem</em></div>';
														
													}
													
													$arrayTipos = Array("http://", "https://","ftp://");
													?>
													<br />
												</td>
											</tr>
											<tr height="40">
												<td height="28" align="right" valign="middle" class="align_">Protoclo:</td>
												<td height="28" valign="middle">
													<select name="formSERVIDOR" class="form-editMedium">
													<?php
													for ($i = 0; $i < count($arrayTipos); $i++) {
														if ($arrayTipos[$i] == $vformTIPO) {
															echo '<option selected="selected" value="' . $arrayTipos[$i] . '">' . $arrayTipos[$i] . '</option>';
															
														} else {
															echo '<option value="' . $arrayTipos[$i] . '">' . $arrayTipos[$i] . '</option>';
															
														}
													}
													?>
													</select>
												</td>
											</tr>
											<tr height="40">
												<td height="28" align="right" valign="middle" class="align_">Link / URL:</td>
												<td height="28" valign="middle"><input type="text" tabindex="2" name="formLINK" size="60" maxlength="250" value="<?php echo $vformLINK ?>" class="form-edit" /></td>
											</tr>
											<tr height="40">
												<td height="28" align="right" valign="middle" class="align_">Origem:</td>
												<td height="28" valign="middle"><input type="text" tabindex="3" name="formORIGEM" size="20" maxlength="50" value="<?php echo $vformORIGEM . " " ?>" class="form-edit" /></td>
											</tr>
											<tr height="40">
												<td height="28" align="right" valign="middle" class="align_">Descri&ccedil;&atilde;o do Link:</td>
												<td valign="top"><textarea name="formDESCRICAO" rows="8" cols="59" tabindex="4" class="form-edit"><?php echo $vformDESCRICAO ?></textarea></td>
											</tr>
										</tbody>
										<tfoot></tfoot>
									</table>
									
									<div class="clear"><br /></div>
									
									<div id="area-aviso"></div>
									
									<br /><br /><input type="submit" tabindex="6" value="  Atualizar Link " class="formSUBMIT" onClick="fSalvarOk()" />

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