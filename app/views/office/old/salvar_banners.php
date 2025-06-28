<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/funcoes.php";
include "conexao.php";

$vSecaoTitulo = "CADASTRAR NOVO USUÁRIO";

$vSALVAR = false;
$vMENSAGEM = "";
$vVAZIOS = "";

$vformIDUSUARIO = isset($_POST["formIDUSUARIO"]) ? $_POST["formIDUSUARIO"] : NULL;
$vformIDBANNER = isset($_POST["formIDBANNER"]) ? $_POST["formIDBANNER"] : NULL;

$vformATIVO = isset($_POST["formATIVO"]) ? $_POST["formATIVO"] : NULL;
$vformORDEM = isset($_POST["formORDEM"]) ? $_POST["formORDEM"] : NULL;
$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : NULL;
$vformSECAO = isset($_POST["formSECAO"]) ? $_POST["formSECAO"] : NULL;
$vformLARGURA = isset($_POST["formLARGURA"]) ? $_POST["formLARGURA"] : NULL;
$vformALTURA = isset($_POST["formALTURA"]) ? $_POST["formALTURA"] : NULL;
$vformSUBSECAO = isset($_POST["formSUBSECAO"]) ? $_POST["formSUBSECAO"] : NULL;
$vformLINKTIPO = isset($_POST["formLINKTIPO"]) ? $_POST["formLINKTIPO"] : NULL;
$vformLINK = isset($_POST["formLINK"]) ? $_POST["formLINK"] : NULL;
$vformDATA_INICIO_DIA = isset($_POST["formDATA_INICIO_DIA"]) ? $_POST["formDATA_INICIO_DIA"] : NULL;
$vformDATA_INICIO_MES = isset($_POST["formDATA_INICIO_MES"]) ? $_POST["formDATA_INICIO_MES"] : NULL;
$vformDATA_INICIO_ANO = isset($_POST["formDATA_INICIO_ANO"]) ? $_POST["formDATA_INICIO_ANO"] : NULL;
$vformDATA_FIM_DIA = isset($_POST["formDATA_FIM_DIA"]) ? $_POST["formDATA_FIM_DIA"] : NULL;
$vformDATA_FIM_MES = isset($_POST["formDATA_FIM_MES"]) ? $_POST["formDATA_FIM_MES"] : NULL;
$vformDATA_FIM_ANO = isset($_POST["formDATA_FIM_ANO"]) ? $_POST["formDATA_FIM_ANO"] : NULL;

$vDT_CADASTRO = date("Y-m-d H:i:s"); 


// ***********************************************************
// *
// *
// * Inicia gravação nas tabelas
// *
// *
// ***********************************************************



$vConexao->query("UPDATE sysc_banners SET 
						descricao='" . $vformDESCRICAO . "', 
						secao='" . $vformSECAO . "', 
						subsecao='" . $vformSUBSECAO . "', 
						ordem=0" . (int)$vformORDEM . ", 
						altura=0" . (int)$vformALTURA . ", 
						largura=0" . (int)$vformLARGURA . ", 
						linktipo='" . $vformLINKTIPO . "', 
						link='" . $vformLINK . "', 
						ativo='" . $vformATIVO . "', 
						data_inicio='" . $vformDATA_INICIO_ANO . '-' . $vformDATA_INICIO_MES . '-' . $vformDATA_INICIO_DIA . "', 
						data_fim='" . $vformDATA_FIM_ANO . '-' . $vformDATA_FIM_MES . '-' . $vformDATA_FIM_DIA . "' WHERE id=" . $vformIDBANNER) or die (mysql_error());
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
	
	echo 'top.document.getElementById("areaOK' . $vformIDBANNER . '").style.display = "block";';
	
	echo '</script>';
	?>
</body>
</html>
