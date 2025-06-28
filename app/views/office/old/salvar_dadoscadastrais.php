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
$vformEMAILATUAL = isset($_POST["formEMAILATUAL"]) ? $_POST["formEMAIL"] : NULL;
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
$vformSKYPE = isset($_POST["formSKYPE "]) ? $_POST["formSKYPE "] : NULL;
$vformSEXO = isset($_POST["formSEXO"]) ? $_POST["formSEXO"] : NULL;

$vformPAIS = isset($_POST["formPAIS"]) ? $_POST["formPAIS"] : NULL;
$vformESTADOEXTERIOR = isset($_POST["formESTADOEXTERIOR"]) ? $_POST["formESTADOEXTERIOR"] : NULL;
$vformBANCOEXTERIOR = isset($_POST["formBANCOEXTERIOR"]) ? $_POST["formBANCOEXTERIOR"] : NULL;

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
if ($vformRG == "") { $vVAZIOS .= "&mdash; Número do RG<br />"; }
if ($vformBAIRRO == "") { $vVAZIOS .= "&mdash; Bairro<br />"; }
if ($vformCIDADE == "") { $vVAZIOS .= "&mdash; Cidade<br />"; }
if ($vformESTADO == "") { $vVAZIOS .= "&mdash; Estado<br />"; }
if ($vformCEP == "") { $vVAZIOS .= "&mdash; CEP<br />"; }
if ($vformDDDFONE == "") { $vVAZIOS .= "&mdash; DDD do Fone<br />";}
if ($vformFONE == "") { $vVAZIOS .= "&mdash; Fone<br />"; }
if ($vformEMAILP == "") { $vVAZIOS .= "&mdash; E-mail<br />"; }

if ($vVAZIOS != "") {
	$vMENSAGEM = "Os campos listados abaixo, não podem ser vazios:<br /><br /><strong>" . $vVAZIOS . "</strong>";
	$vSALVAR = false;

} else {
	if (strtolower(trim($vformEMAILATUAL)) != strtolower(trim($vformEMAILP))) {
		if (fSeEmail($vformEMAILP)) {
			$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE email_proprio='" . $vformEMAILP . "'") or die (mysqli_error()); 
				$vRE = mysqli_fetch_array($vQUERY);
			
			if ($vRE != "") {
				$vMENSAGEM = "Já existe uma pessoa cadastrada com o <strong>E-MAIL PRÓPRIO</strong> informado. Informe um outro e-mail.";
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
						if ((int)$vformDTNASCIMENTOANO > (date("Y")-18)) {
							$vMENSAGEM = "O <strong>ANO</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Você precisa ser maior que 18 anos.";
							$vSALVAR = false;
							
						} else {
							$vSALVAR = true;
							
						}
						
					}
					
				}
			}
			
			mysqli_free_result($vQUERY);
			
		} else {
			$vMENSAGEM = "O <strong>E-MAIL PRÓPRIO</strong> informado parece não ser um e-mail válido. Verifique e digite novamente.";
			$vSALVAR = false;
			
		}
		
	} else {
		if ((int)$vformDTNASCIMENTODIA > 31) {
			$vMENSAGEM = "O <strong>DIA</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Digite novamente.";
			$vSALVAR = false;

		} else {
			if ((int)$vformDTNASCIMENTOMES > 12) {
				$vMENSAGEM = "O <strong>MÊS</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Digite novamente.";
				$vSALVAR = false;

			} else {
				if ((int)$vformDTNASCIMENTOANO > (date("Y")-18)) {
					$vMENSAGEM = "O <strong>ANO</strong> da <strong>DATA DE NASCIMENTO</strong> estar incorreto. Você precisa ter no mínimo 18 anos.";
					$vSALVAR = false;

				} else {
					$vSALVAR = true;

				}
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
					  "skype='" . $vformSKYPE . "'" . $vWhere)
	or die ("Falha ao tentar salvor Dados do Usuario");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Central de Apostas :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
	<?php
	echo '<script type="text/javascript">';
	
	if ($vSALVAR) {
		echo '$vHTML = "<div align=\'center\' style=\'font-size: 24px; font-weight: bold\'>ATUALIZAÇÃO EFETUADA COM SUCESSO!</div>";';

		echo 'top.document.getElementById("area-aviso").innerHTML = $vHTML;';
		echo 'top.document.getElementById("area-aviso").style.display = "table";';
		
	} else {
		echo '$vHTML = "<div align=\'center\'><img src=\'images/alerta_atencao.gif\' /></div><br />";';
		echo '$vHTML += "' . $vMENSAGEM . '";';

		echo 'top.document.getElementById("area-aviso").innerHTML = $vHTML;';
		echo 'top.document.getElementById("area-aviso").style.display = "table";';

	}
	
	echo '</script>';
	?>
</body>
</html>
