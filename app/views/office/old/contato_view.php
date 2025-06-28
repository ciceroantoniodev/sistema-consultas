<?php
header("Content-Type: text/html; charset=UTF-8",true);

if (strpos($_SERVER['HTTP_USER_AGENT'], "Firefox") > 0) {
	$vMarginTop = "1860px";
	
} else {
	$vMarginTop = "1860px";
	
}

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

if ($vgetACAO == "alterar") {
	$vTitulo = "Alterar Dados no Plano";
	
} else {
	$vTitulo = "Cadastrar Novo Plano";
	
}


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;

$vQUERY = $vConexao->query("SELECT * FROM sysc_contatos WHERE id=" . $vgetID) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);

	$vformNOME = $vRE['nome'];
	$vformEMAIL= $vRE['email'];
	$vformDDDFONE = $vRE['dddfone'];
	$vformFONE = $vRE['fone'];
	$vformCIDADE = $vRE['cidade'];
	$vformESTADO = $vRE['estado'];
	$vformCOMOSOUBE = $vRE['comosoube'];
	$vformCONTATOPOR = $vRE['contatopor'];
	$vformMENSAGEM = $vRE['mensagem'];
	$vformRESPOSTA = $vRE['resposta'];
	$vformLIDA = $vRE['lida'];
	$vformRESPONDIDA = $vRE['respondida'];
	$vformANEXO = $vRE['anexo'];
	$vformDATA = $vRE['data'];
	
mysqli_free_result($vQUERY);

$vBorder = "border: none";
$vExisteAnexo = "N";

if ($vformANEXO != "" && file_exists("../docs/documentos/". $vformANEXO)) {
	$vDocumento = strtoupper(substr($vformANEXO, strpos($vformANEXO, ".")+1)) . ".png";
	$vBorder = "border: #dddddd 1px solid; border-radius: 10px";
	$vExisteAnexo = "S";

	if (file_exists("images/extensoes/".$vDocumento)) {
		$vImg = '<img src="images/extensoes/'. $vDocumento . '" width="100" border="0"/>';
		
	} else {
		$vImg = '<img src="images/extensoes/DOC.png" width="100" border="0"/>';
		
	}
}

$vConexao->query("UPDATE sysc_contatos SET lida='S' WHERE id=" . $vgetID) or die("Falha na execução da consulta.");
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
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-quero-apostas">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / <a href="javascript: showDIRECT('', 'contatos.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">CONTATOS</a> / VER CONTATO</div><br /><br />
						
						<div class="Titulo-Interno">Ver Contato</div><br /><br />
						
						<div id="area-cadastro">   
							<table cellspacing="5" border='0'>
								<tr>
									<td>
										<table cellpadding="0" cellspacing="0" style="font-size: 16px">
											<tr height="35">
												<td>Nome:</td>
												<td class="CorRed"><?php echo $vformNOME ?></td>
											</tr>
											<tr height="35">
												<td>E-Mail:</td>
												<td class="CorRed"><?php echo $vformEMAIL ?></td>
											</tr>
											<tr height="35">
												<td>Contato:</td>
												<td class="CorRed"><?php echo '(' . $vformDDDFONE . ') ' . $vformFONE ?></td>
											</tr>
											<tr height="35">
												<td>Cidade:</td>
												<td class="CorRed"><?php echo $vformCIDADE . '/' . $vformESTADO ?></td>
											</tr>
											<tr height="35">
												<td>Como soube?&nbsp;&nbsp;&nbsp;</td>
												<td class="CorRed"><?php echo $vformCOMOSOUBE ?></td>
											</tr>
										</table>

									</td>
									<td width="20">&nbsp;</td>
									<td style="<?php echo $vBorder ?>">
										<div align="center" style="margin: 10px">
											<?php 
											if ($vExisteAnexo == "S") {
												echo 'Documento Anexo:<br /><br />';
												
												echo '<a href="http://www.panevale.com/docs/documentos/'. $vformANEXO . '" target="_blank">' . $vImg . '</a>';

											}
											?>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="3"><br/></td>
								</tr>
								<tr>
									<td colspan="3" width="400" valign="top" style="background: #ffffff; border: #dddddd 1px solid;">
										<div align="justify" style="margin: 10px">
											<div>Mensagem:</div><br />
											<?php echo '<div class="CorRed">' . $vformMENSAGEM . '</div>'?>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<br /><div>Responder:</div><br />
										<?php
										if ($vformRESPONDIDA == "S") {
											echo '<div style="width: 797px; height: 304px; overflow-y: scroll; border: #cccccc 1px solid"><div style="margin: 5px">';
											echo $vformRESPOSTA ;
											echo '</div></div>';
											
										} else {
											echo '<iframe src="openwysiwyg/editor.php?id=contato&idc=' . $vgetID . '" scrolling="yes" frameborder="0" name="direcionar" style="border:none; width:800px; height:320px;" allowTransparency="true"></iframe>';
											
										}
										?>
									</td>
								</tr>
							</table>

						</div>

						<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>

					</div>					
				</div>
			</div>
		</div>
	</div>
</body>
</html>