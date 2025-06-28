<?php
header("Content-Type: text/html; charset=UTF-8",true);

if (strpos($_SERVER['HTTP_USER_AGENT'], "Firefox") > 0) {
	$vMarginTop = "1860px";
	
} else {
	$vMarginTop = "1860px";
	
}

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;
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
	
	<link rel="shortcut icon" href="favicon.ico"> 
	<style type="text/css">
	<!--
	html {height:100%; overflow-y: auto;}
	.form-edit {
		float: left;
		width: 400px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
		margin-right: 20px;
	}
	.form-editMedium {
		float: left;
		width:140px;
		clear: none;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-editSmall {
		float: left;
		width:100px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-editSmall1 {
		float: left;
		width:40px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-edit-data {
		float: left;
		width:30px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-edit-dataano {
		float: left;
		width:50px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}
	
	.form-submit {
		background: #A9D0F5; 
		width: 100px; 
		height: 100px; 
		border-top: #81BEF7 1px solid; 
		border-left: #81BEF7 1px solid; 
		border-right: #5882FA 1px solid; 
		border-bottom: #5882FA 1px solid; 
		padding: 3px; 
		font-size: 20px; 
		font-family: sego, tahoma, arial; 
		color: #08298A;
	}
	-->
	</style>
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-litagens">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / BANNERS</div><br /><br />
						
						<div class="Titulo-Interno">Banners</div><br /><br />
						
						<table width="90%" border="0" cellspacing="0" cellpadding="0" class="letras_">
							<tr>
								<td align="center">
									<?php
									$dbQUERY = $vConexao->query("SELECT * FROM sysc_banners ORDER BY id") or die("Falha na execu&ccedil;&atilde;o da consulta.");

									$i = 1;
									
									while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
										$resDESCRICAO = $dbRE['descricao'];
										$resARQUIVO = $dbRE['arquivo'];
										$resLINKTIPO = $dbRE['linktipo'];
										$resSITE = $dbRE['link'];
										$resSECAO = $dbRE['secao'];
										$resPOSICIONAMENTO = $dbRE['subsecao'];
										$resORDEM = $dbRE['ordem'];
										$resALTURA = $dbRE['altura'];
										$resLARGURA = $dbRE['largura'];
										
										if ($dbRE['data_inicio'] == "0000-00-00") {
											$resDATA_INICIO_DIA = "00";
											$resDATA_INICIO_MES = "00";
											$resDATA_INICIO_ANO = "0000";
											
										} else {
											$resDATA_INICIO_DIA = date('d', strtotime($dbRE['data_inicio']));
											$resDATA_INICIO_MES = date('m', strtotime($dbRE['data_inicio']));
											$resDATA_INICIO_ANO = date('Y', strtotime($dbRE['data_inicio']));
										}
										
										if ($dbRE['data_fim'] == "0000-00-00") {
											$resDATA_FIM_DIA = "00";
											$resDATA_FIM_MES = "00";
											$resDATA_FIM_ANO = "0000";
											
										} else {
											$resDATA_FIM_DIA = date('d', strtotime($dbRE['data_fim']));
											$resDATA_FIM_MES = date('m', strtotime($dbRE['data_fim']));
											$resDATA_FIM_ANO = date('Y', strtotime($dbRE['data_fim']));
											
										}
										
										if (strpos(strtoupper($resARQUIVO), ".SWF") > 0) {
											$syscTIPO = "ANIMA&ccedil;&atilde;O FLASH";
											$resTIPO = "SWF";
											
										} else {
											$syscTIPO = "IMAGEM (jpg, gif, png, bmp, tiff)";
											$resTIPO = "IMG";
											
										}
										
										if (strtoupper($dbRE['ativo'] == "S")) {
											$syscATIVOSIM = "checked='checked'";
											$syscATIVONAO = "";
											
										} else {
											$syscATIVOSIM = "";
											$syscATIVONAO = "checked='checked'";
											
										}
										
										$vBannerArquivo = trim($dbRE['arquivo']);
										
										$syscFOTODESTAQUE = "<img src='../docs/banners/" . trim($dbRE['arquivo']) . "' border='0' />";

										$syscMOSTRARDADOS = 0;
										
										$resARQUIVO = $dbRE['arquivo'] . " ";
										
										if (trim($resARQUIVO) == "") {
											$syscFOTODESTAQUE = "<img src='../docs/images/sem_imagem.gif' border='0' />";
											$syscMOSTRARDADOS = 1;
											
										}
									
										echo '<div style="margin-bottom: 35px">';
										echo '		<table width="100%" cellspacing="0" cellpadding="0" border="0" class="letras_">';
										echo '  		<tr>';
										echo '    			<td valign="middle" style="border: #cccccc 1px solid;"><div id="areaIMAGEM' . (int)$dbRE['id'] . '" align="center" style="margin: 10px">';
										echo $syscFOTODESTAQUE;
										echo '  			</div></td>';
										echo '  		</tr>';
										echo '  		<tr><td style="padding: 10px; background: #dddddd; border: #cccccc 1px solid">';
										
										echo '<div id="ErroImagem' . (int)$dbRE['id'] . '" style="display: none; width: 100%; background: #FF0040; border: #DF0101 1px solid; padding: 10px; margin-top: 15px; color: #ffffff"><div id="ErroImagem' . (int)$dbRE['id'] . 'Texto" style="text-align: center"></div></div>';

										echo '  		<div align="center"><table><tr><td>';
										
										if (fSeImagem($vBannerArquivo) && file_exists("../docs/banners/" . $vBannerArquivo)) {
											echo '			<div id="area-banner-imagem' . (int)$dbRE['id'] . '"><div style="display: inline"><span style=\'color: #DF013A\'><span style=\'font-family: tahoma, arial; font-size: 16px\'>[ imagem enviada ]</span> </span> <a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&id=' . $dbRE['id'] . '&o=banners&c=arquivo" target="direcionar"><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 14px; font-family: tahoma, arial; color: #ffffff;display: inline\'>&nbsp;Excluir&nbsp;</div></a></div></div>';
										
										} else {	
											echo '			<div id="area-banner-imagem' . (int)$dbRE['id'] . '"><form method="post" action="enviar_imagem.php?o=banners&idu=' . fId("c", $vgetIDUSUARIO) . '&id=' . $dbRE['id'] . '&c=arquivo" target="direcionar" enctype="multipart/form-data">ENVIAR IMAGEM: <div style="display: inline"><input type="file" name="formBANNER" onChange="javascript: submit()" /></div></form></div>';
										
										}
										
										echo '				</td><td width="40"><div align="center">|</div></td><td valign="bottom"><a href="javascript: fBannerDados(' . (int)$dbRE['id'] . ')" target="direcionar"><div id="txtVER' . $dbRE['id'] . '" style=\'background: #A9D0F5; height: 20px; border-top: #81BEF7 1px solid; border-left: #81BEF7 1px solid; border-right: #5882FA 1px solid; border-bottom: #5882FA 1px solid; padding: 3px; font-size: 14px; font-family: tahoma, arial; color: #08298A;display: inline\'>&nbsp;Ver Dados&nbsp;</div></a></td></tr></table>';
										echo '    			</div></td>';
										echo '  		</tr>';
										echo '  		<tr>';
										echo '    			<td align="left" style="background: #dddddd; border: #cccccc 1px solid">';
										echo '    				<div id="areaDADOS' . (int)$dbRE['id'] . '" style="display: none; margin: 15px">';
										
																	if ($dbRE['data_inicio'] == "0000-00-00") {
																		$syscPERIODO_INICIAL = "00-00-0000";
																		
																	} else {
																		$syscPERIODO_INICIAL = strftime("%d/%m/%Y", strtotime($dbRE['data_inicio']));
																		
																	}
																	
																	if ($dbRE['data_fim'] == "0000-00-00") {
																		$syscPERIODO_FINAL = "00-00-0000";
																		
																	} else {
																		$syscPERIODO_FINAL = strftime("%d/%m/%Y", strtotime($dbRE['data_fim']));
																		
																	}
																	?>
																	<form method="post" action="salvar_banners.php" target="direcionar">
																		<input type="hidden" name="formIDUSUARIO" value="<?php echo fId("c", $vgetIDUSUARIO) ?>" />
																		<input type="hidden" name="formIDBANNER" value="<?php echo $dbRE['id'] ?>" />
																		
																		<table cellspacing="2" cellpadding="0" border="0" style="font-size: 14px">
																			<thead></thead>
																			<tbody>
																				<tr> 
																					<td valign="middle">Banner Ativo?</span></td>
																					<td valign="middle"><input type="radio" name="formATIVO" value="S" <?php echo $syscATIVOSIM ?> />SIM&nbsp;<input type="radio" name="formATIVO" value="N" <?php echo $syscATIVONAO ?>>N&atilde;O</td>
																					<td valign="middle">Ordem:</span></td>
																					<td valign="middle"><input type="text" name="formORDEM" size="3" maxlength="2" value="<?php echo $resORDEM ?>" class="form-edit-dataano" /></td>
																					<td valign="middle" width="150" rowspan="5"><div align="center"><div id="areaOK<?php echo $dbRE['id'] ?>" style="background: #81BEF7; color: #08298A; font-size: 18px; width: 100px; padding: 5px; margin-bottom: 10px; display: none">Ok! Salvo.</div><input type="submit" value="Atualizar" class="form-submit" /></div></td>
																				</tr>
																				<tr> 
																					<td valign="middle">Descri&ccedil;&atilde;o:</td>
																					<td valign="middle"><input type="text" name="formDESCRICAO" size="50" maxlength="80" value="<?php echo $resDESCRICAO ?>" class="form-edit" /></td>
																					<td valign="middle">Se&ccedil;&atilde;o:</span></td>
																					<td valign="middle"> 
																						<select name="formSECAO" class="form-editSmall">
																							<option value="home">Home</option>
																							<option value="slide" selected="selected">Slide</option>
																						</select>
																					</td>
																				</tr>
																				<tr> 
																					<td valign="middle">Largura (pixels):</td>
																					<td valign="middle"> 
																						<table cellspacing="2" cellpadding="0" border="0"><tr><td>
																							<input type="text" name="formLARGURA" size="4" maxlength="5" value="<?php echo $resLARGURA ?>" class="form-editSmall" />
																							</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Altura (pixels):</td><td><input type="text" name="formALTURA" size="4" maxlength="5" value="<?php echo $resALTURA ?>" class="form-editSmall" />
																						</td></tr></table>
																					</td>
																					<td valign="middle">Posicionamento:</td>
																					<td valign="middle"> 
																						<select name="formSUBSECAO" class="form-editSmall">
																							<?php
																							$arrayPOSICIONAMENTO = Array("esquerda", "centro", "direita", "superior", "meio", "inferior", "slide", "outro");

																							for ($i = 0; $i < count($arrayPOSICIONAMENTO); $i++) {
																								if ($resPOSICIONAMENTO == $arrayPOSICIONAMENTO[$i]) {
																									echo '<option value="' . $arrayPOSICIONAMENTO[$i] . '" selected="selected">' . $arrayPOSICIONAMENTO[$i] . '</option>';

																								} else {
																									echo '<option value="' . $arrayPOSICIONAMENTO[$i] . '">' . $arrayPOSICIONAMENTO[$i] . '</option>';

																								}
																							}
																							?>	
																						</select>
																					</td>
																				</tr>
																				<tr> 
																					<td valign="middle">Link:</span></td>
																					<td valign="middle" colspan="3"> 
																						<table cellspacing="2" cellpadding="0" border="0"><tr><td>
																							<?php
																							$arrayLINKTIPO = array(5);

																							$arrayLINKTIPO[0] = "http://";
																							$arrayLINKTIPO[1] = "https://";
																							$arrayLINKTIPO[2] = "ftp://";
																							$arrayLINKTIPO[3] = "interno";
																							$arrayLINKTIPO[4] = "outro";

																							echo '<select name="formLINKTIPO" class="form-editSmall">';

																							for ($i = 0; $i < count($arrayLINKTIPO); $i++) {
																							if ($resLINKTIPO == $arrayLINKTIPO[$i]) {
																							echo '<option value="' . $arrayLINKTIPO[$i] . '" selected="selected">' . $arrayLINKTIPO[$i] . '</option>';

																							} else {
																							echo '<option value="' . $arrayLINKTIPO[$i] . '">' . $arrayLINKTIPO[$i] . '</option>';

																							}
																							}

																							echo '</select>';
																							?>											
																							</td><td><input type="text" name="formLINK" size="50" maxlength="200" value="<?php echo $resSITE ?>" class="form-edit" /></td>
																						</tr></table>
																					</td>
																				</tr>
																				<tr> 
																					<td valign="middle">Data da Publica&ccedil;&atilde;o:</span></td>
																					<td valign="middle"> 
																						<table cellspacing="2" cellpadding="0" border="0"><tr>
																							<td><input type="text" name="formDATA_INICIO_DIA" size="2" maxlength="2" value="<?php echo $resDATA_INICIO_DIA ?>" class="form-edit-data" />/</td>
																							<td><input type="text" name="formDATA_INICIO_MES" size="2" maxlength="2" value="<?php echo $resDATA_INICIO_MES ?>" class="form-edit-data" />/</td>
																							<td><input type="text" name="formDATA_INICIO_ANO" size="4" maxlength="4" value="<?php echo $resDATA_INICIO_ANO ?>" class="form-edit-dataano" /></td>
																						</tr></table>
																					</td>
																					<td valign="middle">Data de Expira&ccedil;&atilde;o:</span></td>
																					<td valign="middle"> 
																						<table cellspacing="2" cellpadding="0" border="0"><tr>
																							<td><input type="text" name="formDATA_FIM_DIA" size="2" maxlength="2" value="<?php echo $resDATA_FIM_DIA ?>" class="form-edit-data" />/</td>
																							<td><input type="text" name="formDATA_FIM_MES" size="2" maxlength="2" value="<?php echo $resDATA_FIM_MES ?>" class="form-edit-data" />/</td>
																							<td><input type="text" name="formDATA_FIM_ANO" size="4" maxlength="4" value="<?php echo $resDATA_FIM_ANO ?>" class="form-edit-dataano" /></td>
																						</tr></table>
																					</td>
																				</tr>
																			</body>
																			</tfoot></tfoot>
																		</table>
																	</form>
										<?php
										
										echo '    				</div>';
										echo '   			</td>';
										echo '  		</tr>';
										echo '		</table>';
										echo '</div>';
										
										$i++;

									}
									mysqli_free_result($dbQUERY);
									?>
								</td>
							</tr>
						</table>				
				
						<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>
						
					</div>
				</div>					
			</div>
		</div>
	</div>
</body>
</html>