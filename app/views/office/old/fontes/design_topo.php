<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vID_Cadastro = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vPagina = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
$vAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vImagem_Topo = "";
$vPosicao = 0;

if ($vAcao == "del") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_paginas WHERE pagina='" . $vPagina . "'") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		if ($vRE != "") {
			$vImagemAntiga = $vRE['imagem_topo'];
			
			$vPosicao = strpos(strtoupper($vImagemAntiga), ".JPG") + strpos(strtoupper($vImagemAntiga), ".PNG") + strpos(strtoupper($vImagemAntiga), ".GIF") + strpos(strtoupper($vImagemAntiga), ".BMP");
			
			if ($vPosicao > 0) {
				if (file_exists("../documentos/layout/" . $vImagemAntiga)) {
					unlink("../documentos/layout/" . $vImagemAntiga);

				}
			}
			
		}
	mysqli_free_result($vQUERY);
	
	$vConexao->query("UPDATE sysc_paginas SET imagem_topo='' WHERE pagina='" . $vPagina . "'") or die("Falha na execução da consulta.");
	
	$vImagem_Topo = "";

}

if ($vAcao == "imagem") {
	$vformFILE = isset($_FILES["formFILE"]) ? $_FILES["formFILE"] : FALSE;
	
	// Pega extensão do arquivo
	preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $vformFILE["name"], $vFileExtensao);

	// Gera um nome único para a imagem
	$imagem_nome = trim(strtolower($vPagina)) . "_" . md5(uniqid(time())) . "." . $vFileExtensao[1];

	// Caminho de onde a imagem ficará
	$imagem_dir = "../documentos/layout/" . $imagem_nome;

	// Faz o upload da imagem
	move_uploaded_file($vformFILE["tmp_name"], $imagem_dir);

	$vQUERY = $vConexao->query("SELECT * FROM sysc_paginas WHERE pagina='" . $vPagina . "'") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		if ($vRE != "") {
			$vImagemAntiga = $vRE['imagem_topo'];
			
			$vPosicao = strpos(strtoupper($vImagemAntiga), ".JPG") + strpos(strtoupper($vImagemAntiga), ".PNG") + strpos(strtoupper($vImagemAntiga), ".GIF") + strpos(strtoupper($vImagemAntiga), ".BMP");
			
			if ($vPosicao > 0) {
				if (file_exists("../documentos/layout/" . $vImagemAntiga)) {
					unlink("../documentos/layout/" . $vImagemAntiga);

				}
			}
			
		}
	mysqli_free_result($vQUERY);
	
	$vConexao->query("UPDATE sysc_paginas SET imagem_topo='" . $imagem_nome . "', descricao_ver='N' WHERE pagina='" . $vPagina . "'") or die("Falha na execução da consulta.");
}

if ($vAcao == "atualizar") {
	$vformCORTOPO = isset($_POST["formCORTOPO"]) ? $_POST["formCORTOPO"] : NULL;
	$vformALTURATOPO = isset($_POST["formALTURATOPO"]) ? $_POST["formALTURATOPO"] : NULL;
	$vformLARGURATOPO = isset($_POST["formLARGURATOPO"]) ? $_POST["formLARGURATOPO"] : NULL;
	$vformTEXTOVER = isset($_POST["formTEXTOVER"]) ? $_POST["formTEXTOVER"] : NULL;
	$vformTEXTOTOPO = isset($_POST["formTEXTOTOPO"]) ? $_POST["formTEXTOTOPO"] : NULL;
	$vformFONTE = isset($_POST["formFONTE"]) ? $_POST["formFONTE"] : NULL;
	$vformTAMANHO = isset($_POST["formTAMANHO"]) ? $_POST["formTAMANHO"] : NULL;
	$vformPOSICIONAMENTO = isset($_POST["formPOSICIONAMENTO"]) ? $_POST["formPOSICIONAMENTO"] : NULL;
	$vformCORFONTETOPO = isset($_POST["formCORFONTETOPO"]) ? $_POST["formCORFONTETOPO"] : NULL;
	$vformREMETIRIMAGEM = isset($_POST["formREMETIRIMAGEM"]) ? $_POST["formREMETIRIMAGEM"] : NULL;
	
	$vConexao->query(	"UPDATE sysc_paginas SET
							descricao='" . $vformTEXTOTOPO . "',
							descricao_ver='" . $vformTEXTOVER . "',
							repetir_topo='" . $vformREMETIRIMAGEM . "',
							cor_topo='" . $vformCORTOPO . "',
							fonte_topo='" . $vformFONTE . "',
							corfonte_topo='" . $vformCORFONTETOPO . "',
							tamanhofonte_topo=0" . (int)$vformTAMANHO . ",
							posicaofonte_topo='" . $vformPOSICIONAMENTO . "',
							altura_topo=0" . (int)$vformALTURATOPO . ",
							largura_topo=0" . (int)$vformLARGURATOPO . "
						WHERE pagina='" . $vPagina . "'") or die("Falha na execução da consulta.");
}

$vQUERY = $vConexao->query("SELECT * FROM sysc_paginas WHERE pagina='" . $vPagina . "'") or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	if ($vRE != "") {
		$vImagem_Topo = $vRE['imagem_topo'];
		$vAltura_Topo = $vRE['altura_topo'];
		$vDescricao_Topo = $vRE['descricao'];
		$vDescricao_Ver = $vRE['descricao_ver'];
		$vLargura_Topo = $vRE['largura_topo'];
		$vCor_Topo = $vRE['cor_topo'];
		$vFonte_Topo = $vRE['fonte_topo'];
		$vTamanhoFonte_Topo = $vRE['tamanhofonte_topo'];
		$vCorFonte_Topo = $vRE['corfonte_topo'];
		$vPosicaoFonte_Topo = $vRE['posicaofonte_topo'];
		$vRepetir_Topo = $vRE['repetir_topo'];
		
		if ($vDescricao_Ver == "S") {
			$vDescricaoSim = 'checked="checked"';
			$vDescricaoNao = '';
			
		} else {
			$vDescricaoSim = '';
			$vDescricaoNao = 'checked="checked"';
			
		}
	
		if ($vRepetir_Topo == "S") {
			$vRepetirSim = 'checked="checked"';
			$vRepetirNao = '';
			$vRepetirImagem = "repeat";
			
		} else {
			$vRepetirSim = '';
			$vRepetirNao = 'checked="checked"';
			$vRepetirImagem = "no-repeat center";

		}
	
		$vPosicao = strpos(strtoupper($vImagem_Topo), ".JPG") + strpos(strtoupper($vImagem_Topo), ".PNG") + strpos(strtoupper($vImagem_Topo), ".GIF") + strpos(strtoupper($vImagem_Topo), ".BMP");

		if ($vPosicao > 0) {
			$vImagemInfor = getimagesize("../documentos/layout/".$vImagem_Topo);
			$vImagemLargura = $vImagemInfor[0];	  // largura
			$vImagemAltura = $vImagemInfor[1];	  // altura
			$vImagemBackground = "background: url(../documentos/layout/" . $vImagem_Topo . ") " . $vRepetirImagem . "; background-color: " . $vCor_Topo;
			
		} else {
			$vImagemLargura = $vLargura_Topo;
			$vImagemAltura = $vAltura_Topo;
			$vImagemBackground = "background:" . $vRE['cor_topo'];
	
		}
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
		
		<div class="titulo-escritorio">Personalização do Design: Topo do Hotsite</div>

		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td id="tdBack" height="<?php echo $vImagemAltura ?>" style="<?php echo $vImagemBackground ?>">
					<div align="center" style="height: <?php echo $vAltura_Topo . "px" ?>">
						<table border="0" height="100%" width="<?php echo $vLargura_Topo . "px" ?>" cellspacing="0" cellpadding="0">
							<tr>
								<td id="textoDescricao" middle="center">
									<?php
									if ($vDescricao_Ver == "S") {
										echo '<div style="font-family: ' . $vFonte_Topo . '; font-size: ' . $vTamanhoFonte_Topo . 'px; color: ' . $vCorFonte_Topo . '; text-align: ' . $vPosicaoFonte_Topo . '">';
										echo $vDescricao_Topo;
										echo '</div>';
									}
									?>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td align="center">
					<?php
					echo '<div align="center" class="design-imagem">';
					
					if ($vPosicao > 0) {
						echo '<em><strong>Imagem Atual:</strong> Altura: ' . $vImagemAltura . 'px | Largura:  ' . $vImagemLargura . 'px</em>';
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="design_topo.php?id=' . $vID_Cadastro . '&pg=' . $vPagina . '&acao=del" >EXCLUIR IMAGEM</a>';
					
					} else {
						echo '<form action="design_topo.php?id=' . $vID_Cadastro . '&pg=' . $vPagina . '&acao=imagem" method="post" enctype="multipart/form-data"><em>Nenhuma imagem foi enviada para o topo do hotsite.</em>';
						echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="formFILE" onChange="javascript: submit();" /></form>';
					}
					
					echo '</div>';
					?>
				</td>
			</tr>
			<tr>
				<td align="center">
					<form action="design_topo.php?id=<?php echo $vID_Cadastro ?>&pg=<?php echo $vPagina ?>&acao=atualizar" method="post" name="formDesign">
					<?php
					echo '<div align="left" class="design-config">';
					echo '<div style="float: left; border-right: #cccccc 1px solid; padding-right: 15px">';
					echo 'COR DO TOPO: <input type="text" name="formCORTOPO" value="' . $vCor_Topo . '" size="15" class="form_" />';
					echo '&nbsp;<em style="color: #999999">(Informe o código hexa da cor.<br />Clique em uma cor na paleta abaixo e veja o código hexa.)</em><br /><br />';
					echo '<div id="mydiv"></div>';
					echo '<span id="textcolor"></span>';
					echo '<br />ALTURA DO TOPO: <input type="text" name="formALTURATOPO" value="' . $vAltura_Topo . '" size="5" class="form_" /> <em>pixel</em>';
					echo '<br />LARGURA DO TOPO: <input type="text" name="formLARGURATOPO" value="' . $vLargura_Topo . '" size="5" class="form_" /> <em>pixel (Largura útil para o Texto)</em>';
					echo '<br />REPETIR IMAGEM: <input type="radio" name="formREMETIRIMAGEM" value="S" ' . $vRepetirSim . ' onClick="fRepetirImagem(1)" /> SIM <input type="radio" name="formREMETIRIMAGEM" value="N" ' . $vRepetirNao . ' onClick="fRepetirImagem(2)" /> NAO';
					echo '<br /><input type="submit" value="Atualizar" class="form_submit" />';
					echo '</div>';
					echo '<div style="float: left; padding-left: 15px">';
					echo '<br />TEXTO PARA O TOPO:&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="formTEXTOVER" value="S" onClick="fMostrarDescricao(1)" ' . $vDescricaoSim . ' /> Mostrar  <input type="radio" name="formTEXTOVER" onClick="fMostrarDescricao(2)" value="N" ' . $vDescricaoNao . ' /> Ocultar<br /><textarea name="formTEXTOTOPO" rows="2" cols="45" class="form_">' . $vDescricao_Topo . '</textarea><br />';
					echo '<br />FONTE DO TEXTO: <select name="formFONTE" onChange="fFonte()" class="form_"><option value="' . strtolower($vFonte_Topo) . '" selected="selected">' . $vFonte_Topo . '</option><option value="arial">Arial</option><option value="arial black">Arial Black</option><option value="comic sans ms">Comic Sans</option><option value="tahoma">Tahoma</option><option value="lucida sans">Lucida Sans</option><option value="times new roman">Times New Roman</option><option value="impact">Impact</option><option value="georgia">Georgia</option></select>';
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TAMANHO: <select name="formTAMANHO" onChange="fTamanho()" class="form_">';
					echo '<option value="' . (int)$vTamanhoFonte_Topo .'" selected="selected">' . $vTamanhoFonte_Topo .'</option>';
					echo '<option value="18">18</option>';
					echo '<option value="22">22</option>';
					echo '<option value="26">26</option>';
					echo '<option value="30">30</option>';
					echo '<option value="34">34</option>';
					echo '<option value="38">38</option>';
					echo '<option value="42">42</option>';
					echo '<option value="46">46</option>';
					echo '<option value="50">50</option>';
					echo '<option value="54">54</option>';
					echo '<option value="58">58</option>';
					echo '<option value="62">62</option>';
					echo '<option value="66">66</option>';
					echo '<option value="70">70</option>';
					echo '</select>';
					
					if ($vPosicaoFonte_Topo == "left") {
						$vgetTIPOPosicao = "ESQUERDA";
						
					} else if ($vPosicaoFonte_Topo == "right") {
						$vgetTIPOPosicao = "DIREITA";
						
					} else {
						$vgetTIPOPosicao = "CENTRALIZADO";
					}
					
					echo '<br /><br />POSICIONAMENTO DO TEXTO: <select name="formPOSICIONAMENTO" onChange="fPosicionamentos()" class="form_"><option value="' . $vPosicaoFonte_Topo . '" selected="selected">' . $vgetTIPOPosicao . '</option><option value="left">ESQUERDA</option><option value="right">DIREITA</option><option value="center">CENTRALIZADO</option></select>';
					echo '<br /><br />COR DA FONTE: <input type="text" name="formCORFONTETOPO" onChange="fCorFonte()" value="' . $vCorFonte_Topo . '" size="15" class="form_" />';
					echo '<br /><em style="color: #999999">(Utilize a paleta ao lado e veja o código hexa.)</em><br /><br />';
					echo '</div>';
					echo '<br /></div>';
					echo '<br />';
					?>
					</form>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>