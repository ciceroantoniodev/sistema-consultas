<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title><?=$vHeadTitle?></title>
		
		<meta http-equiv="content-language" content="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="description" content="Petrolina Piscinas é uma empresa especializada na construção de piscinas e áreas de lazer, trabalhando com qualidade superior e inovação." />
		<meta name="robots" content="index, follow"> 
		
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="http://www.petrolinapiscinas.com.br">
		<meta property="og:title" content="Petrolina Piscinas">
		<meta property="og:site_name" content="Petrolina Piscinas">
		<meta property="og:description" content="Petrolina Piscinas é uma empresa especializada na construção de piscinas e áreas de lazer, trabalhando com qualidade superior e inovação.">
		<meta property="og:image" content="http://www.petrolinapiscinas.com.br/docs/fotos/empresa/2019-11-21.jpg">
		<meta property="og:image:type" content="image/jpeg">
		<meta property="og:image:width" content="400">
		<meta property="og:image:height" content="238">
		<meta property="og:type" content="website">
		
		<meta name="author" content="SAMSITE Web Design Sistemas">
		<meta name="reply-to" content="suporte@samsite.com.br">
		
		<link rel="icon" type="image/x-icon" href="<?=$vUrlPadrao?>/images/petrolina-piscinas-favicon.png" />
				
		<link href="https://fonts.googleapis.com/css?family=Dosis|Hammersmith+One|Open+Sans|Raleway:200" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/social-style.css">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/fontawesome.min.css">

		<script src="<?php echo $vUrlPadrao ?>/assets/js/geral002.js"></script>
		<script src="<?php echo $vUrlPadrao ?>/assets/js/query_redirect.js"></script>
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<style>
			<!--
			.label_ { margin: 0px; padding: 0px; }
			
			.edit-login { margin: 0px; padding: 0px; }

			.submit_ { 
				background: #0a993a;
				border: #14ba4c 5px solid;
				border-radius: 25px;
				color: #ffffff;
				font-family: SegoMedium;
				font-size: 24px;
				font-weight: normal;
				padding: 6px;
				margin: auto;
				width: 170px;
			}
			
			#area-aviso {
				background: #f77460;
				border: #ff8370 10px solid;
				border-radius: 25px;
				color: #ffffff;
				display: none;
				font-family: SegoMedium;
				font-size: 16px;
				font-weight: normal;
				padding: 10px;
				margin: auto;
				margin-bottom: 15px;
				width: 500px;
			}
			
			div.planos_indisponivel {
				position: absolute;
				widht: 100%;
				z-index: 99;
			}
			
			.item-produto {
				border-bottom: 2px #dddddd solid;
				margin-bottom: 10px;
				padding-bottom: 10px;
			}
			
			.item-descricao {
				font-style: italic;
				margin-top: 30px;
				margin-bottom: 30px;
			}
			-->
		</style>	
		
		<link rel="stylesheet" type="text/css" href="<?php echo $vUrlPadrao ?>/assets/css/estilo008.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo $vUrlPadrao ?>/assets/css/media006.css"/>

		<script type="text/javascript">
		var $w = $(window);

		$w.on("menu", function(){
		   if( $w.menuTop() > 300 ) {
			   document.getElementById("botao_up").style.display = "block";
			   
		   } else {
			   document.getElementById("botao_up").style.display = "none";
			   
		   }
		});
		</script>
		
	</head>
	<body>
		<?php
		include "header_interno.php";
		?>

		<section id="area-internas">
			
			<br><br>
			
			<div class="container">
				
				<div class="row">
					<div class="col">
						<?php
						$c = 1;

						echo '<div class="tableCategorias">';

						for ($i = 0; $i < count($arrayCategorias); $i++) {
							
							echo '	<div class="tableCategoriasTd"><div><a href="' . $vUrlPadrao . '/produtos/categoria/' . $arrayCategorias[$i]['Link'] . '" class="produtos">' . $arrayCategorias[$i]['Nome'] . '</a></div></div>';
							
						}
						
						echo '</div>';
						?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12"><br><br>
						<h1 class="tit-produtos"><?php echo $arrayProdutos['Nome'] ?></h1>
						
						<?php
						if (trim($arrayProdutos['SubTitulo']) != "") {
							echo '<h3 class="sub-tit-produtos">' . $arrayProdutos['SubTitulo'] . '</h3>';
						}
						?>
					</div>
				</div>
				
				<br><br>
				
				<div class="row">

					<div class="col-md-6">
						<div id="box-produtos-detalhes-txt">
							<br>
							<?php

							if (strpos("_".$_SESSION['sysOrcamento'], '['.$arrayProdutos['Id'].']') > 0) {
								echo '<a href="' . $vUrlPadrao . '/orcamento" class="orcamento"><div class="btn-add-orcamento"><span style="font-size: 18px">Produto Adicionado ao</span><br>Orçamento</div></a><br><br>';
								
							} else {
								echo '<div id="areaAdicionar"><button class="btn-orcamento" onClick="fAddOrcamento(' . $arrayProdutos['Id'] . ', \'' . $vUrlPadrao . '\')"><span style="font-size: 18px">Adicionar ao</span><br>Orçamento</button><br><br></div>';
								
							}

							if (!empty($arrayProdutos['Diametro'])) {
								echo '<div class="item-produto"><strong>Diametro:</strong> ' . $arrayProdutos['Diametro'] . '</div>';
							}
							
							if (!empty($arrayProdutos['Cumprimento'])) {
								echo '<div class="item-produto"><strong>Cumprimento:</strong> ' . $arrayProdutos['Cumprimento'] . '</div>';
							}
							
							if (!empty($arrayProdutos['Largura'])) {
								echo '<div class="item-produto"><strong>Largura:</strong> ' . $arrayProdutos['Largura'] . '</div>';
							}
							
							if (!empty($arrayProdutos['Altura'])) {
								echo '<div class="item-produto"><strong>Altura:</strong> ' . $arrayProdutos['Altura'] . '</div>';
							}
							
							if (!empty($arrayProdutos['Profundidade'])) {
								echo '<div class="item-produto"><strong>Profundidade:</strong> ' . $arrayProdutos['Profundidade'] . '</div>';
							}
							
							if (!empty($arrayProdutos['Borda'])) {
								echo '<div class="item-produto"><strong>Borda:</strong> ' . $arrayProdutos['Borda'] . '</div>';
							}
							
							if (!empty($arrayProdutos['BordaAreia'])) {
								echo '<div class="item-produto"><strong>Borda Areia:</strong> ' . $arrayProdutos['BordaAreia'] . '</div>';
							}
							
							if ($arrayProdutos['TemCores']=="S") {
								$aCores = explode(";", $arrayProdutos['Cores']);
								$vCores = "";
								
								foreach($aCores AS $vCor) {
									if (!empty($vCor)) {
										$vCores .= '<div style="float: left; width: 23px; height: 23px; border: #dddddd 1px solid; border-radius: 25px; background: ' . $vCor. '">&nbsp;</div>';
									}
								}
								
								echo '<div class="item-produto"><div style="display: table"><div style="float: left"><strong>Cores:&nbsp;&nbsp;</strong></div> ' . $vCores . '</div></div>';
								echo '<div class="clear"></div>';
							}
							
							if (!empty($arrayProdutos['Descricao'])) {
								echo '<div class="item-descricao">' . $arrayProdutos['Descricao'] . '</div>';
							}
							
							if (!empty($arrayProdutos['Especificacoes'])) {
								echo '<h5 class="sub-tit-detalhes">Especificações&nbsp;&nbsp;&nbsp;</h5><br>';
								
								echo $arrayProdutos['Especificacoes'];
								
								echo '<br><br>';
							}
							
							if (!empty($arrayProdutos['Caracteristicas'])) {
								echo '<h5 class="sub-tit-detalhes">Caractéristicas Técnicas&nbsp;&nbsp;&nbsp;</h5><br>';
								
								echo $arrayProdutos['Caracteristicas'];
								
							}
							?>
							<br><br><br>
							
						</div>
					</div>
					<div class="col-md-6">
						<div id="box-produtos-detalhes-img">
							<?php 
							if (fSeImagem($arrayProdutos['Foto1']) && file_exists('docs/fotos/produtos/' . $arrayProdutos['Foto1'])) {
								echo '<figure><img id="imgPrincipal" src="'. $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto1'] . '" border="0"></figure>';
							
								echo '<div id="box-produtos-miniaturas">';
								echo '	<table id="tbl-miniaturas" border="0">';
								echo '		<tr>';
								echo '			<td>';
								
								if (fSeImagem($arrayProdutos['Foto1']) && file_exists('docs/fotos/produtos/' . $arrayProdutos['Foto1'])) {
									echo '<a href="javascript: fAmpliarMiniatura(\'' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto1'] . '\')"><figure class="fig-miniatura"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto1'] . '" border="0"></figure></a>';
									
								}
								
								echo '			</td>';
								echo '			<td>';
								
								if (fSeImagem($arrayProdutos['Foto2']) && file_exists('docs/fotos/produtos/' . $arrayProdutos['Foto2'])) {
									echo '<a href="javascript: fAmpliarMiniatura(\'' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto2'] . '\')"><figure class="fig-miniatura"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto2'] . '" border="0"></figure></a>';
									
								}
								
								echo '			</td>';
								echo '			<td>';
								
								if (fSeImagem($arrayProdutos['Foto3']) && file_exists('docs/fotos/produtos/' . $arrayProdutos['Foto3'])) {
									echo '<a href="javascript: fAmpliarMiniatura(\'' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto3'] . '\')"><figure class="fig-miniatura"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto3'] . '" border="0"></figure></a>';
									
								}
								
								echo '			</td>';
								echo '			<td>';
								
								if (fSeImagem($arrayProdutos['Foto4']) && file_exists('docs/fotos/produtos/' . $arrayProdutos['Foto4'])) {
									echo '<a href="javascript: fAmpliarMiniatura(\'' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto4'] . '\')"><figure class="fig-miniatura"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto4'] . '" border="0"></figure></a>';
									
								}
								
								echo '			</td>';
								echo '			<td>';
								
								if (fSeImagem($arrayProdutos['Foto5']) && file_exists('docs/fotos/produtos/' . $arrayProdutos['Foto5'])) {
									echo '<a href="javascript: fAmpliarMiniatura(\'' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto5'] . '\')"><figure class="fig-miniatura"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos['Foto5'] . '" border="0"></figure></a>';
									
								}
								
								echo '			</td>';
								echo '		</tr>';
								echo '	</table>';
								echo '</div>';
								
							} else {
								echo '<figure style="margin: auto; display: table;"><img src="'. $vUrlPadrao . '/images/imagem_indisponivel.png" border="0" style="margin: 15px"></figure>';

							}
							?>
							
						</div>
					</div>

				</div>
				
				<br><br>

				<div class="row">
					<div class="col-md-12">
						<h2>Produtos Relacionados</h2>
					</div>
				</div>
				
				<br><br>

				<?php
				$vSql = "";
				$vSql1 = "";
				
				$vProdutosRelacionados = trim($arrayProdutos['Relacionados']);
				$vProdutosRelacionados = str_replace("][", "|",  $vProdutosRelacionados);
				$vProdutosRelacionados = str_replace("[", "",  $vProdutosRelacionados);
				$vProdutosRelacionados = str_replace("]", "",  $vProdutosRelacionados);
				
				$arrayRelacionados = explode("|", $vProdutosRelacionados);
				
				if (count($arrayRelacionados) >= 4) {
					
					for ($i = 0; $i < count($arrayRelacionados); $i++) {
						
						if ($i > 0) { $vSql .= ' OR '; }
						
						$vSql .= '(id=' . $arrayRelacionados[$i] . ')';
						
					}
					
					$vQuery = "SELECT * FROM sysc_produtos WHERE $vSql";
					
				} else {

					$vProdutosRelacionados = trim($arrayProdutos['Categorias']);
					$vProdutosRelacionados = str_replace("][", "|",  $vProdutosRelacionados);
					$vProdutosRelacionados = str_replace("[", "",  $vProdutosRelacionados);
					$vProdutosRelacionados = str_replace("]", "",  $vProdutosRelacionados);
					
					$arrayRelacionados = explode("|", $vProdutosRelacionados);
					
					for ($i = 0; $i < count($arrayRelacionados); $i++) {
						
						if ($i > 0) { $vSql .= ' OR '; }
						
						$vSql .= '(id_categoria LIKE \'%[' . $arrayRelacionados[$i] . ']%\')';
						
					}					
					
					
					$vTags = $arrayProdutos['Tags'] . ';';
					
					$vTagsSim = false;
					
					$arrayTags = explode(";", $vTags);
					
					
					for ($i = 0; $i < count($arrayTags); $i++) {

						if (trim(" ".$arrayTags[$i]) != "") {

							if ($i > 0) { $vSql1 .= ' OR '; }

							$vSql1 .= '(tags LIKE \'%' . $arrayTags[$i] . '%\')';
							$vSql1 .= ' OR (nome LIKE \'%' . $arrayTags[$i] . '%\')';
							$vSql1 .= ' OR (subtitulo LIKE \'%' . $arrayTags[$i] . '%\')';

							$vTagsSim = true;
						}

					}		

					$vQuery = "SELECT * FROM sysc_produtos WHERE $vSql";

					if ($vTagsSim) {
						$vQuery .= " OR " . $vSql1;

					}

				}

				$arrayRelacionados = Array();
				$i = 0;
				
				$vSql = "(id <> " . $arrayProdutos['Id'] . ")";
				
				$queryProdutos = $vConexao->query($vQuery) or die ("Falha ao tentar conexao: Produtos_373");

					while ($reProdutos = mysqli_fetch_assoc($queryProdutos)) {
						
						if ($reProdutos['id'] != $arrayProdutos['Id']) {
							
							$vSql .= " AND (id <> " . $reProdutos['id'] . ")";
							
							$arrayRelacionados[$i] = Array(
														"Id"=>$reProdutos['id'],
														"Nome"=>$reProdutos['nome'],
														"Foto"=>$reProdutos['foto_capa'],
														"Link"=>$reProdutos['link']
													 );

							$i++;
							
							if ($i > 3) { break; }
							
						}
						
					}
					
				mysqli_free_result($queryProdutos);
	
	
				if ($i <= 3) {
		
					$i--;		
					
					$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtos WHERE $vSql ORDER BY id DESC") or die ("Falha ao tentar conexao: Produtos_398");

						while ($reProdutos = mysqli_fetch_assoc($queryProdutos)) {
							
							$arrayRelacionados[$i] = Array(
														"Id"=>$reProdutos['id'],
														"Nome"=>$reProdutos['nome'],
														"Foto"=>$reProdutos['foto_capa'],
														"Link"=>$reProdutos['link']
													 );

							$i++;
							
							if ($i > 3) { break; }
							
						}
						
					mysqli_free_result($queryProdutos);

				}

				?>
				<div class="row">
					<?php
					for ($i = 0; $i < count($arrayRelacionados); $i++) {
						
						echo '<div class="col-md-3">';
							
						echo '	<a href="' . $vUrlPadrao . '/produtos/' . $sysAcao  . '/' . $arrayRelacionados[$i]['Link'] . '" class="categorias">';
						echo '	<article class="categorias-list"><figure>';
						
						$vProdutoFoto = 'docs/fotos/produtos/' . trim($arrayRelacionados[$i]['Foto']);

						if (fSeImagem($vProdutoFoto) && file_exists($vPastaLocal . '/' . $vProdutoFoto)) {
							echo '<img src="' . $vUrlPadrao . '/' . $vProdutoFoto . '" border="0" class="img-responsive">';
							
						} else {
							echo '<img src="' . $vUrlPadrao . '/images/imagem_indisponivel.png" border="0" class="img-responsive">';
							
						}
						
						echo '		</figure><h2 class="categorias-nome">' . $arrayRelacionados[$i]['Nome'] . '</h2>';
						echo '	</article>';
						echo '	</a>';
						
						echo '</div>';
						
					}
					?>
				</div>

			</div><!--container-->
			
			<br><br>
			
		</section>

		<?php
		include "rodape.php";
		?>
		
		<div id="botao_up">
			<a id="subir" href="#" title="Voltar ao topo"><img src="docs/images/up.png" alt="Voltar ao topo" border="0" /></a>
		</div>
			
		<script>window.jQuery || document.write('<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/jquery-slim.min.js"><\/script>')</script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/popper.min.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/holder.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
			   $('#subir').click(function(){ 
					$('html, body').animate({menuTop:0}, 'slow');
					return false;
				 });
				
			 });
		</script>
	</body>
</html>				