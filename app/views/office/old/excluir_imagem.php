<?php
header("Content-Type: text/html; charset=UTF-8",true);

session_start();

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetCAMPO = isset($_GET["c"]) ? $_GET["c"] : NULL;
$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetId = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

if ($vgetORIGEM == "institucional") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_dadoscadastrais") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE[$vgetCAMPO];

			$vUnLink = unlink('../../images/' . $vFoto) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_dadoscadastrais SET " . $vgetCAMPO . "=''") or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
	
} else if ($vgetORIGEM == "categorias") {
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE id=" . $vgetId) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE[$vgetCAMPO];

			$vUnLink = unlink('../../docs/fotos/produtos/' . $vFoto) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_produtoscategorias SET " . $vgetCAMPO . "='' WHERE id=" . $vgetId) or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
	
} else if ($vgetORIGEM == "produtos") {
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_produtos WHERE id=" . $vgetId) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE[$vgetCAMPO];

			$vUnLink = unlink('../../docs/fotos/produtos/' . $vFoto) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_produtos SET " . $vgetCAMPO . "='' WHERE id=" . $vgetId) or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
	
} else if ($vgetORIGEM == "links") {
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_links WHERE id=" . $vgetId) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE[$vgetCAMPO];

			$vUnLink = unlink('../../docs/logos/' . $vFoto) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_links SET " . $vgetCAMPO . "='' WHERE id=" . $vgetId) or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
	
} else if ($vgetORIGEM == "galeria") {
	
	if ((int)$vgetId > 0) {
		$vQUERY = $vConexao->query("SELECT * FROM sysc_galeriasshow WHERE id=" . $vgetId) or die("Falha na execução da consulta.");
			$vRE = mysqli_fetch_array($vQUERY);

			if ($vRE != "") {
				$vFoto = $vRE[$vgetCAMPO];

				$vUnLink = unlink('../../docs/fotos/empresa/' . $vFoto) or die (mysqli_error());
				
				$vConexao->query("DELETE FROM sysc_galeriasshow WHERE id=" . $vgetId) or die (mysql_error());

			}
		mysqli_free_result($vQUERY);
		
	} else {
		$vgetArquivo = isset($_GET["arq"]) ? $_GET["arq"] : NULL;

		$vUnLink = unlink('../../docs/fotos/empresa/' . $vgetArquivo) or die (mysqli_error());
		
	}	
	
} else if ($vgetORIGEM == "banners") {
	$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
	
	$vAreaImagem = "areaIMAGEM" . (int)$vgetID;
	$vAreaLinks = "area-banner-imagem" . (int)$vgetID;
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_banners WHERE id=" . $vgetID) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE['arquivo'];

			$vUnLink = unlink('../../docs/banners/' . trim($vFoto)) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_banners SET altura=0, largura=0, arquivo='', linktipo='', link='', ativo='N', cliques=0, visualizacoes=0 WHERE id=" . $vgetID) or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
	
} else if ($vgetORIGEM == "usuarios") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetId) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE[$vgetCAMPO];

			$vUnLink = unlink('../../docs/fotos/usuarios/' . $vFoto) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_usuarios SET " . $vgetCAMPO . "='' WHERE id=" . $vgetId) or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
	
} else if ($vgetORIGEM == "fornecedores") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_fornecedores WHERE id=" . $vgetId) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$vFoto = $vRE[$vgetCAMPO];

			$vUnLink = unlink('../../docs/logos/' . $vFoto) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_fornecedores SET " . $vgetCAMPO . "='' WHERE id=" . $vgetId) or die (mysql_error());

		}
	mysqli_free_result($vQUERY);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>..:.::. CashOut Club - Cursos e Investimentos ..::.:..</title>
	
	<meta http-equiv="content-language" content="pt-br">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="CASHOUT CLUB é um projeto criado para melhorar a condição das pessoas que querem fazer do TRADING ESPORTIVO uma fonte de renda extra para suas vidas." />
	<meta name="keywords" content="cashoutclub, trade, curso, investimento, treinamento, clube, club, saque, caixa, betfar, futebol, esporte, esportivo, aposta"/>
	<meta name="robots" content="index, follow">
	<meta name="author" content="SAMSITE Web Design Sistemas">
	<meta name="reply-to" content="suporte@samsite.com.br">
</head>

<body>
	<?php
	echo '<script type="text/javascript">';
	
	if ($vgetORIGEM == "institucional") {
		echo 'top.document.getElementById("area-cadastro-foto").innerHTML = "<img src=\"images/semfoto_masculino.jpg\" border=\"0\" />";';
		echo 'top.document.getElementById("area-cadastro-fotobotao").innerHTML = "<form method=\'post\' action=\'enviar_imagem.php?o=planos&idu=' . fId("c", $vgetIDUSUARIO) . '\' target=\'direcionar\' enctype=\'multipart/form-data\'><br />Enviar Imagem<br /><br /><div style=\'display: inline\'><input type=\'file\' name=\'formIMAGEM\' onChange=\'javascript: submit()\' /></div></form>";';
		
	} else if ($vgetORIGEM == "categorias" || $vgetORIGEM == "produtos" || $vgetORIGEM == "links" || $vgetORIGEM == "fornecedores") {
		echo 'top.document.getElementById("AreaImagemImagem").innerHTML = "<img src=\"images/semfoto_masculino.jpg\" border=\"0\" />";';
		echo 'top.document.getElementById("AreaImagemBotao").innerHTML = "<form method=\'post\' action=\'enviar_imagem.php?o=planos&idu=' . fId("c", $vgetIDUSUARIO) . '&o=' . $vgetORIGEM . '&c=' . $vgetCAMPO . '&ida=' . $vgetId . '\' target=\'direcionar\' enctype=\'multipart/form-data\'><br />Enviar Imagem<br /><br /><div style=\'display: inline\'><input type=\'file\' name=\'FormFileImagem\' onChange=\'javascript: submit()\' /></div></form>";';
		
		
	} else if ($vgetORIGEM == "usuarios") {
		echo 'top.document.getElementById("AreaImagemImagem").innerHTML = "<img src=\"images/semfoto_masculino.jpg\" border=\"0\" />";';
		echo 'top.document.getElementById("AreaImagemBotao").innerHTML = "<form method=\'post\' action=\'enviar_imagem.php?o=planos&idu=' . fId("c", $vgetIDUSUARIO) . '&o=' . $vgetORIGEM . '&c=' . $vgetCAMPO . '&ida=' . $vgetId . '\' target=\'direcionar\' enctype=\'multipart/form-data\'><br />Enviar Imagem<br /><br /><div style=\'display: inline\'><input type=\'file\' name=\'FormFileImagem\' onChange=\'javascript: submit()\' /></div></form>";';
		
		$_SESSION['syscFOTO'] = "";
		
	} else if ($vgetORIGEM == "galeria") {
		echo 'top.showDIRECT(\'\', \'query_galerias.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaREDIRECT\');';
		
	} else {
		if ($vgetCAMPO == "foto") {
			if ($vSexo == "F") {
				echo 'top.document.getElementById("area-cadastro-foto").innerHTML = "<img src=\"images/semfoto_feminino.jpg\" width=\"200\" height=\"200\" border=\"0\" />";';
				
			} else {
				echo 'top.document.getElementById("area-cadastro-foto").innerHTML = "<img src=\"images/semfoto_masculino.jpg\" width=\"200\" height=\"200\" border=\"0\" />";';
				
			}
			
			echo 'top.document.getElementById("area-cadastro-fotobotao").innerHTML = "<br /><form method=\"post\" action=\"enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=perfil\" target=\"direcionar\" enctype=\"multipart/form-data\"><input type=\"file\" name=\"formFOTO\" onChange=\"javascript: submit()\" /><div style=\"font-size: 12px; color: #666666; margin-top: 6px\"><em>(Envie uma imagem com a dimensão de 200 X 200 pixels.)</em></div></form>";';
			
			$_SESSION['syscFOTO'] = "";
			
		} else if ($vgetCAMPO == "foto_rg") {
			echo 'top.document.getElementById("area-foto-rg").innerHTML = "<form method=\"post\" action=\"enviar_imagem.php?o=rg&idu=' . fId("c", $vgetIDUSUARIO) . '\" target=\"direcionar\" enctype=\"multipart/form-data\">DOCUMENTO DO IDENTIDADE: <div style=\"display: inline\"><input type=\"file\" name=\"formFOTORG\" onChange=\"javascript: submit()\" /></div></form>";';

		} else if ($vgetCAMPO == "recebimento") {
			echo 'top.document.getElementById("area-comprovante-texto").innerHTML = "Verifamos em nossa base de dados que seu pagamento ainda não foi confirmado. Envie o comprovante do pagamento para confirmação por nosso Setor Financeiro.";';
			echo 'top.document.getElementById("area-comprovante").innerHTML = "<form method=\"post\" action=\"enviar_imagem.php?o=adesao&id=' . fId("c", $vgetIDFINAN) . '&idu=' . fId("c", $vgetIDUSUARIO) . '\" target=\"direcionar\" enctype=\"multipart/form-data\">ENVIAR COMPROVANTE: <div style=\"display: inline\"><input type=\"file\" name=\"formCOMPROVANTE\" onChange=\"javascript: submit()\" /></div></form>";';

		} else if ($vgetCAMPO == "arquivo") {
			echo 'top.document.getElementById(\'' . $vAreaImagem . '\').innerHTML = "<img src=\'../../docs/images/sem_imagem.gif\' border=\'0\' />";';
			echo 'top.document.getElementById(\'' . $vAreaLinks . '\').innerHTML = "<form method=\'post\' action=\'enviar_imagem.php?o=banners&idu=' . fId("c", $vgetIDUSUARIO) . '&id=' . $vgetID . '&c=arquivo\' target=\'direcionar\' enctype=\'multipart/form-data\'>ENVIAR IMAGEM: <div style=\'display: inline\'><input type=\'file\' name=\'formBANNER\' onChange=\'javascript: submit()\' /></div></form>";';

		} else {
			echo 'top.document.getElementById("area-foto-cpf").innerHTML = "<form method=\"post\" action=\"enviar_imagem.php?o=cpf&idu=' . fId("c", $vgetIDUSUARIO) . '\" target=\"direcionar\" enctype=\"multipart/form-data\">DOCUMENTO CPF: <div style=\"display: inline\"><input type=\"file\" name=\"formFOTOCPF\" onChange=\"javascript: submit()\" /></div></form>";';

		}
	}
	
	echo '</script>';
	?>
</body>
</html>