<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vID_Cadastro = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vPagina = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
$vAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vImagem_Rodape = "";
$vPosicao = 0;


//---------------------------------------------------
//
// Define o nome da pasta onde estão as imagens
//
//---------------------------------------------------


//if ($vPagina == "") {
	$nome_pasta = "gal" . StrZero($vID_Cadastro, 10);
	
//} else {
//	$nome_pasta = $vPagina;
	
//}


//---------------------------------------------------
//
// Pega o limite de fotos no Cadastro Geral
//
//---------------------------------------------------


$vQUERY = $vConexao->query("SELECT fotos FROM sysc_cadastrogeral WHERE id=" . $vID_Cadastro) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	if ($vRE != "") {
		$vLimiteFotos = (int)$vRE['fotos'];
		
	} else {
		$vLimiteFotos = 5;
		
	}
mysqli_free_result($vQUERY);
	

//---------------------------------------------------
//
// Inicia exclusão de fotos
//
//---------------------------------------------------


if ($vAcao == "del") {
	$vArquivoDel = isset($_GET["f"]) ? $_GET["f"] : NULL;
	$vID_Galeria = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
	
	if (file_exists("../documentos/galerias/" . $nome_pasta . "/" . $vArquivoDel)) {
		unlink("../documentos/galerias/" . $nome_pasta . "/" . $vArquivoDel);

	}
	
	$vConexao->query("DELETE FROM sysc_galeriasshow WHERE id=" . $vID_Galeria) or die("Falha na execução da consulta.");

}


//---------------------------------------------------
//
// Inicia a inclusão de novas fotos
//
//---------------------------------------------------


if ($vAcao == "imagem") {
	$vformFILE = isset($_FILES["formFILE"]) ? $_FILES["formFILE"] : FALSE;
	
	if(!is_dir("../documentos/galerias/" . $nome_pasta)) {
		mkdir("../documentos/galerias/" . $nome_pasta);

	}
	
	// Pega extensão do arquivo
	preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $vformFILE["name"], $vFileExtensao);

	// Gera um nome único para a imagem
	$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

	// Caminho de onde a imagem ficará
	$imagem_dir = "../documentos/galerias/" . $nome_pasta . "/" . $imagem_nome;

	// Faz o upload da imagem
	move_uploaded_file($vformFILE["tmp_name"], $imagem_dir);

	$vConexao->query("INSERT INTO sysc_galeriasshow (id_cadastro, pagina, pasta, arquivo) VALUES (0" . $vID_Cadastro . ",'" . $vPagina . "','" . $nome_pasta . "','" . $imagem_nome . "')") or die("Falha na execução da consulta.");
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_galeriasshow WHERE pagina='" . $vPagina . "' ORDER By ordem DESC") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		if ($vRE != "") {
			$vNovaOrdem = ((int)$vRE['ordem'] + 1);
			
		} else {
			$vNovaOrdem = 1;
			
		}
	mysqli_free_result($vQUERY);
	
	$vConexao->query("UPDATE sysc_galeriasshow SET ordem=" . $vNovaOrdem . " WHERE (pagina='" . $vPagina . "') AND (arquivo='" . $imagem_nome. "')") or die("Falha na execução da consulta.");
}


//---------------------------------------------------
//
// Inicia atualização do banco após alterações
//
//---------------------------------------------------


if ($vAcao == "atualizar") {
	$vformLISTA = isset($_POST["formLISTA"]) ? $_POST["formLISTA"] : NULL;
	
	if ((int)$vformLISTA > 0) {
		for ($i = 1; $i <= (int)$vformLISTA; $i++) {
			$vformID = isset($_POST["formID" . $i]) ? $_POST["formID" . $i] : NULL;
			$vformORDEM = isset($_POST["formORDEM" . $i]) ? $_POST["formORDEM" . $i] : NULL;
			$vformTITULO = isset($_POST["formTITULO" . $i]) ? $_POST["formTITULO" . $i] : NULL;
			$vformDESCRICAO = isset($_POST["formDESCRICAO" . $i]) ? $_POST["formDESCRICAO" . $i] : NULL;

			$vformORDEM = "00000" . trim($vformORDEM);
			
			$vConexao->query(	"UPDATE sysc_galeriasshow SET
									titulo='" . $vformTITULO . "',
									descricao='" . $vformDESCRICAO . "',
									ordem='" . substr($vformORDEM, (strlen($vformORDEM)-5), 5) . "'
								WHERE id=" . $vformID) or die("Falha na execução da consulta.");
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="../documentos/js/funcoes-geral.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
	
	table { font-family: tahoma, arial; font-size: 13px; }
	
	.design-imagem {
		background: #f4f4f4;
		width: 900px;
		border: #cccccc 1px solid;
		font-size: 12px;
		height: 30px;
		padding-top: 10px;
		margin-top: 10px;
	}
	
	.design-config {
		background: #f4f4f4;
		width: 880px;
		border: #cccccc 1px solid;
		font-size: 12px;
		padding: 10px;
		margin-top: 10px;
		display: table;
	}
	
	.form_ {
		background: #ffffff;
		color: #660000;
		font-size: 14px;
		border: #cccccc 1px solid;
	}
	
	.form_ordem {
		background: #ffffff;
		color: #660000;
		font-size: 18px;
		font-weight: bold;
		border: #cccccc 3px solid;
	}
	
	.form_button {
		background: #ff6600;
		color: #ffffff;
		font-size: 20px;
		padding: 5px;
		border: none;
		border-bottom: #ff3333 1px solid;
		border-right: #ff3333 1px solid;
		margin-top: 10px;
		width: 240px;
	}
	
	#areaENVIAR {
		background: #f4f4f4;
		border: #cccccc 1px solid;
		width: 800px;
		font-family: tahoma;
		font-size: 16px;
		height: 40px;
		padding-top: 17px;
		display: none;
		text-align: center;
	}
    -->
    </style>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>
  
<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<div align="center">
		<div class="clear">&nbsp;</div>
		
		<div class="titulo-escritorio">Personalização do Design: Envio de Fotos</div>

		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center">
					<div id="areaENVIAR">&nbsp;</div>
					
					<?php
					echo '<form action="design_fotos.php?id=' . $vID_Cadastro . '&pg=' . $vPagina . '&acao=atualizar" method="post" name="formFotos">';
					echo '<input type="button" value="  Atualizar Alterações  " class="form_button" onClick="javascript: submit();" />';
					echo '<table border="0" cellspacing="10" cellpadding="0">';
					
					$vQUERY = $vConexao->query("SELECT * FROM sysc_galeriasshow WHERE id_cadastro=" . $vID_Cadastro . " ORDER By ordem") or die("Falha na execução da consulta.");
						
						$i = 1;
						
						while ($vRE = mysqli_fetch_assoc($vQUERY)) {
							$vArquivo = $vRE['arquivo'];
							$vPasta = $vRE['pasta'];

							echo '<tr>';
							echo '<td><img src="' . "../documentos/galerias/" . $nome_pasta . '/' . $vArquivo . '" width="200" hspace="5" vspace="5" border="0" /><br />';
							echo '&nbsp;<input type="text" name="formORDEM' . $i . '" class="form_ordem" value="' . (int)$vRE['ordem'] . '" size="3" maxlength="2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							echo '<a href="design_fotos.php?id=' . $vID_Cadastro . '&ida=' . $vRE['id'] . '&pg=' . $vPagina . '&f=' . $vArquivo . '&acao=del" >EXCLUIR FOTO</a></td>';
							echo '<td valign="top">';
							echo 'Título:<br /><input type="text" name="formTITULO' . $i . '" size="50" value="' . $vRE['titulo'] . '" class="form_" /><br /><br />';
							echo 'Descrição:<br />';
							echo '<textarea name="formDESCRICAO' . $i . '" rows="2" cols="50" class="form_">' . $vRE['descricao'] . '</textarea>';
							echo '<input type="hidden" name="formID' . $i . '" value="' . $vRE['id'] . '" />';
							echo '</td>';
							echo '</tr>';
							echo '<tr><td colspan="2"><hr style="border: none; border-top: #999999 1px solid" /></td></tr>';
							
							$i++;
						}
					mysqli_free_result($vQUERY);

					echo '</table>';
					echo '<input type="hidden" name="formLISTA" value="' . ($i-1) . '" />';
					echo '<input type="button" value="  Atualizar Alterações  " class="form_button" onClick="javascript: submit();" /><br /><br /><br />';
					echo '</form>';
					
					if (($i-1) < $vLimiteFotos) {
						echo '<script language="JavaScript" type="text/javascript">';
						echo 'vForm = "<form action=\"design_fotos.php?id=' . $vID_Cadastro . '&pg=' . $vPagina . '&acao=imagem\" method=\"post\" enctype=\"multipart/form-data\">";';
						echo 'vForm += "Enviar uma foto: <input type=\"file\" name=\"formFILE\" onChange=\"javascript: submit();\" />";';
						echo 'vForm += "</form>";';
						echo 'document.getElementById("areaENVIAR").innerHTML = vForm;';
						echo 'document.getElementById("areaENVIAR").style.display = "table";';
						echo 'document.getElementById("areaENVIAR").style.color = "#0000FF";';
						echo '</script>';
						
					} else {
						echo '<script language="JavaScript" type="text/javascript">';
						echo 'document.getElementById("areaENVIAR").innerHTML = "O limite de fotos foi atingido. Para enviar novas fotos, exclua uma ou mais fotos existentes.";';
						echo 'document.getElementById("areaENVIAR").style.display = "table";';
						echo 'document.getElementById("areaENVIAR").style.color = "#CC0000";';
						echo '</script>';
						
					}					
					?>					
				</td>
			</tr>
		</table>
	</div>
</body>
</html>