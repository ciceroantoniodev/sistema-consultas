<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

/* Define o limitador de cache para 'private' */
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* Define o limite de tempo do cache em 30 minutos */
session_cache_expire(120);
$cache_expire = session_cache_expire();

/* Inicia a sessão */
session_start();

$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetIDUSUARIO = isset($_GET['idu']) ? $_GET['idu'] : NULL;
$vgetTIPO = isset($_GET['tp']) ? $_GET['tp'] : NULL;

$vformIDOFERTA = isset($_POST["formIDOFERTA"]) ? $_POST["formIDOFERTA"] : NULL;
$vformFILES = isset($_POST["formFILES"]) ? $_POST["formFILES"] : 0;
$vformPASTA = isset($_POST["formPASTA"]) ? $_POST["formPASTA"] : NULL;
$vformTITULO = isset($_POST["formTITULO"]) ? $_POST["formTITULO"] : NULL;

$syscPASTA = $vformPASTA;

if ($vgetORIGEM == "banners") {
	$syscPASTA = "banners";

} elseif ($vgetORIGEM == "ofertas") {
	$arrayCAMPOS = array("imagem", "foto1", "foto2", "foto3", "foto4");
	$arraySIZES = array(150, 500, 500, 500, 500);

} elseif ($vgetORIGEM == "classificados") {
	$arrayCAMPOS = array("foto1", "foto2", "foto3", "foto4");
	$arraySIZES = array(500, 500, 500, 500);

}

if ((int)$vformFILES <= 0) {
	$vformFILES = 1;

}

$uploadDIR = $syscPASTA . '/';

$uploadOK = 20;

include "conexao.php";

$arrayFILES = array();
$arrayTEMP = array();

for ($i = 0; $i < (int)$vformFILES; $i++) {
	$syscFILENOME = "formFILE" . ($i + 1);
	
	$arrayFILES[$i] = $_FILES[$syscFILENOME]['name'];
	$arrayTEMP[$i] = $_FILES[$syscFILENOME]['tmp_name'];

}

$y = 10;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./documentos/css/estilo.css" media="all" />
	<style type="text/css">
	<!--
	html {height:100%;}

	.table {height:100%;}
	
	td {padding-left: 3px; padding-right: 3px}
	
	#carregando {
		border: 2px solid #585858;
		background: #ffffff;
		font-size: 10px;
		font-family: verdana;
		position: absolute;
		margin: 20%;
		padding: 10px;
		text-align: center;
	}
	#img {
		display: none;
	}
	-->
	</style>

	<script language="Javascript" type="text/javascript">
	</script>
</head>

<body style="margin: 100px">
	<?php	
	$vDiv = 0;
	
	for ($i = 0; $i < count($arrayFILES); $i++) {
		if ($arrayFILES[$i] != "") {
			$vDiv = $i;
			
			// Pega extensão do arquivo
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arrayFILES[$i], $vFileExtensao);

			// Gera um nome único para a imagem
			$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

			// Caminho de onde a imagem ficará
			$imagem_dir = $uploadDIR . $imagem_nome;

			// Faz o upload da imagem
			move_uploaded_file($arrayTEMP[$i], $imagem_dir);
			
			$imagem_nome = fImagemRedimensionar($imagem_nome, $arraySIZES[$i], $syscPASTA);

		}

	}
	
	if ($vformIDOFERTA != "") {
		if ($vgetORIGEM == "classificados") {
			$vConexao->query("UPDATE sysc_classificados SET " . $arrayCAMPOS[(int)$vDiv] . "='" . $imagem_nome . "' WHERE id=" . $vformIDOFERTA) or die ($vConexao->error());
			
		} elseif ($vgetORIGEM == "ofertas") {
			$vConexao->query("UPDATE sysc_cadastroofertas SET " . $arrayCAMPOS[(int)$vDiv] . "='" . $imagem_nome . "' WHERE id=" . $vformIDOFERTA) or die ($vConexao->error());
			
		}
	}

	echo '<script language="JavaScript" type="text/javascript">';
	
	echo 'parent.document.getElementById("divImagem' . $vDiv . '").innerHTML = "<img src=\"' . $uploadDIR . $imagem_nome . '\" border=\"0\" />";';
	echo 'parent.document.getElementById("divInput' . $vDiv . '").innerHTML = "<div class=\"botao-red\"><a href=\"web_enviarimagens.php?local=' . $getLOCAL . '&ida=' . $vformIDOFERTA . '&idu=' . $vgetIDUSUARIO . '&tt=' . $vformTITULO . '&tp=' . $vgetTIPO . '&o=' . $vgetORIGEM . '&acao=deletar&campo=' . $arrayCAMPOS[(int)$vDiv] . '&arq=' . $imagem_nome . '\" class=\"rodape\">&nbsp;&nbsp;Excluir Imagem&nbsp;&nbsp;</a></div>";';
	echo 'parent.document.getElementById("ImagemLoading").style.display = "none";';
	
	echo '</script>';
	?>

</body>
</html
