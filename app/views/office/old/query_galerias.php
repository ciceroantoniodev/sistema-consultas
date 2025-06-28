<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

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
	<script language="Javascript" src="./documentos/js/funcoes.js" type="text/javascript"></script>
	<style type="text/css">
	<!--
	html {height:100%; overflow-y: auto;}

	.table {height:100%;}
	
	td {padding-left: 3px; padding-right: 3px}
	
	.form_  {font-family: tahoma, verdana, arial; 
			   font-size: 12px; 
			   font-weight: bold; 
			   color: #e04430; 
				 height: 18px;
				 border-right: #7f9db9 1px solid;
			   border-top: #cfdbec 1px solid;
			   border-left: #cfdbec 1px solid;
			   border-bottom: #7f9db9 1px solid;}
	
	.form_textarea  {font-family: tahoma, verdana, arial; 
			   font-size: 12px; 
			   font-weight: bold; 
			   color: #e04430; 
			   border-right: #7f9db9 1px solid;
			   border-top: #cfdbec 1px solid;
			   border-left: #cfdbec 1px solid;
			   border-bottom: #7f9db9 1px solid;}
	
	.enviar_  {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #ffffff;
				height: 22px;
				border-style: solid;
				background: url(http://www.syscontrole.com.br/documentos/images/ground_submit.gif) repeat-x;
				border-right: #047ac4 1px solid;
				border-top: #5cbedc 1px solid;
				border-left: #5cbedc 1px solid;
				border-bottom: #047ac4 1px solid;
				padding-left: 10px;
				padding-right: 10px;
				}
	
	-->
	</style>
</head>
<body>
	<div align="left" style="border: #cccccc 1px solid; background: #dddddd; font-size: 18px; padding: 15px; color: #666666">
		<?php
		echo '<table><tr><td>Enviar Uma Imagem:</td><td><form method="post" action="enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=galeria" target="direcionar" enctype="multipart/form-data"><input type="file" name="FormFileImagem" onChange="javascript: submit()" /></form></td></tr></table>';
		?>
	</div>
	
	<form action="salvar_galeriashow.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="direcionar" name="frmGaleriaShow">
		
		<div align="center"><br/><br/><input type="submit" value="Atualizar Galeria" class="formSUBMIT" /></div>
		
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
							echo '<div style="width: 150px; border: 1px #cccccc solid; padding: 5px; margin: 5px;border-bottom: #cfdbec 1px solid">';
								echo '<img src="' . $syscLOCAL;
								echo $syscARQUIVO;
								echo '" border="0" id="imagem_' . $i . '" width="150" />';
							echo '</div>';

							echo '<a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&c=arquivo&o=galeria&arq=' . $syscARQUIVO . '&ida=' . $vIda . '" target="direcionar"><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; margin: auto; width: 120px\'>&nbsp;Excluir Essa Imagem&nbsp;</div></a>';
						echo '</div>';

						echo '<div style="float: left; font-size: 12px; color: #666666">';

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
		<br /><br />
	</form>						
</body>
</html>