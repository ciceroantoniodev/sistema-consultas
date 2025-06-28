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
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;
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
	-->
	</style>
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-litagens">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> / CONTATOS</div><br /><br />
						
						<?php
						echo '<br /><div align="center"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr><td class="area-grid-barra" colspan="7">';
						echo '<div class="floatLEFT"><div class="Titulo-Interno">Gerenciamento de Contatos</div></div>';
						echo '<div class="floatRIGHT"><form name="frmGridBuscar" onSubmit="return false">Buscar: <input type="text" name="formBUSCAR" size="30" class="form-edit-buscar" /><input type="button" value="Ok!" onClick="fAjaxDirecionar(\'grid_usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '&key=A\')" class="form-buscar-ok" /></form></div>';
						echo '<div class="floatRIGHT">';
						echo '	<form name="frmGridExcluir">';
						echo '		<input type="hidden" name="formDELTABELA" value="sysc_contatos" />';
						echo '		<input type="hidden" name="formDELCAMPO" value="nome" />';
						echo '		<input type="hidden" name="formDEL" value="" />';
						echo '		<a href="javascript: fExcluirRegistros(\'' . fId("c", $vgetIDUSUARIO) . '\');" target="home"><div class="btn-excluir">Excluir Sele&ccedil;&atilde;o</div></a>';
						echo '	</form>';
						echo '</div>';

						echo '</td></tr>';
						echo '<tr><td><div id="areaDIRECT">';
						
						$dbQUERY = $vConexao->query("SELECT * FROM sysc_contatos ORDER BY id DESC") or die("Falha na execução da consulta.");

						$syscLINHA = 1;
						$syscCOR = 1;
						$i = 0;
						$arrayDiasSemana = Array("Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado");

						echo '<form name="frmGrid">';
						echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
						echo '<tr>';

						echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';
						echo '<td align="center" class="area-grid-cabeca">ID</td>';
						echo '<td align="center" class="area-grid-cabeca">NOME</td>';
						echo '<td align="center" class="area-grid-cabeca">E-MAIL</td>';
						echo '<td align="center" class="area-grid-cabeca">CONTATO</td>';
						echo '<td align="center" class="area-grid-cabeca">CIDADE</td>';
						echo '<td align="center" class="area-grid-cabeca">LIDA?</td>';
						echo '<td align="center" class="area-grid-cabeca">RESPONDIDA?</td>';
						echo '<td align="center" class="area-grid-cabeca">ANEXO?</td>';
						echo '<td align="center" class="area-grid-cabeca">DATA</td></tr>';

						while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
							if ($syscCOR == 1) {
								echo '<tr bgcolor="#ffffff">';
								$syscCOR = 2;
								
							} else {
								echo '<tr bgcolor="#f8f8f8">';
								$syscCOR = 1;
								
							}
							
							echo '<td class="area-grid-cel"><div align="center">';
							echo '<input type="checkbox" name="formEXCLUIR" value="' . $dbRE['id'] . '" />';
							echo '</div></td>';
							
							echo '<td class="area-grid-cel"><div align="center">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo StrZero($dbRE['id'], 6);
								echo '</a>';
							echo '</div></td>';

							echo '<td class="area-grid-cel">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo trim($dbRE['nome']);
								echo '</a>';
							echo '</td>';

							echo '<td class="area-grid-cel"><div align="left">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo $dbRE['email'];
								echo '</a>';
							echo '&nbsp;&nbsp;</div></td>';

							echo '<td class="area-grid-cel"><div align="left">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo '(' . $dbRE['dddfone'] . ') ' . $dbRE['fone'];
								echo '</a>';
							echo '&nbsp;&nbsp;</div></td>';

							echo '<td class="area-grid-cel"><div align="left">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo $dbRE['cidade'] . ' / ' . $dbRE['estado'];
								echo '</a>';
							echo '&nbsp;&nbsp;</div></td>';

							echo '<td class="area-grid-cel"><div align="center">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								if ($dbRE['lida'] == "S") {
									echo 'SIM';
									
								} else {
									echo 'N&Atilde;O';
									
								}
								echo '</a>&nbsp;&nbsp;';
							echo '</div></td>';

							echo '<td class="area-grid-cel"><div align="center">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								if ($dbRE['respondida'] == "S") {
									echo 'SIM';
									
								} else {
									echo 'N&Atilde;O';
									
								}
								echo '</a>&nbsp;&nbsp;';
							echo '</div></td>';

							echo '<td class="area-grid-cel"><div align="center">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								if (trim($dbRE['anexo']) != "") {
									echo '<span style="font-weight: bold; color: #ff0000">SIM</span>';
									
								} else {
									echo 'N&Atilde;O';
									
								}
								echo '</a>&nbsp;&nbsp;';
							echo '</div></td>';

							echo '<td class="area-grid-cel borderRIGHT">';
								echo '<a href="javascript: showDIRECT(\'\', \'contato_view.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&id=' . $dbRE['id'] . '\', \'areaConteudo\')" class="grid">';
								echo $dbRE['data'];
								echo '</a>';
							echo '</td>';

							echo '</tr>';
							
							$i++;
						}

						echo '<tr bgcolor="#cccccc"><td colspan="10" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';

						
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