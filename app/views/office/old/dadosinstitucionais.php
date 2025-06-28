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

$queryUsuarios = $vConexao->query("SELECT * FROM sysc_dadoscadastrais") or die("Falha na execução da consulta.");

	$reUsuarios = mysqli_fetch_array($queryUsuarios);

	$vformNOME = $reUsuarios['nome'];
	$vformENDERECO = $reUsuarios['endereco'];
	$vformCIDADE = $reUsuarios['cidade'];
	$vformCEP = $reUsuarios['cep'];
	$vformEMAIL = $reUsuarios['email'];
	$vformFACEBOOK = $reUsuarios['facebook'];
	$vformSITE = $reUsuarios['site'];
	$vformCNPJ = $reUsuarios['cnpj'];
	$vformDTNASCIMENTODIA = strftime("%d", strtotime($reUsuarios['dt_nascimento']));
	$vformDTNASCIMENTOMES = strftime("%m", strtotime($reUsuarios['dt_nascimento']));
	$vformDTNASCIMENTOANO = strftime("%Y", strtotime($reUsuarios['dt_nascimento']));
	$vformENDERECO_NUM = $reUsuarios['endereco_num'];
	$vformBAIRRO = $reUsuarios['bairro'];
	$vformCOMPLEMENTO = $reUsuarios['referencia'];
	$vformESTADO = $reUsuarios['uf'];
	$vformDDDFONE1 = $reUsuarios['dddfone1'];
	$vformFONE1 = $reUsuarios['fone1'];
	$vformDDDFONE2 = $reUsuarios['dddfone2'];
	$vformFONE2 = $reUsuarios['fone2'];
	$vformDDDCELULAR = $reUsuarios['dddcelular'];
	$vformCELULAR = $reUsuarios['celular'];
	$vformDDDFAX = $reUsuarios['dddfax'];
	$vformFAX = $reUsuarios['fax'];
	$vformSKYPE = $reUsuarios['skype'];
	$vformTWITTER = $reUsuarios['twitter'];
	$vformWHATSAPP = $reUsuarios['whatsapp'];
	$vformFOTO = $reUsuarios['imagem'];
	$vformMAPA = $reUsuarios['mapa'];
		
//		$vformAUTENTICACAO = $reUsuarios['autenticacao'];
		
//		$vformFOTORG = $reUsuarios['foto_rg'];
//		$vformFOTOCPF = $reUsuarios['foto_cpf'];
		
//		$vformVALIDARCPF = $reUsuarios['validado_cpf'];
//		$vformVALIDARRG = $reUsuarios['validado_rg'];
//		$vformVALIDAREMAIL = $reUsuarios['validado_email'];

//		if ($vformVALIDARCPF != "S") { $vformVALIDARCPF = "N"; }
//		if ($vformVALIDARRG != "S") { $vformVALIDARRG = "N"; }
//		if ($vformVALIDAREMAIL != "S") { $vformVALIDAREMAIL = "N"; }
		
	if ((int)$vformDTNASCIMENTODIA . '-' . (int)$vformDTNASCIMENTOMES . '-' . (int)$vformDTNASCIMENTOANO == "1-1-1970") {
		$vformDTNASCIMENTODIA = "";
		$vformDTNASCIMENTOMES = "";
		$vformDTNASCIMENTOANO = "";

	}
	
	$i++;
	
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
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / DADOS INSTITUCIONAIS</div><br /><br />
						
						<div class="Titulo-Interno">Dados Institucionais</div><br /><br /><br />
						
						<div id="area-cadastro">   
							<div class="cadastro-titulo">IMAGEM / LOGOMARCA</div>
							
							<div class="clear"><br /></div>
							
							<div align="center">
								<?php
								if (fSeImagem($vformFOTO) && file_exists("../images/" . $vformFOTO)) {
									echo '<div id="area-cadastro-foto"><img src="../images/' . $vformFOTO . '" border="0" /></div>';
									echo '<div id="area-cadastro-fotobotao"><a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=institucional&c=imagem" target="direcionar"><br /><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; width: 100px\'>&nbsp;excluir imagem&nbsp;</div></a></div>';
									
								} else {
									echo '<div id="area-cadastro-foto"><img src="images/semfoto_masculino.jpg" width="200" height="200" border="0" /></div>';
									
									echo '<div id="area-cadastro-fotobotao"><br /><form method="post" action="enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=institucional" target="direcionar" enctype="multipart/form-data"><input type="file" name="formFOTO" onChange="javascript: submit()" /></form></div>';
									
									echo '<div id="ImagemFoto" style="display: none; width: 100%; background: #FF0040; border: #DF0101 1px solid; padding: 10px; margin-top: 15px; color: #ffffff"><div id="ImagemFotoTexto" style="text-align: center"></div></div>';
									
								}
								?>

							</div>
							
							<div class="clear"><br /><br /><br /></div>
								
							<form method="post" action="salvar_dadosinstitucionais.php" target="direcionar" id="frmCadastro" name="frmCadastro" onSubmit="return fValidaCadastro()">
								<input type="hidden" name="formIDUSUARIO" value="<?php echo $vgetIDUSUARIO ?>" />

								<div class="cadastro-titulo">DADOS INSTITUCIONAIS</div>
								
								<div class="clear"><br /></div>
								
								<div id="boxEIXO"></div>

								<div id="area-cadastro-left">
									<label for="Nome">Nome Fantasia</label>
									<input type="text" name="formNOME" id="idNOME" class="form-edit" tabindex="3" maxlength="100"  value="<?php echo $vformNOME ?>" />
						  
									<label for="Endereco">Endere&ccedil;o</label>
									<input type="text" name="formENDERECO" id="idENDERECO" class="form-edit" tabindex="9" maxlength="100" value="<?php echo $vformENDERECO ?>" />

									<label for="Complemento">Ponto de Refer&ecirc;ncia</label>
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
									
									<label for="idSITE">Site</label>
									<input type="text" name="formSITE" id="idSITE" class="form-edit" tabindex="24" maxlength="250" value="<?php echo $vformSITE ?>" />
									<div class="clear"></div>

									<label for="idTWITTER">Twitter</label>
									<input type="text" name="formTWITTER" id="idTWITTER" class="form-edit" tabindex="24" maxlength="250" value="<?php echo $vformTWITTER ?>" />
									<div class="clear"></div>
									
									<label for="idCELULAR">Celular</label>
									<div class="clear"></div>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="55"><input type="text" name="formDDDCELULAR" id="idDDDCELULAR" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="19" maxlength="2" value="<?php echo $vformDDDCELULAR ?>" /></td>
											<td width="165"><input type="text" name="formCELULAR" id="idCELULAR" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="20" maxlength="20" value="<?php echo $vformCELULAR ?>" /></td>
										</tr>
									</table>

								</div>
								
								<div id="area-cadastro-right">					
									<label for="Bairro">CNPJ</label>
									<div class="clear"></div>
									<input type="text" name="formBAIRRO" id="idBAIRRO" class="form-editMetade" tabindex="14" maxlength="80" value="<?php echo $vformCNPJ ?>" />
									
									<label for="Bairro">N&uacute;mero</label>
									<input type="text" name="formNUMERO" id="idNUMERO" class="form-editSmall" tabindex="10" maxlength="10" value="<?php echo $vformENDERECO_NUM ?>" />
									
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
						  
									
									<label for="idFACEBOOK">Fone (1)</label>
									<div class="clear"></div>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="55"><input type="text" name="formDDDFONE1" id="idDDDFONE" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="19" maxlength="2" value="<?php echo $vformDDDFONE1 ?>" /></td>
											<td width="165"><input type="text" name="formFONE1" id="idFONE" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="20" maxlength="20" value="<?php echo $vformFONE1 ?>" /></td>
										</tr>
									</table>
									
									<label for="idFACEBOOK">Fone (2)</label>
									<div class="clear"></div>
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="55"><input type="text" name="formDDDFONE2" id="idDDDFONE" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="19" maxlength="2" value="<?php echo $vformDDDFONE2 ?>" /></td>
											<td width="165"><input type="text" name="formFONE2" id="idFONE" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="20" maxlength="20" value="<?php echo $vformFONE2 ?>" /></td>
										</tr>
									</table>
									
									<label for="idFACEBOOK">Facebook</label>
									<input type="text" name="formFACEBOOK" id="idFACEBOOK" class="form-edit" tabindex="24" maxlength="250" value="<?php echo $vformFACEBOOK ?>" />
									
									<label for="isSKYPE">Skype</label>
									<input type="text" name="formSKYPE" id="isSKYPE" class="form-edit" tabindex="26" maxlength="50" value="<?php echo $vformSKYPE ?>" />
									
									<label for="isWHATSAPP">WhatsApp</label>
									<div class="clear"></div>
									<input type="text" name="formWHATSAPP" id="isWHATSAPP" class="form-editMedium" tabindex="26" maxlength="50" value="<?php echo $vformWHATSAPP ?>" />
								</div>
								
								<div>	
									<label for="isMAPA">Mapa</label>
									<div class="clear"></div>
									<textarea name="formMAPA" id="isMAPA" class="form-edit" tabindex="26" rows="7"><?php echo $vformMAPA ?></textarea>
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