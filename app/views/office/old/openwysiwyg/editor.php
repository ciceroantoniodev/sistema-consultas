<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "../conexao.php";
include "../documentos/include/funcoes.php";

$vgetORIGEM = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetID = isset($_GET["idc"]) ? $_GET["idc"] : NULL;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;
$vformCONTEUDO = isset($_POST["formConteudo"]) ? $_POST["formConteudo"] : NULL;
$vformID = isset($_POST["formID"]) ? $_POST["formID"] : NULL;

$vRespondida = "N";

if ($vformACAO == "salvar") {
	if ($vgetORIGEM == "contato") {
		$vQUERY = $vConexao->query("SELECT * FROM sysc_contatos WHERE id='" . $vformID . "'") or die("Falha na execução da consulta.");
			$vRE = mysqli_fetch_array($vQUERY);
			
			$vContatoNome = $vRE['nome'];
			$vContatoEmail = $vRE['email'];
			
		mysqli_free_result($vQUERY);
		
		$vConexao->query("UPDATE sysc_contatos SET resposta='" . $vformCONTEUDO . "', respondida='S', data_resposta='" . date("Y-m-d H:i:s") . "' WHERE id=" . $vformID) or die("Falha na execução da consulta.");
		
		$vgetID = $vformID;
		$vRespondida = "S";
		
		$syscHTML = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		$syscHTML .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
		$syscHTML .= '<head>';
		$syscHTML .= '	<title>Panevale - Máquinas e Equipamentos</title>';
		$syscHTML .= '	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
		$syscHTML .= '</head>';
		$syscHTML .= '<body style="margin: 0px; background: #f4f4f4; font-family: tahoma, arial">';
		$syscHTML .= '	<div align="center" style="height: 110px;text-align: center; margin-bottom: 30px;background: #ffcc29;border-bottom: #e6b103 1px solid;width: 100%; color: #057336; font-family: tahoma, arial; font-size: 26px"><div style="font-size: 40px; font-weight: bold; padding-top: 10px">PANEVALE</div><div>Máquinas e Equipamentos</div></div>';
		$syscHTML .= '	<div style="margin-left: 40px; margin-right: 40px">';
		$syscHTML .= '		<div align="left" style="font-size: 24px">Olá, <font color="#ff0000">'. $vContatoNome . '</font>.</div>';
		$syscHTML .= '		<div>&nbsp;</div>';

		$syscHTML .= '		<div align="justify">' . $vformCONTEUDO . '</div>';

		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div align="left">Obrigado pelo contato.<br /><br /></div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div align="left"><strong style="color: #057336; font-size: 20px">[ ATENDIMENTO PANEVALE ]</strong><br /></div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div>&nbsp;</div>';
		$syscHTML .= '		<div>.&nbsp;</div>';
		$syscHTML .= '	</div>';
		$syscHTML .= '</body>';
		$syscHTML .= '</html>';

		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=utf-85\r\n";
		$header .= "From: Panevale - Máquinas e Equipamentos <ti@panevale.com>";

		ini_set("SMTP", "108.179.193.32");

//		mail(trim($vContatoEmail), "PANEVALE: Resposta ao Seu Contato Pelo Site", $syscHTML, $header);

	} else {
		$vConexao->query("UPDATE sysc_conteudo SET conteudo='" . $vformCONTEUDO . "' WHERE secao='" . $vgetORIGEM . "'") or die("Falha na execução da consulta.");
		
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Panevale - Máquinas e Equipamentos</title>
	<meta http-equiv="content-language" content="pt-br">
	
	<meta name="robots" content="noindex, nofollow">
	
	<meta name="author" content="SAMSITE Web Design Sistemas">
	<meta name="reply-to" content="suporte@samsite.com.br">
	
	<link rel="shortcut icon" href="favicon.ico"> 
	<style type="text/css">
	<!--
	html {height:100%; overflow-y: auto;}
	body {margin: 0px; background: #fcfcfc; }
	.submit-cadastro {
		clear: both;
		font-size: 18px;
		color: #FFF;
		width: 200px;
		height: 40px;
		background: #1464ad;
		border: none;
		border-radius: 4px;
		padding-top: 5px;
		margin-top: 20px;
	}
	-->
	</style>
	
	<link rel="stylesheet" href="docs/style.css" type="text/css">
	
	<!-- 
		Include the WYSIWYG javascript files
	-->
	<script type="text/javascript" src="scripts/wysiwyg.js"></script>
	<script type="text/javascript" src="scripts/wysiwyg-settings.js"></script>
	<!-- 
		Attach the editor on the textareas
	-->
	<?php
	echo '<script type="text/javascript">';
	
	if ($vgetORIGEM == "contato") {
		if ($vRespondida != "S") {
			echo '	WYSIWYG.attach(\'textarea1\', small);';

		}
	
	} else {
		echo '	WYSIWYG.attach(\'textarea1\');';
	
	}
	
	echo '</script>';
	?>
</head>
<body style="background: #fcfcfc">
	<?php
	$vTamanho = "width:800px;height:500px";
	$vSubmit = "<div align='center'><input type='submit' value='Salvar Edi&ccedil;&atilde;o' class='submit-cadastro' /></div>";

	if ($vgetORIGEM == "contato") {
		$vConteudo = " ";
		$vTamanho = "width:800px;height:200px;background: #fcfcfc";
		$vSubmit = "<div align='left'><input type='submit' value='Responder Contato' class='submit-cadastro' /></div>";

		$vQUERY = $vConexao->query("SELECT * FROM sysc_contatos WHERE id='" . $vgetID . "'") or die("Falha na execução da consulta.");
			$vRE = mysqli_fetch_array($vQUERY);

			$vConteudo = $vRE['resposta'];

			if ($vRE['respondida'] == "S") {
				$vRespondida = "S";

			}

		mysqli_free_result($vQUERY);

	} else {
		$vQUERY = $vConexao->query("SELECT * FROM sysc_conteudo WHERE secao='" . $vgetORIGEM . "'") or die("Falha na execução da consulta.");
			$vRE = mysqli_fetch_array($vQUERY);
			
			$vConteudo = $vRE['conteudo'];
			
		mysqli_free_result($vQUERY);
	}
	?>

	<form action="editor.php?id=<?php echo $vgetORIGEM ?>" method="post">
		<input type="hidden" name="formACAO" value="salvar" />
		<input type="hidden" name="formID" value="<?php echo $vgetID ?>" />

		<?php
		if ($vRespondida == "S") {
			echo '<div style="width: 797px; height: 304px; overflow-y: scroll; border: #cccccc 1px solid"><div style="margin: 5px">';
			echo $vConteudo;
			echo '</div></div>';

		} else {
			echo '<textarea id="textarea1" name="formConteudo" style="' . $vTamanho . '">';
			echo $vConteudo;
			echo '</textarea>';

			echo $vSubmit;
		}
		?>

	</form>
</body>
</html>