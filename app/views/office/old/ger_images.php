<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetOrigem = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetId = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vImagem = "";
$vCaminho = "";

if ($vgetOrigem == "categorias") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_categorias.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE CATEGORIAS</a> ';
	
	$vQuery = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE id=" .  $vgetId) or die("Falha na execução da consulta");

		$vRE = mysqli_fetch_array($vQuery);

		$vDescricao = $vRE['nome'];
		$vImagem = $vRE['imagem'];
		$vCaminho = "../../docs/fotos/produtos/";
		$vCampo = "imagem";
		
	mysqli_free_result($vQuery);
	
} else if ($vgetOrigem == "produtos") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_produtos.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE PRODUTOS</a> ';
	
	$vQuery = $vConexao->query("SELECT * FROM sysc_produtos WHERE id=" .  $vgetId) or die("Falha na execução da consulta");

		$vRE = mysqli_fetch_array($vQuery);

		$vDescricao = $vRE['nome'];
		$arrayImagens = Array($vRE['foto_miniatura'], $vRE['foto1'], $vRE['foto2'], $vRE['foto3'], $vRE['foto4'], $vRE['foto5']);
		$vCaminho = "../../docs/fotos/produtos/";
		$arrayCampos = Array("foto_miniatura", "foto1", "foto2", "foto3", "foto4", "foto5");
		
	mysqli_free_result($vQuery);
	
} else if ($vgetOrigem == "links") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_links.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE LINKS</a> ';
	
	$vQuery = $vConexao->query("SELECT * FROM sysc_links WHERE id=" .  $vgetId) or die("Falha na execução da consulta");

		$vRE = mysqli_fetch_array($vQuery);

		$vDescricao = $vRE['titulo'] . ' [ '.$vRE['link'] . ' ]';
		$vImagem = $vRE['logo'];
		$vCaminho = "../../docs/logos/";
		$vCampo = "logo";
		
	mysqli_free_result($vQuery);
	
} else if ($vgetOrigem == "usuarios") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'usuarios.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE USU&Aacute;RIOS</a> ';
	
	$vQuery = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" .  $vgetId) or die("Falha na execução da consulta");

		$vRE = mysqli_fetch_array($vQuery);

		$vDescricao = trim($vRE['nome']) . ' '. trim($vRE['sobrenome']);
		$vImagem = $vRE['foto'];
		$vCaminho = "../../docs/fotos/usuarios/";
		$vCampo = "foto";
		
	mysqli_free_result($vQuery);
	
} else if ($vgetOrigem == "fornecedores") {
	$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_fornecedores.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE FORNECEDORES</a> ';
	
	$vQuery = $vConexao->query("SELECT * FROM sysc_fornecedores WHERE id=" .  $vgetId) or die("Falha na execução da consulta");

		$vRE = mysqli_fetch_array($vQuery);

		$vDescricao = trim($vRE['nome']);
		$vImagem = $vRE['logo'];
		$vCaminho = "../../docs/logo/";
		$vCampo = "logo";
		
	mysqli_free_result($vQuery);
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
			
		<script language="Javascript" src="./documentos/js/funcoes.js" type="text/javascript"></script>

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
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno . ' / ' . $vDescricao ?></div><br /><br />
							
							<div class="Titulo-Interno">Envio de Imagens</div><br /><br /><br />
							
							<div id="area-cadastro">   

								<div align="center">
									<?php
									if ($vgetOrigem == "produtos") {
										echo '<div style="display: table; padding: 10px; padding-left: 30px; padding-right: 30px; border-top: #cccccc 1px solid; border-bottom: #cccccc 1px solid;font-size: 20px">';
										echo 'Descri&ccedil;&atilde;o: <strong>' . $vDescricao . '</strong>';
										echo '</div><br/><br/>';
										
										for ($i = 0; $i < count($arrayImagens); $i++) {
											if (fSeImagem($arrayImagens[$i]) && file_exists($vCaminho . $arrayImagens[$i])) {
												echo '<div id="AreaImagemImagem' . $arrayCampos[$i] . '"><img src="' . $vCaminho . $arrayImagens[$i] . '" width="200" height="200" border="0" /></div>';
												echo '<div id="AreaImagemBotao' . $arrayCampos[$i] . '"><a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&ida=' . $vgetId . '&o=' . $vgetOrigem . '&c=' . $arrayCampos[$i] . '" target="direcionar"><br /><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; width: 100px\'>&nbsp;excluir imagem&nbsp;</div></a></div>';
												
											} else {
												echo '<div id="AreaImagemImagem' . $arrayCampos[$i] . '"><img src="images/imagem_indisponivel.png" width="200" height="200" border="0" /></div>';
												echo '<div id="AreaImagemBotao' . $arrayCampos[$i] . '"><br /><form method="post" action="enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=' . $vgetOrigem . '&c=' . $arrayCampos[$i] . '&ida=' . $vgetId . '" target="direcionar" enctype="multipart/form-data"><input type="file" name="FormFileImagem" onChange="javascript: submit()" /></form></div>';
												
												echo '<div id="AreaImagemBox' . $arrayCampos[$i] . '" style="display: none; width: 100%; background: #FF0040; border: #DF0101 1px solid; padding: 10px; margin-top: 15px; color: #ffffff"><div id="AreaImagemTexto" style="text-align: center"></div></div>';
												
											}
											echo '<br/><hr style="border: none; border-top: #cccccc 1px solid; width: 400px"/><br/>';
										}
										
									} else {
										echo '<div style="display: table; padding: 10px; padding-left: 30px; padding-right: 30px; border-top: #cccccc 1px solid; border-bottom: #cccccc 1px solid;font-size: 20px">';
										echo 'Descri&ccedil;&atilde;o: <strong>' . $vDescricao . '</strong>';
										echo '</div><br/><br/>';
										
										if (fSeImagem($vImagem ) && file_exists($vCaminho . $vImagem)) {
											echo '<div id="AreaImagemImagem"><img src="' . $vCaminho . $vImagem . '" width="200" height="200" border="0" /></div>';
											echo '<div id="AreaImagemBotao"><a href="excluir_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&ida=' . $vgetId . '&o=' . $vgetOrigem . '&c=' . $vCampo . '" target="direcionar"><br /><div style=\'background: #999999; height: 20px; border-right: #666666 1px solid; border-bottom: #666666 1px solid; padding: 3px; font-size: 12px; font-family: tahoma, arial; color: #ffffff; width: 100px\'>&nbsp;excluir imagem&nbsp;</div></a></div>';
											
										} else {
											echo '<div id="AreaImagemImagem"><img src="images/imagem_indisponivel.png" width="200" height="200" border="0" /></div>';
											echo '<div id="AreaImagemBotao"><br /><form method="post" action="enviar_imagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=' . $vgetOrigem . '&c=' . $vCampo . '&ida=' . $vgetId . '" target="direcionar" enctype="multipart/form-data"><input type="file" name="FormFileImagem" onChange="javascript: submit()" /></form></div>';
											
											echo '<div id="AreaImagemBox" style="display: none; width: 100%; background: #FF0040; border: #DF0101 1px solid; padding: 10px; margin-top: 15px; color: #ffffff"><div id="AreaImagemTexto" style="text-align: center"></div></div>';
											
										}

									}
									?>
								</div>
								
								<iframe src="vazio.php" name="direcionar" scrolling="yes" frameborder="0" width="1" height="1"></iframe>

							</div>

							<div id="boxDIALOGO"></div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</body>
</html>