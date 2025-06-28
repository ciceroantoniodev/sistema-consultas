<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;
$vgetIdOrcamento = isset($_GET["ida"]) ? $_GET["ida"] : NULL;


$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_orcamentos.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE ORCAMENTOS</a> ';


$vformTITULO = "";
$vformDESCRICAO = "";
$vformLINK = "";
$vformORIGEM = "";
$vformIMAGEM = "";

$vDATA_CAD = date("Y-m-d H:i:s"); 

$syscTITULOSECAO = "Vizualiza&ccedil;&atilde;o de Or&ccedil;amento";

if ($vgetAcao == "") {
	$vgetAcao = "novo";
	
}

if ($vgetAcao == "alterar") {
	$dbSQL = "SELECT * FROM sysc_links WHERE id=" . $vgetIdOrcamento;

	$queryLinks = $vConexao->query($dbSQL) or die (mysql_error());

	while ($reLinks = mysqli_fetch_assoc($queryLinks)) {
		$vformTITULO = $reLinks['titulo'];
		$vformDESCRICAO = $reLinks['descricao'];
		$vformLINK = $reLinks['link'];
		$vformORIGEM = $reLinks['origem'];
		$vformIMAGEM = $reLinks['logo'];

	}
	mysqli_free_result($queryLinks);
	
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
			
		<style type="text/css">
		<!--
		html {height:100%; overflow-y: auto;}

		.table {height:100%;}
		
		td {font-weight: bold; color: #333333; padding: 2px}

		-->
		</style>

	</head>

	<body>
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-quero-apostas">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno ?>/ <?php echo $syscTITULOSECAO ?></div><br /><br />
							
							<div class="Titulo-Interno"><?php echo $syscTITULOSECAO ?></div><br /><br /><br />
							
							<div id="area-cadastro">   

								<form action="salvar_links.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmCadLinks" onSubmit="return fValidaForm(this)">
									<input name="formACAO" type="hidden" value="<?php echo $vgetAcao ?>" />
									<input name="formID_LINK" type="hidden" value="<?php echo $vgetIdOrcamento ?>" />
									
									<div id="boxEIXO"></div>
						
									<?php
									$vEchoCabeca = '';
									
									$vEcho = '<div id="areaDIRECT">';
									
									$syscLINHA = 1;
									$syscCOR = 1;
									$i = 1;

									$vEcho .= '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
									$vEcho .= '<tr>';

									$vEcho .= '<td align="center" class="area-grid-cabeca">NOME DO PRODUTO</td>';
									$vEcho .= '<td align="center" class="area-grid-cabeca">REFERENCIA</td>';
									$vEcho .= '<td align="center" class="area-grid-cabeca">QUANTIDADE</td>';
									$vEcho .= '<td align="center" class="area-grid-cabeca">FOTO</td></tr>';

									$queryFornecedores = $vConexao->query("SELECT sysc_orcamentosprodutos.*, 
																				  sysc_orcamentos.nome,
																				  sysc_orcamentos.empresa,
																				  sysc_orcamentos.cidade,
																				  sysc_orcamentos.uf,
																				  sysc_orcamentos.bairro,
																				  sysc_orcamentos.email,
																				  sysc_orcamentos.fone,
																				  sysc_orcamentos.whatsapp,
																				  sysc_orcamentos.mensagem,
																				  sysc_orcamentos.itens,
																				  sysc_orcamentos.pendente,
																				  sysc_orcamentos.data_cad AS DataCadastro
																				  FROM sysc_orcamentosprodutos 
																				  INNER JOIN sysc_orcamentos ON sysc_orcamentosprodutos.id_orcamento=sysc_orcamentos.id
																				  WHERE sysc_orcamentosprodutos.id_orcamento=$vgetIdOrcamento ORDER BY id") or die("Falha na execução da consulta.");

										while ($reFornecedores = mysqli_fetch_assoc($queryFornecedores)) {
											if ($i <= 1) {
												$vEchoCabeca .= '<table style="font-size: 16px; font-family: Lucida Sans, Tahoma; font-weight: normal">';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Nome da Pessoa:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['nome']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Nome da Empresa:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['empresa']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Cidade:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['cidade'] . ((trim($reFornecedores['uf'])!="") ? '/'.strtoupper(trim($reFornecedores['uf'])) : "") . '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Bairro:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['bairro']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">E-mail:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['email']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">WhatsApp:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['whatsapp']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Total de Itens:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['itens']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Data do Or&ccedil;amento:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['DataCadastro']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '<tr>';
												$vEchoCabeca .= '<td align="right">Mensagem:</td>';
												$vEchoCabeca .= '<td style="color: #0055a5">' . $reFornecedores['mensagem']. '</td>';
												$vEchoCabeca .= '</tr>';
												$vEchoCabeca .= '</table><br/><br/>';
											}
											
											if ($syscCOR == 1) {
												$vEcho .= '<tr bgcolor="#ffffff">';
												$syscCOR = 2;
												
											} else {
												$vEcho .= '<tr bgcolor="#f8f8f8">';
												$syscCOR = 1;
												
											}
											
											$vEcho .= '<td class="area-grid-cel">';
												$vEcho .= '<a href="javascript: showDIRECT(\'\', \'view_orcamentos.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reFornecedores['id'] . '\', \'areaConteudo\')" class="grid">';
												$vEcho .= trim($reFornecedores['produto']);
												$vEcho .= '</a>';
											$vEcho .= '</td>';

											$vEcho .= '<td class="area-grid-cel">';
												$vEcho .= '<a href="javascript: showDIRECT(\'\', \'view_orcamentos.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reFornecedores['id'] . '\', \'areaConteudo\')" class="grid">';
												$vEcho .= $reFornecedores['referencia'];
												$vEcho .= '</a>';
											$vEcho .= '</td>';

											$vEcho .= '<td class="area-grid-cel"><div align="right">';
												$vEcho .= '<a href="javascript: showDIRECT(\'\', \'view_orcamentos.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reFornecedores['id'] . '\', \'areaConteudo\')" class="grid">';
												
												$vEcho .= $reFornecedores['quantidade'];
												
												$vEcho .= '</a>';
											$vEcho .= '&nbsp;&nbsp;&nbsp;&nbsp;</div></td>';

											$vEcho .= '<td class="area-grid-cel borderRIGHT">';
												$vEcho .= '<a href="javascript: showDIRECT(\'\', \'view_orcamentos.php?idu=' . fId("c", $vgetIDUSUARIO) . '&acao=alterar&ida=' . $reFornecedores['id'] . '\', \'areaConteudo\')" class="grid">';
												
												$vEcho .= $reFornecedores['foto'];
												
												$vEcho .= '</a>';
											$vEcho .= '</td>';

											$vEcho .= '</tr>';
											
											$i++;
										}
										
									mysqli_free_result($queryFornecedores);

									$vEcho .= '<tr bgcolor="#cccccc"><td colspan="9" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div>';
									
									echo $vEchoCabeca;
									echo $vEcho;
									?>									
								</form>						

								<iframe src="vazio.php" name="SalvarForm" scrolling="yes" frameborder="0" width="1" height="1"></iframe>

							</div>

							<div id="boxDIALOGO"></div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</body>
</html>