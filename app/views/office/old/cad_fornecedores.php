<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;
$vgetIdCategoria = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vSALVAR = "N";
$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_fornecedores.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE FORNECEDORES</a> ';

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vTituloSecao = "Cadastro de Fornecedores";

$vgetID_FORNECEDOR = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vformTIPO = '';
$vformNOME = '';
$vformCNPJ = '';
$vformIE = '';
$vformENDERECO = '';
$vformENDERECO_NUM = '';
$vformCOMPLEMENTO = '';
$vformBAIRRO = '';
$vformCIDADE = '';
$vformESTADO = '';
$vformCEP = '';
$vformDDDFONE1 = '';
$vformFONE1 = '';
$vformDDDFONE2 = '';
$vformFONE2 = '';
$vformDDDCELULAR = '';
$vformCELULAR = '';
$vformDDDFAX = '';
$vformFAX = '';
$vformEMAIL = '';
$vformSITE = '';
$vformFACEBOOK = '';
$vformSKYPE = '';
$vformCONTATO = '';
$vformOBS = '';

$vDT_CADASTRO = date("Y-m-d H:i:s");

if ($vgetAcao == "alterar") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_fornecedores WHERE id=" . $vgetID_FORNECEDOR) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		if ($vRE != "") {
			$vformTIPO = $vRE["tipo"];
			$vformNOME = $vRE["nome"];
			$vformCNPJ = $vRE["cnpj"];
			$vformIE = $vRE["ie"];
			$vformENDERECO = $vRE["endereco"];
			$vformENDERECO_NUM = $vRE["endereco_num"];
			$vformBAIRRO = $vRE["bairro"];
			$vformCIDADE = $vRE["cidade"];
			$vformESTADO = $vRE["estado"];
			$vformCEP = $vRE["cep"];
			$vformCOMPLEMENTO = $vRE["referencia"];
			$vformDDDFONE1 = $vRE["dddfone1"];
			$vformFONE1 = $vRE["fone1"];
			$vformDDDFONE2 = $vRE["dddfone2"];
			$vformFONE2 = $vRE["fone2"];
			$vformDDDCELULAR = $vRE["dddcelular"];
			$vformCELULAR = $vRE["celular"];
			$vformDDDFAX = $vRE["dddfax"];
			$vformFAX = $vRE["fax"];
			$vformEMAIL = $vRE["email"];
			$vformSITE = $vRE["site"];
			$vformFACEBOOK = $vRE["facebook"];
			$vformSKYPE = $vRE["skype"];
			$vformCONTATO = $vRE["contato"];
			$vformOBS = $vRE["obs"];
		}
	mysqli_free_result($vQUERY);
	
	$vformACAO = "atualizar";
	$vTituloSecao = "Alterar Dados do Fornecedor";

} else {
	$vformACAO = "novo";

}

if ($vformTIPO == "fornecedor") {
	$vCheckedFornecedor = 'checked="checked"';
	$vCheckedFabricante = '';
	
} else {
	$vCheckedFornecedor = '';
	$vCheckedFabricante = 'checked="checked"';
	
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
			
		<script language="Javascript" src="./documentos/js/funcoes.js" type="text/javascript"></script>

		<style type="text/css">
		<!--
		html {height:100%; overflow-y: auto;}

		.table {height:100%;}
		
		td {font-weight: bold; color: #333333; padding: 2px}
		
		td.tt {
			height: 35px;
			width: 220px;
			text-align: right;
			vertical-align: middle;
		}
		-->
		</style>

	</head>

	<body>
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-quero-apostas">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno ?>/ CADASTRO DE FORNECEDORES</div><br /><br />
							
							<div class="Titulo-Interno"><?php echo $vTituloSecao ?></div><br /><br /><br />
							
							<div id="area-cadastro">   

								<form action="salvar_fornecedores.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmCadFornecedores" onSubmit="return fValidaForm(this)">
									<input name="formACAO" type="hidden" value="<?php echo $vformACAO ?>" />
									<input name="formID_FORNECEDOR" type="hidden" value="<?php echo $vgetID_FORNECEDOR ?>" />
									
									<div id="boxEIXO"></div>
															
									<div id="form-cadastros" class="widthVAR">
										
										<table width="100%" cellspacing="0" cellpadding="0" border="0" class="letras_">
											<?php
											if ($vgetID_FORNECEDOR != "") {
												echo '<tr>';
												echo '<td align="right" class="tt"><strong>C&Oacute;DIGO:</strong></td>';
												echo '<td><span class="fonte18 CorRed">' . StrZero($vgetID_FORNECEDOR, 6) . '</span></td>';
												echo '</tr>';
												
											} 
											?>
											<tr> 
												<td align="right" class="tt">Tipo:</td>
												<td><input type="radio" name="formTIPO" tabindex="1" value="fornecedor" <?php echo $vCheckedFornecedor ?> /> FORNECEDOR&nbsp;&nbsp;&nbsp;<input type="radio" name="formTIPO" value="fabricante" <?php echo $vCheckedFabricante ?> /> FABRICANTE</td>
											</tr>
											<tr> 
												<td align="right" class="tt">Nome:</td>
												<td><input type="text" name="formNOME" maxlength="80" tabindex="2" value="<?php echo $vformNOME ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">CNPJ:</td>
												<td>
													<input type="text" name="formCNPJ" size="18" tabindex="3" maxlength="20" value="<?php echo $vformCNPJ ?>" class="form-editMetade" />&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>
											<tr> 
												<td align="right" class="tt">Inscri&ccedil;&atilde;o Estadual:</td>
												<td>
													<input type="text" name="formIE" size="18" tabindex="4" maxlength="20" value="<?php echo $vformIE ?>" class="form-editMedium" />
												</td>
											</tr>
											<tr> 
												<td align="right" class="tt">Endere&ccedil;o:</td>
												<td><input type="text" name="formENDERECO" maxlength="80" tabindex="5" value="<?php echo $vformENDERECO ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Endere&ccedil;o N&uacute;mero:</td>
												<td><input type="text" name="formENDERECO_NUM" size="10" tabindex="6" maxlength="10" value="<?php echo $vformENDERECO_NUM ?>" class="form-editSmall" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Complemento:</td>
												<td><input type="text" name="formCOMPLEMENTO" size="30" tabindex="7" maxlength="80" value="<?php echo $vformCOMPLEMENTO ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Bairro:</td>
												<td><input type="text" name="formBAIRRO" size="40" tabindex="8" maxlength="80" value="<?php echo $vformBAIRRO ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">CEP:</td>
												<td><input type="text" name="formCEP" size="10" tabindex="9" maxlength="15" value="<?php echo $vformCEP ?>" class="form-editMedium" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Cidade:</td>
												<td><input type="text" name="formCIDADE" size="30" tabindex="10" maxlength="80" value="<?php echo $vformCIDADE ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Estado:</td>
												<td>
													<select name="formESTADO" tabindex="11" class="form-editSmall">
														<option value="<?php echo $vformESTADO ?>"><?php echo $vformESTADO ?></option>
														<option value="AC">AC</option>
														<option value="AL">AL</option>
														<option value="AM">AM</option>
														<option value="AP">AP</option>
														<option value="BA">BA</option>
														<option value="CE">CE</option>
														<option value="DF">DF</option>
														<option value="ES">ES</option>
														<option value="GO">GO</option>
														<option value="MA">MA</option>
														<option value="MG">MG</option>
														<option value="MS">MS</option>
														<option value="MT">MT</option>
														<option value="PA">PA</option>
														<option value="PB">PB</option>
														<option value="PE">PE</option>
														<option value="PI">PI</option>
														<option value="PR">PR</option>
														<option value="RJ">RJ</option>
														<option value="RN">RN</option>
														<option value="RO">RO</option>
														<option value="RR">RR</option>
														<option value="RS">RS</option>
														<option value="SC">SC</option>
														<option value="SE">SE</option>
														<option value="SP">SP</option>
														<option value="TO">TO</option>
													</select>												
												</td>
											</tr>
											<tr> 
												<td align="right" class="tt">Fone(s):</td>
												<td>
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="55"><input type="text" name="formDDDFONE1" id="idDDDFONE1" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="12" maxlength="2" value="<?php echo $vformDDDFONE1 ?>" /></td>
															<td width="165"><input type="text" name="formFONE1" id="idFONE1" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="13" maxlength="20" value="<?php echo $vformFONE1 ?>" /></td>
															<td width="55"><input type="text" name="formDDDFONE2" id="idDDDFONE2" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="14" maxlength="2" value="<?php echo $vformDDDFONE2 ?>" /></td>
															<td width="165"><input type="text" name="formFONE2" id="idFONE2" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="15" maxlength="20" value="<?php echo $vformFONE2 ?>" /></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr> 
												<td align="right" class="tt">Celular:</td>
												<td>
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="55"><input type="text" name="formDDDCELULAR" id="idDDDCELULAR" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="16" maxlength="2" value="<?php echo $vformDDDCELULAR ?>" /></td>
															<td width="165"><input type="text" name="formCELULAR" id="idCELULAR" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="17" maxlength="20" value="<?php echo $vformCELULAR ?>" /></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr> 
												<td align="right" class="tt">Fax:</td>
												<td>
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td width="55"><input type="text" name="formDDDFAX" id="idDDDFAX" onKeyPress="return fApenasNumero(event)" class="form-editSmall1" tabindex="18" maxlength="2" value="<?php echo $vformDDDFAX ?>" /></td>
															<td width="165"><input type="text" name="formFAX" id="idFAX" onKeyPress="return fApenasNumero(event)" class="form-editMedium" tabindex="19" maxlength="20" value="<?php echo $vformFAX ?>" /></td>
														</tr>
													</table>
												</td>
											</tr>
											<tr> 
												<td align="right" class="tt">E-mail:</td>
												<td><input type="text" name="formEMAIL" maxlength="100" tabindex="20" value="<?php echo $vformEMAIL ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Site:</td>
												<td><input type="text" name="formSITE" maxlength="150" tabindex="21" value="<?php echo $vformSITE ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Facebook:</td>
												<td><input type="text" name="formFACEBOOK" maxlength="150" tabindex="22" value="<?php echo $vformFACEBOOK ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Skype:</td>
												<td><input type="text" name="formSKYPE" size="30" maxlength="50" tabindex="23" value="<?php echo $vformSKYPE ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Pessoa de Contato:</td>
												<td><input type="text" name="formCONTATO" size="30" maxlength="50" tabindex="24" value="<?php echo $vformCONTATO ?>" class="form-edit" /></td>
											</tr>
											<tr> 
												<td align="right" class="tt">Observa&ccedil;&atilde;o:</td>
												<td><textarea name="formOBS" rows="8" cols="47" tabindex="25" class="form-edit"><?php echo $vformOBS ?></textarea></td>
											</tr>
										</table>
										
										<div class="clear"><br /></div>
										
										<div id="area-aviso"></div>
										
										<div class="clear"><br /></div>
										
										<div align="center"><input type="submit" value="   Atualizar Dados  " tabindex="26" class="formSUBMIT" /></div>
									
										<div class="clear"><br /></div>

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