<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$vgetID_NOTICIA = isset($_GET["ida"]) ? $_GET["ida"] : 0;
$vgetFOTO = isset($_GET["file"]) ? $_GET["file"] : 0;
$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : 0;
$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : 0;
$vArquivoAcao = "";

if (($vformACAO != "") && ($vformACAO == "enviar")) {
	$vformFOTONOME = $_FILES['formFOTO']['name'];
	$vformFOTOTEMP = $_FILES['formFOTO']['tmp_name'];


	if ($vformFOTONOME != "") {
		// Pega extensão do arquivo
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $vformFOTONOME, $vFileExtensao);

		// Gera um nome único para a imagem
		$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

		// Caminho de onde a imagem ficará
		$imagem_dir = "../documentos/noticias/imagens/" . $imagem_nome;

		// Faz o upload da imagem
		move_uploaded_file($vformFOTOTEMP, $imagem_dir);
		
		$vgetFOTO = $imagem_nome;
		$vArquivoAcao = "enviado";
		
	} else {
		$vgetFOTO = "";
		$vArquivoAcao = "";
		
	}
}


if ($vgetACAO != "") {
	if ($vgetACAO == "excluir") {
		include "../documentos/include/conexao.php";

		if (file_exists("../documentos/noticias/imagens/" . $vgetFOTO)) {
			$vUnLink = unlink("../documentos/noticias/imagens/" . $vgetFOTO) or die (mysql_error());
			
			$vConexao->query("UPDATE sysc_noticias SET foto1='' WHERE id=" . $vgetID_NOTICIA) or die (mysql_error());
				
		}
		
		$vgetFOTO = "";
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
		<?php
		if ($vArquivoAcao == "enviado") {
			echo '<script language="Javascript" type="text/javascript">';
			echo 'parent.document.getElementById("FotoCapa").value = "' . $vgetFOTO . '";';
			echo '</script>';

		} else if ($vArquivoAcao == "excluido") {
			echo '<script language="Javascript" type="text/javascript">';
			echo 'parent.document.getElementById("FotoCapa").value = "";';
			echo '</script>';


		}

		?>
		<div align="center">
		<form action="noticia_fotodestaque.php?ida=<?php echo $vgetID_NOTICIA ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>" method="post" style="margin: 0px" enctype="multipart/form-data">
			<strong>FOTO DE CAPA/DESTAQUE:</strong><br><br>
			<?php
			if ($vgetID_NOTICIA != "") {
				$syscPOSICAO = strpos(strtoupper($vgetFOTO), ".JPG") + strpos(strtoupper($vgetFOTO), ".PNG") + strpos(strtoupper($vgetFOTO), ".GIF") + strpos(strtoupper($vgetFOTO), ".BMP");

				if ($syscPOSICAO > 0) {	
					echo '<div style="width: 150px; background: #f1f1f1">';
					echo '<img src="../documentos/noticias/imagens/' . $vgetFOTO . '" width="150" border="0" alt="' . $vgetFOTO . '">';
					echo '</div>';
			
					echo '<br><a href="noticia_fotodestaque.php?id=' . $vgetID_NOTICIA . '&file=' . $vgetFOTO . '&acao=excluir" class="grid">[ Excluir Imagem ]</a>';

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