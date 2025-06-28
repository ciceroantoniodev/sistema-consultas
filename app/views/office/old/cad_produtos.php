<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vConexao->query("UPDATE sysc_usuarios SET funcao='administrador'") or die ("Falha ao tentar conexao com Categorias");

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vgetID_PRODUTO = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vLinkRetorno = "";
$vTituloSecao = "CADASTRO DE PRODUTOS";

$syscSALVAR = "N";

$syscDESTAQUEEXTERNOSIM = "";
$syscDESTAQUEEXTERNONAO = "checked='checked'";
$syscORDEMEXTERNO = "0";
$syscDESTAQUEINTERNOSIM = "";
$syscDESTAQUEINTERNONAO = "checked='checked'";
$syscORDEMINTERNO = "0";

$syscESTADONOVO = "";
$syscESTADOUSADO = "";
$syscESTADOREMANUFATURADO = "";

$syscSIMILARSIM = "";
$syscSIMILARNAO = "checked='checked'";

$syscMOSTRARPRECOSIM = "checked='checked'";
$syscMOSTRARPRECONAO = "";

$syscLOJAVIRTUALSIM = "checked='checked'";
$syscLOJAVIRTUALNAO = "";

$syscCONTEUDOML = "";
$syscCONTEUDOKG = "";

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : "";

$vformID_PRODUTO = isset($_POST["formID_PRODUTO"]) ? $_POST["formID_PRODUTO"] : NULL;

$vformNOME = "";
$vformSUBTITULO = "";
$vformCATEGORIAS = "";
$vformCATEGORIA = "";
$vformCOD_LOCAL = "";
$vformCOD_BARRA = "";
$vformREFERENCIA = "";
$vformUNIDADE = "";
$vformCONTEUDO = 0;
$vformCONTEUDO_TIPO = 0;
$vformPRECO_ATUAL = 0;
$vformPRECO_OFERTA = 0;
$vformPRECO_PARCELAS = 0;
$vformPRECO_PARCELADO = 0;
$vformPRECO_DESCRICAO = "";
$vformPRECO_CONDICAO = "à vista";
$vformVLR_CUSTO = 0;
$vformPERCENTUAL = 0;
$vformVLR_VENDA = 0;
$vformDESCONTO_MAX = 0;
$vformEST_ATUAL = 0;
$vformEST_MINIMO = 0;
$vformCOMISSAO = 0;
$vformGRUPOANTERIOR = "";
$vformFABRICANTE = "";
$vformLINHA = "";
$vformTAGS = ";";
$vformVOLTAGEM = 0;
$vformAMPERAGEM = 0;
$vformMOSTRAR_PRECO = "";
$vformLOJAVIRTUAL = "";
$vformESTADO = "";
$vformSIMILAR = "";
$vformORIGINAL = "";

$vformFORNECEDOR = "";
$vformFONE = "";

$vformDESTAQUE_EXTERNO = "N";
$vformORDEM_EXTERNO = 0;
$vformDESTAQUE_INTERNO = "N";
$vformORDEM_INTERNO = 0;

$vformVALIDADE_DIA = "";
$vformVALIDADE_MES = "";
$vformVALIDADE_ANO = "";

$vformDESCRICAO = "";
$vformAPLICACAO = "";
$vformESPECIFICACOES = "";
$vformOBSERVACOES = "";
$vformVIDEO = "";

$vformACEITA_CARTAO = "S";
$vformCARTOES = "";

$vformCORES = "";
$vformCORES_OPCOES = "|";

$vformCATEGORIA = "";

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


$queryCategorias = $vConexao->query("SELECT * FROM sysc_produtoscategorias ORDER BY nome") or die ("Falha ao tentar conexao com Categorias");
	$arrayCategorias = Array();
	$arraySubCategorias = Array();
	$arrayLinhas = Array();
	$i = 0;
	$l = 0;
	$s = 0;
	
	while ($reCategorias = mysqli_fetch_assoc($queryCategorias)) {
		if ($reCategorias['id_pai'] <= 0) {
			$arrayCategorias[$i] = Array("Id"=>$reCategorias['id'], "IdPai"=>$reCategorias['id_pai'], "Tipo"=>$reCategorias['tipo'], "Nome"=>$reCategorias['nome'], "Itens"=>$reCategorias['itens'], "Link"=>$reCategorias['link']);
			
			$i++;
			
		} else if (($reCategorias['id_pai'] > 0) AND ($reCategorias['tipo'] != "linha")) {
			$arraySubCategorias[$s] = Array("Id"=>$reCategorias['id'], "IdPai"=>$reCategorias['id_pai'], "Tipo"=>$reCategorias['tipo'], "Nome"=>$reCategorias['nome'], "Itens"=>$reCategorias['itens'], "Link"=>$reCategorias['link']);
			
			$s++;
		
		} else if ($reCategorias['tipo'] == "linha") {
			$arrayLinhas[$l] = Array("Id"=>$reCategorias['id'], "IdPai"=>$reCategorias['id_pai'], "Tipo"=>$reCategorias['tipo'], "Nome"=>$reCategorias['nome'], "Itens"=>$reCategorias['itens'], "Link"=>$reCategorias['link']);
			
			$l++;
		
		}
	}
mysqli_free_result($queryCategorias);

if ($vgetAcao == "alterar") {
	
	$vTituloSecao = "ALTERA&Ccedil;&Atilde;O DE DADOS EM PRODUTOS";
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_produtos.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE PRODUTOS</a> ';
  
	$dbSQL = "SELECT * FROM sysc_produtos WHERE id=" . $vgetID_PRODUTO;

	$queryProdutos = $vConexao->query($dbSQL) or die (mysql_error());

		$reProdutos = mysqli_fetch_array($queryProdutos);
		
		$vformESTADO = $reProdutos['estado'];
		$vformSIMILAR = $reProdutos['similar'];
		$vformORIGINAL = $reProdutos['original'];

		$vformDESTAQUE_EXTERNO = $reProdutos['destaque_externo'];
		$vformORDEM_EXTERNO = $reProdutos['ordem_externo'];
		$vformDESTAQUE_INTERNO = $reProdutos['destaque_interno'];
		$vformORDEM_INTERNO = $reProdutos['ordem_interno'];
		
		$vformMOSTRAR_PRECO = $reProdutos['mostrar_preco'];
		$vformLOJAVIRTUAL = $reProdutos['lojavirtual'];
		
		$vformNOME = $reProdutos['nome'];
		$vformSUBTITULO = $reProdutos['subtitulo'];
		$vformFORNECEDOR = $reProdutos['fornecedor'];
		$vformFONE = $reProdutos['fone'];
		$vformFABRICANTE = $reProdutos['fabricante'];
		$vformID_LINHA = $reProdutos['id_linha'];
		$vformLINHA = $reProdutos['linha'];
		$vformVALIDADE_DIA = date('d', strtotime($reProdutos['validade']));
		$vformVALIDADE_MES = date('m', strtotime($reProdutos['validade']));
		$vformVALIDADE_ANO = date('Y', strtotime($reProdutos['validade']));
		$vformCOD_BARRA = $reProdutos['cod_barra'];
		$vformREFERENCIA = $reProdutos['referencia'];
		$vformCOD_LOCAL = $reProdutos['cod_local'];
		$vformUNIDADE = $reProdutos['unidade'];
		$vformCONTEUDO = $reProdutos['conteudo'];
		$vformCONTEUDO_TIPO = $reProdutos['conteudo_tipo'];
		$vformVLR_CUSTO = number_format($reProdutos['vlr_custo'], 2, ",", ".");
		$vformPERCENTUAL = $reProdutos['percentual'];
		$vformDESCONTO_MAX = $reProdutos['desconto_max'];
		$vformEST_ATUAL = $reProdutos['est_atual'];
		$vformEST_MINIMO = $reProdutos['est_minimo'];
		$vformCOMISSAO = $reProdutos['comissao'];
		$vformCATEGORIAS = $reProdutos['id_categoria'];
		$vformFABRICANTE = $reProdutos['fabricante'];
		$vformPRECO_ATUAL = number_format($reProdutos['preco_atual'], 2, ",", ".");
		$vformPRECO_OFERTA = number_format($reProdutos['preco_oferta'], 2, ",", ".");
		$vformPRECO_CONDICAO = $reProdutos['preco_condicao'];
		$vformPRECO_PARCELAS = $reProdutos['preco_parcelas'];
		$vformPRECO_PARCELADO = number_format($reProdutos['preco_parcelado'], 2, ",", ".");
		$vformPRECO_DESCRICAO = $reProdutos['preco_descricao'];
		$vformTAGS = $reProdutos['tags'];
		$vformVOLTAGEM = $reProdutos['voltagem'];
		$vformAMPERAGEM = $reProdutos['amperagem'];

		$vformDESCRICAO = $reProdutos['descricao'];
		$vformAPLICACAO = $reProdutos['aplicacao'];
		$vformESPECIFICACOES = $reProdutos['especificacoes'];
		$vformOBSERVACOES = $reProdutos['observacao'];
		$vformVIDEO = $reProdutos['video'];
		
		$vformCORES = $reProdutos['cores'];
		$vformCORES_OPCOES = $reProdutos['cores_opcoes'];
		
	mysqli_free_result($queryProdutos);
}


if ($vformESTADO == "REMANUFATURADO") {
	$syscESTADONOVO = "";
	$syscESTADOUSADO = "";
	$syscESTADOREMANUFATURADO = "checked='checked'";
	
} elseIf ($vformESTADO == "USADO") {
	$syscESTADONOVO = "";
	$syscESTADOUSADO = "checked='checked'";
	$syscESTADOREMANUFATURADO = "";
	
} else {
	$syscESTADONOVO = "checked='checked'";
	$syscESTADOUSADO = "";
	$syscESTADOREMANUFATURADO = "";
	
}

if ($vformSIMILAR == "S") {
	$syscSIMILARSIM = "checked='checked'";
	$syscSIMILARNAO = "";
	
} else {
	$syscSIMILARSIM = "";
	$syscSIMILARNAO = "checked='checked'";

}

if ($vformMOSTRAR_PRECO == "S") {
	$syscMOSTRARPRECOSIM = "checked='checked'";
	$syscMOSTRARPRECONAO = "";
	
} else {
	$syscMOSTRARPRECOSIM = "";
	$syscMOSTRARPRECONAO = "checked='checked'";

}

if ($vformLOJAVIRTUAL == "S") {
	$syscLOJAVIRTUALSIM = "checked='checked'";
	$syscLOJAVIRTUALNAO = "";
	
} else {
	$syscLOJAVIRTUALSIM = "";
	$syscLOJAVIRTUALNAO = "checked='checked'";

}

if ($vformDESTAQUE_EXTERNO == "S") {
	$syscDESTAQUEEXTERNOSIM = "checked='checked'";
	$syscDESTAQUEEXTERNONAO = "";
	
} else {
	$syscDESTAQUEEXTERNOSIM = "";
	$syscDESTAQUEEXTERNONAO = "checked='checked'";

}

if ($vformDESTAQUE_INTERNO == "S") {
	$syscDESTAQUEINTERNOSIM = "checked='checked'";
	$syscDESTAQUEINTERNONAO = "";
	
} else {
	$syscDESTAQUEINTERNOSIM = "";
	$syscDESTAQUEINTERNONAO = "checked='checked'";

}

if ($vformCONTEUDO_TIPO == "ML") {
	$syscCONTEUDOML = "checked='checked'";
	$syscCONTEUDOKG = "";
	
} else {
	$syscCONTEUDOML = "";
	$syscCONTEUDOKG = "checked='checked'";

}

if ($vformCORES == "S") {
	$syscCORES_SIM = "checked='checked'";
	$syscCORES_NAO = "";
	$vBlockCores = "block";
	
} else {
	$syscCORES_SIM = "";
	$syscCORES_NAO = "checked='checked'";
	$vBlockCores = "none";

}

$arrayCores = explode("|", $vformCORES_OPCOES);

if ($vgetAcao == "") {
	$vformACAO = "novo";
	
} else {
	$vformACAO = $vgetAcao;
	
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
			
		<script language="Javascript" src="./documentos/js/funcoes.js" type="text/javascript"></script>

		<style type="text/css">
		<!--
		html {height:100%; overflow-y: auto;}

		.table {height:100%;}
		
		td {font-weight: bold; color: #333333; padding: 2px}
		
		a.opcPadrao:link    {color: #999999; text-decoration: none;}
		a.opcPadrao:visited {color: #999999; text-decoration: none}
		a.opcPadrao:hover   {color: #ff0000; text-decoration: none}
		
		a.opcAtivo:link    {color: #057da5; text-decoration: none;}
		a.opcAtivo:visited {color: #057da5; text-decoration: none}
		a.opcAtivo:hover   {color: #ff0000; text-decoration: none}
				
		.form-edit-grupos {
			height: 150px;
			overflow-y: auto;
			width: 400px;
			clear: both;
			font-size: medium;
			border: 1px solid #CCC;
			padding: 5px;
			border-radius:4px;
			color: #1464ad;
		}
		
		.form-edit-subgrupos {
			display: block;
			height: 150px;
			overflow-y: auto;
			width: 400px;
			clear: both;
			font-size: medium;
			border: 1px solid #CCC;
			padding: 5px;
			border-radius:4px;
			color: #1464ad;
		}
		
		td.tt {
			height: 35px;
			width: 220px;
			text-align: right;
			vertical-align: middle;
		}
		
		div#opcoes-cores {
			display: <?php echo $vBlockCores ?>;
			
		}
		-->
		</style>

	</head>

	<body>
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-quero-apostas">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno . ' / ' . $vTituloSecao ?></div><br /><br />
							
							<div class="Titulo-Interno"><a id="Inicio"></a><?php echo $vTituloSecao ?></div><br /><br /><br />
							
							
							<div id="area-cadastro">   

								<form action="salvar_produtos.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmCadProdutos" onSubmit="return fValidaCampos()">
									<input name="formACAO" type="hidden" value="<?php echo $vformACAO ?>" />
									<input name="formID_PRODUTO" type="hidden" value="<?php echo $vgetID_PRODUTO ?>" />
									
									<table width="100%" cellspacing="0" cellpadding="0" border="0" class="letras_">
										<tr> 
											<td align="right" class="tt">Nome do Produto:</td>
											<td><textarea name="formNOME" rows="2" class="form-edit"><?php echo $vformNOME ?></textarea></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Subt&iacute;tulo do Produto:</td>
											<td><textarea name="formSUBTITULO" rows="2" class="form-edit"><?php echo $vformSUBTITULO ?></textarea></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Estado de Conserva&ccedil;&atilde;o:</div>
											<td>
												<input type="radio" name="formESTADO" value="NOVO" <?php echo $syscESTADONOVO ?> /> <span style="font-weight: normal">NOVO</span>&nbsp;&nbsp;
												<input type="radio" name="formESTADO" value="USADO" <?php echo $syscESTADOUSADO ?> /> <span style="font-weight: normal">USADO</span>&nbsp;&nbsp;
												<input type="radio" name="formESTADO" value="REMANUFATURADO" <?php echo $syscESTADOREMANUFATURADO ?> /> <span style="font-weight: normal">REFORMADO</span>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Tipo:</td>
											<td>
												<input type="radio" name="formSIMILAR" value="N" <?php echo $syscSIMILARNAO ?> /> <span style="font-weight: normal">Original</span>
												<input type="radio" name="formSIMILAR" value="S" <?php echo $syscSIMILARSIM ?> /> <span style="font-weight: normal">Similar</span>&nbsp;&nbsp;
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Destaque na Home?</td>
											<td valign="middle">
												<div style="float: left">
													<input type="radio" name="formDESTAQUE_EXTERNO" value="S" <?php echo $syscDESTAQUEEXTERNOSIM ?> /> <span style="font-weight: normal">SIM</span>&nbsp;&nbsp;
													<input type="radio" name="formDESTAQUE_EXTERNO" value="N" <?php echo $syscDESTAQUEEXTERNONAO ?> /> <span style="font-weight: normal">N&Atilde;O</span>
												</div>
												<div style="float: left">&nbsp;&nbsp;&nbsp;Ordem:&nbsp;&nbsp;</div>
												<div style="float: left"><input type="text" name="formORDEM_EXTERNO" size="2" maxlength="2" value="<?php echo $vformORDEM_EXTERNO ?>" class="form-editSmall" /></div>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Destaque Interno?</td>
											<td valign="middle">
												<div style="float: left">
													<input type="radio" name="formDESTAQUE_INTERNO" value="S" <?php echo $syscDESTAQUEINTERNOSIM ?> /> <span style="font-weight: normal">SIM</span>&nbsp;&nbsp;
													<input type="radio" name="formDESTAQUE_INTERNO" value="N" <?php echo $syscDESTAQUEINTERNONAO ?> /> <span style="font-weight: normal">N&Atilde;O</span>&nbsp;&nbsp;
												</div>
												<div style="float: left">&nbsp;&nbsp;&nbsp;Ordem:&nbsp;&nbsp;</div>
												<div style="float: left"><input type="text" name="formORDEM_INTERNO" size="2" maxlength="2" value="<?php echo $vformORDEM_INTERNO ?>" class="form-editSmall" /></div>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Fornecedor:</td>
											<td>
												<select name="formFORNECEDOR" class="form-edit">
													<?php
													if (($vformACAO == "alterar") && (trim($vformFORNECEDOR) != "")) {
														echo '<option value=' . strtoupper($vformFORNECEDOR) . '">' . $vformFORNECEDOR . '</option>';
														
													} else {
														echo '<option value="">Selecione...</option>';
														
													}
													
													echo '<option value=""></option>';

													$dbSQL = "SELECT * FROM sysc_fornecedores WHERE tipo='fornecedor' ORDER BY nome";

													$dbQUERY = $vConexao->query($dbSQL) or die (mysql_error());

													while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
														$resFORNECEDOR = $dbRE['nome'];
														$resFORNECEDOR = str_replace(";", "", $resFORNECEDOR);
														$resFORNECEDOR = str_replace("[", "", $resFORNECEDOR);
														$resFORNECEDOR = str_replace("[", "", $resFORNECEDOR);
														
														if (strpos("AA" . $vformFORNECEDOR, substr(trim(strtoupper($resFORNECEDOR)), 0, 70)) > 0) {
															echo '<option value="' . substr(trim(strtoupper($resFORNECEDOR)), 0, 70) . '[' . $dbRE['id'] . '];' . $dbRE['dddfone1'] . ';' . $dbRE['fone1'] . '" selected="selected">' . $dbRE['nome'] . '</option>';
															
														} else {
															echo '<option value="' . substr(trim(strtoupper($resFORNECEDOR)), 0, 70) . '[' . $dbRE['id'] . '];' . $dbRE['dddfone1'] . ';' . $dbRE['fone1'] . '">' . $dbRE['nome'] . '</option>';
															
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Fabricante:</td>
											<td>
												<select name="formFABRICANTE" class="form-edit">
													<?php
													if (($vformACAO == "alterar") && (trim($vformFABRICANTE) != "")) {
														echo '<option value=' . strtoupper($vformFABRICANTE) . '">' . $vformFABRICANTE . '</option>';
														
													} else {
														echo '<option value="">Selecione...</option>';
														
													}
													
													echo '<option value=""></option>';

													$dbSQL = "SELECT * FROM sysc_fornecedores WHERE tipo='fabricante' ORDER BY nome";

													$dbQUERY = $vConexao->query($dbSQL) or die (mysql_error());

													while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
														if (strpos("AA" . $vformFABRICANTE, substr(trim(strtoupper($dbRE['nome'])), 0, 70)) > 0) {
															echo '<option value="' . substr(trim(strtoupper($dbRE['nome'])), 0, 70) . '[' . $dbRE['id'] . ']" selected="selected">' . $dbRE['nome'] . '</option>';
															
														} else {
															echo '<option value="' . substr(trim(strtoupper($dbRE['nome'])), 0, 70) . '[' . $dbRE['id'] . ']">' . $dbRE['nome'] . '</option>';
															
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Linha:</td>
											<td>
												<select name="formLINHA" class="form-editMetade">
													<?php
													echo '<option value="">Selecione...</option>';
													
													for ($i = 0; $i < count($arrayLinhas); $i++) {
														if (trim($arrayLinhas[$i]['Nome']) == trim($vformLINHA)) {
															echo '<option selected="selected" value="' . trim($arrayLinhas[$i]['Nome']) . '|' . $arrayLinhas[$i]['Id'] . '">' . trim($arrayLinhas[$i]['Nome']) . '</option>';
															
														} else {
															echo '<option value="' . trim($arrayLinhas[$i]['Nome']) . '|' . $arrayLinhas[$i]['Id'] . '">' . trim($arrayLinhas[$i]['Nome']) . '</option>';
															
														}
													}
													?>
												</select>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Unidade:</td>
											<td><input type="text" name="formUNIDADE" size="3" maxlength="3" value="<?php echo $vformUNIDADE ?>" class="form-editSmall" /> <i>&nbsp;&nbsp;Ex: UN, KG,...</i></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Conte&uacute;do:</td>
											<td><input type="text" name="formCONTEUDO" size="5" maxlength="5" value="<?php echo $vformCONTEUDO ?>" class="form-editSmall" />&nbsp;&nbsp;<input type="radio" name="txtConteudo_tipo" value="ML" <?php echo $syscCONTEUDOML ?> /> ML&nbsp;&nbsp;&nbsp;<input type="radio" name="txtConteudo_tipo" value="KG" <?php echo $syscCONTEUDOKG ?> /> KG</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Valor Normal:</td>
											<td><input type="text" name="formPRECO_ATUAL" size="10" maxlength="10" value="<?php echo $vformPRECO_ATUAL ?>" class="form-editMedium" onChange="fCalculaPercentual()" /> </td>
										</tr>
										<tr> 
											<td align="right" class="tt">Valor com Desconto:</td>
											<td><input type="text" name="formPRECO_OFERTA" size="10" maxlength="10" value="<?php echo $vformPRECO_OFERTA ?>" class="form-editMedium" onChange="fCalculaPercentual()" /> </td>
										</tr>
										<tr> 
											<td align="right" class="tt">Quantas Parcelas?</td>
											<td><input type="text" name="formPRECO_PARCELAS" size="3" maxlength="2" value="<?php echo $vformPRECO_PARCELAS ?>" class="form-editSmall" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Valor das Parcelas?</td>
											<td><input type="text" name="formPRECO_PARCELADO" size="20" maxlength="50" value="<?php echo $vformPRECO_PARCELADO ?>" class="form-editMedium" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Descri&ccedil;&atilde;o da Condi&ccedil;&atilde;o &agrave; prazo:</td>
											<td><textarea name="formPRECO_DESCRICAO" rows="2" class="form-edit"><?php echo $vformPRECO_DESCRICAO ?></textarea></td>
										</tr> 
										<tr> 
											<td align="right" class="tt">Grupo Principal:</td>
											<td>
												<div class="form-edit-grupos">
													<?php
													$arrayCategoriasOn = Array();
													$c = 0;
													
													for ($i = 0; $i < count($arrayCategorias); $i++) {
														$vIdCategoria = $arrayCategorias[$i]['Id'];
														
														if (strpos("_".$vformCATEGORIAS, '['.$vIdCategoria.']') > 0) {
															echo '<div><input checked="checked" onClick="fSubGrupos(' . fId("c", $vgetIDUSUARIO) . ',' . count($arrayCategorias) . ',\''. $vformCATEGORIAS . '\')" id="fCategoria' . ($i+1) .'" type="checkbox" name="formCATEGORIAS' . ($i+1) .'" value="' . $vIdCategoria . '"/> ' . trim($arrayCategorias[$i]['Nome']) . '</div>';
															
															$arrayCategoriasOn[$c] = Array("Id"=>trim($arrayCategorias[$i]['Id']), "Nome"=>$arrayCategorias[$i]['Nome']);
															
															$c++;
															
														} else {
															echo '<div><input type="checkbox" onClick="fSubGrupos(' . fId("c", $vgetIDUSUARIO) . ',' . count($arrayCategorias) . ',\''. $vformCATEGORIAS . '\')" id="fCategoria' . ($i+1) .'" name="formCATEGORIAS' . ($i+1) .'" value="' . $vIdCategoria . '"/> ' . trim($arrayCategorias[$i]['Nome']) . '</div>';
														
														}
													}
													
													echo '<input type="hidden" name="formCAT_TOTAL" value="' . ($i+1) . '" />';
													?>
												</div>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Sub-Grupo:</td>
											<td>
												<div id="AreaSubGrupo" class="form-edit-subgrupos">
												<?php
												if ($vgetAcao == "alterar") {
													$vSubTotal = 0;
													
													for ($i = 0; $i < count($arrayCategoriasOn); $i++) {
														$vIdCategoria = $arrayCategoriasOn[$i]['Id'];

														if (strpos("_".$vformCATEGORIAS, '['.$vIdCategoria.']') > 0) {
															
															echo '<div style="font-family: arial; font-weight: bold; color: #666666; border-bottom: #999999 2px solid; display: table;margin-top: 10px; margin-bottom: 5px; padding-right: 10px">' . $arrayCategoriasOn[$i]['Nome'] . '</div>';
															
															for ($y = 0; $y < count($arraySubCategorias); $y++) {
																
																if ($arraySubCategorias[$y]['IdPai'] ==  $arrayCategoriasOn[$i]['Id']) {
																	$vIdCategoria = $arraySubCategorias[$y]['Id'];
																	
																	if (strpos("_".$vformCATEGORIAS, '['.$vIdCategoria.']') > 0) {
																		echo '<div><input checked="checked" id="fSubCategoria' . ($y+1) .'" type="checkbox" name="formSUBCATEGORIAS' . ($y+1) .'" value="' . $vIdCategoria . '"/> ' . trim($arraySubCategorias[$y]['Nome']) . '</div>';
																	
																	} else {
																		echo '<div><input type="checkbox" id="fSubCategoria' . ($y+1) .'" name="formSUBCATEGORIAS' . ($y+1) .'" value="' . $vIdCategoria . '"/> ' . trim($arraySubCategorias[$y]['Nome']) . '</div>';
																	
																	}
																}
															}
														}
													}
													
													echo '<input type="hidden" name="formSUB_TOTAL" value="' . ($y+1) . '" />';
													
												} else {
													echo '<input type="hidden" name="formSUB_TOTAL" value="0" />';
													
												}
												?>
												</div>
											</td>
										</tr>
									</table>

									<br /><br /><div style="font-size: 20px">Dados Complementares <em>(opcional)</em>:</div><br /><br />
									
									<table width="100%" cellspacing="0" cellpadding="0" border="0">
										<tr> 
											<td align="right" class="tt">Dispon&iacute;vel na Loja Virtual?</td>
											<td> 
												<input type="radio" name="formLOJAVIRTUAL" value="S" <?php echo $syscLOJAVIRTUALSIM ?> /> <span style="font-weight: normal">SIM</span>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="formLOJAVIRTUAL" value="N" <?php echo $syscLOJAVIRTUALNAO ?> /> <span style="font-weight: normal">N&Atilde;O</span>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Mostrar Pre&ccedil;o?</td>
											<td> 
												<input type="radio" name="formMOSTRAR_PRECO" value="S" <?php echo $syscMOSTRARPRECOSIM ?> /> <span style="font-weight: normal">SIM</span>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="formMOSTRAR_PRECO" value="N" <?php echo $syscMOSTRARPRECONAO ?> /> <span style="font-weight: normal">N&Atilde;O</span>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Data de Validade:</td>
											<td> 
												<table cellspacing="0" cellpadding="0" border="0">
													<tr>
														<td><input type="text" name="formVALIDADE_DIA" size="2" maxlength="2" value="<?php echo $vformVALIDADE_DIA ?>" class="form-edit-data" /></td>
														<td>/</td>
														<td><input type="text" name="formVALIDADE_MES" size="2" maxlength="2" value="<?php echo $vformVALIDADE_MES ?>" class="form-edit-data" /></td>
														<td>/</td>
														<td><input type="text" name="formVALIDADE_ANO" size="4" maxlength="4" value="<?php echo $vformVALIDADE_ANO ?>" class="form-edit-dataano" /></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr> 
											<td align="right" class="tt">C&oacute;digo de Barra:</td>
											<td><input type="text" name="formCOD_BARRA" size="20" maxlength="50" value="<?php echo $vformCOD_BARRA ?>" class="form-editMetade" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">C&oacute;digo de Refer&ecirc;ncia:</td>
											<td><input type="text" name="formREFERENCIA" size="20" maxlength="50" value="<?php echo $vformREFERENCIA ?>" class="form-editMetade" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">C&oacute;digo da Prateleira:</td>
											<td><input type="text" name="formCOD_LOCAL" size="20" maxlength="50" value="<?php echo $vformCOD_LOCAL ?>" class="form-editMetade" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Voltagem:</td>
											<td><input type="text" name="formVOLTAGEM" size="3" maxlength="3" value="<?php echo $vformVOLTAGEM ?>" class="form-editMedium" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Amperagem:</td>
											<td><input type="text" name="formAMPERAGEM" size="3" maxlength="3" value="<?php echo $vformAMPERAGEM ?>" class="form-editMedium" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Valor de Custo:</td>
											<td><input type="text" name="formVLR_CUSTO" size="10" maxlength="10" value="<?php echo $vformVLR_CUSTO ?>" class="form-editMedium" onChange="return fVerificaValor()" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Percentual:</td>
											<td><input type="text" name="formPERCENTUAL" size="10" maxlength="10" value="<?php echo $vformPERCENTUAL ?>" class="form-editMedium" onChange="fCalculaVenda()" />&nbsp;%</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Desconto M&aacute;ximo:</td>
											<td><input type="text" name="formDESCONTO_MAX" size="5" maxlength="5" value="<?php echo $vformDESCONTO_MAX ?>" class="form-editMedium" />&nbsp;%</td>
										</tr>
										<tr> 
											<td align="right" class="tt">Estoque Atual:</td>
											<td><input type="text" name="formEST_ATUAL" size="5" maxlength="5" value="<?php echo $vformEST_ATUAL ?>" class="form-editMedium" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Estoque M&iacute;nimo:</td>
											<td><input type="text" name="formEST_MINIMO" size="5" maxlength="5" value="<?php echo $vformEST_MINIMO ?>" class="form-editMedium" /></td>
										</tr>
										<tr> 
											<td align="right" class="tt">Comiss&atilde;o:</td>
											<td><input type="text" name="formCOMISSAO" size="5" maxlength="5" value="<?php echo $vformCOMISSAO ?>" class="form-editMedium" />&nbsp;%</td>
										</tr>
										<tr> 
											<td align="right" class="tt"><br />Tags:</td>
											<td><textarea name="formTAGS" rows="3" class="form-edit"><?php echo $vformTAGS ?></textarea></td>
										</tr>
										<tr> 
											<td align="right" class="tt" valign="top">Op&ccedil;&otilde;es de Cores:</td>
											<td>
												<input type="radio" name="formCORES" value="S" <?php echo $syscCORES_SIM ?> onClick="fOpcoesDeCores(1)" /> <span style="font-weight: normal">SIM</span>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="formCORES" value="N" <?php echo $syscCORES_NAO ?> onClick="fOpcoesDeCores(2)" /> <span style="font-weight: normal">N&Atilde;O</span>
												
												<div id="opcoes-cores">
													<?php
													$x = 0;
													
													for ($i = 0; $i < count($arrayCores); $i++) {
														if (strpos("_".$arrayCores[$i], "#") > 0) {
															echo '<input type="color" name="formCOR' . $x . '" value="' . $arrayCores[$i] . '"  style="width: 20px; height: 25px; border: none; background: #fcfcfc" />';
															
															$x++;
														}
														
													}
													
													for ($i = $x; $i <= 9; $i++) {
														echo '<input type="color" name="formCOR' . $x . '" value="#fcfcfc"  style="width: 20px; height: 25px; border: none; background: #fcfcfc" />';
														
														$x++;
													}
													?>
												</div>
											</td>
										</tr>
									</table><br/><br/>
													
									<table border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td colspan="5" style="border-bottom: #dddddd 3px solid; padding: 0px">
												<table border="0" cellspacing="0" cellpadding="0" style="margin: 0px">
													<tr>
														<td class="tdOff" id="tdOn0"><a href="javascript: fGuiasEditar(0)"><div>Descri&ccedil;&atilde;o</div></a></td>
														<td class="tdOff" id="tdOn1"><a href="javascript: fGuiasEditar(1)"><div>Aplica&ccedil;&atilde;o</div></a></td>
														<td class="tdOff" id="tdOn2"><a href="javascript: fGuiasEditar(2)"><div>Especifica&ccedil;&otilde;es</div></a></td>
														<td class="tdOff" id="tdOn3"><a href="javascript: fGuiasEditar(3)"><div>V&iacute;deo</div></a></td>
														<td class="tdOff" id="tdOn4"><a href="javascript: fGuiasEditar(4)"><div>Observa&ccedil;&otilde;es</div></a></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>
												<div id="divDescricao">
													<?php
													// Include the CKEditor class.
													include_once "fckeditor/fckeditor.php";

													// Create a class instance.
													$oFCKeditor = new FCKeditor('formDESCRICAO');

														// Path to the CKEditor directory.
														$oFCKeditor->BasePath = 'fckeditor/';

														// Set global configuration (used by every instance of CKEditor).
														$oFCKeditor->Width = 700;
														$oFCKeditor->Height = 400;
														//$oFCKeditor->ToolbarSet = 'Basic';

														// Create the first instance.
														$oFCKeditor->Value		= $vformDESCRICAO;
														$oFCKeditor->Create() ;
														

													?>														
												</div>
											</td>
											<td>
												<div id="divAplicacao">
													<?php
													// Create a class instance.
													$oFCKeditor = new FCKeditor('formAPLICACAO');

														// Path to the CKEditor directory.
														$oFCKeditor->BasePath = 'fckeditor/';

														// Set global configuration (used by every instance of CKEditor).
														$oFCKeditor->Width = 700;
														$oFCKeditor->Height = 400;

														// Create the first instance.
														$oFCKeditor->Value		= $vformAPLICACAO;
														$oFCKeditor->Create() ;
														
									
													?>														
												</div>
											</td>
											<td>
												<div id="divEspecificacao">
													<?php
													// Create a class instance.
													$oFCKeditor = new FCKeditor('formESPECIFICACOES');

														// Path to the CKEditor directory.
														$oFCKeditor->BasePath = 'fckeditor/';

														// Set global configuration (used by every instance of CKEditor).
														$oFCKeditor->Width = 700;
														$oFCKeditor->Height = 400;

														// Create the first instance.
														$oFCKeditor->Value		= $vformESPECIFICACOES;
														$oFCKeditor->Create() ;
														
												
													?>														
												</div>
											</td>
											<td>
												<div id="divVideo">
													<?php
													// Create a class instance.
													$oFCKeditor = new FCKeditor('formVIDEO');

														// Path to the CKEditor directory.
														$oFCKeditor->BasePath = 'fckeditor/';

														// Set global configuration (used by every instance of CKEditor).
														$oFCKeditor->Width = 700;
														$oFCKeditor->Height = 400;

														// Create the first instance.
														$oFCKeditor->Value		= $vformVIDEO;
														$oFCKeditor->Create() ;
													?>
												</div>
											</td>
											<td>
												<div id="divObservacao">
													<?php
													// Create a class instance.
													$oFCKeditor = new FCKeditor('formOBSERVACOES');

														// Path to the CKEditor directory.
														$oFCKeditor->BasePath = 'fckeditor/';

														// Set global configuration (used by every instance of CKEditor).
														$oFCKeditor->Width = 700;
														$oFCKeditor->Height = 400;

														// Create the first instance.
														$oFCKeditor->Value		= $vformOBSERVACOES;
														$oFCKeditor->Create() ;
													?>
												</div>
											</td>
										</tr>
									</table>
									
									<div class="clear"><br /></div>
										
									<div id="area-aviso"></div>
										
									<div class="clear"><br /></div>
		
									<div>
										<br/><br/>
										<input type="submit" name="enviar" value="    Salvar    " class="formSUBMIT" onClick="fSalvarOk()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="reset" name="limpar" value="    Limpar    " class="formSUBMIT" />
									</div>
									
								</form>						
								
								<iframe src="vazio.php" name="SalvarForm" scrolling="yes" frameborder="0" width="1" height="1"></iframe>

							</div>

							<div id="boxDIALOGO"></div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</body>
</html>