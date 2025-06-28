<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

if (strpos($_SERVER['HTTP_USER_AGENT'], "Firefox") > 0) {
	$vMarginTop = "1860px";
	
} else {
	$vMarginTop = "1860px";
	
}

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "../documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetIDCHAMADO = isset($_GET["id"]) ? $_GET["id"] : NULL;


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;

$vQUERY = $vConexao->query("SELECT * FROM sysc_chamados WHERE id=" . $vgetIDCHAMADO) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);

	$vChamadoData = $vRE['dt_cadastro'];
	$vChamadoTitulo = $vRE['titulo'];
	$vChamadoDescricao = $vRE['descricao'];
	$vChamadoPendente = $vRE['pendente'];
	
	if ($vChamadoPendente == "S") {
		$vPendenteSim = '';
		$vPendenteNao = 'checked="checked"';
		
	} else {
		$vPendenteSim = 'checked="checked"';
		$vPendenteNao = '';
		
	}
	
	$vConexao->query("UPDATE sysc_chamados SET visualizado='S' WHERE id=" . $vgetIDCHAMADO);
	
mysqli_free_result($vQUERY);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>::: Central de Apostas :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="SAMSITE Sistemas Web Design" />
	<meta name="description" content="A centraldeapostas.com é hoje o maior meio de rendimentos consistentes para investidores que não podem ou não tem conhecimento do mercado de TRADING ESPORTIVO." />
	<meta name="keywords" content="central, aposta, esporte, investimento, investidores, trading, esportivo" />
	<link rel="shortcut icon" href="favicon.ico"> 
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-quero-apostas">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">INÍCIO</a> / <a href="javascript: showDIRECT('', 'chamados.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">GERENCIAMENTO DE CHAMADOS</a> / CHAMADO RECEBIDO</div><br /><br />
						
						<div class="Titulo-Interno">Chamado Recebido</div><br /><br />
						
						<div id="area-cadastro">   
							<table style="font-size: 20px">
								<tr>
									<td nowrap="nowrap">
										<div style="padding: 10px; #dddddd 1px solid;border-bottom: #dddddd 1px solid"><span style="font-weight: bold">Data:</span> <?php echo date("d-m-Y", strtotime($vChamadoData)) . ' às ' . date("H:i:s", strtotime($vChamadoData)) ?></div>
										<div style="padding: 10px; #dddddd 1px solid"><span style="font-weight: bold">Título:</span> <?php echo $vChamadoTitulo ?></div>
										<div style="background: #F5F6CE; padding: 10px; border-top: #dddddd 1px solid;border-bottom: #dddddd 1px solid"><span style="font-weight: bold">Descrição:</span><br /><br /><div style="margin-left: 5px"><?php echo str_replace("usuarioadm", fId("c", $vgetIDUSUARIO), str_replace("%%", '"', str_replace("|", "'", $vChamadoDescricao))) ?> </div></div>
										<?php
										if ($vChamadoPendente == "S") {
											echo '<form action="atualizar_chamado.php?id=' . $vgetIDCHAMADO . '" method="post" target="direcionar"><div style="padding: 10px; #dddddd 1px solid"><span style="font-weight: bold">Chamado resolvido?</span>&nbsp;&nbsp;<input type="radio" name="formPENDENTE" value="N" ' . $vPendenteSim . ' onClick="javascript: submit()" /> SIM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="formPENDENTE" value="S" ' . $vPendenteNao . ' onClick="javascript: submit()" /> NÃO</div></form>';
											
										} else {
										echo '<br /><span style="font-weight: bold; font-style: italic">[ Chamado resolvido ]</span>';
											
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
