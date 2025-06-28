<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vID_Cadastro = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vPagina = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
$vAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vCartoes = "";

if ($vAcao == "atualizar") {
	$vformCARTAO = isset($_POST["formCARTAO"]) ? $_POST["formCARTAO"] : NULL;
	
	if (count($vformCARTAO) > 0) {
		
		for ($i = 0; $i < count($vformCARTAO); $i++) {
			if ($i > 0) { $vCartoes .= "|"; }
			
			$vCartoes .= $vformCARTAO[$i];
			
		}
		
	}
	
	$vConexao->query("UPDATE sysc_paginas SET cartoes='" . $vCartoes . "' WHERE (id_cadastro=" . $vID_Cadastro . ") AND (pagina='" . $vPagina . "')") or die("Falha na execução da consulta.");
}

$vQUERY = $vConexao->query("SELECT * FROM sysc_paginas WHERE (id_cadastro=" . $vID_Cadastro . ") AND (pagina='" . $vPagina . "')") or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	if ($vRE != "") {
		$vCartoes = $vRE['cartoes'];
		
	}
mysqli_free_result($vQUERY);
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
	
	table { font-family: tahoma, arial; font-size: 14px; }
	
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
	
	.form_submit {
		background: #ff6600;
		color: #ffffff;
		font-size: 20px;
		padding: 5px;
		border: none;
		border-bottom: #ff3333 1px solid;
		border-right: #ff3333 1px solid;
		margin-top: 10px;
	}
	
	#textcolor {
		font-size: 18px;
		color: #660000;
	}
    -->
	
    </style>
	
	<script type="text/javascript">
	window.onload = function() {
		fPaletaCores("mydiv", function(color) {
			document.getElementById("textcolor").innerHTML = color;
			//document.formDesign.formCORTOPO.value = color;
		}); 
	}
	
	function fMostrarDescricao(nn) {
		if (nn == 1) {
			document.getElementById("textoDescricao").innerHTML = document.formDesign.formTEXTOTOPO.value;
			fPosicionamentos();
			fFonte();
			fTamanho();
			fCorFonte();
			
		} else {
			document.getElementById("textoDescricao").innerHTML = "";
			
		}
	}
	
	function fPosicionamentos() {
		vPosicao = document.formDesign.formPOSICIONAMENTO.value;
		
		document.getElementById("textoDescricao").style.textAlign = vPosicao;

	}
	
	function fFonte() {
		vFonte = document.formDesign.formFONTE.value;
		
		document.getElementById("textoDescricao").style.fontFamily = vFonte;

	}
	
	function fTamanho() {
		vTamanho = document.formDesign.formTAMANHO.value;
		
		document.getElementById("textoDescricao").style.fontSize = vTamanho+"px";

	}
	
	function fCorFonte() {
		vCorFonte = document.formDesign.formCORFONTETOPO.value;
		
		document.getElementById("textoDescricao").style.color = vCorFonte;

	}

	function fRepetirImagem(nn) {
		vCorFonte = document.formDesign.formCORFONTERODAPE.value;
		if (nn == 1) {
			document.getElementById("tdBack").style.backgroundRepeat = "repeat";
			
		} else {
			document.getElementById("tdBack").style.backgroundRepeat = "no-repeat";
			document.getElementById("tdBack").style.backgroundPosition = "center";
			
		}
	}
	</script>
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
		
		<div class="titulo-escritorio">Personalização do Design: Formas de Pagamento</div>

		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<?php
					$path = "../documentos/cartoes/";
					
					$diretorio = dir($path);					
						$arrayARQUIVOS = Array();

						$i = 0;
						
						while($arquivo = $diretorio -> read()) {
							$vPosicao = strpos(strtoupper($arquivo), ".JPG") + strpos(strtoupper($arquivo), ".PNG") + strpos(strtoupper($arquivo), ".GIF") + strpos(strtoupper($arquivo), ".BMP");

							if ($vPosicao > 0) {
								$arrayARQUIVOS[$i] = $arquivo;
								
								$i++;
								
							}
							
						}
					$diretorio -> close();
					
					$vECHO1 = "";
					$vECHO2 = "";
					$vECHO3 = "";
					
					$d = round((count($arrayARQUIVOS)/3))+1;
					
					for ($i = 0; $i < count($arrayARQUIVOS); $i++) {
						if (strpos("#".$vCartoes, $arrayARQUIVOS[$i]) > 0) {
							$vChecked = 'checked="checked"';
							$vCor = "#dddddd";

						} else {
							$vChecked = '';
							$vCor = "#ffffff";

						}
						
						if ($i < $d) {
							$vECHO1 .= '<tr style="background: ' . $vCor . '"><td><input type="checkbox" name="formCARTAO[]" ' . $vChecked . ' value="' . $arrayARQUIVOS[$i] . '" /></td><td width="120"><img src="../documentos/cartoes/' . $arrayARQUIVOS[$i] . '" border="0" /></td></tr>';
							
						} else if ($i >= $d && $i < ($d*2)) {
							$vECHO2 .= '<tr style="background: ' . $vCor . '"><td><input type="checkbox" name="formCARTAO[]" ' . $vChecked . ' value="' . $arrayARQUIVOS[$i] . '" /></td><td width="120"><img src="../documentos/cartoes/' . $arrayARQUIVOS[$i] . '" border="0" /></td></tr>';
							
						} else {
							$vECHO3 .= '<tr style="background: ' . $vCor . '"><td><input type="checkbox" name="formCARTAO[]" ' . $vChecked . ' value="' . $arrayARQUIVOS[$i] . '" /></td><td width="120"><img src="../documentos/cartoes/' . $arrayARQUIVOS[$i] . '" border="0" /></td></tr>';
						}
						
					}
					
					echo '<form action="design_cartoes.php?id=' . $vID_Cadastro . '&pg=' . $vPagina . '&acao=atualizar" method="post" name="formDesign">';
					echo '<div align="center">';
					echo '<table border="0"><tr>';
					echo '<td valign="top"><table border="0" cellspacing="3" cellpadding="2" style="margin-right: 30px">';
					echo $vECHO1;
					echo '</table>';
					echo '</td>';
					
					echo '<td valign="top">';
					echo '<table border="0" cellspacing="3" cellpadding="2" style="margin-right: 30px">';
					echo $vECHO2;
					echo '</table>';
					echo '</td>';
					
					echo '<td valign="top">';
					echo '<table border="0" cellspacing="3" cellpadding="2">';
					echo $vECHO3;
					echo '</table>';
					echo '</td>';
					echo '</tr></table>';
					echo '<input type="submit" value="Atualizar Dados" class="form_submit" /></div>';
					echo '</form>';
					?>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>