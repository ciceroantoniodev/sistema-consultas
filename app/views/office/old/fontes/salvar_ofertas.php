<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vID = isset($_GET['ida']) ? $_GET['ida'] : NULL;
$vID_Cadastro = isset($_GET['id_cadastro']) ? $_GET['id_cadastro'] : NULL;
$vTipo = isset($_GET['tp']) ? $_GET['tp'] : NULL;
$vgetIDUSUARIO = isset($_GET['idu']) ? $_GET['idu'] : NULL;

$vOfertas = isset($_GET['ofertas']) ? $_GET['ofertas'] : NULL;

$vAcao = isset($_POST['formACAO']) ? $_POST['formACAO'] : NULL;;

$f_tipo = isset($_POST['radio_ofertatipo']) ? $_POST['radio_ofertatipo'] : NULL;;
$f_liberado = isset($_POST['radio_liberado']) ? $_POST['radio_liberado'] : NULL;;
$f_descricao = isset($_POST['txt_descricao']) ? $_POST['txt_descricao'] : NULL;;
$f_preco_atual = isset($_POST['txt_preco_normal']) ? $_POST['txt_preco_normal'] : NULL;;
$f_preco_oferta = isset($_POST['txt_preco_oferta']) ? $_POST['txt_preco_oferta'] : NULL;;
$f_preco_condicao = isset($_POST['radio_condicao']) ? $_POST['radio_condicao'] : NULL;;
$f_preco_parcelas = isset($_POST['txt_parcelas']) ? $_POST['txt_parcelas'] : NULL;;
$f_preco_parcelado = isset($_POST['txt_valor_parcela']) ? $_POST['txt_valor_parcela'] : NULL;;
$f_preco_descricao = isset($_POST['txt_descricaocondicao']) ? $_POST['txt_descricaocondicao'] : NULL;;
$f_tipo_outro = isset($_POST['txt_ofertadinamica']) ? $_POST['txt_ofertadinamica'] : NULL;;
$f_datafim_dia = isset($_POST['txt_datafim_dia']) ? $_POST['txt_datafim_dia'] : NULL;;
$f_datafim_mes = isset($_POST['txt_datafim_mes']) ? $_POST['txt_datafim_mes'] : NULL;;
$f_datafim_ano = isset($_POST['txt_datafim_ano']) ? $_POST['txt_datafim_ano'] : NULL;;

$f_data = date("Y-m-d H:i:s");

if (trim($f_liberado) == "") {
	$f_liberado = "N";
	
}

if ($vAcao == "novo") {
	// Aqui o sistema pega a ID da franquia
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . (int)$vgetIDUSUARIO) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vID_Franquia = 1;
		
		if ($vRE != "") {
			$vID_Franquia = $vRE['id_franquia'];
			$getIDCIDADE = $vRE['id_cidade'];
			$getIDBAIRRO = $vRE['id_bairro'];
		}
	mysqli_free_result($vQUERY);
	
	$dbVALORES = $vID_Franquia;
	$dbVALORES .= "," . $getIDCIDADE;
	$dbVALORES .= "," . $getIDBAIRRO;
	$dbVALORES .= ",0" . $vgetIDUSUARIO;
	$dbVALORES .= ",'" . $f_descricao . "'";
	$dbVALORES .= ",'" . $f_preco_atual . "'";
	$dbVALORES .= ",'" . $f_preco_oferta . "'";
	$dbVALORES .= ",'" . $f_preco_parcelado . "'";
	$dbVALORES .= ",'" . $f_preco_parcelas . "'";
	$dbVALORES .= ",'" . $f_preco_condicao . "'";
	$dbVALORES .= ",'" . $f_preco_descricao . "'";
	$dbVALORES .= ",'" . $f_tipo . "'";
	$dbVALORES .= ",'" . $f_tipo_outro . "'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",0";
	$dbVALORES .= ",0";
	$dbVALORES .= ",'" . $f_liberado . "'";
	$dbVALORES .= ",'N'";
	$dbVALORES .= ",'" . date("Y-m-d") . "'";
	$dbVALORES .= ",'" . StrZero("0".$f_datafim_ano, 4) . "-" . StrZero("0".$f_datafim_mes, 2) . "-" . StrZero("0".$f_datafim_dia, 2) . "'";
	$dbVALORES .= ",'" . $f_data . "'";

	$dbCAMPOS = "id_franquia, id_cidade, id_bairro, id_cadastro, descricao, preco_atual, preco_oferta, preco_parcelado, preco_parcelas, preco_condicao, preco_descricao, tipo, tipo_outro, imagem, foto1, foto2, foto3, foto4, informacoes, cliques, visualizacoes, liberado, destaque, data_inicio, data_fim, data_cad";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_cadastroofertas (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());
  
} else {
	$vConexao->query("UPDATE sysc_cadastroofertas SET descricao='" . $f_descricao . "',
											preco_atual=0" . $f_preco_atual . ", 
											preco_oferta=0" . $f_preco_oferta . ", 
											preco_parcelado=0" . $f_preco_parcelado . ", 
											preco_parcelas=0" . $f_preco_parcelas . ", 
											preco_condicao='" . $f_preco_condicao . "', 
											preco_descricao='" . $f_preco_descricao . "', 
											tipo='" . $f_tipo . "', 
											liberado='" . $f_liberado . "', 
											data_fim='" . StrZero("0".$f_datafim_ano, 4) . "-" . StrZero("0".$f_datafim_mes, 2) . "-" . StrZero("0".$f_datafim_dia, 2) . "', 
											tipo_outro='" . $f_tipo_outro . "' WHERE id=" . $vID) or die(mysqli_error());

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!
<html>
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
</head>
  
<body style="background-color: #ffffff; margin-top: 0pt; margin-bottom: 0pt; margin-left: 0pt; margin-right: 0pt">
	<?php
	echo '<script language="JavaScript" type="text/javascript">';
	
	if ($vAcao == "novo") {
		echo 'parent.document.frmOfertas.txt_descricao.value = "";';
		echo 'parent.document.frmOfertas.txt_preco_normal.value = "0";';
		echo 'parent.document.frmOfertas.txt_preco_oferta.value = "0";';
		echo 'parent.document.frmOfertas.txt_parcelas.value = "0";';
		echo 'parent.document.frmOfertas.txt_valor_parcela.value = "0";';
		echo 'parent.document.frmOfertas.txt_descricaocondicao.value = "";';
		echo 'parent.document.frmOfertas.txt_ofertadinamica.value = "";';
		echo 'parent.fBoxDialogo("CADASTRO EFETUADO COM SUCESSO!");';
		echo 'parent.fVisualizar();';

	} else {
		echo 'parent.history.go(-1);';
		
	}
	
	echo '</script>';
	?>
</body>
</html>
