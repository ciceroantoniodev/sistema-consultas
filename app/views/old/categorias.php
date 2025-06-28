<?php
$arrayCategorias= Array();
$arraySubCategorias= Array();

$vCategoriaId = 0;
$vCategoriaNome = "";
$vCategoriaPrincipal = "";

$queryCategorias= $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE link='$sysParametros'") or die ("Falha ao tentar conexão: 9_CATEGORIAS");
	
	$reCategorias = mysqli_fetch_assoc($queryCategorias);
	
	$vCategoriaId = $reCategorias['id'];
	$vCategoriaIdPai = $reCategorias['id_pai'];
	$vCategoriaNome = $reCategorias['nome'];
	
mysqli_free_result($queryCategorias);


$queryCategorias= $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE ativo='S'") or die ("Falha ao tentar conexão com CATEGORIAS");
	
	$i = 0;
	$x = 0;

	while ($reCategorias = mysqli_fetch_assoc($queryCategorias)) {
	
		if ($reCategorias['id_pai'] == $vCategoriaIdPai) {
			if ($reCategorias['id'] != $vCategoriaId) {
			
				$arrayCategorias[$i] = 	Array(
											"Id"=>$reCategorias['id'],
											"IdPai"=>$reCategorias['id_pai'],
											"Nome"=>$reCategorias['nome'],
											"Imagem"=>$reCategorias['imagem'],
											"Link"=>$reCategorias['link']
										 );
				$i++;
				
			} 
		} 
		
		if ($reCategorias['id'] == $vCategoriaIdPai) {
			$vCategoriaPrincipal = $reCategorias['nome'];
			
		}	
	}

mysqli_free_result($queryCategorias);
?>
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
		<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/fontawesome.min.css">

		<script src="<?=$vUrlPadrao?>/assets/js/geral002.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/js/query_redirect.js"></script>
		
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
		
		<main role="main">
		
			<section id="area-categorias">
			
				<br/><br/>
				
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
						<div class="col-md-12">
							<br><br>

							<div id="areaTitulos">
								<div align="left" style="color: #fa6b86; font-size: 22px; border-bottom: #001a4c 1px solid"><?=$vCategoriaPrincipal ?></div>
								<h1 class="tit-categorias"><?=$vCategoriaNome?></h1>
							</div>
							
							<br><br>
						</div>
					</div>

					<?php
					$c = 1;

					$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtos WHERE id_categoria LIKE '%[$vCategoriaId]%'") or die ("Falha ao tentar conexão com Produtos");
						
						echo '<div class="row">';
						
						while ($reProdutos = mysqli_fetch_assoc($queryProdutos)) {
							
							echo '<div class="col-6 col-sn-4 col-md-3">';
							echo '	<a href="' . $vUrlPadrao . '/produtos/' . $sysParametros  . '/' . $reProdutos['link'] . '" class="categorias">';
							echo '	<article class="categorias-list"><figure>';
							
							$vProdutoFoto = 'docs/fotos/produtos/' . trim($reProdutos['foto_capa']);

							if (fSeImagem($vProdutoFoto) && file_exists($vPastaLocal . '/' . $vProdutoFoto)) {
								echo '<img src="' . $vUrlPadrao . '/' . $vProdutoFoto . '" border="0" class="img-responsive">';
								
							} else {
								echo '<img src="' . $vUrlPadrao . '/images/imagem_indisponivel.png" border="0" class="img-responsive">';
								
							}
							
							echo '		</figure>';
							echo '		<h2 class="categorias-nome">' . $reProdutos['nome'] . '</h2>';
							echo '		<div style="font-size: 14px">';
							echo '		<div>Tamanho: <strong>';
							
							if (!empty($reProdutos['caract_diametro'])) {
								echo $reProdutos['caract_diametro'] . ' x ' . $reProdutos['caract_diametro'];
								
							} else {
								if (!empty($reProdutos['caract_altura'])) {
									echo $reProdutos['caract_altura'] . ' x ';
								}
								
								echo $reProdutos['caract_comprimento'] . ' x ' . $reProdutos['caract_largura'];
								
							}
							
							echo '		</strong></div>';
							
							if (!empty($reProdutos['caract_profundidade'])) {
								echo '		<div>Profundidade: <strong>' . $reProdutos['caract_profundidade'] . '</strong></div>';
								
							}
							
							if (!empty($reProdutos['caract_borda'])) {
								echo '		<div>Borda: <strong>' . $reProdutos['caract_borda'] . (!empty($reProdutos['caract_bordaareia']) ? ' x ' . $reProdutos['caract_bordaareia'] . ' <span style="font-size: 12px; font-style: italic">(borda areia)</span>' : '') . '</strong></div>';
							
							}
							
							echo '	</article>';
							echo '	</a>';
							echo '</div>';
							
						}
						
						echo '</div>';
					mysqli_free_result($queryProdutos);
					
					if ($c <= 5) {
						echo '<div class="col-md-1"></div></div>';
						
					}
					?>

				</div><!--container-->

					
					<div class="clear"><br><br></div>

				</section>
				
		</main>
				
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