<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$vgetLOGO = isset($_GET["logo"]) ? $_GET["logo"] : 0;
$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;
$vgetIDCADASTRO = isset($_GET["idc"]) ? $_GET["idc"] : NULL;

$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : 0;
$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : 0;
$vArquivoAcao = "";

if (($vformACAO != "") && ($vformACAO == "enviar")) {
	$vformFOTONOME = $_FILES['formFOTO']['name'];
	$vformFOTOTEMP = $_FILES['formFOTO']['tmp_name'];

	if ($vformFOTONOME != "") {
		include "../documentos/include/conexao.php";
		
		// Pega extensão do arquivo
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $vformFOTONOME, $vFileExtensao);

		// Gera um nome único para a imagem
		$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

		// Caminho de onde a imagem ficará
		$imagem_dir = "../documentos/logos/" . $imagem_nome;

		// Faz o upload da imagem
		move_uploaded_file($vformFOTOTEMP, $imagem_dir);
		
		$vConexao->query("UPDATE sysc_cadastrogeral SET logo='" . $imagem_nome . "' WHERE id=" . $vgetIDCADASTRO) or die (mysql_error());
		
		$vgetLOGO = $imagem_nome;
		$vArquivoAcao = "enviado";
		
	} else {
		$vgetLOGO = "";
		$vArquivoAcao = "";
		
	}
}


if ($vgetACAO != "") {
	if ($vgetACAO == "excluir") {
		include "../documentos/include/conexao.php";

		if (file_exists("../documentos/logos/" . $vgetLOGO)) {
			$vUnLink = unlink("../documentos/logos/" . $vgetLOGO) or die (mysql_error());
			
			$vConexao->query("UPDATE sysc_cadastrogeral SET logo='' WHERE id=" . $vgetIDCADASTRO) or die (mysql_error());
				
		}
		
		$vgetLOGO = "";
		$vArquivoAcao = "excluido";

	}
}
?>
<html>
	<head>
		<style type="text/css">
		<!--
		html {height:100%;}
		
		body {
			margin: 0px;
			font-family: tahoma, arial;
			font-size: 12px;
		}
		
		.realupload {
			position: relative;
			float: right;
			top: -21px;
			right: 20px;
			opacity:0;
			-moz-opacity:0;
			filter:alpha(opacity:0);
			width: 200px;
		}

		.fakeupload {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			color: #ffffff;
			padding: 2px;
			background-color: #38B0DE;
			width: 120px;
			border: none;
		}
		
		-->
		</style>
	</head>
	<body bgcolor="#FBF8EF">
		<div align="center">
		
		<form action="atualizar_logo.php?idc=<?php echo $vgetIDCADASTRO ?>&idu=<?php echo $vgetIDUSUARIO ?>&logo=<?php echo $vgetLOGO ?>" method="post" style="margin: 0px" enctype="multipart/form-data">
			<br /><strong>LOGOMARCA:</strong><br><br>
			<?php
			if ($vgetIDCADASTRO != "") {
				$syscPOSICAO = strpos(strtoupper($vgetLOGO), ".JPG") + strpos(strtoupper($vgetLOGO), ".PNG") + strpos(strtoupper($vgetLOGO), ".GIF") + strpos(strtoupper($vgetLOGO), ".BMP");

				if ($syscPOSICAO > 0) {	
					echo '<div style="width: 150px; background: #f1f1f1">';
					echo '<img src="../documentos/logos/' . $vgetLOGO . '" width="130" border="0" alt="' . $vgetLOGO . '">';
					echo '</div>';
			
					echo '<br><a href="atualizar_logo.php?idc=' . $vgetIDCADASTRO . '&idu=' . $vgetIDUSUARIO . '&logo=' . $vgetLOGO . '&acao=excluir" class="grid">[ Excluir Imagem ]</a>';

				} else {
					echo '<div style="width: 150px; height: 50px; font-size: 18px; border: #cccccc 1px solid; background: #f1f1f1; color: #999999; text-align: center; padding-top: 30px"><em>sem imagem</em></div><br>';
					echo '<input name="formACAO" type="hidden" value="enviar">';
					echo '<input id="fakeupload" name="fakeupload" class="fakeupload"  type="text" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enviar Imagem">';
					echo '<input id="realupload" name="formFOTO" class="realupload" type="file" onchange="this.form.fakeupload.value = this.value; submit()">';

				}				

			} else {
				echo '<div style="width: 150px; height: 50px; font-size: 18px; border: #cccccc 1px solid; background: #f1f1f1; color: #999999; text-align: center; padding-top: 30px"><em>sem imagem</em></div><br>';
				echo '<input name="formACAO" type="hidden" value="enviar">';
				echo '<input id="fakeupload" name="fakeupload" class="fakeupload"  type="text" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enviar Imagem">';
				echo '<input id="realupload" name="formFOTO" class="realupload" type="file" onchange="this.form.fakeupload.value = this.value; submit()">';

			}			
			?>
		</form>
		</div>
	</body>
</html>