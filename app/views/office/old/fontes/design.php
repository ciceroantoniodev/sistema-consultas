<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vID_Cadastro = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vPagina = "";

$vQUERY = $vConexao->query("SELECT * FROM sysc_paginas WHERE id_cadastro=" . $vID_Cadastro) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	if ($vRE != "") {
		$vPagina = $vRE['pagina'];
		 
	}
mysqli_free_result($vQUERY);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="../funcoes.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ffffff; text-decoration: none}
    a:visited {color: #ffffff; text-decoration: none}
    a:hover   {color: #FF0000; text-decoration: underline}
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
		<div class="clear">&nbsp;</div>
		
		<div class="titulo-escritorio">Personalização do Design</div>

		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
		<table border="0">
			<tr>
				<td>
					<?php
					if ($vPagina != "") {
						echo '<a href="design_topo.php?local=' .$getLOCAL . '&id=' .$vID_Cadastro . '&tp=' .$vgetTIPO . '&r=' .$vgetROTINAS . '&pg=' .$vPagina . '" ><img src="images/icone_topodosite.png" hspace="10" border="0" /></a>';
						echo '<a href="design_rodape.php?local=' .$getLOCAL . '&id=' .$vID_Cadastro . '&tp=' .$vgetTIPO . '&r=' .$vgetROTINAS . '&pg=' .$vPagina . '" ><img src="images/icone_rodapedosite.png" hspace="10" border="0" /></a>';
						
					}
					
					echo '<a href="design_fotos.php?local=' .$getLOCAL . '&id=' .$vID_Cadastro . '&tp=' .$vgetTIPO . '&r=' .$vgetROTINAS . '&pg=' .$vPagina . '" ><img src="images/icone_fotos.png" hspace="10" border="0" /></a>';
					echo '<a href="design_mapa.php?local=' .$getLOCAL . '&id=' .$vID_Cadastro . '&tp=' .$vgetTIPO . '&r=' .$vgetROTINAS . '&pg=' .$vPagina . '" ><img src="images/icone_mapa.png" hspace="10" border="0" /></a>';
					
					if ($vPagina != "") {
						echo '<a href="openwysiwyg/design_historico.php?local=' .$getLOCAL . '&id=' .$vID_Cadastro . '&tp=' .$vgetTIPO . '&r=' .$vgetROTINAS . '&pg=' .$vPagina . '" ><img src="images/icone_historico.png" hspace="10" border="0" /></a>';
						
					}
					
					echo '<a href="design_cartoes.php?local=' .$getLOCAL . '&id=' .$vID_Cadastro . '&tp=' .$vgetTIPO . '&r=' .$vgetROTINAS . '&pg=' .$vPagina . '" ><img src="images/icone_formasdepagamento.png" hspace="10" border="0" /></a>';
					echo '<img src="images/icone_redessociais.png" hspace="10" border="0" />';
					?>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>