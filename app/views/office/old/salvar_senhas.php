<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/funcoes.php";
include "conexao.php";

$vSecaoTitulo = "CADASTRAR NOVO USUÁRIO";

$vSALVAR = false;
$vMENSAGEM = "";
$vVAZIOS = "";

$vformIDUSUARIO = isset($_POST["formIDUSUARIO"]) ? $_POST["formIDUSUARIO"] : NULL;

$vformLSENHAA = isset($_POST["formLSENHAA"]) ? $_POST["formLSENHAA"] : NULL;
$vformLSENHAB = isset($_POST["formLSENHAB"]) ? $_POST["formLSENHAB"] : NULL;

$vformFSENHAA = isset($_POST["formFSENHAA"]) ? $_POST["formFSENHAA"] : NULL;
$vformFSENHAB = isset($_POST["formFSENHAB"]) ? $_POST["formFSENHAB"] : NULL;

$vformLEMBRETE = isset($_POST["formLEMBRETE"]) ? $_POST["formLEMBRETE"] : NULL;

$vDT_CADASTRO = date("Y-m-d H:i:s"); 


// ***********************************************************
// *
// *
// * Inicia validação dos valores recebidos através do formulário
// *
// *
// ***********************************************************

$vConteudo = trim($vformLSENHAA) . trim($vformLSENHAB) . trim($vformFSENHAA) . trim($vformFSENHAB) . trim($vformLEMBRETE);

if ($vConteudo == "") {
	$vMENSAGEM = "Todos os campos estão vazios. Nada foi mudado.";
	$vSALVAR = false;

} else {
	if ((trim($vformLSENHAA) != "") || (trim($vformLSENHAB) != "")) {
		if (trim($vformLSENHAA) != trim($vformLSENHAB)) {
			$vMENSAGEM = "As senhas do PESSOAL não correspondem. Verifique e digite novamente.";
			$vSALVAR = false;
				
		} else {
			if (trim($vformLEMBRETE) == "") {
				$vMENSAGEM = "Digite uma FRASE LEMBRETE para caso esqueça sua senha ela será utilizada para recuperação.";
				$vSALVAR = false;
				
			} else {
				if ((trim($vformFSENHAA) != "") || (trim($vformFSENHAB) != "")) {
					if (trim($vformFSENHAA) != trim($vformFSENHAB)) {
						$vMENSAGEM = "As senhas do FINANCEIRO não correspondem. Verifique e digite novamente.";
						$vSALVAR = false;
						
					} else {
						$vSALVAR = true;
						
					}

				} else {
					$vSALVAR = true;

				}
			}
		}

	} else {
		if ((trim($vformFSENHAA) != "") || (trim($vformFSENHAB) != "")) {
			if (trim($vformFSENHAA) != trim($vformFSENHAB)) {
				$vMENSAGEM = "As senhas do FINANCEIRO não correspondem. Verifique e digite novamente.";
				$vSALVAR = false;
				
			} else {
				$vSALVAR = true;
				
			}

		} else {
			$vSALVAR = true;
			
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
	if ($vformLSENHAA != "") {
		$vConexao->query("UPDATE sysc_usuarios SET senha='" . hash('sha512', $vformLSENHAA) . "' WHERE id=" . $vformIDUSUARIO) or die (mysql_error());

	}
	
	if ($vformFSENHAA != "") {
		$vConexao->query("UPDATE sysc_usuarios SET senha_fin='" . hash('sha512', $vformFSENHAA) . "' WHERE id=" . $vformIDUSUARIO) or die (mysql_error());

	}
	
	if ($vformLEMBRETE != "") {
		$vConexao->query("UPDATE sysc_usuarios SET senha_lembrete='" . $vformLEMBRETE. "' WHERE id=" . $vformIDUSUARIO) or die (mysql_error());

	}

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
