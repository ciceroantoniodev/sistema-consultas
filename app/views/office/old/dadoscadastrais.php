<?php
header("Content-Type: text/html; charset=UTF-8",true);

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
$arrayOPERADORAS = Array("Oi", "Tim", "Vivo", "Claro");

$i = 0;

$queryUsuarios = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO) or die("Falha na execução da consulta.");

	while ($reUsuarios = mysqli_fetch_assoc($queryUsuarios)){
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
		
	}
mysqli_free_result($queryUsuarios);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>SysControle - Sistema Gerenciador de Conteúdo</title>
	<meta http-equiv="content-language" content="pt-br">
	
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
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / DADOS CADASTRAIS</div><br /><br />
						
						<div class="Titulo-Interno">Dados Cadastrais</div><br /><br /><br />
						
						<div id="area-cadastro">   
							<div class="cadastro-titulo">FOTO PERFIL</div>
							
							<div class="clear"><br /></div>
							
							<div align="center">
								<?php
								if (fSeImagem($vformFOTO) && file_exists("images/photos/" . $vformFOTO)) {
									echo '<div id="area-cadastro-foto"><img src="images/photos/' . $vformFOTO . '" width="200" height="200" border="0" /></div>';
									echo '<div id="area-cadastro-fotobotao"><a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&c=foto" target="direcionar"><br /><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; width: 100px\'>&nbsp;excluir imagem&nbsp;</div></a></div>';
									
								} else {
									if ($vformSEXO == "F") {
										echo '<div id="area-cadastro-foto"><img src="images/semfoto_feminino.jpg" width="200" height="200" border="0" /></div>';
										
									} else {
										echo '<div id="area-cadastro-foto"><img src="images/semfoto_masculino.jpg" width="200" height="200" border="0" /></div>';
										
									}
									
									echo '<div id="area-cadastro-fotobotao"><br /><form method="post" action="enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=perfil" target="direcionar" enctype="multipart/form-data"><input type="file" name="formFOTO" onChange="javascript: submit()" /><div style="font-size: 12px; color: #666666; margin-top: 6px"><em>(Envie uma imagem com dimensão de 200 X 200 pixels.)</em></div></form></div>';
									
									echo '<div id="ImagemFoto" style="display: none; width: 100%; background: #FF0040; border: #DF0101 1px solid; padding: 10px; margin-top: 15px; color: #ffffff"><div id="ImagemFotoTexto" style="text-align: center"></div></div>';
									
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
									<input type="text" name="formNOME" id="idNOME" class="form-edit" tabindex="3" maxlength="100"  value="<?php echo $vformNOME ?>" />
						  
									<label for="Endereco">Endere&ccedil;o</label>
									<input type="text" name="formENDERECO" id="idENDERECO" class="form-edit" tabindex="9" maxlength="100" value="<?php echo $vformENDERECO ?>" />

									<label for="Complemento">Complemento</label>
									<input type="text" name="formCOMPLEMENTO" id="idCOMPLEMENTO" class="form-edit" tabindex="13" maxlength="80" value="<?php echo $vformCOMPLEMENTO ?>" />

									<label for="Cdade">Cidade</label>
									<input type="text" name="formCIDADE" id="idCIDADE" class="form-edit" tabindex="15" maxlength="80" value="<?php echo $vformCIDADE ?>" />
						  
									<div class="form-area-campos">
										<br />
										<table border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td width="250" align="left">Pa&iacute;s</td>
												<td width="170" align="left">CEP</td>
											</tr>
											<tr>
												<td>
													<select name="formPAIS" id="idPAIS" class="form-editMedium" tabindex="17" onChange="fAtualizaCampos(document.frmCadastro.formPAIS.options[document.frmCadastro.formPAIS.selectedIndex].value)">
														<option value="BRASIL" selected="selected">BRASIL</option>
													</select>
												</td>
												<td><input type="text" name="formCEP" id="idCEP" class="form-editSmall" tabindex="18" maxlength="15" value="<?php echo $vformCEP ?>" /></td>
											</tr>
										</table>
										
									</div>

									<label for="Email">Email Pr&oacute;prio</label>
									<input type="hidden" name="formEMAILATUAL" value="<?php echo $vformEMAIL ?>" />
									<input type="text" name="formEMAIL" id="idEMAIL" class="form-edit" tabindex="23" maxlength="150" value="<?php echo $vformEMAIL ?>" />

									<label for="EmailAlternativo">Email Alternativo</label>
									<input type="text" name="formEMAILADICIONAL" id="idEMAILADICIONAL" class="form-edit" tabindex="25" maxlength="150" value="<?php echo $vformEMAILADICIONAL ?>" />

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
												<td><input type="text" name="formDTNASCIMENTODIA" id="idDTNASCIMENTODIA" onKeyPress="return fApenasNumero(event)" class="form-edit-data" tabindex="4" maxlength="2" value="<?php echo $vformDTNASCIMENTODIA ?>" /></td>
												<td>/</td>
												<td><input type="text" name="formDTNASCIMENTOMES" id="idDTNASCIMENTOMES" onKeyPress="return fApenasNumero(event)" class="form-edit-data" tabindex="5" maxlength="2" value="<?php echo $vformDTNASCIMENTOMES ?>" /></td>
												<td>/</td>
												<td><input type="text" name="formDTNASCIMENTOANO" id="idDTNASCIMENTOANO" onKeyPress="return fApenasNumero(event)" class="form-edit-dataano" tabindex="6" maxlength="4" value="<?php echo $vformDTNASCIMENTOANO ?>" /></td>
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
													<td><input type="text" name="formNUMERO" id="idNUMERO" class="form-editSmall" tabindex="10" maxlength="10" value="<?php echo $vformENDERECO_NUM ?>" /></td>
													<td width="100" align="left">&nbsp;</td>
													<td><input type="text" name="formCPF" id="idCPF" class="form-editMedium" tabindex="11" value="<?php echo $vformCPF ?>" /></td>
													<td width="100" align="left">&nbsp;</td>
													<td><input type="text" name="formRG" id="idRG" class="form-editMedium" tabindex="12" maxlength="20" value="<?php echo $vformRG ?>" /></td>
												</tr>
											</table>
										</div>
									</div>

									<label for="Bairro">Bairro</label>
									<input type="text" name="formBAIRRO" id="idBAIRRO" class="form-edit" tabindex="14" maxlength="80" value="<?php echo $vformBAIRRO ?>" />

									<label for="Estado">Estado</label>
									<div id="EstadoExterior" style="display: none"><input type="text" name="formESTADOEXTERIOR" id="idESTADOEXTERIOR" class="form-edit-combo" tabindex="12" maxlength="80" value="" /></div>
									<div id="EstadoBrasil">
										<select name="formESTADO" id="idESTADO" class="form-edit" tabindex="16">
											<?php
											$arrayUF = Array(Array("AC", "Acre"),
														Array("AL", "Alagoas"),
														Array("AP", "Amapá"),
														Array("AM", "Amazonas"),
														Array("BA", "Bahia"),
														Array("CE", "Ceará"),
														Array("DF", "Distrito Federal"),
														Array("ES", "Espírito Santo"),
														Array("GO", "Goiás"),
														Array("MA", "Maranhão"),
														Array("MT", "Mato Grosso"),
														Array("MS", "Mato Grosso do Sul"),
														Array("MG", "Minas Gerais"),
														Array("PA", "Pará"),
														Array("PB", "Paraíba"),
														Array("PR", "Paraná"),
														Array("PE", "Pernambuco"),
														Array("PI", "Piauí­"),
														Array("RJ", "Rio de Janeiro"),
														Array("RN", "Rio Grande do Norte"),
														Array("RS", "Rio Grande do Sul"),
														Array("RO", "Rondônia"),
														Array("RR", "Roraima"),
														Array("SC", "Santa Catarina"),
														Array("SP", "São Paulo"),
														Array("SE", "Sergipe"),
														Array("TO", "Tocantins"));

											$vEcho = '';

											for ($i = 0; $i < count($arrayUF); $i++) {
												if ($vformESTADO == $arrayUF[$i][0]) {
													$vEcho .= '<option selected="selected" value="' . $arrayUF[$i][0] . '" >' . $arrayUF[$i][1] . '</option>';

												} else {
													$vEcho .= '<option value="' . $arrayUF[$i][0] . '" >' . $arrayUF[$i][1] . '</option>';

												}

											}

											echo $vEcho;
											?>
										</select>
									</div>
						  
									
									<label for="idFACEBOOK">Fone</label>
									<div class="clear"></div>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="55"><input type="text" name="formDDDFONE" id="idDDDFONE" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="19" maxlength="2" value="<?php echo $vformDDDFONE ?>" /></td>
											<td width="165"><input type="text" name="formFONE" id="idFONE" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="20" maxlength="20" value="<?php echo $vformFONE ?>" /></td>
										</tr>
									</table>
									
									<label for="idFACEBOOK">Site/Facebook</label>
									<input type="text" name="formFACEBOOK" id="idFACEBOOK" class="form-edit" tabindex="24" maxlength="250" value="<?php echo $vformFACEBOOK ?>" />
									<div class="clear"></div>
									
									<label for="Skype">Skype</label>
									<input type="text" name="formSKYPE" id="isSKYPE" class="form-edit" tabindex="26" maxlength="50" value="<?php echo $vformSKYPE ?>" />
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
												<td width="45"><input type="text" name="formDDDCELULAR1" id="idDDDCELULAR1" onKeyPress="return fApenasNumero(event)" class="form-edit-fone1" tabindex="19" maxlength="2" value="<?php echo $vformDDDCELULAR1 ?>" /></td>
												<td width="105"><input type="text" name="formCELULAR1" id="idCELULAR1" onKeyPress="return fApenasNumero(event)" class="form-edit-fone2" tabindex="20" maxlength="20" value="<?php echo $vformCELULAR1 ?>" /></td>
												<td width="80">
													<select name="formOPERADORA1" id="idOPERADORA3" class="form-edit-fone3" tabindex="16">
														<?php
														$vEcho = "";
														
														for ($i = 0; $i < count($arrayOPERADORAS); $i++) {
															if ($vformOPERADORA1 == $arrayOPERADORAS[$i]) {
																$vEcho .= '<option selected="selected" value="' . $arrayOPERADORAS[$i] . '" >' . $arrayOPERADORAS[$i] . '</option>';

															} else {
																$vEcho .= '<option value="' . $arrayOPERADORAS[$i] . '" >' . $arrayOPERADORAS[$i] . '</option>';

															}

														}
														
														echo $vEcho;
														?>
													</select>
												</td>
												<td width="45"><input type="text" name="formDDDCELULAR2" id="idDDDCELULAR2" onKeyPress="return fApenasNumero(event)" class="form-edit-fone1" tabindex="19" maxlength="2" value="<?php echo $vformDDDCELULAR2 ?>" /></td>
												<td width="105"><input type="text" name="formCELULAR2" id="idCELULAR2" onKeyPress="return fApenasNumero(event)" class="form-edit-fone2" tabindex="20" maxlength="20" value="<?php echo $vformCELULAR2 ?>" /></td>
												<td width="80">
													<select name="formOPERADORA2" id="idOPERADORA2" class="form-edit-fone3" tabindex="16">
														<?php
														$vEcho = "";
														
														for ($i = 0; $i < count($arrayOPERADORAS); $i++) {
															if ($vformOPERADORA2 == $arrayOPERADORAS[$i]) {
																$vEcho .= '<option selected="selected" value="' . $arrayOPERADORAS[$i] . '" >' . $arrayOPERADORAS[$i] . '</option>';

															} else {
																$vEcho .= '<option value="' . $arrayOPERADORAS[$i] . '" >' . $arrayOPERADORAS[$i] . '</option>';

															}

														}
														
														echo $vEcho;
														?>
													</select>
												</td>
												<td width="45"><input type="text" name="formDDDCELULAR3" id="idDDDCELULAR3" onKeyPress="return fApenasNumero(event)" class="form-edit-fone1" tabindex="19" maxlength="2" value="<?php echo $vformDDDCELULAR3 ?>" /></td>
												<td width="105"><input type="text" name="formCELULAR3" id="idCELULAR3" onKeyPress="return fApenasNumero(event)" class="form-edit-fone2" tabindex="20" maxlength="20" value="<?php echo $vformCELULAR3 ?>" /></td>
												<td width="100">
													<select name="formOPERADORA3" id="idOPERADORA3" class="form-edit-fone3" tabindex="16">
														<?php
														$vEcho = "";
														
														for ($i = 0; $i < count($arrayOPERADORAS); $i++) {
															if ($vformOPERADORA3 == $arrayOPERADORAS[$i]) {
																$vEcho .= '<option selected="selected" value="' . $arrayOPERADORAS[$i] . '" >' . $arrayOPERADORAS[$i] . '</option>';

															} else {
																$vEcho .= '<option value="' . $arrayOPERADORAS[$i] . '" >' . $arrayOPERADORAS[$i] . '</option>';

															}

														}
														
														echo $vEcho;
														?>
													</select>
												</td>
												<td width="155"><input type="text" name="formWHATSAPP" id="idWHATSAPP" class="form-editMedium" tabindex="24" maxlength="30" value="<?php echo $vformWHATSAPP ?>" /></td>
											</tr>
										</table>
									</div>
								</div>
								
								<div class="clear"><br /><br /></div>
								
								<div id="area-aviso"></div>
								
								<div>
									<div style="float: left"><br /><br /><input type="submit" id="button" value="   ATUALIZAR  " tabindex="27" onClick="fImagemLoad()" class="formSUBMIT" /></div>
								</div>
								
								<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>
			
								<div class="clear"><br /><br /><br /></div>

							</form>

						</div>

						<div id="boxDIALOGO"></div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</body>
</html>