<?php
header("Content-Type: text/html; charset=UTF-8",true);

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usu&aacute;rio
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>..:.::. CashOut Club - Cursos e Investimentos ..::.:..</title>
	
	<meta http-equiv="content-language" content="pt-br">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="CASHOUT CLUB é um projeto criado para melhorar a condição das pessoas que querem fazer do TRADING ESPORTIVO uma fonte de renda extra para suas vidas." />
	<meta name="keywords" content="cashoutclub, trade, curso, investimento, treinamento, clube, club, saque, caixa, betfar, futebol, esporte, esportivo, aposta"/>
	<meta name="robots" content="index, follow">
	<meta name="author" content="SAMSITE Web Design Sistemas">
	<meta name="reply-to" content="suporte@samsite.com.br">
	
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
						<div style="font-size: 13px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / GERENCIAMENTO DE USU&Aacute;RIOS</div><br />
						
						<?php
						echo '<br /><div align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr><td class="area-grid-barra" colspan="7">';
						echo '<div class="floatLEFT"><div class="Titulo-Interno">Gerenciamento de Usu&aacute;rios</div></div>';
						echo '<div class="floatRIGHT"><form name="frmGridBuscar" onSubmit="return false">Buscar: <input type="text" name="formBUSCAR" size="30" class="form-edit-buscar" /><input type="button" value="Ok!" onClick="fAjaxDirecionar(\'grid_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&key=A\')" class="form-buscar-ok" /></form></div>';
						echo '<div class="floatRIGHT">';
						echo '	<form name="frmGridExcluir">';
						echo '		<input type="hidden" name="formDELTABELA" value="sysc_usuarios" />';
						echo '		<input type="hidden" name="formDELCAMPO" value="nome" />';
						echo '		<input type="hidden" name="formDEL" value="" />';
						echo '		<a href="javascript: fExcluirRegistros(\'' . fId("c", $vgetIDUSUARIO) . '\');" target="home"><div class="btn-excluir">Excluir Sele&ccedil;&atilde;o</div></a>';
						echo '	</form>';
						echo '</div>';
						echo '<div class="floatRIGHT"><button class="btn-novo" onclick="showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=novo\', \'areaConteudo\')">Novo</button></div>';

						echo '</td></tr>';
						echo '<tr><td><div id="areaDIRECT">';
						
						$syscLINHA = 1;
						$syscCOR = 1;
						$i = 0;

						echo '<form name="frmGrid">';
						echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr>';

						echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';
						echo '<td align="center" class="area-grid-cabeca">ID</td>';
						echo '<td align="center" class="area-grid-cabeca">NOME</td>';
						echo '<td align="center" class="area-grid-cabeca">USU&Aacute;RIO</td>';
						echo '<td align="center" class="area-grid-cabeca">CARGO</td>';
						echo '<td align="center" class="area-grid-cabeca">CIDADE</td>';
						echo '<td align="center" class="area-grid-cabeca">FONE</td>';
						echo '<td align="center" class="area-grid-cabeca">E-MAIL</td>';
						echo '<td align="center" class="area-grid-cabeca">A&Ccedil;&Atilde;O</td></tr>';

						$queryUsuarios = $vConexao->query("SELECT * FROM sysc_usuarios ORDER BY nome") or die("Falha na execução da consulta.");

							while ($reUsuarios = mysqli_fetch_assoc($queryUsuarios)) {
								if ($syscCOR == 1) {
									echo '<tr bgcolor="#ffffff">';
									$syscCOR = 2;
									
								} else {
									echo '<tr bgcolor="#f8f8f8">';
									$syscCOR = 1;
									
								}
								
								echo '<td class="area-grid-cel"><div align="center">';
								echo '<input type="checkbox" name="formEXCLUIR" value="' . $reUsuarios['id'] . '" />';
								echo '</div></td>';
								
								echo '<td class="area-grid-cel"><div align="center">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									echo StrZero($reUsuarios['id'], 6);
									echo '</a>';
								echo '</div></td>';

								echo '<td class="area-grid-cel">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									echo trim($reUsuarios['nome']);
									echo '</a>';
								echo '</td>';

								echo '<td class="area-grid-cel">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									echo trim($reUsuarios['usuario']);
									echo '</a>';
								echo '</td>';

								echo '<td class="area-grid-cel">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									echo $reUsuarios['cargo'];
									echo '</a>';
								echo '</td>';

								echo '<td class="area-grid-cel">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									echo $reUsuarios['cidade'] . ' / ' . $reUsuarios['uf'];
									echo '</a>';
								echo '</td>';

								echo '<td class="area-grid-cel"><div align="right">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									
									if (trim($reUsuarios['celular1']) != "") {
										echo '(' . $reUsuarios['dddcelular1'] . ') ' . substr($reUsuarios['celular1'], 0, strlen($reUsuarios['celular1'])-4) . '-' . substr($reUsuarios['celular1'], strlen($reUsuarios['celular1'])-4);
									
									} else if (trim($reUsuarios['celular2']) != "") {
										echo '(' . $reUsuarios['dddcelular2'] . ') ' . substr($reUsuarios['celular2'], 0, strlen($reUsuarios['celular2'])-4) . '-' . substr($reUsuarios['celular2'], strlen($reUsuarios['celular2'])-4);
									
									} else if (trim($reUsuarios['celular3']) != "") {
										echo '(' . $reUsuarios['dddcelular3'] . ') ' . substr($reUsuarios['celular3'], 0, strlen($reUsuarios['celular3'])-4) . '-' . substr($reUsuarios['celular3'], strlen($reUsuarios['celular3'])-4);
									
									} else {
										echo '<font color="#999999"><em>n&atilde;o informado</em></font>';
									
									}
									
									echo '</a>&nbsp;&nbsp;';
								echo '</div></td>';

								echo '<td class="area-grid-cel">';
									echo '<a href="javascript: showDIRECT(\'\', \'cad_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									echo trim($reUsuarios['email_proprio']);
									echo '</a>';
								echo '</td>';

								echo '<td class="area-grid-cel borderRIGHT">';
									echo '<div align="center"><a href="javascript: showDIRECT(\'\', \'ger_images.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=usuarios&ida=' . $reUsuarios['id'] . '\', \'areaConteudo\')" class="grid">';
									
									echo '<img src="images/icone-acao-imagens.png" width="25" border="0"/>';
									
									echo '</a></div>';
								echo '</td>';

								echo '</tr>';
								
								$i++;
							}
							
						mysqli_free_result($queryUsuarios);

						echo '<tr bgcolor="#cccccc"><td colspan="9" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';

						echo '</div></td></tr>';
						echo '<tr><td class="area-grid-rodape">&nbsp;</td></tr>';
						echo '</tbody></tfoot></tfoot></table>';
						echo '<div align="left">Total de Cadastros: ' . $i . '</div>';
						echo '</div><br /><br />';
						?>
					</div>
				</div>					
			</div>
		</div>
	</div>
</body>
</html>