<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;

$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);

	$vDataCadastro = $vRE['data_cad'];

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
	<style type="text/css">
	<!--
	html {height:100%; overflow-y: auto;}
	-->
	</style>
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-litagens">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">INÍCIO</a> / GERENCIAMENTO DE CHAMADOS</div><br /><br />
						
						<div class="Titulo-Interno">Chamados</div><br /><br />
						
						<?php
						echo '<br /><div align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr><td class="area-grid-barra" colspan="7">';
						echo '<div class="floatRIGHT">&nbsp;</div><input type="radio" name="formSITUACAO" value="pendente" onClick="javascript: showDIRECT(\'\', \'query_chamados.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=S\', \'areaDIRECT\')" checked="checked" /> PENDENTES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="formSITUACAO" value="resolvido" onClick="javascript: showDIRECT(\'\', \'query_chamados.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=N\', \'areaDIRECT\')" /> RESOLVIDOS';

						echo '</td></tr>';
						echo '<tr><td><div id="areaDIRECT">';
						
						$dbQUERY = $vConexao->query("SELECT * FROM sysc_chamados WHERE pendente='S' ORDER BY id DESC") or die("Falha na execução da consulta.");

						$syscLINHA = 1;
						$syscCOR = 1;
						$i = 0;
						$arrayDiasSemana = Array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

						echo '<form name="frmGrid">';
						echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr>';

						echo '<td align="center" class="area-grid-cabeca">ID</td>';
						echo '<td align="center" class="area-grid-cabeca">DATA</td>';
						echo '<td align="center" class="area-grid-cabeca">TÍTULO</td>';
						echo '<td align="center" class="area-grid-cabeca">PENDENTE</td></tr>';

						while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
							if ($syscCOR == 1) {
								echo '<tr bgcolor="#ffffff">';
								$syscCOR = 2;
								
							} else {
								echo '<tr bgcolor="#f8f8f8">';
								$syscCOR = 1;
								
							}
							
							echo '<td class="area-grid-cel"><div align="center">';
								echo '<a href="javascript: showDIRECT(\'\', \'chamado_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo StrZero($dbRE['id'], 6);
								echo '</a>';
							echo '</div></td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'chamado_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo strftime("%d/%m/%Y %H:%M:%S", strtotime($dbRE['dt_cadastro']));
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel"><div align="left">';
								echo '<a href="javascript: showDIRECT(\'\', \'chamado_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo $dbRE['titulo'];
								echo '</a>';
							echo '&nbsp;&nbsp;</div></td>';

							echo '<td class="area-grid-cel borderRIGHT">';
								echo '<a href="javascript: showDIRECT(\'\', \'chamado_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								if ($dbRE['pendente'] == "S") {
									echo "SIM";
									
								} else {
									echo "NÃO";
									
								}
								echo '</a>';
							echo '</td>';

							echo '</tr>';
							
							$i++;
						}
						
						mysqli_free_result($dbQUERY);
						
						echo '<tr bgcolor="#cccccc"><td colspan="9" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';

						
						echo '</div></td></tr>';
						echo '<tr><td class="area-grid-rodape">&nbsp;</td></tr>';
						echo '</tbody></tfoot></tfoot></table>';
						echo '</div><br /><br />';
						?>
					</div>
				</div>					
			</div>
		</div>
	</div>
</body>
</html>