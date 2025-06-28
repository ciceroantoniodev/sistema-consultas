<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fIdu(0, $_GET["idu"]) : NULL;
$vgetIDFRANQUIA = isset($_GET["idf"]) ? $_GET["idf"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetNIVEL = isset($_GET["n"]) ? $_GET["n"] : NULL;
$vgetIDVENDEDOR = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vTituloSecao = "CADASTRAR IMÓVEL";

// ***********************************************************
// *
// *
// * Pega dados complementares na tabela de Usuários
// *
// *
// ***********************************************************


$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	$vID_Cidade = $vRE['id_cidade'];
	$vID_Bairro = $vRE['id_bairro'];

mysqli_free_result($vQUERY);


// ***********************************************************
// *
// *
// * Inicia gravação dos Classificados
// *
// *
// ***********************************************************


$vImagem_Topo = "";
$vPosicao = 0;

$uploaddir = '../documentos/fotos/classificados/';

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

$vformTIPO = isset($_POST["formTIPO"]) ? $_POST["formTIPO"] : NULL;
$vformFINALIDADE = isset($_POST["formFINALIDADE"]) ? $_POST["formFINALIDADE"] : NULL;
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
$vformENDERECO_NUMERO = isset($_POST["formENDERECO_NUMERO"]) ? $_POST["formENDERECO_NUMERO"] : NULL;
$vformCOMPLEMENTO = isset($_POST["formCOMPLEMENTO"]) ? $_POST["formCOMPLEMENTO"] : NULL;
$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
$vformMAPA = isset($_POST["formMAPA"]) ? $_POST["formMAPA"] : NULL;
$vformCARACT_QUARTOS = isset($_POST["formCARACT_QUARTOS"]) ? $_POST["formCARACT_QUARTOS"] : NULL;
$vformCARACT_SUITES = isset($_POST["formCARACT_SUITES"]) ? $_POST["formCARACT_SUITES"] : NULL;
$vformCARACT_BANHEIROS = isset($_POST["formCARACT_BANHEIROS"]) ? $_POST["formCARACT_BANHEIROS"] : NULL;
$vformCARACT_VAGAS = isset($_POST["formCARACT_VAGAS"]) ? $_POST["formCARACT_VAGAS"] : NULL;
$vformCARACT_AREA = isset($_POST["formCARACT_AREA"]) ? $_POST["formCARACT_AREA"] : NULL;
$vformCARACT_METRAGEM = isset($_POST["formCARACT_METRAGEM"]) ? $_POST["formCARACT_METRAGEM"] : NULL;
$vformCARACT_LOCALIZACAO = isset($_POST["formCARACT_LOCALIZACAO"]) ? $_POST["formCARACT_LOCALIZACAO"] : NULL;
$vformCONDICAO_PRECO = isset($_POST["formCONDICAO_PRECO"]) ? $_POST["formCONDICAO_PRECO"] : NULL;
$vformCONDICAO_PERMUTA = isset($_POST["formCONDICAO_PERMUTA"]) ? $_POST["formCONDICAO_PERMUTA"] : NULL;
$vformCONDICAO_FINANCIAMENTO = isset($_POST["formCONDICAO_FINANCIAMENTO"]) ? $_POST["formCONDICAO_FINANCIAMENTO"] : NULL;
$vformCONDICAO_CARTAOCREDITO = isset($_POST["formCONDICAO_CARTAOCREDITO"]) ? $_POST["formCONDICAO_CARTAOCREDITO"] : NULL;
$vformCONDICAO_TRANSFERENCIA = isset($_POST["formCONDICAO_TRANSFERENCIA"]) ? $_POST["formCONDICAO_TRANSFERENCIA"] : NULL;
$vformCONDICAO_IPTU = isset($_POST["formCONDICAO_IPTU"]) ? $_POST["formCONDICAO_IPTU"] : NULL;
$vformCONDICAO_TERRENO = isset($_POST["formCONDICAO_TERRENO"]) ? $_POST["formCONDICAO_TERRENO"] : NULL;
$vformCONDICAO_CONSTRUIDA = isset($_POST["formCONDICAO_CONSTRUIDA"]) ? $_POST["formCONDICAO_CONSTRUIDA"] : NULL;
$vformCONDICAO_VLRCONDOMINIO = isset($_POST["formCONDICAO_VLRCONDOMINIO"]) ? $_POST["formCONDICAO_VLRCONDOMINIO"] : NULL;
$vformCONDICAO_ANO = isset($_POST["formCONDICAO_ANO"]) ? $_POST["formCONDICAO_ANO"] : NULL;
$vformCONDICAO_PAVIMENTOS = isset($_POST["formCONDICAO_PAVIMENTOS"]) ? $_POST["formCONDICAO_PAVIMENTOS"] : NULL;
$vformCONDICAO_TIPO = isset($_POST["formCONDICAO_TIPO"]) ? $_POST["formCONDICAO_TIPO"] : NULL;
$vformCONDICAO_ZONEAMENTO = isset($_POST["formCONDICAO_ZONEAMENTO"]) ? $_POST["formCONDICAO_ZONEAMENTO"] : NULL;
$vformCONDICAO_CONDOMINIO = isset($_POST["formCONDICAO_CONDOMINIO"]) ? $_POST["formCONDICAO_CONDOMINIO"] : NULL;
$vformCARACTERISTICAS = isset($_POST["formCARACTERISTICAS"]) ? $_POST["formCARACTERISTICAS"] : NULL;
$vformINSTALACOES = isset($_POST["formINSTALACOES"]) ? $_POST["formINSTALACOES"] : NULL;
$vformINFRAESTRUTURA = isset($_POST["formINFRAESTRUTURA"]) ? $_POST["formINFRAESTRUTURA"] : NULL;
$vformLAZER = isset($_POST["formLAZER"]) ? $_POST["formLAZER"] : NULL;
$vformINFORMACOES = isset($_POST["formINFORMACOES"]) ? $_POST["formINFORMACOES"] : NULL;

$vCARACTERISTICAS = '';
$vINSTALACOES = '';
$vINFRAESTRUTURA = '';
$vLAZER = '';

for ($i = 0; $i < count($vformCARACTERISTICAS); $i++) {
	if ($i > 0) { $vCARACTERISTICAS .= ','; }
	
	$vCARACTERISTICAS .= $vformCARACTERISTICAS[$i];
}

for ($i = 0; $i < count($vformINSTALACOES); $i++) {
	if ($i > 0) { $vINSTALACOES .= ','; }
	
	$vINSTALACOES .= $vformINSTALACOES[$i];
}

for ($i = 0; $i < count($vformINFRAESTRUTURA); $i++) {
	if ($i > 0) { $vINFRAESTRUTURA .= ','; }
	
	$vINFRAESTRUTURA .= $vformINFRAESTRUTURA[$i];
}

for ($i = 0; $i < count($vformLAZER); $i++) {
	if ($i > 0) { $vLAZER .= ','; }
	
	$vLAZER .= $vformLAZER[$i];
}

if ($vformACAO == "salvar") {
	
	$vDATA_CAD = date("Y-m-d H:i:s");
	
	$dbCAMPOS = "id_franquia, id_cidade, id_bairro, id_imobiliaria, id_usuario, tipo, finalidade, estado, cidade, cep, endereco, endereco_numero, complemento, bairro, mapa, mapa_link, caract_quartos, caract_suites, caract_banheiros, caract_vagas, caract_area, caract_metragem, caract_localizacao, condicao_preco, condicao_permuta, condicao_financiamento, condicao_cartaocredito, condicao_transferencia, condicao_iptu, condicao_terreno, condicao_construida, condicao_vlrcondominio, condicao_ano, condicao_pavimentos, condicao_tipo, condicao_zoneamento, condicao_condominio, informacoes, divulgar_fone, divulgar_celular, divulgar_email, caracteristicas, instalacoes, infra_estrutura, lazer, pendente, cliques, visualizacoes, data_cad";
	
$vformID_IMOBILIARIA = 0;

	$dbVALORES = "0" . $vgetIDFRANQUIA;
	$dbVALORES .= ",0" . $vID_Cidade; 
	$dbVALORES .= ",0" . $vID_Bairro; 
	$dbVALORES .= ",0" . $vformID_IMOBILIARIA; 
	$dbVALORES .= ",0" . $vgetIDUSUARIO; 
	$dbVALORES .= ",'" . $vformTIPO . "'"; 
	$dbVALORES .= ",'" . $vformFINALIDADE . "'"; 
	$dbVALORES .= ",'" . $vformESTADO . "'"; 
	$dbVALORES .= ",'" . $vformCIDADE . "'"; 
	$dbVALORES .= ",'" . $vformCEP . "'"; 
	$dbVALORES .= ",'" . $vformENDERECO . "'"; 
	$dbVALORES .= ",'" . $vformENDERECO_NUMERO . "'"; 
	$dbVALORES .= ",'" . $vformCOMPLEMENTO . "'"; 
	$dbVALORES .= ",'" . $vformBAIRRO . "'"; 
	$dbVALORES .= ",'" . $vformMAPA . "'"; 
	$dbVALORES .= ",''"; //mapa_link
	$dbVALORES .= ",'" . $vformCARACT_QUARTOS . "'"; 
	$dbVALORES .= ",'" . $vformCARACT_SUITES . "'"; 
	$dbVALORES .= ",'" . $vformCARACT_BANHEIROS . "'"; 
	$dbVALORES .= ",'" . $vformCARACT_VAGAS . "'"; 
	$dbVALORES .= ",'" . $vformCARACT_AREA . "'"; 
	$dbVALORES .= ",'" . $vformCARACT_METRAGEM . "'"; 
	$dbVALORES .= ",'" . $vformCARACT_LOCALIZACAO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_PRECO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_PERMUTA . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_FINANCIAMENTO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_CARTAOCREDITO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_TRANSFERENCIA . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_IPTU . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_TERRENO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_CONSTRUIDA . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_VLRCONDOMINIO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_ANO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_PAVIMENTOS . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_TIPO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_ZONEAMENTO . "'"; 
	$dbVALORES .= ",'" . $vformCONDICAO_CONDOMINIO . "'"; 
	$dbVALORES .= ",'" . $vformINFORMACOES . "'"; 
	$dbVALORES .= ",''"; // divulgar_fone
	$dbVALORES .= ",''";  // divulgar_celular
	$dbVALORES .= ",''";  // divulgar_email
	$dbVALORES .= ",'" . $vCARACTERISTICAS . "'"; 
	$dbVALORES .= ",'" . $vINSTALACOES . "'"; 
	$dbVALORES .= ",'" . $vINFRAESTRUTURA . "'"; 
	$dbVALORES .= ",'" . $vLAZER . "'"; 
	$dbVALORES .= ",'N'"; // pendente
	$dbVALORES .= ",'0'"; // cliques
	$dbVALORES .= ",'0'"; // visualizacoes
	$dbVALORES .= ",'" . $vDATA_CAD . "'";		// data_cad
	echo $dbVALORES;

	//$dbSALVAR = $vConexao->query("INSERT INTO sysc_classificados (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());

} else if ($vformACAO == "alterar") {
	$vConexao->query("UPDATE sysc_classificados SET 
							id_categoria=0" . (int)$vformID_CATEGORIA . ", 
							categoria='" . $vformCATEGORIA . "',
							titulo='" . $vformTITULO . "', 
							estado='" . $vformESTADO . "',
							preco=0" . str_replace(",", ".", $vformPRECO) . ",
							descricao='" . $vformDESCRICAO . "' WHERE id=" . $vformIDCLASS) or die(mysqli_error());

}

if ($vAcao == "alterar") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_classificados WHERE id=" . $vgetIDA) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vformCATEGORIA = $vRE['categoria'];
		$vformID_CATEGORIA = $vRE['id_categoria'];
		$vformTITULO = $vRE['titulo'];
		$vformPRECO = $vRE['preco'];
		$vformESTADO = $vRE['estado'];
		$vformDESCRICAO = $vRE['descricao'];
		
		$vformFOTO1 = $vRE['foto1'];
		$vformFOTO2 = $vRE['foto2'];
		$vformFOTO3 = $vRE['foto3'];
		$vformFOTO4 = $vRE['foto4'];
		
	mysqli_free_result($vQUERY);
	
	$vformACAO = "alterar";

} else {
	$vformACAO = "salvar";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
</head>
  
<body>
Ok
</body>
</html>