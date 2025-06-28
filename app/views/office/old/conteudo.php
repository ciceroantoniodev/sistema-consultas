<?php
header("Content-Type: text/html; charset=UTF-8",true);

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

include("fckeditor/fckeditor.php");
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
	.form-edit {
		float: left;
		width: 400px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
		margin-right: 20px;
	}
	.form-editMedium {
		float: left;
		width:140px;
		clear: none;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-editSmall {
		float: left;
		width:100px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-editSmall1 {
		float: left;
		width:40px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-edit-data {
		float: left;
		width:30px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}

	.form-edit-dataano {
		float: left;
		width:50px;
		clear: both;
		font-size: 14px;
		border: 1px solid #CCC;
		padding: 2px;
		border-radius:4px;
		color: #1464ad;
	}
	
	.form-submit {
		background: #A9D0F5; 
		width: 100px; 
		height: 100px; 
		border-top: #81BEF7 1px solid; 
		border-left: #81BEF7 1px solid; 
		border-right: #5882FA 1px solid; 
		border-bottom: #5882FA 1px solid; 
		padding: 3px; 
		font-size: 20px; 
		font-family: sego, tahoma, arial; 
		color: #08298A;
	}
	
	#op1 {
		font-size: 24px;
		border: #cccccc 1px solid;
		width: 700px;
		margin-bottom: 5px;
		padding: 6px;
		background: #CEECF5;
		
	}
	
	.opOpcoes {
		font-size: 24px;
		border: #cccccc 1px solid;
		width: 700px;
		margin-bottom: 5px;
		padding: 6px;
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
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / EDITAR CONTE&Uacute;DO</div><br /><br />
						
						<div class="Titulo-Interno">Editar Conte&uacute;do</div><br /><br />
						
						<table width="90%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="center">
									<div id="op1" class="opOpcoes" onMouseOver="fOvr('op1', '#81BEF7')" onMouseOut="fOut('op1', 1)" onClick="fClk('op1', 1, 'institucional')">EMPRESA</div>
									<div id="op2" class="opOpcoes" onMouseOver="fOvr('op2', '#81BEF7')" onMouseOut="fOut('op2', 2)" onClick="fClk('op2', 2, 'assistencia')">ASSIST&Ecirc;NCIA T&Eacute;CNICA</div>
									<div id="op3" class="opOpcoes" onMouseOver="fOvr('op3', '#81BEF7')" onMouseOut="fOut('op3', 3)" onClick="fClk('op3', 3, 'parcerias')">PARCERIAS</div>
									<div id="op4" class="opOpcoes" onMouseOver="fOvr('op4', '#81BEF7')" onMouseOut="fOut('op4', 4)" onClick="fClk('op4', 4, 'homequemsomos')">TEXTO INICIAL - QUEM SOMOS</div>
									<div id="op5" class="opOpcoes" onMouseOver="fOvr('op5', '#81BEF7')" onMouseOut="fOut('op5', 5)" onClick="fClk('op5', 5, 'homeprodutos')">TEXTO INICIAL - PRODUTOS</div>
									<div>&nbsp;</div>
									<div>
										<iframe src="openwysiwyg/editor.php?id=institucional" scrolling="yes" frameborder="0" name="direcionar" style="border:none; width:810px; height:650px;" allowTransparency="true"></iframe>
									</div>
								</td>
							</tr>
						</table>				
				
						
					</div>
				</div>					
			</div>
		</div>
	</div>
</body>
</html>