<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "documentos/include/funcoes.php";
include "conexao.php";

$vSALVAR = false;
$vMENSAGEM = "";
$vVAZIOS = "";

$vformIDUSUARIO = isset($_POST["formIDUSUARIO"]) ? $_POST["formIDUSUARIO"] : NULL;
$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;
$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
$vformCOMPLEMENTO = isset($_POST["formCOMPLEMENTO"]) ? $_POST["formCOMPLEMENTO"] : NULL;
$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
$vformEMAILATUAL = isset($_POST["formEMAILATUAL"]) ? $_POST["formEMAILATUAL"] : NULL;
$vformEMAILP = isset($_POST["formEMAIL"]) ? $_POST["formEMAIL"] : NULL;
$vformEMAILA = isset($_POST["formEMAILADICIONAL"]) ? $_POST["formEMAILADICIONAL"] : NULL;
$vformSITE = isset($_POST["formFACEBOOK"]) ? $_POST["formFACEBOOK"] : NULL;
$vformCPF = isset($_POST["formCPF"]) ? $_POST["formCPF"] : NULL;
$vformRG = isset($_POST["formRG"]) ? $_POST["formRG"] : NULL;
$vformDTNASCIMENTODIA = isset($_POST["formDTNASCIMENTODIA"]) ? $_POST["formDTNASCIMENTODIA"] : NULL;
$vformDTNASCIMENTOMES = isset($_POST["formDTNASCIMENTOMES"]) ? $_POST["formDTNASCIMENTOMES"] : NULL;
$vformDTNASCIMENTOANO = isset($_POST["formDTNASCIMENTOANO"]) ? $_POST["formDTNASCIMENTOANO"] : NULL;
$vformNUMERO = isset($_POST["formNUMERO"]) ? $_POST["formNUMERO"] : NULL;
$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
$vformDDDFONE = isset($_POST["formDDDFONE"]) ? $_POST["formDDDFONE"] : NULL;
$vformFONE = isset($_POST["formFONE"]) ? $_POST["formFONE"] : NULL;
$vformDDDCELULAR1 = isset($_POST["formDDDCELULAR1"]) ? $_POST["formDDDCELULAR1"] : NULL;
$vformCELULAR1 = isset($_POST["formCELULAR1"]) ? $_POST["formCELULAR1"] : NULL;
$vformDDDCELULAR2 = isset($_POST["formDDDCELULAR2"]) ? $_POST["formDDDCELULAR2"] : NULL;
$vformCELULAR2 = isset($_POST["formCELULAR2"]) ? $_POST["formCELULAR2"] : NULL;
$vformDDDCELULAR3 = isset($_POST["formDDDCELULAR3"]) ? $_POST["formDDDCELULAR3"] : NULL;
$vformCELULAR3 = isset($_POST["formCELULAR3"]) ? $_POST["formCELULAR3"] : NULL;
$vformOPERADORA1 = isset($_POST["formOPERADORA1"]) ? $_POST["formOPERADORA1"] : NULL;
$vformOPERADORA2 = isset($_POST["formOPERADORA2"]) ? $_POST["formOPERADORA2"] : NULL;
$vformOPERADORA3 = isset($_POST["formOPERADORA3"]) ? $_POST["formOPERADORA3"] : NULL;
$vformWHATSAPP = isset($_POST["formWHATSAPP"]) ? $_POST["formWHATSAPP"] : NULL;
$vformSKYPE = isset($_POST["formSKYPE"]) ? $_POST["formSKYPE"] : NULL;
$vformSEXO = isset($_POST["formSEXO"]) ? $_POST["formSEXO"] : NULL;
$vformCARGO = isset($_POST["formCARGO"]) ? $_POST["formCARGO"] : NULL;

$vformPAIS = isset($_POST["formPAIS"]) ? $_POST["formPAIS"] : NULL;

$vformOBS = isset($_POST["formOBS"]) ? $_POST["formOBS"] : NULL;

$vformUSUARIOATUAL = isset($_POST["formUSUARIOATUAL"]) ? $_POST["formUSUARIOATUAL"] : NULL;
$vformSENHAATUAL = isset($_POST["formSENHAATUAL"]) ? $_POST["formSENHAATUAL"] : NULL;

$vformUSUARIO = isset($_POST["formUSUARIO"]) ? $_POST["formUSUARIO"] : NULL;
$vformSENHA = isset($_POST["formSENHA"]) ? $_POST["formSENHA"] : NULL;
$vformSENHAB = isset($_POST["formSENHAB"]) ? $_POST["formSENHAB"] : NULL;

$vDT_CADASTRO = date("Y-m-d H:i:s"); 



// ***********************************************************
// *
// *
// * Inicia validação dos valores recebidos através do formulário
// *
// *
// ***********************************************************

if ($vformNOME == "") { $vVAZIOS .= "&mdash; Nome<br />"; }
if ($vformDTNASCIMENTODIA == "") { $vVAZIOS .= "&mdash; Data de Nascimento<br />"; }
if ($vformDTNASCIMENTOMES == "") { $vVAZIOS .= "&mdash; Data de Nascimento<br />"; }
if ($vformDTNASCIMENTOANO == "") { $vVAZIOS .= "&mdash; Data de Nascimento<br />"; }
if ($vformSEXO == "") { $vVAZIOS .= "&mdash; Sexo<br />"; }
if ($vformENDERECO == "") { $vVAZIOS .= "&mdash; Endereço<br />"; }
if ($vformNUMERO == "") { $vVAZIOS .= "&mdash; Número do Endereço<br />"; }
if ($vformBAIRRO == "") { $vVAZIOS .= "&mdash; Bairro<br />"; }
if ($vformCIDADE == "") { $vVAZIOS .= "&mdash; Cidade<br />"; }
if ($vformESTADO == "") { $vVAZIOS .= "&mdash; Estado<br />"; }
if ($vformCEP == "") { $vVAZIOS .= "&mdash; CEP<br />"; }
if ($vformDDDCELULAR1 == "") { $vVAZIOS .= "&mdash; DDD do Celular 1<br />";}
if ($vformCELULAR1 == "") { $vVAZIOS .= "&mdash; Celular 1<br />"; }
if ($vformEMAILP == "") { $vVAZIOS .= "&mdash; E-mail<br />"; }
if ($vformUSUARIO == "") { $vVAZIOS .= "&mdash; Usu&aacute;rio<br />"; }

if ($vVAZIOS != "") {
	$vMENSAGEM = "Os campos listados abaixo, não podem ser vazios:<br /><br /><strong>" . $vVAZIOS . "</strong>";
	$vSALVAR = false;

} else {
	if (strtolower(trim($vformUSUARIOATUAL)) != strtolower(trim($vformUSUARIO))) {
		$queryUsuarios = $vConexao->query("SELECT * FROM sysc_usuarios WHERE usuario='" . $vformUSUARIO . "'") or die (mysqli_error()); 
			$reUsuarios = mysqli_fetch_array($queryUsuarios);
			
			if ($reUsuarios != "") {
				$vMENSAGEM = "Já existe uma pessoa cadastrada com este <strong>NOME DE USU&Aacute;RIO</strong> informado. Informe outro Nome de Usu&aacute;rio.";
				$vSALVAR = false;
				
			} else {
			
				if ((int)$vformDTNASCIMENTODIA > 31) {
					$vMENSAGEM = "O <strong>DIA</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Digite novamente.";
					$vSALVAR = false;
					
				} else {
					if ((int)$vformDTNASCIMENTOMES > 12) {
						$vMENSAGEM = "O <strong>MÊS</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Digite novamente.";
						$vSALVAR = false;
						
					} else {
						$vSALVAR = true;
						
					}
					
				}
			}
			
		mysqli_free_result($queryUsuarios);
			

	} else {
		if ((int)$vformDTNASCIMENTODIA > 31) {
			$vMENSAGEM = "O <strong>DIA</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Digite novamente.";
			$vSALVAR = false;

		} else {
			if ((int)$vformDTNASCIMENTOMES > 12) {
				$vMENSAGEM = "O <strong>MÊS</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Digite novamente.";
				$vSALVAR = false;

			} else {
				$vSALVAR = true;

			}
		}
	}
}


// ***********************************************************
// *
// *
// * Inicia gravação nas tabelas
// *
// *
// ***********************************************************


if ($vSALVAR) {
	if ($vformACAO == "novo") {
		$dbCAMPOS = "id_cliente, cod_unico, nivel, nome, sexo, cpf, rg, orgao, dt_nascimento, endereco, endereco_num, bairro, cidade, uf, cep, complemento, referencia, pais, dddfone, fone, dddcelular1, celular1, operadora1, dddcelular2, celular2, operadora2, dddcelular3, celular3, operadora3, email_proprio, email_adicional, whatsapp, facebook, skype, twitter, funcao, id_cargo, cargo, ativo, foto, usuario, senha, senha_lembrete, obs, data_cad";

		$dbVALORES = "0";
		$dbVALORES .= ",''";
		$dbVALORES .= ",0";
		$dbVALORES .= ",'" . $vformNOME . "'";
		$dbVALORES .= ",'" . $vformSEXO . "'";
		$dbVALORES .= ",'" . $vformCPF . "'";
		$dbVALORES .= ",'" . $vformRG . "'";
		$dbVALORES .= ",''"; // orgao
		
		if ((int)$vformDTNASCIMENTOANO <= 0 OR (int)$vformDTNASCIMENTOMES <= 0 OR (int)$vformDTNASCIMENTODIA <= 0) {
			$dbVALORES .= ",NULL";
			
		} else {
			$dbVALORES .= ",'" . StrZero($vformDTNASCIMENTOANO, 4) . "-" . StrZero($vformDTNASCIMENTOMES, 2) . "-" . StrZero($vformDTNASCIMENTODIA, 2) . "'";
			
		}

		$dbVALORES .= ",'" . $vformENDERECO . "'";
		$dbVALORES .= ",'" . $vformNUMERO . "'";
		$dbVALORES .= ",'" . $vformBAIRRO . "'";
		$dbVALORES .= ",'" . $vformCIDADE . "'";
		$dbVALORES .= ",'" . $vformESTADO . "'";
		$dbVALORES .= ",'" . $vformCEP . "'";
		$dbVALORES .= ",'" . $vformCOMPLEMENTO . "'";
		$dbVALORES .= ",''"; // referencia
		$dbVALORES .= ",'" . $vformPAIS . "'";
		$dbVALORES .= ",'" . $vformDDDFONE . "'";
		$dbVALORES .= ",'" . $vformFONE . "'";
		$dbVALORES .= ",'" . $vformDDDCELULAR1 . "'";
		$dbVALORES .= ",'" . $vformCELULAR1 . "'";
		$dbVALORES .= ",'" . $vformOPERADORA1 . "'";
		$dbVALORES .= ",'" . $vformDDDCELULAR2 . "'";
		$dbVALORES .= ",'" . $vformCELULAR2 . "'";
		$dbVALORES .= ",'" . $vformOPERADORA2 . "'";
		$dbVALORES .= ",'" . $vformDDDCELULAR3 . "'";
		$dbVALORES .= ",'" . $vformCELULAR3 . "'";
		$dbVALORES .= ",'" . $vformOPERADORA3 . "'";
		$dbVALORES .= ",'" . $vformEMAILP . "'";
		$dbVALORES .= ",'" . $vformEMAILA . "'";
		$dbVALORES .= ",'" . $vformWHATSAPP . "'";
		$dbVALORES .= ",'" . $vformSITE . "'";
		$dbVALORES .= ",'" . $vformSKYPE . "'";
		$dbVALORES .= ",''"; // twitter
		$dbVALORES .= ",'USUARIO'";
		$dbVALORES .= ",0" . (int)substr($vformCARGO, 0, strpos($vformCARGO, "|"));
		$dbVALORES .= ",'" . substr($vformCARGO, (strpos($vformCARGO, "|")+1)) . "'";
		$dbVALORES .= ",'S'"; // ativo
		$dbVALORES .= ",''"; // foto
		$dbVALORES .= ",'" . $vformUSUARIO . "'";
		$dbVALORES .= ",'" . hash('sha512', $vformSENHA) . "'";
		$dbVALORES .= ",''"; // senha_lembrete
		$dbVALORES .= ",'" . $vformOBS . "'"; // obs
		$dbVALORES .= ",'" . $vDT_CADASTRO . "'";

		$dbSALVAR = $vConexao->query("INSERT INTO sysc_usuarios (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die("Falha ao tentar gravar dados do Usuario");

	} else {
		$vAlt = "UPDATE sysc_usuarios SET ";
		$vWhere = " WHERE id=" . $vformIDUSUARIO;

		$vConexao->query($vAlt . 
						  "nome='" . $vformNOME . "'," .
						  "rg='" . $vformRG . "'," .
						  "cpf='" . $vformCPF . "'," .
						  "sexo='" . $vformSEXO . "'," .
						  "dt_nascimento='" . StrZero($vformDTNASCIMENTOANO, 4) . "-" . StrZero($vformDTNASCIMENTOMES, 2) . "-" . StrZero($vformDTNASCIMENTODIA, 2) . "'," .
						  "endereco='" . $vformENDERECO . "'," .
						  "endereco_num='" . $vformNUMERO . "'," .
						  "bairro='" . $vformBAIRRO . "'," .
						  "cidade='" . $vformCIDADE . "'," .
						  "uf='" . $vformESTADO . "'," .
						  "cep='" . $vformCEP . "'," .
						  "pais='" . $vformPAIS . "'," .
						  "complemento='" . $vformCOMPLEMENTO . "'," .
						  "dddfone='" . $vformDDDFONE . "'," . 
						  "fone='" . $vformFONE . "'," .
						  "dddcelular1='" . $vformDDDCELULAR1 . "'," .
						  "celular1='" . $vformCELULAR1 . "'," .
						  "operadora1='" . $vformOPERADORA1 . "'," .
						  "dddcelular2='" . $vformDDDCELULAR2 . "'," .
						  "celular2='" . $vformCELULAR2 . "'," .
						  "operadora2='" . $vformOPERADORA2 . "'," .
						  "dddcelular3='" . $vformDDDCELULAR3 . "'," .
						  "celular3='" . $vformCELULAR3 . "'," .
						  "operadora3='" . $vformOPERADORA3 . "'," .
						  "email_proprio='" . $vformEMAILP . "'," .
						  "email_adicional='" . $vformEMAILA . "'," .
						  "facebook='" . $vformSITE . "'," .
						  "whatsapp='" . $vformWHATSAPP . "'," .
						  "skype='" . $vformSKYPE . "'," .
						  "id_cargo='" . substr($vformCARGO, 0, (strpos("_".$vformCARGO, "|")-1)) . "'," .
						  "cargo='" . substr($vformCARGO, strpos("_".$vformCARGO, "|")) . "'," .
						  "usuario='" . $vformUSUARIO . "'," .
						  "obs='" . $vformOBS . "'" . $vWhere)
		or die ("Falha ao tentar salvor Dados1 do Usuario");
		
		if(trim($vformSENHA) != "") {
			
			if ($vformSENHAATUAL !=  hash('sha512', $vformSENHA)) {
				$vConexao->query("UPDATE sysc_usuarios SET senha='" . hash('sha512', $vformSENHA) . "' WHERE id=" . $vformIDUSUARIO)	or die ("Falha ao tentar salvor Dados2 do Usuario");

			}
			
		}
	}
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
			
			if ($vformACAO == "novo") {
				echo 'top.document.frmCadastro.formNOME.value = "";';
				echo 'top.document.frmCadastro.formENDERECO.value = "";';
				echo 'top.document.frmCadastro.formCOMPLEMENTO.value = "";';
				echo 'top.document.frmCadastro.formCIDADE.value = "";';
				echo 'top.document.frmCadastro.formCEP.value = "";';
				echo 'top.document.frmCadastro.formEMAILATUAL.value = "";';
				echo 'top.document.frmCadastro.formEMAIL.value = "";';
				echo 'top.document.frmCadastro.formEMAILADICIONAL.value = "";';
				echo 'top.document.frmCadastro.formDTNASCIMENTODIA.value = "00";';
				echo 'top.document.frmCadastro.formDTNASCIMENTOMES.value = "00";';
				echo 'top.document.frmCadastro.formDTNASCIMENTOANO.value = "0000";';
				echo 'top.document.frmCadastro.formSEXO.value = "";';
				echo 'top.document.frmCadastro.formNUMERO.value = "";';
				echo 'top.document.frmCadastro.formCPF.value = "";';
				echo 'top.document.frmCadastro.formRG.value = "";';
				echo 'top.document.frmCadastro.formBAIRRO.value = "";';
				echo 'top.document.frmCadastro.formESTADO.value = "";';
				echo 'top.document.frmCadastro.formDDDFONE.value = "";';
				echo 'top.document.frmCadastro.formFONE.value = "";';
				echo 'top.document.frmCadastro.formFACEBOOK.value = "";';
				echo 'top.document.frmCadastro.formSKYPE.value = "";';
				echo 'top.document.frmCadastro.formDDDCELULAR1.value = "";';
				echo 'top.document.frmCadastro.formCELULAR1.value = "";';
				echo 'top.document.frmCadastro.formOPERADORA1.value = "";';
				echo 'top.document.frmCadastro.formDDDCELULAR2.value = "";';
				echo 'top.document.frmCadastro.formCELULAR2.value = "";';
				echo 'top.document.frmCadastro.formOPERADORA2.value = "";';
				echo 'top.document.frmCadastro.formDDDCELULAR3.value = "";';
				echo 'top.document.frmCadastro.formCELULAR3.value = "";';
				echo 'top.document.frmCadastro.formOPERADORA3.value = "";';
				echo 'top.document.frmCadastro.formWHATSAPP.value = "";';
				echo 'top.document.frmCadastro.formUSUARIOATUAL.value = "";';
				echo 'top.document.frmCadastro.formSENHAATUAL.value = "";';
				echo 'top.document.frmCadastro.formUSUARIO.value = "";';
				echo 'top.document.frmCadastro.formSENHA.value = "";';
				echo 'top.document.frmCadastro.formSENHAB.value = "";';

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
