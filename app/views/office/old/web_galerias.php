<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetIFRAMEHEIGHT = isset($_GET["h"]) ? $_GET["h"] : NULL;
$vgetPASTA = isset($_GET["pasta"]) ? $_GET["pasta"] : NULL;
$vgetTITULO = isset($_GET["titulo"]) ? $_GET["titulo"] : NULL;
$vgetURL = isset($_GET["url"]) ? $_GET["url"] : NULL;

$vgetIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$syscTITULOSECAO = "FOTOS NA GALERIA SHOW";

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

if ($vformACAO == "atualizar") {
	$vformID = isset($_POST["formID"]) ? $_POST["formID"] : NULL;
	$vformTITULO = isset($_POST["formTITULO"]) ? $_POST["formTITULO"] : NULL;
	$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : NULL;
	$vformEXCLUIR = isset($_POST["formEXCLUIR"]) ? $_POST["formEXCLUIR"] : NULL;
	$vformARQUIVO = isset($_POST["formARQUIVO"]) ? $_POST["formARQUIVO"] : NULL;
	
	$dbQUERY = $vConexao->query("SELECT * FROM sysc_galeriasshow ORDER BY id DESC") or die (mysql_error()); 
	$dbRE = mysqli_fetch_array($dbQUERY);

	$vformNOVA_ID = $dbRE['id'] + 1;
	
	for ($i = 0; $i < count($vformID); $i++) {
		if ((trim($vformTITULO[$i]) != "") || (trim($vformDESCRICAO[$i] != ""))) {
			if ((int)$vformID[$i] > 0) {
				$dbALT = "UPDATE sysc_galeriasshow SET ";
				$dbWHERE = " where id=" . $vformID[$i];

				$vConexao->query($dbALT . "titulo='" . $vformTITULO[$i] . "'" . $dbWHERE) or die (mysql_error());
				$vConexao->query($dbALT . "descricao='" . $vformDESCRICAO[$i] . "'" . $dbWHERE) or die (mysql_error());
					
			} else {
				$vConexao->query("INSERT INTO sysc_galeriasshow VALUES (0" . $vformNOVA_ID . ",0" . $vusuarioIDC . ",0" . $vusuarioIDU . ",0" . $vgetIDA . ",'" . $vusuarioCODUNC . "','" . $vformTITULO[$i] . "','" . $vformDESCRICAO[$i] . "','" . str_replace("galerias/", "", $vgetPASTA) . "','" . $vformARQUIVO[$i] . "')") or die (mysql_error());
				
				$vformNOVA_ID++;
				
			}
		}
	}
	
	if (count($vformEXCLUIR) > 0) {
		for ($i = 0; $i < count($vformEXCLUIR); $i++) {
			$vConexao->query("DELETE FROM sysc_galeriasshow WHERE id=". $vformEXCLUIR[$i]) or die (mysql_error());
			
		}
		
	}
	
}

$queryGaleria = $vConexao->query("SELECT * FROM sysc_galeriasshow") or die("Falha na execução da consulta.");

	$arrayGalerias = Array();
	$arrayArquivos = Array();

	$i = 0;

	while ($reGaleria = mysqli_fetch_assoc($queryGaleria)) {
		$arrayGalerias[$i] = Array("Id"=>$reGaleria['id'], "Arquivo"=>$reGaleria['arquivo'], "Titulo"=>$reGaleria['titulo'], "Descricao"=>$reGaleria['descricao']);
		$arrayArquivos[$i] = $reGaleria['arquivo'];
		
		$i++;
	}
mysqli_free_result($queryGaleria);
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

		<style type="text/css">
		<!--
		html {height:100%; overflow-y: auto;}

		.table { height:100%; }
		
		-->
		</style>
	</head>
	<body>
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-litagens">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / GALERIA DE FOTOS</div><br /><br />
							
							<div class="Titulo-Interno">Galeria de Fotos</div><br /><br />
							
							<div id="areaREDIRECT" style="display: table">
								<div id="AreaImagemBoxTexto" style="border: #ffa3a3 5px solid; border-radius: 15px; margin-bottom: 20px; display: none; background: #f98989; font-size: 16px; text-align: center; padding: 15px; color: #660000">1</div>
								
								<div align="left" style="border: #cccccc 1px solid; background: #dddddd; font-size: 18px; padding: 15px; color: #666666">
									<?php
									echo '<table><tr><td>Enviar Uma Imagem:</td><td><form method="post" action="enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=galeria" target="direcionar" enctype="multipart/form-data"><input type="file" name="FormFileImagem" onChange="javascript: submit()" /></form></td></tr></table>';
									?>
								</div>
								
								<form action="salvar_galeriashow.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="direcionar" name="frmGaleriaShow">
									
									<div align="center"><br/><input type="submit" value="Atualizar Galeria" class="formSUBMIT" /></div>
									
									<br/>								
									<div id="area-aviso"></div>
									<br/>
									
									<div align="left" style="margin: 10px">
										<?php
										$syscLOCAL = '../../docs/fotos/empresa/';
										$syscDIR = dir($syscLOCAL);
										
										$i = 1;
										
										while($syscARQUIVO = $syscDIR -> read()){
											$vKey = array_search($syscARQUIVO, $arrayArquivos);
											
											$vIda = 0;
											$vTitulo = "";
											$vDescricao = "";
											
											if ((string)$vKey != "") {
												$vIda = $arrayGalerias[$vKey]['Id'];
												$vTitulo = $arrayGalerias[$vKey]['Titulo'];
												$vDescricao = $arrayGalerias[$vKey]['Descricao'];
												
											}

											if (fSeImagem($syscARQUIVO)) {

												echo '<div style="display: table; margin-bottom: 20px; padding-bottom: 15px">';
													echo '<div style="float: left; margin-right: 10px; text-align: center">';
														echo '<div id="cDiv' . $i . '" style="position: absolute; z-index: 99; width: 150px; border: 1px #cccccc solid; padding: 5px; margin: 5px;border-bottom: #cfdbec 1px solid">';
															echo '<img src="' . $syscLOCAL;
															echo $syscARQUIVO;
															echo '" border="0" id="cFotoGaleria' . $i . '" onClick="fAmpliarFoto(' . $i . ')" width="150" />';
														echo '</div>';

														echo '<div style="margin-top: 130px"><a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&c=arquivo&o=galeria&arq=' . $syscARQUIVO . '&ida=' . $vIda . '" target="direcionar"><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; margin: auto; width: 120px\'>&nbsp;Excluir Essa Imagem&nbsp;</div></a></div>';
													echo '</div>';

													echo '<div style="float: left; margin-left: 40px; font-size: 12px; color: #666666">';

														echo '<input type="hidden" name="formID' . $i . '" value="' . $vIda . '" />';
														echo '<input type="hidden" name="formARQUIVO' . $i . '" value="' . $syscARQUIVO . '" />';

														echo '<div>T&iacute;tulo:</div><input type="text" name="formTITULO' . $i . '" size="75" maxlength="150" value="' . $vTitulo . '" class="form-edit" />';
														echo '<div class="clear"><br />Descri&ccedil;&atilde;o:<br /><textarea name="formDESCRICAO' . $i . '" rows="3" class="form-edit">' . $vDescricao . '</textarea></div>';

													echo '</div>';
												echo '</div>';

												$i++;

											}
											
										}
									   
										$syscDIR -> close();
										
										echo '<input type="hidden" name="formTOTAL" value="' . $i . '" />';

										?>
									</div>
								</form>									
							</div>
					
							<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>
							
						</div>
					</div>					
				</div>
			</div>
		</div>
	</body>
</html>