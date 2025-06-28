<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetIFRAMEHEIGHT = isset($_GET["h"]) ? $_GET["h"] : NULL;

$vgetID_PRODUTO = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$syscID_CATEGORIA = 0;

$syscSALVAR = "N";

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : "";

$vformID_PRODUTO = isset($_POST["formID_PRODUTO"]) ? $_POST["formID_PRODUTO"] : NULL;

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : "";
$vformSUBTITULO = isset($_POST["formSUBTITULO"]) ? $_POST["formSUBTITULO"] : "";
$vformCOD_LOCAL = isset($_POST["formCOD_LOCAL"]) ? $_POST["formCOD_LOCAL"] : "";
$vformCOD_BARRA = isset($_POST["formCOD_BARRA"]) ? $_POST["formCOD_BARRA"] : "";
$vformREFERENCIA = isset($_POST["formREFERENCIA"]) ? $_POST["formREFERENCIA"] : "";
$vformUNIDADE = isset($_POST["formUNIDADE"]) ? $_POST["formUNIDADE"] : "";
$vformCONTEUDO = isset($_POST["formCONTEUDO"]) ? $_POST["formCONTEUDO"] : 0;
$vformCONTEUDO_TIPO = isset($_POST["formCONTEUDO_TIPO"]) ? $_POST["formCONTEUDO_TIPO"] : 0;
$vformPRECO_ATUAL = isset($_POST["formPRECO_ATUAL"]) ? $_POST["formPRECO_ATUAL"] : 0;
$vformPRECO_OFERTA = isset($_POST["formPRECO_OFERTA"]) ? $_POST["formPRECO_OFERTA"] : 0;
$vformPRECO_PARCELAS = isset($_POST["formPRECO_PARCELAS"]) ? $_POST["formPRECO_PARCELAS"] : 0;
$vformPRECO_PARCELADO = isset($_POST["formPRECO_PARCELADO"]) ? $_POST["formPRECO_PARCELADO"] : 0;
$vformPRECO_DESCRICAO = isset($_POST["formPRECO_DESCRICAO"]) ? $_POST["formPRECO_DESCRICAO"] : "";
$vformPRECO_CONDICAO = isset($_POST["formPRECO_CONDICAO"]) ? $_POST["formPRECO_CONDICAO"] : "à vista";
$vformVLR_CUSTO = isset($_POST["formVLR_CUSTO"]) ? $_POST["formVLR_CUSTO"] : 0;
$vformPERCENTUAL = isset($_POST["formPERCENTUAL"]) ? $_POST["formPERCENTUAL"] : 0;
$vformVLR_VENDA = isset($_POST["formVLR_VENDA"]) ? $_POST["formVLR_VENDA"] : 0;
$vformDESCONTO_MAX = isset($_POST["formDESCONTO_MAX"]) ? $_POST["formDESCONTO_MAX"] : 0;
$vformEST_ATUAL = isset($_POST["formEST_ATUAL"]) ? $_POST["formEST_ATUAL"] : 0;
$vformEST_MINIMO = isset($_POST["formEST_MINIMO"]) ? $_POST["formEST_MINIMO"] : 0;
$vformCOMISSAO = isset($_POST["formCOMISSAO"]) ? $_POST["formCOMISSAO"] : 0;
$vformGRUPOANTERIOR = isset($_POST["formGRUPOANTERIOR"]) ? $_POST["formGRUPOANTERIOR"] : "";
$vformFABRICANTE = isset($_POST["formFABRICANTE"]) ? $_POST["formFABRICANTE"] : "";
$vformLINHA = isset($_POST["formLINHA"]) ? $_POST["formLINHA"] : "";
$vformTAGS = isset($_POST["formTAGS"]) ? $_POST["formTAGS"] : ";";
$vformVOLTAGEM = isset($_POST["formVOLTAGEM"]) ? $_POST["formVOLTAGEM"] : 0;
$vformAMPERAGEM = isset($_POST["formAMPERAGEM"]) ? $_POST["formAMPERAGEM"] : 0;
$vformMOSTRAR_PRECO = isset($_POST["formMOSTRAR_PRECO"]) ? $_POST["formMOSTRAR_PRECO"] : "";
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : "";
$vformSIMILAR = isset($_POST["formSIMILAR"]) ? $_POST["formSIMILAR"] : "";

$vformCORES = isset($_POST["formCORES"]) ? $_POST["formCORES"] : "";
$vformCOR0 = isset($_POST["formCOR0"]) ? $_POST["formCOR0"] : "";
$vformCOR1 = isset($_POST["formCOR1"]) ? $_POST["formCOR1"] : "";
$vformCOR2 = isset($_POST["formCOR2"]) ? $_POST["formCOR2"] : "";
$vformCOR3 = isset($_POST["formCOR3"]) ? $_POST["formCOR3"] : "";
$vformCOR4 = isset($_POST["formCOR4"]) ? $_POST["formCOR4"] : "";
$vformCOR5 = isset($_POST["formCOR5"]) ? $_POST["formCOR5"] : "";
$vformCOR6 = isset($_POST["formCOR6"]) ? $_POST["formCOR6"] : "";
$vformCOR7 = isset($_POST["formCOR7"]) ? $_POST["formCOR7"] : "";
$vformCOR8 = isset($_POST["formCOR8"]) ? $_POST["formCOR8"] : "";
$vformCOR9 = isset($_POST["formCOR9"]) ? $_POST["formCOR9"] : "";

$vformCORES_OPCOES = "|";
$vformCORES_OPCOES .= ($vformCOR0 != "#fcfcfc") ? $vformCOR0 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR1 != "#fcfcfc") ? $vformCOR1 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR2 != "#fcfcfc") ? $vformCOR2 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR3 != "#fcfcfc") ? $vformCOR3 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR4 != "#fcfcfc") ? $vformCOR4 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR5 != "#fcfcfc") ? $vformCOR5 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR6 != "#fcfcfc") ? $vformCOR6 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR7 != "#fcfcfc") ? $vformCOR7 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR8 != "#fcfcfc") ? $vformCOR8 . "|" : "";
$vformCORES_OPCOES .= ($vformCOR9 != "#fcfcfc") ? $vformCOR9 . "|" : "";

if ($vformCORES == "N") {
	$vformCORES_OPCOES = "|";
	
}

$vformCAT_TOTAL = isset($_POST["formCAT_TOTAL"]) ? $_POST["formCAT_TOTAL"] : "";
$vformSUB_TOTAL = isset($_POST["formSUB_TOTAL"]) ? $_POST["formSUB_TOTAL"] : "";

$vformCATEGORIAS = '';
$vformSUBCATEGORIAS = '';

if ((int)$vformCAT_TOTAL > 0) {
	
	for ($i = 1; $i <= (int)$vformCAT_TOTAL; $i++) {
		$vformCATEGORIAS .= isset($_POST["formCATEGORIAS".$i]) ? '['.$_POST["formCATEGORIAS".$i].']' : "";
		
	}
	
}

if ((int)$vformSUB_TOTAL > 0) {
	
	for ($i = 1; $i <= (int)$vformSUB_TOTAL; $i++) {
		$vformSUBCATEGORIAS .= isset($_POST["formSUBCATEGORIAS".$i]) ? '['.$_POST["formSUBCATEGORIAS".$i].']' : "";
		
	}
	
}

$vformFORNECEDOR = isset($_POST["formFORNECEDOR"]) ? $_POST["formFORNECEDOR"] : "";
$vformFONE = "";

$arrayFORNECEDOR = explode(";", $vformFORNECEDOR);

if (count($arrayFORNECEDOR) >= 3) {
	$vformFORNECEDOR = $arrayFORNECEDOR[0];
	$vformFONE = '(' . $arrayFORNECEDOR[1] . ')' . $arrayFORNECEDOR[2];
	
}

if ($vformSIMILAR == "S") {
	$vformORIGINAL = "N";
	
} else {
	$vformORIGINAL = "S";
	$vformSIMILAR == "N";
	
}

$vformDESTAQUE_EXTERNO = isset($_POST["formDESTAQUE_EXTERNO"]) ? $_POST["formDESTAQUE_EXTERNO"] : "";
$vformORDEM_EXTERNO = isset($_POST["formORDEM_EXTERNO"]) ? $_POST["formORDEM_EXTERNO"] : "";
$vformDESTAQUE_INTERNO = isset($_POST["formDESTAQUE_INTERNO"]) ? $_POST["formDESTAQUE_INTERNO"] : "";
$vformORDEM_INTERNO = isset($_POST["formORDEM_INTERNO"]) ? $_POST["formORDEM_INTERNO"] : "";

$vformVALIDADE_DIA = isset($_POST["formVALIDADE_DIA"]) ? $_POST["formVALIDADE_DIA"] : "";
$vformVALIDADE_MES = isset($_POST["formVALIDADE_MES"]) ? $_POST["formVALIDADE_MES"] : "";
$vformVALIDADE_ANO = isset($_POST["formVALIDADE_ANO"]) ? $_POST["formVALIDADE_ANO"] : "";

$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : "";
$vformAPLICACAO = isset($_POST["formAPLICACAO"]) ? $_POST["formAPLICACAO"] : "";
$vformESPECIFICACOES = isset($_POST["formESPECIFICACOES"]) ? $_POST["formESPECIFICACOES"] : "";
$vformOBSERVACOES = isset($_POST["formOBSERVACOES"]) ? $_POST["formOBSERVACOES"] : "";
$vformVIDEO = isset($_POST["formVIDEO"]) ? $_POST["formVIDEO"] : "";

$vformACEITA_CARTAO = isset($_POST["formACEITA_CARTAO"]) ? $_POST["formACEITA_CARTAO"] : "S";
$vformCARTOES = isset($_POST["formCARTOES"]) ? $_POST["formCARTOES"] : "";

$vDATA_CAD = date("Y-m-d H:i:s"); 


// ***********************************************************
// *
// *
// * Inicia validação dos valores recebidos através do formulário
// *
// *
// ***********************************************************


$vVAZIOS = "";


if ($vformNOME == "") { $vVAZIOS .= "&mdash; Nome<br />"; }
//if ($vformFORNECEDOR == "") { $vVAZIOS .= "&mdash; Fornecedor<br />"; }
//if ($vformLINHA == "") { $vVAZIOS .= "&mdash; Linha<br />"; }
if ($vformCATEGORIAS == "") { $vVAZIOS .= "&mdash; Grupo Principal<br />"; }
//if ($vformSUBCATEGORIAS == "") { $vVAZIOS .= "&mdash; Sub-Grupo<br />"; }

if ($vVAZIOS != "") {
	$vMENSAGEM = "Os campos listados abaixo, n&atilde;o podem ser vazios:<br /><br /><strong>" . $vVAZIOS . "</strong>";
	$vSALVAR = false;
	
} else {
	
	if ($vformACAO == "novo") {	

		$dbVALORES = "0" . $vgetIDUSUARIO;
		$dbVALORES .= ",'" . $vformCATEGORIAS . $vformSUBCATEGORIAS . "'";
		$dbVALORES .= ",0" . (int)substr($vformLINHA, strpos("_".$vformLINHA, "|"));
		$dbVALORES .= ",'" . $vformNOME . "'";
		$dbVALORES .= ",'" . $vformSUBTITULO . "'";
		$dbVALORES .= ",'" . $vformFABRICANTE . "'";
		$dbVALORES .= ",'" . substr($vformLINHA, 0, (strpos("_".$vformLINHA, "|")-1)) . "'";
		$dbVALORES .= ",'" . $vformCOD_BARRA . "'";
		$dbVALORES .= ",'" . $vformREFERENCIA . "'";
		$dbVALORES .= ",'" . $vformCOD_LOCAL . "'";
		$dbVALORES .= ",0" . $vformAMPERAGEM;
		$dbVALORES .= ",0" . $vformVOLTAGEM;
		$dbVALORES .= ",'" . $vformUNIDADE . "'";
		$dbVALORES .= ",0" . $vformCONTEUDO;
		$dbVALORES .= ",'" . $vformCONTEUDO_TIPO . "'";
		$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO_ATUAL);
		$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO_OFERTA);
		$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO_PARCELADO);
		$dbVALORES .= ",0" . $vformPRECO_PARCELAS;
		$dbVALORES .= ",'" . $vformPRECO_CONDICAO . "'";
		$dbVALORES .= ",'" . $vformPRECO_DESCRICAO . "'";
		$dbVALORES .= ",0" . $vformPERCENTUAL;
		$dbVALORES .= ",0" . str_replace(",", ".", $vformVLR_CUSTO);
		$dbVALORES .= ",0" . $vformDESCONTO_MAX;
		$dbVALORES .= ",0" . $vformEST_ATUAL;
		$dbVALORES .= ",0" . $vformEST_MINIMO;
		$dbVALORES .= ",'ativo'";
		$dbVALORES .= ",'" . $vformFORNECEDOR . "'";
		$dbVALORES .= ",'" . $vformFONE . "'";
		$dbVALORES .= ",'" . $vformDESCRICAO . "'";
		$dbVALORES .= ",'" . $vformAPLICACAO . "'";
		$dbVALORES .= ",'" . $vformOBSERVACOES . "'";
		$dbVALORES .= ",NULL";
		$dbVALORES .= ",0";
		
		if ((int)$vformVALIDADE_ANO > 0 && (int)$vformVALIDADE_MES > 0 && (int)$vformVALIDADE_DIA > 0) {
			$dbVALORES .= ",'" . $vformVALIDADE_ANO . '-' . $vformVALIDADE_MES . '-' . $vformVALIDADE_DIA . "'";
			
		} else {
			$dbVALORES .= ",NULL";
			
		}
		
		$dbVALORES .= ",0" . $vformCOMISSAO;
		$dbVALORES .= ",0";
		$dbVALORES .= ",''";
		$dbVALORES .= ",''";
		$dbVALORES .= ",''";
		$dbVALORES .= ",''";
		$dbVALORES .= ",''";
		$dbVALORES .= ",0";
		$dbVALORES .= ",'" . $vformESPECIFICACOES . "'";
		$dbVALORES .= ",'" . $vformVIDEO . "'";
		$dbVALORES .= ",'" . $vformACEITA_CARTAO . "'";
		$dbVALORES .= ",'" . $vformCARTOES . "'";
		$dbVALORES .= ",'" . $vformDESTAQUE_EXTERNO . "'";
		$dbVALORES .= ",'" . $vformDESTAQUE_INTERNO . "'";
		$dbVALORES .= ",0" . $vformORDEM_EXTERNO;
		$dbVALORES .= ",0" . $vformORDEM_INTERNO;
		$dbVALORES .= ",'" . $vformTAGS . "'";
		$dbVALORES .= ",'" . $vformORIGINAL . "'";
		$dbVALORES .= ",'" . $vformESTADO . "'";
		$dbVALORES .= ",'" . $vformSIMILAR . "'";
		$dbVALORES .= ",'" . $vformMOSTRAR_PRECO . "'";
		$dbVALORES .= ",'" . $vformCORES . "'";
		$dbVALORES .= ",'" . $vformCORES_OPCOES . "'";
		$dbVALORES .= ",'" . $vDATA_CAD . "'";
	  
		$dbCAMPOS = "id_usuario, id_categoria, id_linha, nome, subtitulo, fabricante, linha, cod_barra, referencia, cod_local, amperagem, voltagem, unidade, conteudo, conteudo_tipo, preco_atual, preco_oferta, preco_parcelado, preco_parcelas, preco_condicao, preco_descricao, percentual, vlr_custo, desconto_max, est_atual, est_minimo, status, fornecedor, fone, descricao, aplicacao, observacao, ult_venda, tot_vendas, validade, comissao, fotos, foto_miniatura, foto1, foto2, foto3, foto4, cliques, especificacoes, video, aceita_cartao, cartoes, destaque_externo, destaque_interno, ordem_externo, ordem_interno, tags, original, estado, similar, mostrar_preco, cores, cores_opcoes, data";

		$dbSALVAR = $vConexao->query("INSERT INTO sysc_produtos (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());
		
		$syscSALVAR = "S";

		
		$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtos WHERE nome='$vformNOME' AND data='$vDATA_CAD'") or die (mysql_error());
		
			$reProdutos = mysqli_fetch_array($queryProdutos);
			
			$vformID_PRODUTO = $reProdutos['id'];
			
		mysqli_free_result($queryProdutos);


	} else if ($vformACAO == "alterar") {
		
		$vgetID_PRODUTO = $vformID_PRODUTO;

		$dbALT = "UPDATE sysc_produtos SET ";
		$dbWHERE = " where id=" . $vformID_PRODUTO;
		
		if ((int)$vformVALIDADE_ANO > 0 && (int)$vformVALIDADE_MES > 0 && (int)$vformVALIDADE_DIA > 0) {
			$vDataValidade = "'".$vformVALIDADE_ANO . '-' . $vformVALIDADE_MES . '-' . $vformVALIDADE_DIA."'";
			
		} else {
			$vDataValidade = "NULL";
			
		}
		
		$vConexao->query($dbALT . 
						"id_categoria='" . $vformCATEGORIAS . $vformSUBCATEGORIAS . "'" .
						",id_linha=0" . (int)substr($vformLINHA, strpos("_".$vformLINHA, "|")) .
						",nome='" . $vformNOME . "'" .
						",subtitulo='" . $vformSUBTITULO . "'" .
						",fabricante='" . $vformFABRICANTE . "'" .
						",linha='" . substr($vformLINHA, 0, (strpos("_".$vformLINHA, "|")-1)) . "'" .
						",cod_barra='" . $vformCOD_BARRA . "'" .
						",referencia='" . $vformREFERENCIA . "'" .
						",cod_local='" . $vformCOD_LOCAL . "'" .
						",amperagem=0" . $vformAMPERAGEM .
						",voltagem=0" . $vformVOLTAGEM .
						",unidade='" . $vformUNIDADE . "'" .
						",conteudo=0" . $vformCONTEUDO .
						",conteudo_tipo='" . $vformCONTEUDO_TIPO . "'" .
						",preco_atual=0" . str_replace(",", ".", $vformPRECO_ATUAL) .
						",preco_oferta=0" . str_replace(",", ".", $vformPRECO_OFERTA) .
						",preco_parcelado=0" . str_replace(",", ".", $vformPRECO_PARCELADO) .
						",preco_parcelas=0" . $vformPRECO_PARCELAS .
						",preco_condicao='" . $vformPRECO_CONDICAO . "'" .
						",preco_descricao='" . $vformPRECO_DESCRICAO . "'" .
						",percentual=0" . $vformPERCENTUAL .
						",vlr_custo=0" . str_replace(",", ".", $vformVLR_CUSTO) .
						",desconto_max=0" . $vformDESCONTO_MAX .
						",est_atual=0" . $vformEST_ATUAL .
						",est_minimo=0" . $vformEST_MINIMO .
						",fornecedor='" . $vformFORNECEDOR . "'" .
						",fone='" . $vformFONE . "'" .
						",descricao='" . $vformDESCRICAO . "'" .
						",aplicacao='" . $vformAPLICACAO . "'" .
						",observacao='" . $vformOBSERVACOES . "'" .
						",validade=" . $vDataValidade . 
						",comissao=0" . $vformCOMISSAO .
						",especificacoes='" . $vformESPECIFICACOES . "'" .
						",video='" . $vformVIDEO . "'" .
						",aceita_cartao='" . $vformACEITA_CARTAO . "'" .
						",cartoes='" . $vformCARTOES . "'" .
						",destaque_externo='" . $vformDESTAQUE_EXTERNO . "'" .
						",destaque_interno='" . $vformDESTAQUE_INTERNO . "'" .
						",ordem_externo=0" . $vformORDEM_EXTERNO .
						",ordem_interno=0" . $vformORDEM_INTERNO .
						",tags='" . $vformTAGS . "'" .
						",original='" . $vformORIGINAL . "'" .
						",estado='" . $vformESTADO . "'" .
						",similar='" . $vformSIMILAR . "'" .
						",cores='" . $vformCORES . "'" .
						",cores_opcoes='" . $vformCORES_OPCOES . "'" .
						",mostrar_preco='" . $vformMOSTRAR_PRECO . "'" . $dbWHERE) 
		or die ("Falha ao tentar conexao com Produtos");
		
		$syscSALVAR = "S";

	}


	$vProdutoLink = fGerarLink($vformID_PRODUTO . "-" . $vformNOME);


	$queryLink = $vConexao->query("SELECT * FROM sysc_produtos WHERE id=" . $vformID_PRODUTO) or die ("Falha ao tentar conexão com LINKS DE PRODUTOS");
		
		$reLink = mysqli_fetch_array($queryLink);
		
		if (trim($reLink['link']) != trim($vProdutoLink)) {
			$vConexao->query("UPDATE sysc_produtos SET link='$vProdutoLink' WHERE id=" . $vformID_PRODUTO);

		}

	mysqli_free_result($queryLink);


	if (($vformDESTAQUE_EXTERNO == "S") && ($syscSALVAR == "S")) {
		$vQUERY = $vConexao->query("SELECT * FROM sysc_produtosdestaques WHERE id_cadastro=" . $vformID_PRODUTO) or die (mysql_error());
		
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE == "") {
			$dbQUERY = $vConexao->query("SELECT * FROM sysc_produtosdestaques ORDER BY id DESC") or die (mysql_error()); 
			$dbRE = mysqli_fetch_array($dbQUERY);

			$vformID_DESTAQUE = $dbRE['id'] + 1;
			
			$dbVALORES = "0" . $vformID_DESTAQUE;
			$dbVALORES .= ",0" . $vformID_PRODUTO;
			$dbVALORES .= ",0" . $vformCATEGORIAS;
			$dbVALORES .= ",'" . $vformCATEGORIA . "'";
			$dbVALORES .= ",'" . $vformNOME . "'";
			$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO_ATUAL);
			$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO_OFERTA);
			$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO_PARCELADO);
			$dbVALORES .= ",0" . $vformPRECO_PARCELAS;
			$dbVALORES .= ",'" . $vformPRECO_CONDICAO . "'";
			$dbVALORES .= ",'" . $vformPRECO_DESCRICAO . "'";
			$dbVALORES .= ",'" . $vformMOSTRAR_PRECO . "'";
			$dbVALORES .= ",''";
			$dbVALORES .= ",''";
			$dbVALORES .= ",'" . $syscFOTO1 . "'";
			$dbVALORES .= ",'" . $syscFOTO2 . "'";
			$dbVALORES .= ",'" . $syscFOTO3 . "'";
			$dbVALORES .= ",'" . $syscFOTO4 . "'";
			$dbVALORES .= ",'" . $syscFOTO5 . "'";
			$dbVALORES .= ",''";
			$dbVALORES .= ",0";
			$dbVALORES .= ",0";
			$dbVALORES .= ",'" . $vformTAGS . "'";
			$dbVALORES .= ",'S'";
			$dbVALORES .= ",'" . $vDATA_CAD . "'";
			$dbVALORES .= ",'0000-00-00'";
			$dbVALORES .= ",'" . $vDATA_CAD . "'";
	  
			$dbCAMPOS = "id, id_cadastro, id_categoria, categoria, descricao, preco_atual, preco_oferta, preco_parcelado, preco_parcelas, preco_condicao, preco_descricao, mostrar_preco, tipo, tipo_outro, foto_miniatura, foto1, foto2, foto3, foto4, informacoes, cliques, visualizacoes, tags, ativo, data_inicio, data_fim, data_cad";
			
			$dbSALVAR = $vConexao->query("INSERT INTO sysc_produtosdestaques (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());
			
		} else {
			$dbALT = "UPDATE sysc_produtosdestaques SET ";
			$dbWHERE = " where id=" . $vRE['id'];
			
			$vConexao->query($dbALT . "categoria='" . $vformCATEGORIA . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "preco_atual=0" . str_replace(",", ".", $vformPRECO_ATUAL) . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "preco_oferta=0" . str_replace(",", ".", $vformPRECO_OFERTA) . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "preco_parcelado=0" . str_replace(",", ".", $vformPRECO_PARCELADO) . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "preco_parcelas=0" . $vformPRECO_PARCELAS . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "preco_condicao='" . $vformPRECO_CONDICAO . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "preco_descricao='" . $vformPRECO_DESCRICAO . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "descricao='" . $vformNOME . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "tags='" . $vformTAGS . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "mostrar_preco='" . $vformMOSTRAR_PRECO . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "foto_miniatura='" . $syscFOTO1 . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "foto1='" . $syscFOTO2 . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "foto2='" . $syscFOTO3 . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "foto3='" . $syscFOTO4 . "'" . $dbWHERE) or die (mysql_error());
			$vConexao->query($dbALT . "foto4='" . $syscFOTO5 . "'" . $dbWHERE) or die (mysql_error());
			
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
		echo '<script type="text/javascript" src="js/menu_redirect' . $jsReDirect . '.js"></script>';
		?>
	</head>

	<body>
		<?php
		echo '<script type="text/javascript">';
		
		if ($syscSALVAR == "S") {
			echo 'vHTML = "<div align=\'center\' style=\'font-size: 24px; font-weight: bold\'>ATUALIZA&Ccedil;&Atilde;O EFETUADA COM SUCESSO!</div>";';

			echo 'fMostrarAviso(vHTML);';
			
			if ($vformACAO == "novo") {	
				echo 'top.showDIRECT(\'\', \'cad_produtos.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\');';
			
			}
			
		} else {
			echo 'vHTML = "<div align=\'center\'><img src=\'images/alerta_atencao.gif\' /></div><br />";';
			echo 'vHTML += "' . $vMENSAGEM . '";';

			echo 'fMostrarAviso(vHTML);';
			
		}
		
		echo '</script>';
		?>
	</body>
</html>