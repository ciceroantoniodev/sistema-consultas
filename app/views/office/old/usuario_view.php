<?php
header("Content-Type: text/html; charset=UTF-8",true);

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usu&aacute;rio
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;

$queryUsuarios = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetID) or die("Falha na execução da consulta.");

	$reUsuarios = mysqli_fetch_array($queryUsuarios);
	
	$arrayUSUARIOS[$i] = Array($reUsuarios['usuario'], $reUsuarios['senha']);

	$vformNOME = $reUsuarios['nome'];
	$vformENDERECO = $reUsuarios['endereco'];
	$vformCOMPLEMENTO = $reUsuarios['complemento'];
	$vformCIDADE = $reUsuarios['cidade'];
	$vformCEP = $reUsuarios['cep'];
	$vformEMAIL = $reUsuarios['email_proprio'];
	$vformEMAILADICIONAL = $reUsuarios['email_adicional'];
	$vformFACEBOOK = $reUsuarios['facebook'];
	$vformCPF = $reUsuarios['cpf'];
	$vformRG = $reUsuarios['rg'];
	$vformDTNASCIMENTODIA = strftime("%d", strtotime($reUsuarios['dt_nascimento']));
	$vformDTNASCIMENTOMES = strftime("%m", strtotime($reUsuarios['dt_nascimento']));
	$vformDTNASCIMENTOANO = strftime("%Y", strtotime($reUsuarios['dt_nascimento']));
	$vformENDERECO_NUM = $reUsuarios['endereco_num'];
	$vformBAIRRO = $reUsuarios['bairro'];
	$vformESTADO = $reUsuarios['uf'];
	$vformDDDFONE = $reUsuarios['dddfone'];
	$vformFONE = $reUsuarios['fone'];
	$vformDDDCELULAR1 = $reUsuarios['dddcelular1'];
	$vformCELULAR1 = $reUsuarios['celular1'];
	$vformOPERADORA1 = $reUsuarios['operadora1'];
	$vformDDDCELULAR2 = $reUsuarios['dddcelular2'];
	$vformCELULAR2 = $reUsuarios['celular2'];
	$vformOPERADORA2 = $reUsuarios['operadora2'];
	$vformDDDCELULAR3 = $reUsuarios['dddcelular3'];
	$vformCELULAR3 = $reUsuarios['celular3'];
	$vformOPERADORA3 = $reUsuarios['operadora3'];
	$vformSKYPE = $reUsuarios['skype'];
	$vformWHATSAPP = $reUsuarios['whatsapp'];
	$vformSEXO = $reUsuarios['sexo'];
	$vformFOTO = $reUsuarios['foto'];
	
	if ((int)$vformDTNASCIMENTODIA . '-' . (int)$vformDTNASCIMENTOMES . '-' . (int)$vformDTNASCIMENTOANO == "1-1-1970") {
		$vformDTNASCIMENTODIA = "";
		$vformDTNASCIMENTOMES = "";
		$vformDTNASCIMENTOANO = "";

	}
	
	if ($vformSEXO == "M") {
		$vCheCkedSexoM = 'checked="checked"';
		$vCheCkedSexoF = '';
		
	} else {
		$vCheCkedSexoM = '';
		$vCheCkedSexoF = 'checked="checked"';
		
	}
	
	$i++;

mysqli_free_result($queryUsuarios);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>..:.::. CashOut Club - Cursos e Investimentos ..::.:..</title>
	
	<meta http-equiv="content-language" content="pt-br">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="CASHOUT CLUB é um projeto criado para melhorar a condição das pessoas que querem fazer do TRADING ESPORTIVO uma fonte de renda extra para suas vidas." />
	<meta name="keywords" content="cashoutclub, trade, curso, investimento, treinamento, clube, club, saque, caixa, betfar, futebol, esporte, esportivo, aposta"/>
	<meta name="robots" content="index, follow">
	<meta name="author" content="SAMSITE Web Design Sistemas">
	<meta name="reply-to" content="suporte@samsite.com.br">
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-quero-apostas">
					<div align="left" style="margin: 30px;">
						<?php
						$vgetIDCHAMADO = isset($_GET["idc"]) ? $_GET["idc"] : NULL;
						
						if ($vgetORIGEM == "usuarios") {
							echo '<div style="font-size: 14px"><a href="javascript: showDIRECT(\'\', \'inicio.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="ltopo">IN&Iacute;CIO</a> / <a href="javascript: showDIRECT(\'\', \'usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="ltopo">GERENCIAMENTO DE USU&Aacute;RIOS</a> / DADOS DO USU&Aacute;RIO</div><br /><br />';
							
						} else if ($vgetORIGEM == "chamados" || $vgetORIGEM == "chamados_doc") {
							echo '<div style="font-size: 14px"><a href="javascript: showDIRECT(\'\', \'inicio.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="ltopo">IN&Iacute;CIO</a> / <a href="javascript: showDIRECT(\'\', \'chamados.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="ltopo">GERENCIAMENTO DE CHAMADOS</a> / <a href="javascript: showDIRECT(\'\', \'chamado_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&id=' . $vgetIDCHAMADO . '&acao=alterar\', \'areaConteudo\')" class="ltopo">CHAMADO RECEBIDO</a> / DADOS DO USU&Aacute;RIO</div><br /><br />';
							
						} else {
							echo '<div style="font-size: 14px"><a href="javascript: showDIRECT(\'\', \'inicio.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="ltopo">IN&Iacute;CIO</a> / <a href="javascript: showDIRECT(\'\', \'indicacoes.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="ltopo">MINHAS INDICAÇÕES</a> / DADOS DO USU&Aacute;RIO</div><br /><br />';
							
						}
						?>
						
						<div class="Titulo-Interno">Dados do Usu&aacute;rio</div><br /><br /><br />
						
					
						<div id="area-cadastro">   
							<div class="cadastro-titulo">FOTO PERFIL</div>
							
							<div class="clear"><br /></div>
							
							<div align="center">
								<?php
								if (fSeImagem($vformFOTO) && file_exists("images/photos/" . $vformFOTO)) {
									echo '<div id="area-cadastro-foto"><img src="images/photos/' . $vformFOTO . '" width="200" height="200" border="0" /></div>';
									
								} else {
									if ($vformSEXO == "F") {
										echo '<div id="area-cadastro-foto"><img src="images/semfoto_feminino.jpg" width="200" height="200" border="0" /></div>';
										
									} else {
										echo '<div id="area-cadastro-foto"><img src="images/semfoto_masculino.jpg" width="200" height="200" border="0" /></div>';
										
									}
									
								}
								?>

							</div>
							
							<div class="clear"><br /><br /><br /></div>
								
							<form method="post" action="salvar_dadoscadastrais.php" target="direcionar" id="frmCadastro" name="frmCadastro" onSubmit="return fValidaCadastro()">
								<input type="hidden" name="formIDUSUARIO" value="<?php echo $vgetIDUSUARIO ?>" />

								<div class="cadastro-titulo">DADOS PESSOAIS</div>
								
								<div class="clear"><br /></div>
								
								<div id="boxEIXO"></div>

								<div id="area-cadastro-left">
									<label for="Nome">Nome</label>
									<div class="usuario-view"><?php echo $vformNOME ?></div>
						  
									<label for="Endereco">Endere&ccedil;o</label>
									<div class="usuario-view"><?php echo $vformENDERECO ?></div>

									<label for="Complemento">Complemento</label>
									<div class="usuario-view"><?php echo $vformCOMPLEMENTO ?>&nbsp;</div>
									
									<label for="Cdade">Cidade</label>
									<div class="usuario-view"><?php echo $vformCIDADE ?></div>
						  
									<div class="form-area-campos">
										<br />
										<table border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="250" align="left">Pa&iacute;s</td>
												<td width="170" align="left">CEP</td>
											</tr>
											<tr>
												<td><div class="usuario-view">BRASIL</div></td>
												<td><div class="usuario-view"><?php echo $vformCEP ?></div></td>
											</tr>
										</table>
										
									</div>

									<label for="Email">Email Pr&oacute;prio</label>
									<div class="usuario-view"><?php echo $vformEMAIL ?></div>

									<label for="EmailAlternativo">Email Alternativo</label>
									<div class="usuario-view"><?php echo $vformEMAILADICIONAL ?></div>

								</div>
								
								<div id="area-cadastro-right">					
									<div class="form-area-campos">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="155" align="left" nowrap="nowrap" colspan="5">Data de Nascimento</td>
												<td width="25" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td width="250" align="left">Sexo</td>
												<td width="25" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;</td>
											</tr>
											<tr>
												<td><div class="usuario-view"><?php echo $vformDTNASCIMENTODIA ?></div></td>
												<td>/</td>
												<td><div class="usuario-view"><?php echo $vformDTNASCIMENTOMES ?></div></td>
												<td>/</td>
												<td><div class="usuario-view"><?php echo $vformDTNASCIMENTOANO ?></div></td>
												<td width="25" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td nowrap="nowrap"><input type="radio" name="formSEXO" id="idSEXO" tabindex="7" value="M" <?php echo $vCheCkedSexoM ?> /> Masculino&nbsp;&nbsp;<input type="radio" name="formSEXO" id="idSEXO" tabindex="8" value="F" <?php echo $vCheCkedSexoF ?> /> Feminino</td>
												<td width="25" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;</td>
											</tr>
										</table>
										
										<div style="margin-top: 20px">
											<table border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td width="150" align="left">N&uacute;mero</td>
													<td width="100" align="left">&nbsp;</td>
													<td width="155" align="left">CPF</td>
													<td width="100" align="left">&nbsp;</td>
													<td width="155" align="left">RG</td>
												</tr>
												<tr>
													<td><div class="usuario-view"><?php echo $vformENDERECO_NUM ?>&nbsp;</div></td>
													<td width="100" align="left">&nbsp;</td>
													<td><div class="usuario-view"><?php echo $vformCPF ?>&nbsp;</div></td>
													<td width="100" align="left">&nbsp;</td>
													<td><div class="usuario-view"><?php echo $vformRG ?>&nbsp;</div></td>
												</tr>
											</table>
										</div>
									</div>

									<label for="Bairro">Bairro</label>
									<div class="usuario-view"><?php echo $vformBAIRRO ?></div>

									<label for="Estado">Estado</label>
									<div id="EstadoExterior" style="display: none"><input type="text" name="formESTADOEXTERIOR" id="idESTADOEXTERIOR" class="form-edit-combo" tabindex="12" maxlength="80" value="" /></div>
									<div id="EstadoBrasil">
										<div class="usuario-view"><?php echo $vformESTADO ?></div>
									</div>
						  
									
									<label for="idFACEBOOK">Fone</label>
									<div class="clear"></div>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="55"><div class="usuario-view">(<?php echo $vformDDDFONE ?>)</div></td>
											<td width="165"><div class="usuario-view"><?php echo $vformFONE ?>&nbsp;</div></td>
										</tr>
									</table>
									
									<label for="idFACEBOOK">Site/Facebook</label>
									<div class="usuario-view"><?php echo $vformFACEBOOK ?>&nbsp;</div>
									<div class="clear"></div>
									
									<label for="Skype">Skype</label>
									<div class="usuario-view"><?php echo $vformSKYPE ?>&nbsp;</div>
								</div>
								
								<div class="clear"></div>
								
								<div>
									<div class="form-area-campos">
										<table border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="left" colspan="3">Celular (1)</td>
												<td align="left" colspan="3">Celular (2)</td>
												<td align="left" colspan="3">Celular (3)</td>
												<td align="left">WhatsApp</td>
											</tr>
											<tr>
												<td width="45"><div class="usuario-view">(<?php echo $vformDDDCELULAR1 ?>)</div></td>
												<td width="105"><div class="usuario-view"><?php echo $vformCELULAR1 ?></div></td>
												<td width="80"><div class="usuario-view"><?php echo $vformOPERADORA1 ?></div></td>
												<td width="45"><div class="usuario-view">(<?php echo $vformDDDCELULAR2 ?>)</div></td>
												<td width="105"><div class="usuario-view"><?php echo $vformCELULAR2 ?></div></td>
												<td width="80"><div class="usuario-view"><?php echo $vformOPERADORA2 ?></div></td>
												<td width="45"><div class="usuario-view">(<?php echo $vformDDDCELULAR2 ?>)</div></td>
												<td width="105"><div class="usuario-view"><?php echo $vformCELULAR2 ?></div></td>
												<td width="100"><div class="usuario-view"><?php echo $vformOPERADORA3 ?></div></td>
												<td width="155"><div class="usuario-view"><?php echo $vformWHATSAPP ?></div></td>
											</tr>
										</table>
									</div>
								</div>
								
								
								<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>
			
								<div class="clear"><br /><br /><br /></div>

							</form>

						</div>					
					
					
					


					

					</div>					
				</div>
			</div>
		</div>
	</div>
</body>
</html>