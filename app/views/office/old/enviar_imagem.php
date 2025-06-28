<?php
header("Content-Type: text/html; charset=UTF-8",true);

session_start();

/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(120);
$cache_expire = session_cache_expire();

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetId = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetCampo = isset($_GET["c"]) ? $_GET["c"] : NULL;

$vDT_CADASTRO = date("Y-m-d H:i:s"); 

// ***********************************************************
// *
// *
// * Inicia gravação nas tabelas
// *
// *
// ***********************************************************

$vPeso = 300000;

$vformFileName = $_FILES['FormFileImagem']['name'];
$vformFileTemp = $_FILES['FormFileImagem']['tmp_name'];
$vformFileSize = $_FILES['FormFileImagem']['size'];

$vAreaImagem = "AreaImagemImagem";
$vAreaDiv = "AreaImagemBotao";
$vAreaError = "AreaImagemBox";

if ($vgetORIGEM == "institucional") {
	$vformFileName = $_FILES['formFOTO']['name'];
	$vformFileTemp = $_FILES['formFOTO']['tmp_name'];
	$vformFileSize = $_FILES['formFOTO']['size'];
	$vCampoFoto = "imagem";
	$vLargura = 1000;
	$vAreaDiv = "area-cadastro-foto";
	$vAreaError = "ErroImagem";
	$vCaminho = "../../../images/";
	
} else if ($vgetORIGEM == "categorias") {
	$vCampoFoto = "imagem";
	$vLargura = 1000;
	$vCaminho = "../../docs/fotos/produtos/";
	
} else if ($vgetORIGEM == "produtos") {
	$vCampoFoto = $vgetCampo;
	$vLargura = 800;
	$vAreaImagem = "AreaImagemImagem" . $vgetCampo;
	$vAreaDiv = "AreaImagemBotao" . $vgetCampo;
	$vAreaError = "AreaImagemBox" . $vgetCampo;
	$vCaminho = "../../docs/fotos/produtos/";
	
} else if ($vgetORIGEM == "links") {
	$vCampoFoto = "logo";
	$vLargura = 1000;
	$vCaminho = "../../docs/logos/";

} else if ($vgetORIGEM == "galeria") {
	$vCampoFoto = "arquivo";
	$vPeso = 400000;
	$vLargura = 1000;
	$vCaminho = "../../docs/fotos/empresa/";

} else if ($vgetORIGEM == "usuarios") {
	$vCampoFoto = "foto";
	$vLargura = 1000;
	$vCaminho = "../../docs/fotos/usuarios/";

} else if ($vgetORIGEM == "fornecedores") {
	$vCampoFoto = "logo";
	$vLargura = 300;
	$vCaminho = "../../docs/logos/";

} else if ($vgetORIGEM == "banners") {
	$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
	$vgetCAMPO = isset($_GET["c"]) ? $_GET["c"] : NULL;
	
	$vformFileName = $_FILES['formBANNER']['name'];
	$vformFileTemp = $_FILES['formBANNER']['tmp_name'];
	$vformFileSize = $_FILES['formBANNER']['size'];
	$vCampoFoto = "arquivo";
	$vLargura = 1000;
	$vAreaImagem = "areaIMAGEM" . (int)$vgetID;
	$vAreaDiv = "area-banner-imagem" . (int)$vgetID;
	$vAreaError .= (int)$vgetID;

} else {
	$vformFileName = $_FILES['formFOTO']['name'];
	$vformFileTemp = $_FILES['formFOTO']['tmp_name'];
	$vformFileSize = $_FILES['formFOTO']['size'];
	$vCampoFoto = "foto";
	$vLargura = 200;
	$vPeso = 250000;
	$vAreaDiv = "area-cadastro-foto";
	$vAreaError = "ImagemFoto";
	
}

$vformFOTO = "";
$vVazios = "";
$vVAZIOS = "";
$vSALVAR = true;

$vMensagem = "";
$vError = "N";

if (fSeImagem($vformFileName)) {

	if ($vformFileSize > $vPeso) {
		$vMensagem = "Arquivo de imagem muito grande. Peso m&aacute;ximo permitido de <span style=\'font-style: italic\'>[ " . fBytes($vPeso) . " bytes ]</span>";
		$vError = "S";
		
	} else {
		// Pega extensão do arquivo
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $vformFileName, $vFileExtensao);

		// Gera um nome único para a imagem
		$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

		// Caminho de onde a imagem ficará
		if ($vgetORIGEM == "institucional") {
			$imagem_dir = "../../images/" . $imagem_nome;
			$imagem_local = "../../images";
			
		} else if ($vgetORIGEM == "categorias") {
			$imagem_dir = "../../docs/fotos/produtos/" . $imagem_nome;
			$imagem_local = "../../docs/fotos/produtos";
			
		} else if ($vgetORIGEM == "produtos") {
			$imagem_dir = "../../docs/fotos/produtos/" . $imagem_nome;
			$imagem_local = "../../docs/fotos/produtos";
			
		} else if ($vgetORIGEM == "links") {
			$imagem_dir = "../../docs/logos/" . $imagem_nome;
			$imagem_local = "../../docs/logos";
			
		} else if ($vgetORIGEM == "galeria") {
			$imagem_dir = "../../docs/fotos/empresa/" . $imagem_nome;
			$imagem_local = "../../docs/fotos/empresa";
			
		} else if ($vgetORIGEM == "usuarios") {
			$imagem_dir = "../../docs/fotos/usuarios/" . $imagem_nome;
			$imagem_local = "../../docs/fotos/usuarios";
			
		} else if ($vgetORIGEM == "fornecedores") {
			$imagem_dir = "../../docs/logos/" . $imagem_nome;
			$imagem_local = "../../docs/logos";
			
		} else if ($vgetORIGEM == "banners") {
			$imagem_dir = "../../docs/banners/" . $imagem_nome;
			$imagem_local = "../../docs/banners";
			
		} else {
			$imagem_dir = "images/photos/" . $imagem_nome;
			echo $imagem_dir;
			$imagem_local = "images/photos";
			echo '-'.$imagem_local;
			
		}
		
		// Faz o upload da imagem
		move_uploaded_file($vformFileTemp, $imagem_dir);
		
		// $imagem, $extensao, $largura, $peso, $pasta
		$vformFOTO = fImagemRedimensionar($imagem_nome,  $vFileExtensao[1], $vLargura, $vPeso, $imagem_local);

		
		// ***********************************************
		// *
		// * Inicia gravação no banco de dados
		// *
		// ***********************************************
		
		
		if ($vgetORIGEM == "banners") {
			$vConexao->query("UPDATE sysc_banners SET " . $vCampoFoto . "='" . $vformFOTO . "', ativo='S' WHERE id=" . $vgetId) or die (mysqli_error());

		} else if ($vgetORIGEM == "institucional") {
			$vConexao->query("UPDATE sysc_dadoscadastrais SET " . $vCampoFoto . "='" . $vformFOTO . "'") or die (mysqli_error());

		} else if ($vgetORIGEM == "categorias") {
			$vConexao->query("UPDATE sysc_produtoscategorias SET " . $vCampoFoto . "='" . $vformFOTO . "' WHERE id=" . $vgetId) or die (mysqli_error());

		} else if ($vgetORIGEM == "produtos") {
			$vConexao->query("UPDATE sysc_produtos SET " . $vCampoFoto . "='" . $vformFOTO . "' WHERE id=" . $vgetId) or die (mysqli_error());

		} else if ($vgetORIGEM == "usuarios") {
			$vConexao->query("UPDATE sysc_usuarios SET " . $vCampoFoto . "='" . $vformFOTO . "' WHERE id=" . $vgetId) or die (mysqli_error());

		} else if ($vgetORIGEM == "fornecedores") {
			$vConexao->query("UPDATE sysc_fornecedores SET " . $vCampoFoto . "='" . $vformFOTO . "' WHERE id=" . $vgetId) or die (mysqli_error());

		} else if ($vgetORIGEM == "links") {
			$vConexao->query("UPDATE sysc_links SET " . $vCampoFoto . "='" . $vformFOTO . "' WHERE id=" . $vgetId) or die (mysqli_error());

		} else if ($vgetORIGEM == "galeria") {
			$dbVALORES = "'" . $vformFOTO . "'";
			$dbVALORES .= ",''";
			$dbVALORES .= ",'" . $imagem_local . "'";
			$dbVALORES .= ",'" . $vformFOTO . "'";
		  
			$dbSALVAR = $vConexao->query("INSERT INTO sysc_galeriasshow (titulo, descricao, pasta, arquivo) VALUES (" . $dbVALORES . ")") or die("Falha em tentar salvar Fotos na Galeria");

		} else {
			$vConexao->query("UPDATE sysc_usuarios SET " . $vCampoFoto . "='" . $vformFOTO . "' WHERE id=" . $vgetIDUSUARIO) or die (mysql_error());
			
		}
	}
	
} else {
	$vMensagem = "O arquivo enviado não é uma imagem válida. Envie arquivos do tipo: JPG, PNG, BMP.";
	$vError = "S";

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

	if ($vError == "S") {
		echo 'top.document.getElementById("' . $vAreaError . 'Texto").innerHTML = "' . $vMensagem . '";';
		echo 'top.document.getElementById("' . $vAreaError . 'Texto").style.display = "block";';
		echo 'top.fBoxAlerta(2,"' . $vAreaError . 'Texto",7000);';
		
	} else {
		if ($vgetORIGEM == "institucional") {
			echo 'top.document.getElementById("area-cadastro-foto").innerHTML = "<img src=\'' . $vCaminho . $vformFOTO . '\' border=\'0\' />";';
			echo 'top.document.getElementById("area-cadastro-fotobotao").innerHTML = "<a href=\'excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=institucional&c=imagem\' target=\'direcionar\'><br /><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; width: 100px\'>&nbsp;excluir imagem&nbsp;</div></a>";';
			
		} else if ($vgetORIGEM == "categorias" || $vgetORIGEM == "produtos" || $vgetORIGEM == "links") {
			echo 'top.document.getElementById("' . $vAreaImagem . '").innerHTML = "<img src=\'' .  $vCaminho . $vformFOTO . '\' border=\'0\' /><br />";';
			echo 'top.document.getElementById("' . $vAreaDiv . '").innerHTML = "<div style=\'display: inline\'><span style=\'color: #DF013A\'><span style=\'font-family: tahoma, arial; font-size: 16px\'>[ imagem enviada ]</span> </span> <a href=\'excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&ida=' . $vgetId . '&o=' . $vgetORIGEM . '&c=' . $vCampoFoto . '\' target=\'direcionar\'><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 14px; font-family: tahoma, arial; color: #ffffff;display: inline\'>&nbsp;Excluir&nbsp;</div></a></div>";';
			
		} else if ($vgetORIGEM == "fornecedores") {
			echo 'top.document.getElementById("' . $vAreaImagem . '").innerHTML = "<img src=\'' .  $vCaminho . $vformFOTO . '\' border=\'0\' /><br />";';
			echo 'top.document.getElementById("' . $vAreaDiv . '").innerHTML = "<div style=\'display: inline\'><span style=\'color: #DF013A\'><span style=\'font-family: tahoma, arial; font-size: 16px\'>[ imagem enviada ]</span> </span> <a href=\'excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&ida=' . $vgetId . '&o=' . $vgetORIGEM . '&c=' . $vCampoFoto . '\' target=\'direcionar\'><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 14px; font-family: tahoma, arial; color: #ffffff;display: inline\'>&nbsp;Excluir&nbsp;</div></a></div>";';
			
		} else if ($vgetORIGEM == "galeria") {
			echo 'top.showDIRECT(\'\', \'query_galerias.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaREDIRECT\');';
			
		} else if ($vgetORIGEM == "banners") {
			echo 'top.document.getElementById(\'' . $vAreaImagem . '\').innerHTML = "<img src=\'../documentos/banners/' . $vformFOTO . '\' border=\'0\' /><br />";';
			echo 'top.document.getElementById(\'' . $vAreaDiv . '\').innerHTML = "<div style=\'display: inline\'><span style=\'color: #DF013A\'><span style=\'font-family: tahoma, arial; font-size: 16px\'>[ imagem enviada ]</span> </span> <a href=\'excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&ida=' . $vgetId . '&o=' . $vgetORIGEM . '&c=' . $vCampoFoto . '\' target=\'direcionar\'><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 14px; font-family: tahoma, arial; color: #ffffff;display: inline\'>&nbsp;Excluir&nbsp;</div></a></div>";';
			
		} else if ($vgetORIGEM == "usuarios") {
			echo 'top.document.getElementById("' . $vAreaImagem . '").innerHTML = "<img src=\'' .  $vCaminho . $vformFOTO . '\' border=\'0\' /><br />";';
			echo 'top.document.getElementById("' . $vAreaDiv . '").innerHTML = "<div style=\'display: inline\'><span style=\'color: #DF013A\'><span style=\'font-family: tahoma, arial; font-size: 16px\'>[ imagem enviada ]</span> </span> <a href=\'excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&ida=' . $vgetId . '&o=' . $vgetORIGEM . '&c=' . $vCampoFoto . '\' target=\'direcionar\'><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 14px; font-family: tahoma, arial; color: #ffffff;display: inline\'>&nbsp;Excluir&nbsp;</div></a></div>";';

			$_SESSION['syscFOTO'] = trim($vformFOTO);
			
		}
	} 

	echo '</script>';
	?>
</body>
</html>