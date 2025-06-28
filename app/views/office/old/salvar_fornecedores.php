<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "documentos/include/funcoes.php";
include "conexao.php";
include "js_.php";

$vSALVAR = "N";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

$vformID_FORNECEDOR = isset($_POST["formID_FORNECEDOR"]) ? $_POST["formID_FORNECEDOR"] : NULL;

$vformTIPO = isset($_POST["formTIPO"]) ? $_POST["formTIPO"] : NULL;
$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;
$vformCNPJ = isset($_POST["formCNPJ"]) ? $_POST["formCNPJ"] : NULL;
$vformIE = isset($_POST["formIE"]) ? $_POST["formIE"] : NULL;
$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
$vformENDERECO_NUM = isset($_POST["formENDERECO_NUM"]) ? $_POST["formENDERECO_NUM"] : NULL;
$vformCOMPLEMENTO = isset($_POST["formCOMPLEMENTO"]) ? $_POST["formCOMPLEMENTO"] : NULL;
$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
$vformDDDFONE1 = isset($_POST["formDDDFONE1"]) ? $_POST["formDDDFONE1"] : NULL;
$vformFONE1 = isset($_POST["formFONE1"]) ? $_POST["formFONE1"] : NULL;
$vformDDDFONE2 = isset($_POST["formDDDFONE2"]) ? $_POST["formDDDFONE2"] : NULL;
$vformFONE2 = isset($_POST["formFONE2"]) ? $_POST["formFONE2"] : NULL;
$vformDDDCELULAR = isset($_POST["formDDDCELULAR"]) ? $_POST["formDDDCELULAR"] : NULL;
$vformCELULAR = isset($_POST["formCELULAR"]) ? $_POST["formCELULAR"] : NULL;
$vformDDDFAX = isset($_POST["formDDDFAX"]) ? $_POST["formDDDFAX"] : NULL;
$vformFAX = isset($_POST["formFAX"]) ? $_POST["formFAX"] : NULL;
$vformEMAIL = isset($_POST["formEMAIL"]) ? $_POST["formEMAIL"] : NULL;
$vformSITE = isset($_POST["formSITE"]) ? $_POST["formSITE"] : NULL;
$vformFACEBOOK = isset($_POST["formFACEBOOK"]) ? $_POST["formFACEBOOK"] : NULL;
$vformSKYPE = isset($_POST["formSKYPE"]) ? $_POST["formSKYPE"] : NULL;
$vformCONTATO = isset($_POST["formCONTATO"]) ? $_POST["formCONTATO"] : NULL;
$vformOBS = isset($_POST["formOBS"]) ? $_POST["formOBS"] : NULL;

$vDT_CADASTRO = date("Y-m-d H:i:s");

// ***********************************************************
// *
// *
// * Inicia gravação na tabela PASTORES do novo registro
// *
// *
// ***********************************************************

if ($vformACAO == "novo") {
	$dbCAMPOS = "id_usuario, tipo, nome, endereco, endereco_num, bairro, cidade, estado, cep, dddfone1, fone1, dddfone2, fone2, dddcelular, celular, dddfax, fax, email, facebook, skype, site, referencia, cnpj, ie, contato, obs, dt_cadastro";

	$dbVALORES = $vgetIDUSUARIO;
	$dbVALORES .= ",'" . $vformTIPO . "'";
	$dbVALORES .= ",'" . $vformNOME . "'";
	$dbVALORES .= ",'" . $vformENDERECO . "'";
	$dbVALORES .= ",'" . $vformENDERECO_NUM . "'";
	$dbVALORES .= ",'" . $vformBAIRRO . "'";
	$dbVALORES .= ",'" . $vformCIDADE . "'";
	$dbVALORES .= ",'" . $vformESTADO . "'";
	$dbVALORES .= ",'" . $vformCEP . "'";
	$dbVALORES .= ",'" . $vformDDDFONE1 . "'";
	$dbVALORES .= ",'" . $vformFONE1 . "'";
	$dbVALORES .= ",'" . $vformDDDFONE2 . "'";
	$dbVALORES .= ",'" . $vformFONE2 . "'";
	$dbVALORES .= ",'" . $vformDDDCELULAR . "'";
	$dbVALORES .= ",'" . $vformCELULAR . "'";
	$dbVALORES .= ",'" . $vformDDDFAX . "'";
	$dbVALORES .= ",'" . $vformFAX . "'";
	$dbVALORES .= ",'" . $vformEMAIL . "'";
	$dbVALORES .= ",'" . $vformFACEBOOK . "'";
	$dbVALORES .= ",'" . $vformSKYPE . "'";
	$dbVALORES .= ",'" . $vformSITE . "'";
	$dbVALORES .= ",'" . $vformCOMPLEMENTO . "'";
	$dbVALORES .= ",'" . $vformCNPJ . "'";
	$dbVALORES .= ",'" . $vformIE . "'";
	$dbVALORES .= ",'" . $vformCONTATO . "'";
	$dbVALORES .= ",'" . $vformOBS . "'";
	$dbVALORES .= ",'" . $vDT_CADASTRO . "'";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_fornecedores (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die("Falha ao tentar salvar Fornecedor");
	
	
	// *******************************************************************************************************
	// * 
	// * Limpa variáveis
	// * 
	// *******************************************************************************************************
	
	
	$vformNOME = "";
	$vformCNPJ = "";
	$vformIE = "";
	$vformESTADO_CIVIL = "";
	$vformENDERECO = "";
	$vformENDERECO_NUM = "";
	$vformCOMPLEMENTO = "";
	$vformBAIRRO = "";
	$vformCIDADE = "";
	$vformESTADO = "";
	$vformPAIS = "";
	$vformCEP = "";
	$vformDDDFONE1 = "";
	$vformFONE1 = "";
	$vformDDDFONE2 = "";
	$vformFONE2 = "";
	$vformDDDCELULAR = "";
	$vformCELULAR = "";
	$vformDDDFAX = "";
	$vformFAX = "";
	$vformEMAIL = "";
	$vformFACEBOOK = "";
	$vformSITE = "";
	$vformCONTATO = "";
	$vformSKYPE = "";
	$vformOBS = "";
	
	$vSALVAR = "S";
	
} else if ($vformACAO == "atualizar") {
	$vAlt = "UPDATE sysc_fornecedores SET ";
	$vWhere = " WHERE id=" . $vformID_FORNECEDOR;
	
	$vConexao->query($vAlt . 
					  "nome='" . $vformNOME . "'," .
					  "cnpj='" . $vformCNPJ . "'," .
					  "ie='" . $vformIE . "'," .
					  "endereco='" . $vformENDERECO . "'," .
					  "endereco_num='" . $vformENDERECO_NUM . "'," .
					  "bairro='" . $vformBAIRRO . "'," .
					  "cidade='" . $vformCIDADE . "'," .
					  "estado='" . $vformESTADO . "'," .
					  "cep='" . $vformCEP . "'," .
					  "referencia='" . $vformCOMPLEMENTO . "'," .
					  "dddfone1='" . $vformDDDFONE1 . "'," . 
					  "fone1='" . $vformFONE1 . "'," .
					  "dddfone2='" . $vformDDDFONE2 . "'," . 
					  "fone2='" . $vformFONE2 . "'," .
					  "dddcelular='" . $vformDDDCELULAR . "'," .
					  "celular='" . $vformCELULAR . "'," .
					  "email='" . $vformEMAIL . "'," .
					  "site='" . $vformSITE . "'," .
					  "facebook='" . $vformFACEBOOK . "'," .
					  "skype='" . $vformSKYPE . "'," .
					  "obs='" . $vformOBS . "'" . $vWhere)
	or die (mysql_error());
	
	$vSALVAR = "S";
	
	$vformACAO = "atualizar";
	
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
	
		<?php
		echo '<script type="text/javascript" src="js/funcoes_geral' . $jsGeral . '.js"></script>';
		?>
	</head>

	<body>
		<?php
		echo '<script type="text/javascript">';
		
		if ($vSALVAR) {
			echo 'vHTML = "<div align=\'center\' style=\'font-size: 24px; font-weight: bold\'>ATUALIZA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!</div>";';
			
			if ($vformACAO == "novo") {
				echo 'top.document.frmCadFornecedores.formNOME.value = "";';
				echo 'top.document.frmCadFornecedores.formCNPJ.value = "";';
				echo 'top.document.frmCadFornecedores.formIE.value = "";';
				echo 'top.document.frmCadFornecedores.formENDERECO.value = "";';
				echo 'top.document.frmCadFornecedores.formENDERECO_NUM.value = "";';
				echo 'top.document.frmCadFornecedores.formCOMPLEMENTO.value = "";';
				echo 'top.document.frmCadFornecedores.formBAIRRO.value = "";';
				echo 'top.document.frmCadFornecedores.formCEP.value = "";';
				echo 'top.document.frmCadFornecedores.formCIDADE.value = "";';
				echo 'top.document.frmCadFornecedores.formESTADO.value = "";';
				echo 'top.document.frmCadFornecedores.formDDDFONE1.value = "";';
				echo 'top.document.frmCadFornecedores.formFONE1.value = "";';
				echo 'top.document.frmCadFornecedores.formDDDFONE2.value = "";';
				echo 'top.document.frmCadFornecedores.formFONE2.value = "";';
				echo 'top.document.frmCadFornecedores.formDDDCELULAR.value = "";';
				echo 'top.document.frmCadFornecedores.formCELULAR.value = "";';
				echo 'top.document.frmCadFornecedores.formDDDFAX.value = "";';
				echo 'top.document.frmCadFornecedores.formFAX.value = "";';
				echo 'top.document.frmCadFornecedores.formEMAIL.value = "";';
				echo 'top.document.frmCadFornecedores.formSITE.value = "";';
				echo 'top.document.frmCadFornecedores.formFACEBOOK.value = "";';
				echo 'top.document.frmCadFornecedores.formSKYPE.value = "";';
				echo 'top.document.frmCadFornecedores.formCONTATO.value = "";';
				echo 'top.document.frmCadFornecedores.formOBS.value = "";';
				echo 'top.document.frmCadFornecedores.formNOME.focus();';
			}
			
		} else {
			echo 'vHTML = "<div align=\'center\'><img src=\'images/alerta_atencao.gif\' /></div><br />";';
			echo 'vHTML += "' . $vMENSAGEM . '";';

		}
		
		echo 'fMostrarAviso(vHTML);';
			
		echo '</script>';
		?>
	</body>
</html>
