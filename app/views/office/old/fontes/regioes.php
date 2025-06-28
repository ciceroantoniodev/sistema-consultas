<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vPagina = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vImagem_Topo = "";
$vPosicao = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="js/menu_redirect.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
	
	#areaESTADOS {
		text-align: left;
		width: 248px;
		border: #999999 1px solid;
		margin-left: 10px;
		padding-top: 5px;
		padding-bottom: 10px;
	}
	
	#areaCIDADES {
		text-align: left;
		width: 248px;
		border: #999999 1px solid;
		margin-left: 10px;
	}
	
	#areaBAIRROS {
		text-align: left;
	}
	
	.areaTITULOS {
		background: #666666;
		color: #ffffff;
		font-weight: bold;
		font-size: 16px;
		height: 23px;
		padding-top: 3px;
		text-align: center;
		width: 250px;
		margin-left: 10px;
	}
	
	.areaICONES {
		background: #cccccc;
		color: #ffffff;
		font-weight: bold;
		font-size: 12px;
		height: 23px;
		padding-top: 3px;
		text-align: left;
		border-left: #999999 1px solid;
		border-bottom: #999999 1px solid;
		border-right: #999999 1px solid;
		width: 248px;
		margin-left: 10px;
		margin-bottom: 10px;
	}
	
	.botao_novo {
		background: #3446D3;
		border: #1D2B95 1px solid;
		border-top: #6F7EEE 1px solid;
		border-left: #6F7EEE 1px solid;
		display: table;
		text-align: center;
		float: left;
		margin-left: 5px;
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
	
	<div align="left">
		<div class="clear">&nbsp;</div>
		
		<div align="center"><div class="titulo-escritorio">Gerenciamento de Regiões</div></div>

		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left">
					<div class="areaTITULOS">ESTADOS</div>
					<div id="areaESTADOS">
						<?php
						//$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastroestados ORDER BY nome") or die("Falha na execução da consulta.");
						$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastroestados WHERE (liberado='S') AND (cidades>0) ORDER BY nome") or die("Falha na execução da consulta.");

							$i = 1;
							
							while ($vRE = mysqli_fetch_assoc($vQUERY)) {
								$vNomeUF = $vRE['nome'];
								$vSiglaUF = $vRE['uf'];
								
								echo '<div><input type="radio" name="formESTADOS" valeu="' . $vSiglaUF . '" onClick="showDIRECT(\'\',\'regioes_cidades.php?uf=' . $vSiglaUF . '\',\'areaCIDADES\')" /> ' . strtoupper($vNomeUF) . '</div>';
								
								$i++;
								
							}
						mysqli_free_result($vQUERY);
						
						if ($i > 5) {
							echo '<script language="JavaScript" type="text/javascript">';
							echo 'document.getElementById("areaESTADOS").style.height = "80px";';
							echo 'document.getElementById("areaESTADOS").style.overflow = "auto";';
							echo '</script>';
						}
						?>
					</div>
					<div class="areaICONES"><div class="botao_novo">&nbsp;Novo&nbsp;</div></div>
		
					<div style="clear: both"></div>
					
					<div id="areaCIDADES"></div>
				</td>
				<td valign="top" align="left">
					<div id="areaBAIRROS"></div>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>