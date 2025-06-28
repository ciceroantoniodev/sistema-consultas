<?php
header("Content-Type: text/html; charset=UTF-8",true);

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;


$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetIFRAMEHEIGHT = isset($_GET["h"]) ? $_GET["h"] : NULL;
$vgetPASTA = isset($_GET["pasta"]) ? $_GET["pasta"] : NULL;
$vgetTITULO = isset($_GET["titulo"]) ? $_GET["titulo"] : NULL;
$vgetURL = isset($_GET["url"]) ? $_GET["url"] : NULL;

$vgetIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vgetPASTA = isset($_GET["pasta"]) ? $_GET["pasta"] : NULL;

$syscTITULOSECAO = "GERENCIADOR DE ARQUIVOS";
$syscMARGINTOP = "80px";
$syscMARGINLEFT = "80px";
$syscDB = "";

$syscDIRNAME = str_replace("\syscontrole", "", dirname(__FILE__));
$syscDIRNAME = str_replace("/syscontrole", "", $syscDIRNAME);

$arrayDiretorios = Array(
						Array("images/", "Imagens do Site"), 
						Array("docs/banners/", "Banners"), 
						Array("docs/fotos/empresa/", "Imagens dos Conte&uacute;dos"), 
						Array("admin/images/", "Imagens do Escrit&oacute;rio Virtual"), 
						Array("docs/fotos/usuarios/", "Fotos do Perfil")
				);

if ($vgetPASTA == "") {
	$syscLOCAL = '../../images/';

} else {
	$syscLOCAL = '../../' . $vgetPASTA;

}
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
	<link rel="shortcut icon" href="favicon.ico"> 
	<style type="text/css">
	<!--
	html {height:100%; overflow-y: auto;}
	.table {height:100%;}
	
	td {padding-left: 3px; padding-right: 3px}
	
	.select_  {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 14px;
				color: #ff0000;
				height: 25px;
				width: 250px;
				}
				
	.excluir_  {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #ffffff;
				height: 22px;
				border-style: solid;
				background: url(images/ground_submit_reset.gif) repeat-x;
				border-right: #901022 1px solid;
				border-top: #ff0000 1px solid;
				border-left: #ff0000 1px solid;
				border-bottom: #901022 1px solid;
				padding-left: 10px;
				padding-right: 10px;
				}
	
	.enviar_  {
				float: left;
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #ffffff;
				height: 22px;
				border-style: solid;
				background: url(images/ground_submit.gif) repeat-x;
				border-right: #047ac4 1px solid;
				border-top: #5cbedc 1px solid;
				border-left: #5cbedc 1px solid;
				border-bottom: #047ac4 1px solid;
				padding-top: 3px;
				padding-left: 10px;
				padding-right: 10px;
				}
	-->
	</style>
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-litagens">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / GERENCIAR IMAGENS</div><br /><br />
						
						<div class="Titulo-Interno">Gerenciar Imagens</div><br /><br />
								
						<div align="left" style="display: table; width: 100%; border: #cccccc 1px solid; background: #dddddd; font-size: 16px; height: 40px; padding-top: 5px; color: #333333">
							<?php
								echo '<form name="frmGerImagens" style="margin: 0px;float: left">&nbsp;&nbsp;&nbsp;Pasta de Origem: ';

								$syscECHO = '';

								for ($i = 0; $i < count($arrayDiretorios); $i++) {
									$syscDIRLISTA = '[' . trim($arrayDiretorios[$i][0]) . ']';

									if (($syscDIRLISTA != "[.]") && ($syscDIRLISTA != "[..]") && ($syscDIRLISTA != "[syscontrole]")) {
										if (trim($arrayDiretorios[$i][0]) == $vgetPASTA) {
											$syscECHO .= '<option value="' . $arrayDiretorios[$i][0] . '" selected="selected">' . $arrayDiretorios[$i][1] . '</option>';
											
										} else {
											$syscECHO .= '<option value="' . $arrayDiretorios[$i][0] . '">' . $arrayDiretorios[$i][1] . '</option>';
											
										}
										
									}
								}
								
								echo '<select name="formPASTAS" id="frmPastas" class="select_" onChange="javascript: fSubmitImagens(\'' . fId("c", $vgetIDUSUARIO) . '\')">';
								echo $syscECHO;
								echo '</select></form>';
							?>
							<div style="float: right; font-size: 12px; margin-right: 15px">
								<div class="enviar_"><a href="web_novoarquivo.php?id=<?php echo $vgetID ?>&url=<?php echo $vgetURL ?>&titulo=<?php echo $vgetTITULO ?>&pasta=<?php echo $vgetPASTA ?>&o=<?php echo $vgetORIGEM ?>&h=<?php echo $vgetIFRAMEHEIGHT ?>)" style="color: #ffffff; text-decoration: none">Enviar Arquivos</a></div>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
								<input type="button" value="   Excluir   " class="excluir_" onClick="fValidaForm()" />
							</div>
							<div style="clear: right"></div>
						</div>
						
						<div align="left" style="margin: 10px">
							<?php
							$syscDIR = dir($syscLOCAL);
							
							$i = 1;
							$vEcho = '';

							while($syscARQUIVO = $syscDIR -> read()){
								$vLarguraImagem = 0;
								$vAlturaImagem = 0;

								$syscEXTENSAO = substr($syscARQUIVO, strrpos($syscARQUIVO, "."));
								
								$vIS_DIR = $syscDIRNAME . '/' . $vgetPASTA . '/' . $syscARQUIVO;

								if (is_dir(str_replace("/", "\\", $vIS_DIR))) {
									$syscEXTENSAO = "PASTA";

								}
								
								if (fSeImagem($syscARQUIVO) && ((trim($syscARQUIVO) != ".") && (trim($syscARQUIVO) != ".."))) {
									if (strtolower($syscEXTENSAO) == ".png") {
										$original=imagecreatefrompng($syscLOCAL . $syscARQUIVO);

									} else if (strtolower($syscEXTENSAO) == ".gif") {
										$original=imagecreatefromgif($syscLOCAL . $syscARQUIVO);

									} else {

										$original=imagecreatefromjpeg($syscLOCAL . $syscARQUIVO);

									}
									
									$vBytesImagem = filesize($syscLOCAL . $syscARQUIVO);
									
									// pega a largura da foto original
									$vLarguraImagem = imagesx($original);
									$vLarguraReal = $vLarguraImagem;
									
									// pega a altura da foto original
									$vAlturaImagem = imagesy($original);
									$vAlturaReal = $vAlturaImagem;
									
									echo '<div style="width: 150px; height: 150px; float: left; display: table">';
									echo '<div align="center" style="display: table; width: 150px; height: 150px; border: 1px #cccccc solid; margin: 5px">';
									
									if ($vLarguraImagem > 150) {
										$vLarguraA = ((150 / $vLarguraImagem) * 100);
										
										$vLarguraImagem = ($vLarguraImagem * ($vLarguraA / 100));
										$vAlturaImagem = ($vAlturaImagem * ($vLarguraA / 100));
										
										if ($vAlturaImagem > 150) {
											$vLarguraA = ((150 / $vAlturaImagem) * 100);
											
											$vLarguraImagem = ($vLarguraImagem * ($vLarguraA / 100));
											$vAlturaImagem = ($vAlturaImagem * ($vLarguraA / 100));
											
										}
										
									} else {
										if ($vAlturaImagem > 150) {
											$vLarguraA = ((150 / $vAlturaImagem) * 100);
											
											$vLarguraImagem = ($vLarguraImagem * ($vLarguraA / 100));
											$vAlturaImagem = ($vAlturaImagem * ($vLarguraA / 100));
											
										}
										
									}
									
									$vDimensao = 'width="' . $vLarguraImagem . '" height="' . $vAlturaImagem . '"';
									
									echo '<div style="display: table; width: 150px; height: 150px; margin: 5px"><img src="' . $syscLOCAL . $syscARQUIVO . '" ' . $vDimensao . ' border="0" id="imagem_' . $i . '" onmouseover="tooltip.pop(this, \'#tip' . $i . '\');" onClick="fAmpliarImagem(\'imagem_' . $i . '\', ' . $vLarguraReal . ', ' . $vAlturaReal . ', ' . $vLarguraImagem . ', ' . $vAlturaImagem . ')" /></div>';
									
									echo '<div align="left" id="divEXCLUIR' . $i . '" style="background: #dddddd"><input type="checkbox" name="formEXCLUIR[]" value="' . $syscARQUIVO . '" /></div>';
									
									echo '</div>';
									echo '<div id="div_' . $i . '" style="display: none; height: 60px; font-size: 9px"></div>';
									echo '</div>';
									
									$vEcho .= '<div id="tip' . $i . '">';
									$vEcho .= '<span style="font-weight: bold">' . $syscARQUIVO . '</span><br />';
									$vEcho .= 'Largura <em styler="font-style: italic">(pixels)</em>: ' . $vLarguraReal . ' | Altura <em styler="font-style: italic">(pixels)</em>:	' . $vAlturaReal;
									$vEcho .= '<br />Peso <em styler="font-style: italic">(bytes)</em>: ' . fBytes($vBytesImagem);
									$vEcho .= '<br />Caminho: ' . str_replace("./", "", str_replace("../", "", $syscLOCAL));
									$vEcho .= '</div>';
									
									$i++;
								}
							}
						   
							$syscDIR -> close();
							?>
						</div>
				
						<div style="display:none;">
							<?php
							echo $vEcho;
							?>
						</div>
						
						<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>
						
					</div>
					
					<div class="clear"><br /><br /><br /></div>

				</div>					
			</div>
		</div>
	</div>
</body>
</html>