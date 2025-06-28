<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vAtualiza = false;

if ($vgetIDUSUARIO == "") {
  $vgetIDUSUARIO = isset($_POST["id"]) ? $_POST["id"] : NULL;
  
}

$vMensagemError = "";

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;
$vformANUNCIO = isset($_POST["formANUNCIO"]) ? $_POST["formANUNCIO"] : NULL;

$vformIDCADASTRO = isset($_POST["formIDCADASTRO"]) ? $_POST["formIDCADASTRO"] : NULL;

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;
$vformSOBRENOME = isset($_POST["formSOBRENOME"]) ? $_POST["formSOBRENOME"] : NULL;
$vformCPF = isset($_POST["formCPF"]) ? $_POST["formCPF"] : NULL;
$vformRG = isset($_POST["formRG"]) ? $_POST["formRG"] : NULL;
$vformORGAO = isset($_POST["formORGAO"]) ? $_POST["formORGAO"] : NULL;
$vformDATA_NASC_DIA = isset($_POST["formDATA_NASC_DIA"]) ? $_POST["formDATA_NASC_DIA"] : NULL;
$vformDATA_NASC_MES = isset($_POST["formDATA_NASC_MES"]) ? $_POST["formDATA_NASC_MES"] : NULL;
$vformDATA_NASC_ANO = isset($_POST["formDATA_NASC_ANO"]) ? $_POST["formDATA_NASC_ANO"] : NULL;
$vformSEXO = isset($_POST["formSEXO"]) ? $_POST["formSEXO"] : NULL;
$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
$vformENDERECO_NUM = isset($_POST["formENDERECO_NUM"]) ? $_POST["formENDERECO_NUM"] : NULL;
$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
$vformREFERENCIA = isset($_POST["formREFERENCIA"]) ? $_POST["formREFERENCIA"] : NULL;
$vformDDDFONE = isset($_POST["formDDDFONE"]) ? $_POST["formDDDFONE"] : NULL;
$vformFONE = isset($_POST["formFONE"]) ? $_POST["formFONE"] : NULL;
$vformDDDCELULAR = isset($_POST["formDDDCELULAR"]) ? $_POST["formDDDCELULAR"] : NULL;
$vformCELULAR = isset($_POST["formCELULAR"]) ? $_POST["formCELULAR"] : NULL;
$vformEMAIL_PROPRIO = isset($_POST["formEMAIL_PROPRIO"]) ? $_POST["formEMAIL_PROPRIO"] : NULL;
$vformEMAIL_ADICIONAL = isset($_POST["formEMAIL_ADICIONAL"]) ? $_POST["formEMAIL_ADICIONAL"] : NULL;

$vformUSUARIO = isset($_POST["formUSUARIO"]) ? $_POST["formUSUARIO"] : NULL;
$vformSENHA = isset($_POST["formSENHA"]) ? $_POST["formSENHA"] : NULL;
$vformSENHAC = isset($_POST["formSENHAC"]) ? $_POST["formSENHAC"] : NULL;

$vDATA_CAD = date("Y-m-d H:i:s");
  
if ($vformACAO == "atualizar") {
	if ($vgetTIPO == "associacao") {
		$f_inicio_posse_dia = isset($_POST["dia_inicio_posse"]) ? $_POST["dia_inicio_posse"] : NULL;
		$f_inicio_posse_mes = isset($_POST["mes_inicio_posse"]) ? $_POST["mes_inicio_posse"] : NULL;
		$f_inicio_posse_ano = isset($_POST["ano_inicio_posse"]) ? $_POST["ano_inicio_posse"] : NULL;
		$f_final_posse_dia = isset($_POST["dia_final_posse"]) ? $_POST["dia_final_posse"] : NULL;
		$f_final_posse_mes = isset($_POST["mes_final_posse"]) ? $_POST["mes_final_posse"] : NULL;
		$f_final_posse_ano = isset($_POST["ano_final_posse"]) ? $_POST["ano_final_posse"] : NULL;
		$f_atualpresidente = isset($_POST["atual_presidente"]) ? $_POST["atual_presidente"] : NULL;

	}
	
	$dbAlt = "UPDATE sysc_usuarios SET ";
	$dbFind =  " WHERE id=" . $vgetIDUSUARIO;
	
	$vUsuarioExiste = 10;
	
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO);
		$vRE = mysqli_fetch_array($vQUERY);
		
		$arrayEXISTE = Array("Usuario"=>$vRE['usuario'], "Email"=>$vRE['email_proprio']);
	mysqli_free_result($vQUERY);
	
	$vConexao->query($dbAlt . "usuario='', email_proprio=''" . $dbFind);

	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE (usuario='" . $vformUSUARIO . "') OR (email_proprio='" . $vformEMAIL_PROPRIO . "')");
		while ($vRE = mysqli_fetch_assoc($vQUERY)) {
			$vUsuarioUsuario = trim($vRE['usuario']);
			if ($vformUSUARIO == $vUsuarioUsuario) {
				$vUsuarioExiste = 20;
				$vMensagemError = "Já existe um usuário cadastrado com este NOME DE USUÁRIO. Nada foi alterado.";
				break;
				
			} else {
				$vUsuarioExiste = 20;
				$vMensagemError = "Já existe um usuário cadastrado com este E-MAIL PRÓPRIO. Nada foi alterado.";
				break;

			}

		}		
	mysqli_free_result($vQUERY);
		
	if ($vUsuarioExiste <= 10) {
		$vConexao->query($dbAlt . "
									anuncio='" . $vformANUNCIO . "', 
									nome='" . $vformNOME . "', 
									sobrenome='" . $vformSOBRENOME . "', 
									cpf_cnpj='" . $vformCPF . "', 
									rg='" . $vformRG . "', 
									orgao='" . $vformORGAO . "', 
									data_nasc='" . StrZero("0".$vformDATA_NASC_ANO, 4) . "-" . StrZero("0".$vformDATA_NASC_MES, 2) . "-" . StrZero("0".$vformDATA_NASC_DIA, 2) . "', 
									sexo='" . $vformSEXO . "', 
									endereco='" . $vformENDERECO . "', 
									endereco_num='" . $vformENDERECO_NUM . "', 
									bairro='" . $vformBAIRRO . "', 
									cidade='" . $vformCIDADE . "', 
									estado='" . $vformESTADO . "', 
									cep='" . $vformCEP . "', 
									referencia='" . $vformREFERENCIA . "', 
									dddfone='" . $vformDDDFONE . "', 
									fone='" . $vformFONE . "', 
									dddcelular='" . $vformDDDCELULAR . "', 
									celular='" . $vformCELULAR . "', 
									email_proprio='" . $vformEMAIL_PROPRIO . "', 
									email_adicional='" . $vformEMAIL_ADICIONAL . "', 
									usuario='" . $vformUSUARIO . "'" . $dbFind);

									
		//---------------------------------------------------------
		//
		// Inicia gravação na tabela CADASTRO GERAL
		//
		//---------------------------------------------------------
		
		
		if ($vgetTIPO == "anunciante") {
			$vformJURIDICA = isset($_POST["formJURIDICA"]) ? $_POST["formJURIDICA"] : NULL;
			$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : NULL;
			$vformPALAVRAS_CHAVE = isset($_POST["formPALAVRAS_CHAVE"]) ? $_POST["formPALAVRAS_CHAVE"] : NULL;
			$vformHISTORICO = isset($_POST["formHISTORICO"]) ? $_POST["formHISTORICO"] : NULL;
			$vformCNPJ = isset($_POST["formCNPJ"]) ? $_POST["formCNPJ"] : NULL;
			$vformIE = isset($_POST["formIE"]) ? $_POST["formIE"] : NULL;
			$vformDDDFONE2 = isset($_POST["formDDDFONE2"]) ? $_POST["formDDDFONE2"] : NULL;
			$vformFONE2 = isset($_POST["formFONE2"]) ? $_POST["formFONE2"] : NULL;
			$vformDDDCELULAR2 = isset($_POST["formDDDCELULAR2"]) ? $_POST["formDDDCELULAR2"] : NULL;
			$vformCELULAR2 = isset($_POST["formCELULAR2"]) ? $_POST["formCELULAR2"] : NULL;
			$vformDDDFAX = isset($_POST["formDDDFAX"]) ? $_POST["formDDDFAX"] : NULL;
			$vformFAX = isset($_POST["formFAX"]) ? $_POST["formFAX"] : NULL;
			$vformCONTATO = isset($_POST["formCONTATO"]) ? $_POST["formCONTATO"] : NULL;
			$vformSITE = isset($_POST["formSITE"]) ? $_POST["formSITE"] : NULL;
			$vformMOSTRAR_FONE = isset($_POST["formMOSTRAR_FONE"]) ? $_POST["formMOSTRAR_FONE"] : NULL;
			$vformMOSTRAR_EMAIL = isset($_POST["formMOSTRAR_EMAIL"]) ? $_POST["formMOSTRAR_EMAIL"] : NULL;
			$vformMOSTRAR_SITE = isset($_POST["formMOSTRAR_SITE"]) ? $_POST["formMOSTRAR_SITE"] : NULL;
			
			$dbAlt = "UPDATE sysc_cadastrogeral SET ";
			$dbFind =  "WHERE id=" . $vformIDCADASTRO;

			if ($vformJURIDICA == "S") {
				$vformCPF = "";
				$vformRG = "";
				$vformORGAO = "";

			} else {
				$vformCNPJ = "";
				$vformIE = "";

			}
			
			$vConexao->query($dbAlt . "
										razao='" . $vformNOME . "', 
										fantasia='" . $vformNOME . "', 
										cnpj='" . $vformCNPJ . "', 
										ie='" . $vformIE . "', 
										cpf='" . $vformCPF . "', 
										rg='" . $vformRG . "', 
										orgao='" . $vformORGAO . "', 
										descricao='" . $vformDESCRICAO . "', 
										palavras_chave='" . $vformPALAVRAS_CHAVE . "', 
										historico='" . $vformHISTORICO . "', 
										dt_nasc='" . StrZero("0".$vformDATA_NASC_ANO, 4) . "-" . StrZero("0".$vformDATA_NASC_MES, 2) . "-" . StrZero("0".$vformDATA_NASC_DIA, 2) . "', 
										endereco='" . $vformENDERECO . "', 
										endereco_num='" . $vformENDERECO_NUM . "', 
										bairro='" . $vformBAIRRO . "', 
										cidade='" . $vformCIDADE . "', 
										estado='" . $vformESTADO . "', 
										cep='" . $vformCEP . "', 
										referencia='" . $vformREFERENCIA . "', 
										dddfone1='" . $vformDDDFONE . "', 
										fone1='" . $vformFONE . "', 
										dddfone2='" . $vformDDDFONE2 . "', 
										fone2='" . $vformFONE2 . "', 
										dddcelular1='" . $vformDDDCELULAR . "', 
										celular1='" . $vformCELULAR . "', 
										dddcelular2='" . $vformDDDCELULAR2 . "', 
										celular2='" . $vformCELULAR2 . "', 
										dddfax='" . $vformDDDFAX . "', 
										fax='" . $vformFAX . "', 
										contato='" . $vformCONTATO . "', 
										site='" . $vformSITE . "', 
										email_proprio='" . $vformEMAIL_PROPRIO . "', 
										email_adicional='" . $vformEMAIL_ADICIONAL . "', 
										mostrar_fone='" . $vformMOSTRAR_FONE . "', 
										mostrar_email='" . $vformMOSTRAR_EMAIL . "', 
										mostrar_site='" . $vformMOSTRAR_SITE . "'" . $dbFind) or die(mysqli_error());;
	  
		} else if ($vgetTIPO == "associacao") {
			$dbAlt = "UPDATE sysc_cadastroassociacao SET ";
			$dbFind =  "WHERE id=" . $vformid;

			$vConexao->query($dbAlt . "nome='" . $vformrazao . "' " . $dbFind);
			$vConexao->query($dbAlt . "cnpj='" . $vformcnpj . "' " . $dbFind);
			$vConexao->query($dbAlt . "endereco='" . $vformendereco . "' " . $dbFind);
			$vConexao->query($dbAlt . "bairro='" . $vformbairro . "' " . $dbFind);
			$vConexao->query($dbAlt . "cidade='" . $vformcidade . "' " . $dbFind);
			$vConexao->query($dbAlt . "estado='" . $vformuf . "' " . $dbFind);
			$vConexao->query($dbAlt . "cep='" . $vformcep . "' " . $dbFind);
			$vConexao->query($dbAlt . "referencia='" . $vformreferencia . "' " . $dbFind);
			$vConexao->query($dbAlt . "dddfone='" . $vformdddfone1 . "' " . $dbFind);
			$vConexao->query($dbAlt . "fone='" . $vformfone1 . "' " . $dbFind);
			$vConexao->query($dbAlt . "dddcelular='" . $vformdddcelular . "' " . $dbFind);
			$vConexao->query($dbAlt . "celular='" . $vformcelular . "' " . $dbFind);
			$vConexao->query($dbAlt . "dddfax='" . $vformdddfax . "' " . $dbFind);
			$vConexao->query($dbAlt . "fax='" . $vformfax . "' " . $dbFind);
			$vConexao->query($dbAlt . "site='" . $vformsite . "' " . $dbFind);
			$vConexao->query($dbAlt . "email_proprio='" . $vformemailproprio . "' " . $dbFind);
			$vConexao->query($dbAlt . "presidente='" . $vformatualpresidente . "' " . $dbFind);
			$vConexao->query($dbAlt . "inicio_posse='" . $vforminicio_posse . "' " . $dbFind);
			$vConexao->query($dbAlt . "final_posse='" . $vformfinal_posse . "' " . $dbFind);
		
		}
	  
									
	} else {
		$vConexao->query($dbAlt . "email_proprio='" . $arrayEXISTE["Email"] . "', usuario='" . $arrayEXISTE["Usuario"] . "'" . $dbFind) or die(mysqli_error());
		
	}

	$vAtualiza = true;
	$vformANUNCIO = $vformANUNCIO;

}

$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO);
	$vRE = mysqli_fetch_array($vQUERY);
	
	$vID_Cadastro = $vRE['id_cadastro'];
	$vformUSUARIO = $vRE['usuario'];
	
	$vformCPF = $vRE['cpf_cnpj'];
	$vformNOME = $vRE['nome'];
	$vformSOBRENOME = $vRE['sobrenome'];
	$vformRG = $vRE['rg'];
	$vformORGAO = $vRE['orgao'];
	
	if ($vRE['data_nasc'] != "0000-00-00") {
		$vformDATA_NASC_DIA = strftime("%d", strtotime($vRE['data_nasc']));
		$vformDATA_NASC_MES = strftime("%m", strtotime($vRE['data_nasc']));
		$vformDATA_NASC_ANO = strftime("%Y", strtotime($vRE['data_nasc']));
		
	} else {
		$vformDATA_NASC_DIA = "00";
		$vformDATA_NASC_MES = "00";
		$vformDATA_NASC_ANO = "0000";
		
	}
	
	$vformSEXO = $vRE['sexo'];
	$vformENDERECO = $vRE['endereco'];
	$vformENDERECO_NUM = $vRE['endereco_num'];
	$vformREFERENCIA = $vRE['referencia'];
	$vformBAIRRO = $vRE['bairro'];
	$vformCIDADE = $vRE['cidade'];
	$vformESTADO = $vRE['estado'];
	$vformCEP = $vRE['cep'];
	$vformEMAIL_PROPRIO = $vRE['email_proprio'];
	$vformEMAIL_ADICIONAL = $vRE['email_adicional'];
	$vformDDDFONE = $vRE['dddfone'];
	$vformFONE = $vRE['fone'];
	$vformDDDCELULAR = $vRE['dddcelular'];
	$vformCELULAR = $vRE['celular'];
	
	if ($vformSEXO == "F") {
		$CheckedFeminino = 'checked="checked"';
		$CheckedMasculino = '';
		
	} else {
		$CheckedFeminino = '';
		$CheckedMasculino = 'checked="checked"';

	}
	
mysqli_free_result($vQUERY);

if ($vgetTIPO == "anunciante") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO);
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vID_Cadastro = $vRE['id_cadastro'];
		$vformUSUARIO = $vRE['usuario'];
	mysqli_free_result($vQUERY);
		
	$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrogeral WHERE id=" . $vID_Cadastro);
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vformID_CATEGORIA = $vRE['id_categoria'];;
		$vformANUNCIO = $vRE['anuncio'];;
		$vformRAZAO = $vRE['razao'];
		$vformFANTASIA = $vRE['fantasia'];
		$vformCNPJ = $vRE['cnpj'];
		$vformIE = $vRE['ie'];
		$vformCPF = $vRE['cpf'];
		$vformRG = $vRE['rg'];
		$vformORGAO = $vRE['orgao'];
		$vformDDDFONE2 = $vRE['dddfone2'];
		$vformFONE2 = $vRE['fone2'];
		$vformDDDCELULAR2 = $vRE['dddcelular2'];
		$vformCELULAR2 = $vRE['celular2'];
		$vformDDDFAX = $vRE['dddfax'];
		$vformFAX = $vRE['fax'];
		$vformCONTATO = $vRE['contato'];
		$vformSITE = $vRE['site'];
		$vformLOGO = $vRE['logo'];

		if ($vRE['cpf'] != "") {
			$vformJURIDICA = "N";
			$CheckedJurNao = 'checked="checked"';
			$CheckedJurSim = '';


		} else {
			$vformJURIDICA = "S";
			$CheckedJurNao = '';
			$CheckedJurSim = 'checked="checked"';

		}
		
		$vformDESCRICAO = $vRE['descricao'];
		$vformPALAVRAS_CHAVE = $vRE['palavras_chave'];
		$vformHISTORICO = $vRE['historico'];
		
		$vformMOSTRAR_FONE = $vRE['mostrar_fone'];
		$vformMOSTRAR_EMAIL = $vRE['mostrar_email'];
		$vformMOSTRAR_SITE = $vRE['mostrar_site'];

		$CheckedFone = '';
		$CheckedEmail = '';
		$CheckedSite = '';
		
		if ($vformMOSTRAR_FONE == "S") {
			$CheckedFone = 'checked="checked"';
			
		}
		
		if ($vformMOSTRAR_EMAIL == "S") {
			$CheckedEmail = 'checked="checked"';
			
		}
		
		if ($vformMOSTRAR_SITE == "S") {
			$CheckedSite = 'checked="checked"';
			
		}
	mysqli_free_result($vQUERY);

} else if ($vgetTIPO == "associacao") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO);
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vID_Cadastro = $vRE['id_cadastro'];
		$vformUSUARIO = $vRE['usuario'];
	mysqli_free_result($vQUERY);
		
	$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrogeral WHERE id=" . $vID_Cadastro);
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vformANUNCIO = $vRE['anuncio'];;
		$vformRAZAO = $vRE['razao'];
		$vformFANTASIA = $vRE['fantasia'];
		$vformDIA_INICIO_POSSE = strftime("%d", strtotime($vRE['inicio_posse']));
		$vformMES_INICIO_POSSE = strftime("%m", strtotime($vRE['inicio_posse']));
		$vformANO_INICIO_POSSE = strftime("%Y", strtotime($vRE['inicio_posse']));
		$vformDIA_FINAL_POSSE = strftime("%d", strtotime($vRE['final_posse']));
		$vformMES_FINAL_POSSE = strftime("%m", strtotime($vRE['final_posse']));
		$vformANO_FINAL_POSSE = strftime("%Y", strtotime($vRE['final_posse']));
		$vformPRESIDENTE = $vRE['presidente'];
		$vformCNPJ = $vRE['cnpj'];
		$vformIE = $vRE['ie'];
		$vformNOME = $vRE['razao'];
		$vformCPF = $vRE['cpf'];
		$vformRG = $vRE['rg'];
		$vformDDDFONE1 = $vRE['dddfone1'];
		$vformFONE1 = $vRE['fone1'];
		$vformDDDFONE2 = $vRE['dddfone2'];
		$vformFONE2 = $vRE['fone2'];
		$vformDDDCELULAR1 = $vRE['dddcelular1'];
		$vformCELULAR1 = $vRE['celular1'];
		$vformDDDFAX = $vRE['dddfax'];
		$vformFAX = $vRE['fax'];
		$vformSITE = $vRE['site'];
		$vformCONTATO = $vRE['contato'];
		$vformSERVICOS = $vRE['serviços'];
	mysqli_free_result($vQUERY);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="js/funcoes_geral.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ffffff; text-decoration: none}
    a:visited {color: #ffffff; text-decoration: none}
    a:hover   {color: #FF0000; text-decoration: underline}

	#AreaAviso {
		background: #e04430;
		width: 900px;
		padding: 20px;
		border: #ffffff 2px solid;
		font-size: 20px;
		color: #ffff00;
		display: block;
		text-align: center;
	}

	#AreaAvisoTitulo {
		color: #ffffff;
		font-size: 38px;
		text-align: center;
	}
    -->
    </style>

	<script language="JavaScript" type="text/javascript">
		function fValidaForm() {
			if (document.frmAtualizarDados.formSENHA.value <> document.frmAtualizarDados.formSENHAC.value) {
				fBoxDialogo("As SENHAS informadas não conferem!");
				document.frmAtualizarDados.formSENHA.value = '';
				document.frmAtualizarDados.formSENHA.focus();
				return false;
			}
			
			if (document.frmAtualizarDados.formFANTASIA.value.length == 0) {
				fBoxDialogo("O campo NOME FANTASIA não pode ser vazio!");
				document.frmAtualizarDados.formFANTASIA.value = '';
				document.frmAtualizarDados.formFANTASIA.focus();
				return false;
			}

		}

	</script>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>
  
<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<div align="center">
		<form action="atualizadados.php?id=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>" method="post" name="frmAtualizarDados" onSubmit="return fValidaForm">
			<input name="formACAO" type="hidden" value="atualizar" />
			<input name="formIDCADASTRO" type="hidden" value="<?php echo $vID_Cadastro ?>" />
			<input name="formANUNCIO" type="hidden" value="<?php echo $vformANUNCIO ?>" />
			
			<div class="clear">&nbsp;</div>
			
			<div class="titulo-escritorio">Atualizar Dados</div>

			<div class="clear">&nbsp;</div>
			
			<?php
			if ($vMensagemError != "") {
				echo '<div align="center" id="AreaAviso">';
				echo '	<div id="AreaAvisoTitulo">ATENÇÃO</div>';
				echo '	<br /><br />';
				echo '	<div id="AreaAvisoMensagem">' . $vMensagemError . '</div>';
				echo '</div>';
			}
			?>
			
			<div class="clear">&nbsp;</div>
			
			<table height="330" width="70%" border="0" id="portfolioFlash">
				<tr>
					<td colspan="2" style="border: #CCCCCC; border-style: solid; border-top-width: 1px; border-right-width: 5px; border-bottom-width: 5px; border-left-width: 1px; padding: 10px">
						<b><span style="color: #ff0000; font-family: tahoma, arial; font-size: 14px">&raquo;&nbsp;Campos para identificação no portal</b></span><br /><br />
						<table cellspacing="0" cellpadding="0" border="0" class="letras_">
							<tr> 
								<td valign="middle" height="2" width="145">&nbsp;&nbsp;Login/Nome de Usuário:</td>
								<td valign="middle" height="25"><input type="text" name="formUSUARIO" size="30" maxlength="150" class="form_" value="<?php echo $vformUSUARIO ?>" /></td>
							</tr>
							<tr> 
								<td valign="middle" height="16" >&nbsp;&nbsp;Nova Senha:</td>
								<td valign="middle" height="25"><input name="formSENHA" type="password" size="20" maxlength="20" class="form_" id="senhaX" /></td>
							</tr>
							<tr> 
								<td valign="middle" height="24" >&nbsp;&nbsp;Confirme Senha:</span>&nbsp;&nbsp;</td>
								<td valign="middle" height="25"><input name="formSENHAC" type="password" size="20" maxlength="20" class="form_" id="senhaC" onBlur="fConfirmeSenha()" /></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2"><br /><br /><b><span style="color: #ff0000; font-family: tahoma, arial; font-size: 14px">&raquo;&nbsp;Informações gerais</b></span><hr /></td>
				</tr>
				<tr>
					<td>
						<div id="boxEIXO"></div>
						<table cellspacing="0" cellpadding="0" border="0" class="letras_">
							<?php
							if ($vgetTIPO == "anunciante") {
								echo '<tr>';
								echo '	<td valign="middle" height="2">&nbsp;&nbsp;Tipo de Pessoa:</td>';
								echo '  <td valign="middle" height="25"><input type="radio" name="formJURIDICA" value="S" '. $CheckedJurSim  .' onClick="fFisicaJuridica(1)" />Jurídica<input type="radio" name="formJURIDICA" value="N" '. $CheckedJurNao  .' onClick="fFisicaJuridica(2)" />Física</td>';
								echo '</tr>';
								echo '<tr>';
								echo '	<td valign="middle" height="2">&nbsp;&nbsp;Nome Fantasia:</td>';
								echo '  <td valign="middle" height="25"><input type="text" name="formNOME" size="50" maxlength="50" class="form_" value="' . $vformNOME . '"></td>';
								echo '</tr>';
								echo '<tr>';
								echo '	<td colspan="2">';
								echo '		<div id="divCNPJ">';
								echo '		<table cellspacing="0" cellpadding="0" border="0" style="margin-left: 7px">';
								echo '			<tr>';
								echo '				<td valign="middle" height="2" width="133">CNPJ:</td>';
								echo '				<td valign="middle" height="25"><input type="text" name="formCNPJ" size="20" maxlength="50" class="form_" value="' . $vformCNPJ . '" /></td>';
								echo '			</tr>';
								echo '			<tr>';
								echo '  			<td valign="middle" height="2">Inscrição Estadual:</td>';
								echo '  			<td valign="middle" height="25">';
								echo '    				<input type="text" name="formIE" size="20" maxlength="50" class="form_" value="' . $vformIE . '">';
								echo '  			</td>';
								echo '			</tr>';
								echo '		</table>';
								echo '		</div>';
								echo '	</td>';
								echo '</tr>';
							}

							if ($vgetTIPO == "associacao") {
								echo '<tr>';
								echo '  <td valign="middle" height="2">&nbsp;&nbsp;Início da Posse:</td>';
								echo '  <td valign="middle" height="25"><input type="text" name="formDIA_INICIO_POSSE" size="2" maxlength="2" class="form_" value="' . strftime("%d", strtotime($vformDIA_INICIO_POSSE)) . '">/<input type="text" name="formMES_INICIO_POSSE" size="2" maxlength="2" class="form_" value="' . strftime("%m", strtotime($vformMES_INICIO_POSSE)) . '">/<input type="text" name="formANO_INICIO_POSSE" size="6" maxlength="6" class="form_" value="' . strftime("%Y", strtotime($vformANO_INICIO_POSSE)) . '"></td>';
								echo '</tr>';
								echo '<tr>';
								echo '  <td valign="middle" height="2">&nbsp;&nbsp;Final da Posse:</td>';
								echo '  <td valign="middle" height="25"><input type="text" name="formDIA_FINAL_POSSE" size="2" maxlength="2" class="form_" value="' . strftime("%d", strtotime($vformDIA_FINAL_POSSE)) . '">/<input type="text" name="formMES_FINAL_POSSE" size="2" maxlength="2" class="form_" value="' . strftime("%m", strtotime($vformMES_FINAL_POSSE)) . '">/<input type="text" name="formANO_FINAL_POSSE" size="6" maxlength="6" class="form_" value="' . strftime("%Y", strtotime($vformANO_FINAL_POSSE)) . '"></td>';
								echo '</tr>';
								echo '<tr>';
								echo '  <td valign="middle" height="2">&nbsp;&nbsp;Atual Presidente:</td>';
								echo '  <td valign="middle" height="25"><input type="text" name="formPRESIDENTE" size="50" maxlength="80" class="form_" value="' . $vformPRESIDENTE . '"></td>';
								echo '</tr>';
							}

							if ($vgetTIPO == "usuario") {
							?>
								<tr> 
									<td valign="middle" height="2">&nbsp;&nbsp;Nome:</td>
									<td valign="middle" height="25"><input type="text" name="formNOME" size="30" maxlength="80" class="form_" value="<?php echo $vformNOME ?>" /></td>
								</tr>
								<tr> 
									<td valign="middle" height="2">&nbsp;&nbsp;Sobrenome:</td>
									<td valign="middle" height="25"><input type="text" name="formSOBRENOME" size="40" maxlength="80" class="form_" value="<?php echo $vformSOBRENOME ?>" /></td>
								</tr>
							<?php
							}
							?>
								<tr> 
									<td colspan="2">
										<div id="divCPF">
										<table cellspacing="0" cellpadding="0" border="0" style="margin-left: 7px">
											<tr> 
												<td valign="middle" height="2" width="133">CPF nº:</td>
												<td valign="middle" height="25"><input type="text" name="formCPF" size="20" maxlength="50" class="form_" value="<?php echo $vformCPF ?>" /></td>
											</tr>
											<tr> 
												<td valign="middle" height="2">RG nº:</td>
												<td valign="middle" height="25"><input type="text" name="formRG" size="20" maxlength="50" class="form_" value="<?php echo $vformRG ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orgão: <input type="text" name="formORGAO" size="10" maxlength="10" class="form_" value="<?php echo $vformORGAO ?>" /></td>
											</tr>
											<tr> 
												<td valign="middle" height="2">Sexo:</td>
												<td valign="middle" height="25"><input type="radio" name="formSEXO" value="M" <?php echo $CheckedMasculino ?> />Masculino&nbsp;&nbsp;&nbsp;<input type="radio" name="formSEXO" value="F" <?php echo $CheckedFeminino ?> />Feminino</td>
											</tr>
										</table>
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle" height="2">&nbsp;&nbsp;Data de Nascimento:</td>
									<td valign="middle" height="25"><input type="text" name="formDATA_NASC_DIA" size="2" maxlength="2" class="form_" value="<?php echo $vformDATA_NASC_DIA ?>" />-<input type="text" name="formDATA_NASC_MES" size="2" maxlength="2" class="form_" value="<?php echo $vformDATA_NASC_MES ?>" />-<input type="text" name="formDATA_NASC_ANO" size="4" maxlength="4" class="form_" value="<?php echo $vformDATA_NASC_ANO ?>" /></td>
								</tr>
							
							<tr> 
								<td valign="middle" height="24" >&nbsp;&nbsp;Endereço:</span>&nbsp;&nbsp;</td>
								<td valign="middle" height="25"><input type="text" name="formENDERECO" size="50" maxlength="50" class="form_" value="<?php echo $vformENDERECO ?>" /></td>
							</tr>
							<tr> 
								<td valign="middle" height="24" >&nbsp;&nbsp;Num. Endereço:</span>&nbsp;&nbsp;</td>
								<td valign="middle" height="25"><input type="text" name="formENDERECO_NUM" size="10" maxlength="10" class="form_" value="<?php echo $vformENDERECO_NUM ?>" /></td>
							</tr>
							<tr> 
								<td width="140" valign="middle" height="2">&nbsp;&nbsp;Ponto de Referência:</td>
								<td valign="middle" height="25"><input type="text" name="formREFERENCIA" size="50" maxlength="50" class="form_" value="<?php echo $vformREFERENCIA ?>" /></td>
							</tr>
							<tr>
								<td valign="middle" height="24" >&nbsp;&nbsp;Bairro:</span>&nbsp;&nbsp;</td>
								<td valign="middle" height="25"><input type="text" name="formBAIRRO" size="30" maxlength="50" class="form_" value="<?php echo $vformBAIRRO ?>" /></td>
							</tr>
							<tr> 
								<td valign="middle" height="24" >&nbsp;&nbsp;Cidade:</span>&nbsp;&nbsp;</td>
								<td valign="middle" height="25">
									<input type="text" name="formCIDADE" size="30" maxlength="50" class="form_" value="<?php echo $vformCIDADE ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Estado:
									<select name="formESTADO" class="form_">
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
								<td valign="middle" height="24" nowrap>&nbsp;&nbsp;CEP:</span>&nbsp;&nbsp;&nbsp;</td>
								<td valign="middle" height="25"><input type="text" name="formCEP" size="10" maxlength="10" class="form_" value="<?php echo $vformCEP ?>" /></td>
							</tr>
							<?php
							if ($vgetTIPO != "anunciante") {
								echo '<tr>';
								echo '    <td valign="middle" height="16">&nbsp;&nbsp;Fone:</td>';
								echo '    <td valign="middle" height="25">';
								echo '      <input type="text" name="formDDDFONE" size="2" maxlength="2" class="form_" value="' . $vformDDDFONE . '">-'; 
								echo '      <input type="text" name="formFONE" size="8" maxlength="8" class="form_" value="' . $vformFONE . '">';
								echo '      <span class="letras_2"> (ex: 11-99999999)</span>';
								echo '    </td>';
								echo '</tr>';
								echo '<tr>';
								echo '    <td valign="middle" height="16">&nbsp;&nbsp;Celular:</td>';
								echo '    <td valign="middle" height="25">';
								echo '      <input type="text" name="formDDDCELULAR" size="2" maxlength="2" class="form_" value="' . $vformDDDCELULAR . '">-'; 
								echo '      <input type="text" name="formCELULAR" size="8" maxlength="8" class="form_" value="' . $vformCELULAR . '">';
								echo '      <span class="letras_2"> (ex: 11-99999999)</span>';
								echo '    </td>';
								echo '</tr>';
								
							} else {
								echo '<tr>';
								echo '    <td valign="middle" height="16">&nbsp;&nbsp;';
								
								if ($vformANUNCIO != "gratis") {
									echo 'Fones:';
									
								} else {
									echo 'Fone:';
									
								}

								echo '    </td>';
								echo '    <td valign="middle" height="25">';
								echo '      <input type="text" name="formDDDFONE" size="2" maxlength="2" class="form_" value="' . $vformDDDFONE . '">-'; 
								echo '      <input type="text" name="formFONE" size="10" maxlength="10" class="form_" value="' . $vformFONE . '">';
								
								if ($vformANUNCIO != "gratis") {
									echo '&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" name="formDDDFONE2" size="2" maxlength="2" class="form_" value="' . $vformDDDFONE2 . '">-'; 
									echo '<input type="text" name="formFONE2" size="10" maxlength="10" class="form_" value="' . $vformFONE2 . '">';
								}
								
								echo '      &nbsp;&nbsp;<em style="color: #666666"> (ex: 11-99999999)</em>';
								echo '    </td>';
								echo '</tr>';								
								echo '<tr>';
								echo '    <td valign="middle" height="16">&nbsp;&nbsp;';
								
								if ($vformANUNCIO != "gratis") {
									echo 'Celulares:';
									
								} else {
									echo 'Celular:';
									
								}

								echo '    </td>';
								echo '	<td valign="middle" height="25">';
								echo '		<input type="text" name="formDDDCELULAR" size="2" maxlength="2" class="form_" value="' . $vformDDDCELULAR . '" />-';
								echo '		<input type="text" name="formCELULAR" size="10" maxlength="10" class="form_" value="' . $vformCELULAR . '" />';
								
								if ($vformANUNCIO != "gratis") {
									echo '&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" name="formDDDCELULAR2" size="2" maxlength="2" class="form_" value="' . $vformDDDCELULAR2 . '">-'; 
									echo '<input type="text" name="formCELULAR2" size="10" maxlength="10" class="form_" value="' . $vformCELULAR2 . '">';
								}
								
								echo '      &nbsp;&nbsp;<em style="color: #666666"> (ex: 11-99999999)</em>';
								echo '	</td>';
								echo '</tr>';
							}
							
							if (($vgetTIPO != "usuario") && ($vformANUNCIO != "gratis")) {
								echo '<tr>';
								echo '	<td valign="middle" height="16" >&nbsp;&nbsp;Fax:</td>';
								echo '	<td valign="middle" height="25">';
								echo '		<input type="text" name="formDDDFAX" size="2" maxlength="2" class="form_" value="' . $vformDDDFAX . '" />-';
								echo '		<input type="text" name="formFAX" size="8" maxlength="8" class="form_" value="' . $vformFAX . '" />';
								echo '		<span class="letras_2"> (ex: 11-99999999)</span>';
								echo '	</td>';
								echo '</tr>';
							}
							?>
							<tr> 
								<td valign="middle" height="16" >&nbsp;&nbsp;Email Próprio:</td>
								<td valign="middle" height="25"><input type="text" name="formEMAIL_PROPRIO" size="50" maxlength="50" class="form_" id="$f_email" value="<?php echo $vformEMAIL_PROPRIO ?>" /></td>
							</tr>
							<tr> 
								<td valign="middle" height="16" >&nbsp;&nbsp;Exibir no Site:</td>
								<td valign="middle" height="25"><input type="checkbox" name="formMOSTRAR_FONE" value="S" <?php echo $CheckedFone ?> /> Fones&nbsp;&nbsp;<input type="checkbox" name="formMOSTRAR_EMAIL" value="S" <?php echo $CheckedEmail ?> /> E-Mail&nbsp;&nbsp;<input type="checkbox" name="formMOSTRAR_SITE" value="S" <?php echo $CheckedSite ?> /> Site</td>
							</tr>
							<?php
							if (($vgetTIPO != "usuario") && ($vformANUNCIO != "gratis")) {
								echo '<tr>';
								echo '	<td valign="middle" height="16">&nbsp;&nbsp;Email Adicional:</td>';
								echo '	<td valign="middle" height="25"><input type="text" name="formEMAIL_ADICIONAL" size="50" maxlength="150" class="form_" value="' . $vformEMAIL_ADICIONAL . '" /></td>';
								echo '</tr>';
								echo '<tr>';
								echo '	<td valign="middle" height="16" >&nbsp;&nbsp;Site:</td>';
								echo '	<td valign="middle" height="25"><input type="text" name="formSITE" size="50" maxlength="50" class="form_" id="$f_email" value="' . $vformSITE . '" /></td>';
								echo '</tr>';
								echo '<tr>';
								echo '	<td valign="middle" height="16" >&nbsp;&nbsp;Pessoa de Contato:</td>';
								echo '	<td valign="middle" height="25"><input type="text" name="formCONTATO" size="50" maxlength="50" class="form_" id="$f_email" value="' . $vformCONTATO . '" /></td>';
								echo '</tr>';
								echo '<tr>'; 
								echo '	<td valign="middle" height="16" valign="top">&nbsp;&nbsp;Descrição dos produtos<br />&nbsp;&nbsp;ou serviços prestados:</td>';
								echo '	<td valign="middle" height="25"><textarea name="formDESCRICAO" id="descricao" rows="7" cols="55" class="form_" onKeyPress="fSoma(this.value)" onKeyUp="fSoma(this.value)">' . $vformDESCRICAO . '</textarea></td>';
								echo '</tr>';
							}
							
							if ($vformANUNCIO == "gratis") {
								$vIgrejas = strpos("_".$vformID_CATEGORIA, "[74]")+strpos("_".$vformID_CATEGORIA, "[262]")+strpos("_".$vformID_CATEGORIA, "[382]")+strpos("_".$vformID_CATEGORIA, "[383]");

								if ($vIgrejas > 0) {
									echo '<tr>'; 
									echo '	<td valign="middle" height="16" valign="top">&nbsp;&nbsp;Descreva os dias com<br />&nbsp;&nbsp;os horários dos cultos:</td>';
									echo '	<td valign="middle" height="25"><textarea name="formDESCRICAO" id="descricao" rows="2" cols="50" class="form_" onKeyPress="fSoma(this.value)" onKeyUp="fSoma(this.value)">' . $vformDESCRICAO . '</textarea></td>';
									echo '</tr>';
								}
								
								echo '<tr>';
								echo '	<td colspan="2"><input type="hidden" name="formPALAVRAS_CHAVE" value="' . $vformPALAVRAS_CHAVE . '" /></td>';
								echo '</tr>';
								
							} else {
								echo '<tr>';
								echo '	<td valign="middle" height="16">&nbsp;&nbsp;Palavras Chave (Tags):</td>';
								echo '	<td valign="middle" height="25"><input type="text" name="formPALAVRAS_CHAVE" size="60" maxlength="100" class="form_" value="' . $vformPALAVRAS_CHAVE . '" /></td>';
								echo '</tr>';
								
							}
							?>
						</table><br />
					</td>
					<td valign="top">
						<?php
						if ($vgetTIPO == "anunciante" && $vformANUNCIO != "gratis") {
							echo '<iframe src="atualizar_logo.php?local=' . $getLOCAL . '&idc=' . $vID_Cadastro . '&idu=' . $vgetIDUSUARIO . '&logo=' . $vformLOGO . '" marginwidth=0 marginheight=0 frameborder=0 width=250 height=300 scrolling=no topmargin="0" leftmargin="0" id="itopo"></iframe>';
							
						}
						?>
					</td>
				</tr>
				<tr> 
					<td align="center" valign="middle" height="21" colspan="2">
						<br />
						<input type="submit" name="enviar" value="    Atualizar Dados    " class="submit_" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="limpar" value="    Limpar Dados    " class="submit_reset" />
					</td>
				</tr>
			</table>
		</form><br /><br />
	</div>
	
	<div id="boxDIALOGO"></div>

	<script type="text/javascript">
		document.getElementById("boxDIALOGO").style.top = fElementoPos("boxEIXO").top + "px";
		
		function fFisicaJuridica(nn) {
			if (nn == 2) {
				document.getElementById("divCPF").style.display = "block";
				document.getElementById("divCNPJ").style.display = "none";

			} else {
				document.getElementById("divCPF").style.display = "none";
				document.getElementById("divCNPJ").style.display = "block";

			}
		}
		
		<?php
		if ($vformJURIDICA == "S") {
			echo 'fFisicaJuridica(1);';
			
		} else {
			echo 'fFisicaJuridica(2);';
			
		}
		?>
	</script>	
</body>
</html>