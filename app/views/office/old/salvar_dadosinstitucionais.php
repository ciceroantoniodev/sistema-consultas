<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "documentos/include/funcoes.php";
include "conexao.php";

$vSecaoTitulo = "CADASTRAR NOVO USUÁRIO";

$vSALVAR = false;
$vMENSAGEM = "";
$vVAZIOS = "";

$vformIDUSUARIO = isset($_POST["formIDUSUARIO"]) ? $_POST["formIDUSUARIO"] : NULL;

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;
$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
$vformCOMPLEMENTO = isset($_POST["formCOMPLEMENTO"]) ? $_POST["formCOMPLEMENTO"] : NULL;
$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
$vformEMAIL = isset($_POST["formEMAIL"]) ? $_POST["formEMAIL"] : NULL;
$vformSITE = isset($_POST["formSITE"]) ? $_POST["formSITE"] : NULL;
$vformFACEBOOK = isset($_POST["formFACEBOOK"]) ? $_POST["formFACEBOOK"] : NULL;
$vformCNPJ = isset($_POST["formCNPJ"]) ? $_POST["formCNPJ"] : NULL;
$vformDTNASCIMENTODIA = isset($_POST["formDTNASCIMENTODIA"]) ? $_POST["formDTNASCIMENTODIA"] : NULL;
$vformDTNASCIMENTOMES = isset($_POST["formDTNASCIMENTOMES"]) ? $_POST["formDTNASCIMENTOMES"] : NULL;
$vformDTNASCIMENTOANO = isset($_POST["formDTNASCIMENTOANO"]) ? $_POST["formDTNASCIMENTOANO"] : NULL;
$vformNUMERO = isset($_POST["formNUMERO"]) ? $_POST["formNUMERO"] : NULL;
$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
$vformDDDFONE1 = isset($_POST["formDDDFONE1"]) ? $_POST["formDDDFONE1"] : NULL;
$vformFONE1 = isset($_POST["formFONE1"]) ? $_POST["formFONE1"] : NULL;
$vformDDDFONE2 = isset($_POST["formDDDFONE2"]) ? $_POST["formDDDFONE2"] : NULL;
$vformFONE2 = isset($_POST["formFONE2"]) ? $_POST["formFONE2"] : NULL;
$vformDDDCELULAR = isset($_POST["formDDDCELULAR"]) ? $_POST["formDDDCELULAR"] : NULL;
$vformCELULAR = isset($_POST["formCELULAR"]) ? $_POST["formCELULAR"] : NULL;
$vformDDDFAX = isset($_POST["formDDDFAX"]) ? $_POST["formDDDFAX"] : NULL;
$vformFAX = isset($_POST["formFAX"]) ? $_POST["formFAX"] : NULL;
$vformWHATSAPP = isset($_POST["formWHATSAPP"]) ? $_POST["formWHATSAPP"] : NULL;
$vformSKYPE = isset($_POST["formSKYPE "]) ? $_POST["formSKYPE "] : NULL;
$vformTWITTER = isset($_POST["formTWITTER"]) ? $_POST["formTWITTER"] : NULL;
$vformMAPA = isset($_POST["formMAPA"]) ? $_POST["formMAPA"] : NULL;

$vDT_CADASTRO = date("Y-m-d H:i:s"); 



// ***********************************************************
// *
// *
// * Inicia validação dos valores recebidos através do formulário
// *
// *
// ***********************************************************

if ($vformNOME == "") { $vVAZIOS .= "&mdash; Nome<br />"; }
if ($vformENDERECO == "") { $vVAZIOS .= "&mdash; Endereço<br />"; }
if ($vformNUMERO == "") { $vVAZIOS .= "&mdash; Número do Endereço<br />"; }
if ($vformBAIRRO == "") { $vVAZIOS .= "&mdash; Bairro<br />"; }
if ($vformCIDADE == "") { $vVAZIOS .= "&mdash; Cidade<br />"; }
if ($vformESTADO == "") { $vVAZIOS .= "&mdash; Estado<br />"; }
if ($vformCEP == "") { $vVAZIOS .= "&mdash; CEP<br />"; }
if ($vformDDDFONE1 == "") { $vVAZIOS .= "&mdash; DDD do Fone<br />";}
if ($vformFONE1 == "") { $vVAZIOS .= "&mdash; Fone<br />"; }
if ($vformEMAIL == "") { $vVAZIOS .= "&mdash; E-mail<br />"; }

if ($vVAZIOS != "") {
	$vMENSAGEM = "Os campos listados abaixo, não podem ser vazios:<br /><br /><strong>" . $vVAZIOS . "</strong>";
	$vSALVAR = false;

} else {
	$vSALVAR = true;
	
}


// ***********************************************************
// *
// *
// * Inicia gravação nas tabelas
// *
// *
// ***********************************************************


if ($vSALVAR) {
	$vAlt = "UPDATE sysc_dadoscadastrais SET ";
	$vWhere = " WHERE id=" . $vformIDUSUARIO;

	$vConexao->query($vAlt . 
					  "nome='" . $vformNOME . "'," .
					  "cnpj='" . $vformCNPJ . "'," .
					  "endereco='" . $vformENDERECO . "'," .
					  "endereco_num='" . $vformNUMERO . "'," .
					  "bairro='" . $vformBAIRRO . "'," .
					  "cidade='" . $vformCIDADE . "'," .
					  "uf='" . $vformESTADO . "'," .
					  "cep='" . $vformCEP . "'," .
					  "referencia='" . $vformCOMPLEMENTO . "'," .
					  "dddfone1='" . $vformDDDFONE1 . "'," . 
					  "fone1='" . $vformFONE1 . "'," .
					  "dddfone2='" . $vformDDDFONE2 . "'," . 
					  "fone2='" . $vformFONE2 . "'," .
					  "dddcelular='" . $vformDDDCELULAR . "'," .
					  "celular='" . $vformCELULAR . "'," .
					  "dddfax='" . $vformDDDFAX . "'," . 
					  "fax='" . $vformFAX . "'," .
					  "whatsapp='" . $vformWHATSAPP . "'," .
					  "skype='" . $vformSKYPE . "'," .
					  "site='" . $vformSITE . "'," .
					  "facebook='" . $vformFACEBOOK . "'," .
					  "twitter='" . $vformTWITTER . "'," .
					  "email='" . $vformEMAIL . "'," .
					  "mapa='" . $vformMAPA . "'" . $vWhere)
	or die ("Falha ao tentar salvor Dados do Usuario");
	
	$vDados = '<?php' . "\r\n";
	$vDados .= '$vDadosTitulo = "' . trim($vformNOME) . '";' . "\r\n";
	$vDados .= '$vDadosEndereco = "' . trim($vformENDERECO) . ', ' . trim($vformNUMERO) . '";' . "\r\n";
	$vDados .= '$vDadosBairro = "' . trim($vformBAIRRO) . '";' . "\r\n";
	$vDados .= '$vDadosCidade = "' . trim($vformCIDADE) . '";' . "\r\n";
	$vDados .= '$vDadosEstado = "' . trim($vformESTADO) . '";' . "\r\n";
	$vDados .= '$vDadosCep = "' . substr(trim($vformCEP), 0, (strlen(trim($vformCEP))-3)) . '-' . substr(trim($vformCEP), (strlen(trim($vformCEP))-3)) . '";' . "\r\n";
	$vDados .= '$vDadosFone1 = "(' . trim($vformDDDFONE1) . ') ' . substr(trim($vformFONE1), 0, (strlen(trim($vformFONE1))-4)) . '-' . substr(trim($vformFONE1), (strlen(trim($vformFONE1))-4)) . '";' . "\r\n";
	$vDados .= '$vDadosFone2 = "(' . trim($vformDDDFONE2) . ') ' . substr(trim($vformFONE2), 0, (strlen(trim($vformFONE2))-4)) . '-' . substr(trim($vformFONE2), (strlen(trim($vformFONE2))-4)) . '";' . "\r\n";
	$vDados .= '$vDadosEmail = "' . trim($vformEMAIL) . '";' . "\r\n";
	$vDados .= '$vDadosSite = "' . trim($vformSITE) . '";' . "\r\n";
	$vDados .= '$vDadosMapa = "' . htmlentities(trim($vformMAPA)) . '";' . "\r\n";
	$vDados .= '?>' . "\r\n";
	
	$fileCriar = fopen("../assets/include/dados.php", "w");
	$vEscreve = fwrite($fileCriar, $vDados);
	fclose($fileCriar);
}

include "js_.php";
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
		echo 'vHTML = "<div align=\'center\' style=\'font-size: 24px; font-weight: bold\'>ATUALIZAÇÃO EFETUADA COM SUCESSO!</div>";';

	} else {
		echo 'vHTML = "<div align=\'center\'><img src=\'images/alerta_atencao.gif\' /></div><br />";';
		echo 'vHTML += "' . $vMENSAGEM . '";';

	}
	
	echo 'fMostrarAviso(vHTML);';
		
	echo '</script>';
	?>
</body>
</html>
