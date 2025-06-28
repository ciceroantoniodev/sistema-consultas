<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";


//------------------> INÍCIO DA INCLUSÃO NO BANCO

$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;

$vSalvar = "N";
$vError = 10;
$vMensagem = "";

$vformUSUARIO = isset($_POST["formUSUARIO"]) ? $_POST["formUSUARIO"] : NULL;
$vformSENHAX = isset($_POST["formSENHAX"]) ? $_POST["formSENHAX"] : NULL;
$vformSENHA = isset($_POST["formSENHA"]) ? $_POST["formSENHA"] : NULL;

$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;

$vformDIA_NASCIMENTO = isset($_POST["formDIA_NASCIMENTO"]) ? $_POST["formDIA_NASCIMENTO"] : NULL;
$vformMES_NASCIMENTO = isset($_POST["formMES_NASCIMENTO"]) ? $_POST["formMES_NASCIMENTO"] : NULL;
$vformANO_NASCIMENTO = isset($_POST["formANO_NASCIMENTO"]) ? $_POST["formANO_NASCIMENTO"] : NULL;

$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
$vformENDERECO_NUM = isset($_POST["formENDERECO_NUM"]) ? $_POST["formENDERECO_NUM"] : NULL;
$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
$vformIDCIDADE = isset($_POST["formIDCIDADE"]) ? $_POST["formIDCIDADE"] : NULL;
$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
$vformESTADO = isset($_POST["formUF"]) ? $_POST["formUF"] : NULL;
$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
$vformDDDFONE = isset($_POST["formDDDFONE"]) ? $_POST["formDDDFONE"] : NULL;
$vformFONE = isset($_POST["formFONE"]) ? $_POST["formFONE"] : NULL;
$vformDDDCELULAR = isset($_POST["formDDDCELULAR"]) ? $_POST["formDDDCELULAR"] : NULL;
$vformCELULAR = isset($_POST["formCELULAR"]) ? $_POST["formCELULAR"] : NULL;
$vformEMAIL = isset($_POST["formEMAIL"]) ? $_POST["formEMAIL"] : NULL;

$vformTIPO = isset($_POST["formTIPO"]) ? $_POST["formTIPO"] : NULL;
$vformCATEGORIA = isset($_POST["formCATEGORIA"]) ? $_POST["formCATEGORIA"] : NULL;
$vformSUBCATEGORIA = isset($_POST["formSUBCATEGORIA"]) ? $_POST["formSUBCATEGORIA"] : NULL;

$vformCODCAPTCHA = isset($_POST["formCODCAPTCHA"]) ? $_POST["formCODCAPTCHA"] : NULL;
$vformCAPTCHA = isset($_POST["formCAPTCHA"]) ? $_POST["formCAPTCHA"] : NULL;

$vDATA = date("Y-m-d H:i:s");

$vAcao = 1;

// Cria Código Único
$vCODUNC = "";

$vID_Usuario = 0;

$arrayCODUNC = explode("#", str_replace(" ", "#", trim($vformNOME)));

for ($i = 0; $i < count($arrayCODUNC); $i++) {
	$vCODUNC .= fTrocarAcentos(substr($arrayCODUNC[$i], strlen($arrayCODUNC[$i])-2, 2));

}

$vCODUNC = substr(strtolower($vCODUNC) . "abcdefg", 0, 7) . date("YmdHis");


// ***********************************************************
// *
// *
// * Inicia validação do CADASTRO
// *
// *
// ***********************************************************


if ($vformCATEGORIA == "") {
	$vError = 20;
	$vMensagem = "O campo [font color='#045FB4'}CATEGORIA[/font} em [font color='#045FB4'}Segmenta&ccedil;&atilde;o[/font} estar vazio.";
		
} else {
	if ($vformSUBCATEGORIA == "") {
		$vError = 20;
		$vMensagem = "O campo [font color='#045FB4'}SUB-CATEGORIA[/font} em [font color='#045FB4'}Segmenta&ccedil;&atilde;o[/font} estar vazio.";

	} else {
		if (
			(trim(" ".$vformNOME) == "") || 
			(trim(" ".$vformDIA_NASCIMENTO) == "") || 
			(trim(" ".$vformMES_NASCIMENTO) == "") || 
			(trim(" ".$vformANO_NASCIMENTO) == "") || 
			(trim(" ".$vformENDERECO) == "") || 
			(trim(" ".$vformENDERECO_NUM) == "") || 
			(trim(" ".$vformBAIRRO) == "") || 
			(trim(" ".$vformIDCIDADE) == "") || 
			(trim(" ".$vformCIDADE) == "") || 
			(trim(" ".$vformESTADO) == "") || 
			(trim(" ".$vformCEP) == "") || 
			(trim(" ".$vformEMAIL) == "")) {
			$vError = 20;
			$vMensagem = "Todos os campos devem estar preenchidos.";
			
		} else {
			if ((trim(" ".$vformDDDFONE) == "") || (trim(" ".$vformFONE) == "")) {
				if ((trim(" ".$vformDDDCELULAR) == "") || (trim(" ".$vformCELULAR) == "")) {
					$vError = 20;
					$vMensagem = "Todos os campos devem estar preenchidos.";
				
				} else {
					$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE usuario='" . $vformUSUARIO . "'") or die("Falha na execução da consulta.");							
						$vRE = mysqli_fetch_array($vQUERY);
							
						if ($vRE != "") {
							$vError = 20;
							$vMensagem = "Ja existe um registro com este [strong}[font color='#045FB4'}Nome de Usu&aacute;rio[/font}[/strong}.[br /}Escolha outro Nome e tente Enviar novamente.";
					
						} else {
							if (trim($vformSENHA) != trim($vformSENHAX)) {
								$vError = 20;
								$vMensagem = "O campo [font color='#045FB4'}SENHA[/font} e [font color='#045FB4'}CONFIRME A SENHA[/font} n&atilde;o est&atilde;o iguais.[br /}Verifique e digite novamente para Enviar.";
								
							} else {
								$vSalvar = "S";
								$vError = 10;

							}
						}
					mysqli_free_result($vQUERY);

				}

			} else {
				$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE usuario='" . $vformUSUARIO . "'") or die("Falha na execução da consulta.");							
					$vRE = mysqli_fetch_array($vQUERY);
						
					if ($vRE != "") {
						$vError = 20;
						$vMensagem = "Ja existe um registro com este [strong}[font color='#045FB4'}Nome de Usu&aacute;rio[/font}[/strong}.[br /}Escolha outro Nome e tente Enviar novamente.";
				
					} else {
						if (trim($vformSENHA) != trim($vformSENHAX)) {
							$vError = 20;
							$vMensagem = "O campo [font color='#045FB4'}SENHA[/font} e [font color='#045FB4'}CONFIRME A SENHA[/font} n&atilde;o est&atilde;o iguais.[br /}Verifique e digite novamente para Enviar.";
							
						} else {
							$vSalvar = "S";
							$vError = 10;

						}
					}
				mysqli_free_result($vQUERY);

			}
		}

	}

}


// ***********************************************************
// *
// *
// * Inicia gravação na tabela CADASTRO GERAL
// *
// *
// ***********************************************************


if ($vSalvar == "S") {
	$dbCAMPOS = "id_franquia, id_cidade, id_bairro, id_categoria, id_usuario, cod_unico, razao, fantasia, palavras_chave, dt_nasc, endereco, endereco_num, bairro, cidade, estado, cep, dddfone1, fone1, dddcelular1, celular1, email_proprio, anuncio, tipo, ativo, fotos, ofertas, produtos, pontos, mostrar_fone, mostrar_email, mostrar_site, data_expira, data_cad";

	if ($vformTIPO == "servicos") {
		$vTipoAnuncio = "[2]servicos";
		
	} else {
		$vTipoAnuncio = "[1]comercio";
		
	}

	// Aqui o sistema pega a ID da franquia
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . (int)$vgetIDUSUARIO) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vID_Franquia = 1;
		
		if ($vRE != "") {
			$vID_Franquia = $vRE['id_franquia'];
		}
	mysqli_free_result($vQUERY);

	// Aqui o sistema pega o nome do bairro
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrobairros WHERE id=" . (int)$vformBAIRRO) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vformBAIRRONOME  = $vRE['nome'];
	mysqli_free_result($vQUERY);

	// Aqui o sistema vasculha as categorias e cria as palavras-chaves
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_categorias WHERE (id=" . $vformCATEGORIA . ") OR (id=" . $vformSUBCATEGORIA . ")") or die("Falha na execução da consulta.");
		$vPalavrasChaves = "";
		$arrayCATEGORIAS = Array();
		$i = 0;
		$vStrPos = "#";

		while ($vRE = mysqli_fetch_assoc($vQUERY)) {
			$vPalavrasChaves .= strtolower(str_replace(" ", ";", trim($vRE['nome']))) . ";";
			$arrayCATEGORIAS[$i] = Array($vRE['id'], $vRE['itens'], $vRE['nivel'], $vRE['nome']);
			
			if ($vRE['id'] == (int)$vformCATEGORIA || $vRE['id'] == (int)$vformSUBCATEGORIA) {
				$vStrPos .= trim($vRE['nome']) . " ";

			}
			
			$i++;
		}
	mysqli_free_result($vQUERY);

	$vPalavrasChaves = str_replace("-", ";", $vPalavrasChaves);
	$vPalavrasChaves = str_replace(";da;", ";", $vPalavrasChaves);
	$vPalavrasChaves = str_replace(";de;", ";", $vPalavrasChaves);
	$vPalavrasChaves = str_replace(";do;", ";", $vPalavrasChaves);
	$vPalavrasChaves = str_replace(";a;", ";", $vPalavrasChaves);
	$vPalavrasChaves = str_replace(";o;", ";", $vPalavrasChaves);
	$vPalavrasChaves = str_replace(";e;", ";", $vPalavrasChaves);
	
	$vDataExpira = date("Y-m-d", strtotime("+2 month"));
	
	// inicia cadastro
	
	$dbVALORES = "0" . $vID_Franquia;	// id_franquia
	$dbVALORES .= "," . $getIDCIDADE;	// id_cidade
	$dbVALORES .= "," . $vformBAIRRO;	// id_bairro
	$dbVALORES .= ",'[" . (int)$vformCATEGORIA . "][" . (int)$vformSUBCATEGORIA . "]'";	// id_categoria
	$dbVALORES .= ",0" . $vgetIDUSUARIO;	//cod_unico
	$dbVALORES .= ",'" . $vCODUNC . "'";	//cod_unico
	$dbVALORES .= ",'" . $vformNOME . "'";	// razao
	$dbVALORES .= ",'" . $vformNOME . "'";	// fantasia
	$dbVALORES .= ",'" . $vPalavrasChaves . "'";	// palavras_chave
	$dbVALORES .= ",'" . StrZero("0" . $vformANO_NASCIMENTO, 4) . "-" . StrZero("0" . $vformMES_NASCIMENTO, 2) . "-". StrZero("0" . $vformDIA_NASCIMENTO, 2) . "'";	//dt_nasc
	$dbVALORES .= ",'" . $vformENDERECO . "'";	// endereco
	$dbVALORES .= ",'" . $vformENDERECO_NUM . "'";	// endereco_num
	$dbVALORES .= ",'" . $vformBAIRRONOME . "'";	// bairro
	$dbVALORES .= ",'" . $vformCIDADE . "'";	// cidade
	$dbVALORES .= ",'" . $vformESTADO . "'";	// estado
	$dbVALORES .= ",'" . $vformCEP . "'";	// cep
	$dbVALORES .= ",'" . $vformDDDFONE . "'";	// dddfone1
	$dbVALORES .= ",'" . $vformFONE . "'";		// fone1
	$dbVALORES .= ",'" . $vformDDDCELULAR . "'";	// dddcelular1
	$dbVALORES .= ",'" . $vformCELULAR . "'";		// celular1
	$dbVALORES .= ",'" . $vformEMAIL . "'";		// email_proprio
	$dbVALORES .= ",'gratis'";		// anuncio
	$dbVALORES .= ",'" . $vTipoAnuncio . "'";		// tipo
	$dbVALORES .= ",'S'";		// ativo
	$dbVALORES .= ",0";		// fotos
	$dbVALORES .= ",1";		// ofertas
	$dbVALORES .= ",0";		// produtos
	$dbVALORES .= ",1";		// pontos
	$dbVALORES .= ",'S'";		// pontos
	$dbVALORES .= ",'S'";		// pontos
	$dbVALORES .= ",'N'";		// pontos
	$dbVALORES .= ",'" . $vDataExpira . "'";		// data_cad
	$dbVALORES .= ",'" . $vDATA . "'";		// data_cad

	$dbSALVAR = $vConexao->query("INSERT INTO sysc_cadastrogeral (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());

	$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrogeral WHERE (cod_unico='" . $vCODUNC . "') AND (data_cad='" . $vDATA . "')") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vCodigo = $vRE['id'];
	mysqli_free_result($vQUERY);


	// ***********************************************************
	// *
	// *
	// * Inicia gravação na tabela LOGIN
	// *
	// *
	// ***********************************************************


	$dbCAMPOS = "id_franquia, id_cidade, id_bairro, id_cadastro, nivel, rotinas, tipo, anuncio, nome, sobrenome, data_nasc, endereco, endereco_num, bairro, cidade, estado, cep, dddfone, fone, dddcelular, celular, email_proprio, funcao, ativo, usuario, senha, data_cad";
	
	$vformUSUARIO = strtoupper(substr($vCODUNC, 0, 5) . trim(" " . $vCodigo . " "));
	$vformSENHA = substr(trim(" " . $vCodigo . " ") . "12345678", 0, 8);
	
	$dbVALORES = "0" . $vID_Franquia;
	$dbVALORES .= ",0" . $getIDCIDADE;
	$dbVALORES .= ",0" . $vformBAIRRO;
	$dbVALORES .= ",0" . $vCodigo;
	$dbVALORES .= ",1";
	$dbVALORES .= ",'[1][2][3][6]'";
	$dbVALORES .= ",'anunciante'";
	$dbVALORES .= ",'gratis'";
	$dbVALORES .= ",'" . $vformNOME . "'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",'" . StrZero("0" . $vformANO_NASCIMENTO, 4) . "-" . StrZero("0" . $vformMES_NASCIMENTO, 2) . "-". StrZero("0" . $vformDIA_NASCIMENTO, 2) . "'";	//dt_nasc
	$dbVALORES .= ",'" . $vformENDERECO . "'";
	$dbVALORES .= ",'" . $vformENDERECO_NUM . "'";
	$dbVALORES .= ",'" . $vformBAIRRONOME . "'";
	$dbVALORES .= ",'" . $vformCIDADE . "'";
	$dbVALORES .= ",'" . $vformESTADO . "'";
	$dbVALORES .= ",'" . $vformCEP . "'";
	$dbVALORES .= ",'" . $vformDDDFONE . "'";
	$dbVALORES .= ",'" . $vformFONE . "'";
	$dbVALORES .= ",'" . $vformDDDCELULAR . "'";
	$dbVALORES .= ",'" . $vformCELULAR . "'";
	$dbVALORES .= ",'" . strtolower($vformEMAIL) . "'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",'S'";
	$dbVALORES .= ",'" . $vformUSUARIO . "'";
	$dbVALORES .= ",'" . hash('sha512', $vformSENHA) . "'";
	$dbVALORES .= ",'" . $vDATA . "'";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_usuarios (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());

	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE (usuario='" . $vformUSUARIO . "') OR (data_cad='" . $vDATA . "')") or die("Falha na execução da consulta.");							
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vID_Usuario = $vRE['id'];

		}
	mysqli_free_result($vQUERY);


	// ***********************************************************
	// *
	// *
	// * Inicia atualização nas tabelas de CATEGORIAS
	// *
	// *
	// ***********************************************************

	
	for ($i = 0; $i < count($arrayCATEGORIAS); $i++) {
		if ((int)$arrayCATEGORIAS[$i][2] == 3) {
			$vNomeCategoria = $arrayCATEGORIAS[$i][3];
			$vIdCategoria = $arrayCATEGORIAS[$i][0];
		}
		
		$dbSALVAR = $vConexao->query("UPDATE sysc_categorias SET itens=0" . ((int)$arrayCATEGORIAS[$i][1] + 1) . " WHERE id=" . (int)(int)$arrayCATEGORIAS[$i][0]) or die(mysqli_error());
	}

	// ***********************************************************


	$vQUERY = $vConexao->query("SELECT * FROM sysc_categoriasbairros WHERE (id_categoria=" . $vIdCategoria . ") AND (id_bairro=" . $vformBAIRRO . ")") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vIdCategoriaBairro = $vRE['id'];
			$vItensCategoria = $vRE['itens'];
			
			$dbSALVAR = $vConexao->query("UPDATE sysc_categoriasbairros SET itens=0" . ($vItensCategoria + 1) . " WHERE id=" . $vIdCategoriaBairro) or die(mysqli_error());
			
		} else {
			if ($vformTIPO == "comercio") {
				$vNivelCategoria = 1;

			} else {
				$vNivelCategoria = 2;

			}

			$dbSALVAR = $vConexao->query("INSERT INTO sysc_categoriasbairros (id_categoria, id_bairro, nivel, nome, itens) VALUES (" . $vIdCategoria . "," . $vformBAIRRO . "," . $vNivelCategoria . ",'" . $vNomeCategoria . "', 1)") or die(mysqli_error());

		}

	mysqli_free_result($vQUERY);

	
	// ***********************************************************
	// *
	// *
	// * Atualiza tabela CADASTRO DE BAIRROS
	// *
	// *
	// ***********************************************************


	$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrobairros WHERE (id=" . $vformBAIRRO . ") AND (id_cidade=" . $getIDCIDADE . ")") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		if ($vRE != "") {
			$vItensBairro = $vRE['itens'];

			$dbSALVAR = $vConexao->query("UPDATE sysc_cadastrobairros SET itens=0" . ((int)$vItensBairro+1) . " WHERE (id=" . $vformBAIRRO . ") AND (id_cidade=" . $getIDCIDADE . ")") or die(mysqli_error());
		}
	mysqli_free_result($vQUERY);

	
	// ***********************************************************
	// *
	// *
	// * Inicia gravação na tabela NEWSLETTER
	// *
	// *
	// ***********************************************************


	if (fSeEmail($vformEMAIL)) {
		$vQUERY = $vConexao->query("SELECT * FROM sysc_newsletter WHERE email='" . $vformEMAIL . "'") or die("Falha na execução da consulta.");
			$vRE = mysqli_fetch_array($vQUERY);
			
			if ($vRE == "") {
				$dbVALORES = "0";
				$dbVALORES .= ",0";
				$dbVALORES .= ",'" . $vformNOME . "'";
				$dbVALORES .= ",'" . $vformEMAIL . "'";
				$dbVALORES .= ",'" . $vformCIDADE . "'";
				$dbVALORES .= ",'" . $vformESTADO . "'";
				$dbVALORES .= ",'S'";
				$dbVALORES .= ",'" . $vDATA . "'";

				$dbSALVAR = $vConexao->query("INSERT INTO sysc_newsletter (id_empresa, id_usuario, nome, email, cidade, estado, ativo, data) VALUES (" . $dbVALORES . ")") or die(mysqli_error());
			}
		mysqli_free_result($vQUERY);
	}
	

	// ***********************************************************
	// *
	// *
	// * Atualização da tabela RESUMO
	// *
	// *
	// ***********************************************************


	$vQUERY = $vConexao->query("SELECT * FROM sysc_resumo WHERE id_bairro=" . $vformBAIRRO) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$resumoCOMERCIO = 0;
		$resumoSERVICOS = 0;
		$resumoFARMACIAS = 0;
		$resumoHOSPITAIS = 0;
		$resumoIGREJAS = 0;
		$resumoPRIVADAS = 0;
		
		if ($vRE != "") {
			$resumoCOMERCIO = $vRE['comercio'];
			$resumoSERVICOS = $vRE['servicos'];
			$resumoFARMACIAS = $vRE['farmacias'];
			$resumoHOSPITAIS = $vRE['hospitais'];
			$resumoIGREJAS = $vRE['igrejas'];
			$resumoPRIVADAS = $vRE['escolas_privadas'];

			if ($vformTIPO == "comercio") {
				$resumoCOMERCIO = ((int)$resumoCOMERCIO+1);
				
			} else if ($vformTIPO == "servicos") {
				$resumoSERVICOS = ((int)$resumoSERVICOS+1);
				
			}
			
			$vStrPos = strtolower($vStrPos);
			
			if (strpos($vStrPos, "farm") > 0 && strpos($vStrPos, "cia") > 0) {
				$resumoFARMACIAS = ((int)$resumoFARMACIAS+1);

			} else if ((strpos($vStrPos, "hospital") > 0) || 
						(strpos($vStrPos, "hospitais") > 0) || 
						(strpos($vStrPos, "clínica") > 0) || 
						(strpos($vStrPos, "consultorio") > 0)) {
				$resumoHOSPITAIS = ((int)$resumoHOSPITAIS+1);

			} else if (strpos($vStrPos, "igreja") > 0) {
				$resumoIGREJAS = ((int)$resumoIGREJAS+1);

			} else if (strpos($vStrPos, "escolas") > 0) {
				$resumoPRIVADAS = ((int)$resumoPRIVADAS+1);

			}
		
			$vConexao->query("UPDATE sysc_resumo SET 
								comercio=0" . (int)$resumoCOMERCIO . ", 
								servicos=0" . (int)$resumoSERVICOS . ",
								farmacias=0" . (int)$resumoFARMACIAS . ", 
								hospitais=0" . (int)$resumoHOSPITAIS . ",
								igrejas=0" . (int)$resumoIGREJAS . ",
								escolas_privadas=0" . (int)$resumoPRIVADAS . " WHERE id_bairro=" . $vformBAIRRO) or die(mysqli_error());
		}
	mysqli_free_result($vQUERY);

	
	// ***********************************************************
	// *
	// *
	// * Inicia gravação na tabela NOTIFICAÇÕES
	// *
	// *
	// ***********************************************************


	$dbCAMPOS = "id_usuario, id_origem, id_destinatario, destino, remetente, mensagem, data, hora, tipo, aviso, lida, quem_leu, dt_lida";
	
	$dbVALORES = "0";
	$dbVALORES .= ",0";
	$dbVALORES .= ",0" . (int)$vID_Usuario;
	$dbVALORES .= ",'usuario'";
	$dbVALORES .= ",'PORTAL MEU BAIRRO TEM'";
	$dbVALORES .= ",'banner_suamarcaemevidencia.jpg'";
	$dbVALORES .= ",'" . date("Y-m-d") . "'";
	$dbVALORES .= ",'" . date("H:i:s") . "'";
	$dbVALORES .= ",'banner'";
	$dbVALORES .= ",'EVIDENCIE SUA MARCA'";
	$dbVALORES .= ",'N'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",'0000-00-00 00:00:00'";
	
	$dbVALORES1 = "0";
	$dbVALORES1 .= ",0";
	$dbVALORES1 .= ",0" . (int)$vID_Usuario;
	$dbVALORES1 .= ",'usuario'";
	$dbVALORES1 .= ",'PORTAL MEU BAIRRO TEM'";
	$dbVALORES1 .= ",'Este &eacute; seu Escrit&oacute;rio Virtual. Uma &aacute;rea restrita de onde voc&ecirc; pode interagir com o site e ter acesso a informa&ccedil;&otilde;es exclusivas. Pode fazer atualiza&ccedil;&otilde;es espec&iacute;ficas, anunciar nos Classificados e outras a&ccedil;&otilde;es exclusivas aos nossos usu&aacute;rios.'";
	$dbVALORES1 .= ",'" . date("Y-m-d") . "'";
	$dbVALORES1 .= ",'" . date("H:i:s") . "'";
	$dbVALORES1 .= ",'notificacao'";
	$dbVALORES1 .= ",'SEJA BEM-VINDO'";
	$dbVALORES1 .= ",'N'";
	$dbVALORES1 .= ",''";
	$dbVALORES1 .= ",'0000-00-00 00:00:00'";

	$dbSALVAR = $vConexao->query("INSERT INTO sysc_notificacoes (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_notificacoes (" . $dbCAMPOS . ") VALUES (" . $dbVALORES1 . ")") or die(mysqli_error());
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
	<?php
	echo '<script language="JavaScript" type="text/javascript">';
	
	if ($vError != 10) {
		echo 'parent.fBoxDialogo("' . str_replace("}", ">", str_replace("[", "<", $vMensagem)) . '");';

	} else {
		echo 'parent.document.frmAnuncio.formNOME.value = "";';
		echo 'parent.document.frmAnuncio.formDIA_NASCIMENTO.value = "";';
		echo 'parent.document.frmAnuncio.formMES_NASCIMENTO.value = "";';
		echo 'parent.document.frmAnuncio.formANO_NASCIMENTO.value = "";';
		echo 'parent.document.frmAnuncio.formENDERECO.value = "";';
		echo 'parent.document.frmAnuncio.formENDERECO_NUM.value = "";';
		echo 'parent.document.frmAnuncio.formCEP.value = "";';
		echo 'parent.document.frmAnuncio.formDDDFONE.value = "";';
		echo 'parent.document.frmAnuncio.formFONE.value = "";';
		echo 'parent.document.frmAnuncio.formDDDCELULAR.value = "";';
		echo 'parent.document.frmAnuncio.formCELULAR.value = "";';
		echo 'parent.document.frmAnuncio.formEMAIL.value = "";';
		echo 'parent.document.frmAnuncio.formCATEGORIA.value = "";';
		echo 'parent.document.frmAnuncio.formSUBCATEGORIA.value = "";';
		echo 'parent.document.getElementById("directCATEGORIAS").style.display = "none";';
		
	}
	
	echo '</script>';
	?>
</body>
</html>