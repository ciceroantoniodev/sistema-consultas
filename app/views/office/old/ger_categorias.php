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
	-->
	</style>
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-litagens">
					<div align="left" style="margin: 30px;">
						
						<div id="boxEIXO"></div>
						
						<div style="font-size: 13px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / GERENCIAMENTO DE CATEGORIAS</div><br />
						
						<?php
						echo '<br /><div align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr><td class="area-grid-barra" colspan="7">';
						echo '<div class="floatLEFT"><div class="Titulo-Interno">Gerenciamento de Categorias</div></div>';
						echo '<div class="floatRIGHT"><form name="frmGridBuscar" onSubmit="return false">Buscar: <input type="text" name="formBUSCAR" size="30" class="form-edit-buscar" /><input type="button" value="Ok!" onClick="fAjaxDirecionar(\'grid_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&key=A\')" class="form-buscar-ok" /></form></div>';
						echo '<div class="floatRIGHT">';
						echo '	<form name="frmGridExcluir">';
						echo '		<input type="hidden" name="formDELTABELA" value="sysc_produtoscategorias" />';
						echo '		<input type="hidden" name="formDELCAMPO" value="nome" />';
						echo '		<input type="hidden" name="formDEL" value="" />';
						echo '		<a href="javascript: fExcluirRegistros(\'' . fId("c", $vgetIDUSUARIO) . '\');" target="home"><div class="btn-excluir">Excluir Sele&ccedil;&atilde;o</div></a>';
						echo '	</form>';
						echo '</div>';

						echo '</td></tr>';
						echo '<tr><td><div id="areaDIRECT">';
						
						$syscLINHA = 1;
						$syscCOR = 1;
						$i = 0;
						
						$arrayCategorias = Array();
						$arraySort = Array();
						$a = 0;

						echo '<form name="frmGrid">';
						echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr>';

						echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';
						echo '<td align="center" class="area-grid-cabeca">ID</td>';
						echo '<td align="center" class="area-grid-cabeca">NOME DO GRUPO</td>';
						echo '<td align="center" class="area-grid-cabeca">TIPO</td>';
						echo '<td align="center" class="area-grid-cabeca">LINK</td>';
						echo '<td align="center" class="area-grid-cabeca">ITENS</td>';
						echo '<td align="center" class="area-grid-cabeca">ATIVO</td>';
						echo '<td align="center" class="area-grid-cabeca">A&Ccedil;&Atilde;O</td></tr>';

						$queryCategorias = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE id_pai<99999 OR tipo!='linha' ORDER BY id_pai, nome") or die("Falha na execução da consulta.");

							while ($reCategorias = mysqli_fetch_assoc($queryCategorias)) {
								
								if ($reCategorias['id_pai'] <= 0) {
									$vIndice =  StrZero($reCategorias['id'], 6) . StrZero($reCategorias['id_pai'], 6);
									
								} else {
									$vIndice =  StrZero($reCategorias['id_pai'], 6) . StrZero($reCategorias['id'], 6);
									
								}
								
								$arrayCategorias[$vIndice] = 	Array(
																	"Id"=>$reCategorias['id'],
																	"IdPai"=>$reCategorias['id_pai'],
																	"Nome"=>$reCategorias['nome'],
																	"Tipo"=>$reCategorias['tipo'],
																	"Link"=>$reCategorias['link'],
																	"Itens"=>$reCategorias['itens'],
																	"Ativo"=>$reCategorias['ativo']
																);

								$arraySort[$a] = $vIndice;
								
								$a++;
							}
							
						mysqli_free_result($queryCategorias);
						
						
						sort($arraySort);
						
						
						foreach ($arraySort AS $vDados)	{
							if ($syscCOR == 1) {
								echo '<tr bgcolor="#ffffff">';
								$syscCOR = 2;
								
							} else {
								echo '<tr bgcolor="#f8f8f8">';
								$syscCOR = 1;
								
							}
							
							echo '<td class="area-grid-cel"><div align="center">';
							echo '<input type="checkbox" name="formEXCLUIR" value="' . $arrayCategorias[$vDados]['Id'] . '" />';
							echo '</div></td>';
							
							echo '<td class="area-grid-cel"><div align="center">';
								echo '<a href="javascript: showDIRECT(\'\', \'cad_produtoscategorias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								echo StrZero($arrayCategorias[$vDados]['Id'], 6);
								echo '</a>';
							echo '</div></td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'cad_produtoscategorias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								if ((int)$arrayCategorias[$vDados]['IdPai'] <= 0) {
									echo '<span style="font-weight: bold">' . trim($arrayCategorias[$vDados]['Nome']) . '</span>';
									
								} else if ((int)$arrayCategorias[$vDados]['IdPai'] > 0 && (int)$arrayCategorias[$vDados]['IdPai'] < 99999 ) {
									echo '<span style="color: #666666">&nbsp;&ndash; ' . trim($arrayCategorias[$vDados]['Nome']) . '</span>';

								}
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'cad_produtoscategorias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								if ($arrayCategorias[$vDados]['Tipo'] == 'linha') {
									echo '<span style="color: #1350c6">LINHA</span>';
									
								} else {
									if ((int)$arrayCategorias[$vDados]['IdPai'] <= 0) {
										echo 'Grupo';
										
									} else if ((int)$arrayCategorias[$vDados]['IdPai'] > 0 && (int)$arrayCategorias[$vDados]['IdPai'] < 99999 ) {
										echo '<span style="color: #9098a8">Sub-Grupo</span>';
							
									}
								}
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'cad_produtoscategorias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								echo $arrayCategorias[$vDados]['Link'];
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'cad_produtoscategorias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								echo $arrayCategorias[$vDados]['Itens'];
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'cad_produtoscategorias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								
								if ($arrayCategorias[$vDados]['Ativo'] == "S") {
									echo 'Sim';
									
								} else {
									echo '<font color="#999999">N&atilde;o</font>';
								
								}
								
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel borderRIGHT">';
								echo '<div align="center"><a href="javascript: showDIRECT(\'\', \'ger_images.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=categorias&ida=' . $arrayCategorias[$vDados]['Id'] . '\', \'areaConteudo\')" class="grid">';
								
								echo '<img src="images/icone-acao-imagens.png" width="25" border="0"/>';
								
								echo '</a></div>';
							echo '</td>';

							echo '</tr>';
							
							$i++;
						}
						


						echo '<tr bgcolor="#cccccc"><td colspan="9" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';

						echo '</div></td></tr>';
						echo '<tr><td class="area-grid-rodape">&nbsp;</td></tr>';
						echo '</tbody></tfoot></tfoot></table>';
						echo '<div align="left">Total de Cadastros: ' . $i . '</div>';
						echo '</div><br /><br />';
						?>
						
						<div id="boxDIALOGO"></div>

					</div>
				</div>					
			</div>
		</div>
	</div>
</body>
</html>