<?php
$arrayCategorias= Array();
$arraySubCategorias= Array();

$vCategoriaId = 0;
$vCategoriaNome = "";

$queryCategorias= $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE link='$sysAcao'") or die ("Falha ao tentar conexão: 9_CATEGORIAS");
	
	$reCategorias = mysqli_fetch_assoc($queryCategorias);
	
	$vCategoriaId = $reCategorias['id'];
	$vCategoriaNome = $reCategorias['nome'];
	
mysqli_free_result($queryCategorias);

$aProdutos = [];
$aSubMenu = [];

$i = 0;
$p = 0;
$m = 0;

$vSql = "";

$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE ativo='S' AND id_pai=$vCategoriaId ORDER BY ordem, nome") or die ("Falha ao tentar se conectar com Links");
	while ($reProdutos = mysqli_fetch_assoc($queryProdutos)) {
		
		if ($reProdutos['tipo']=="grupo") {
			$aSubMenu[$m] = [ "Nome"=>$reProdutos['nome'], "Link"=>$reProdutos['link'] ];
			
			$m++;
			
		}
		
		if ($reProdutos['tipo']=="subgrupo") {
			if ($reProdutos['produtos_categoria']=="proprio") {
				$aProdutos['Proprio'][$p] = 	[
										"Id"=>$reProdutos['id'],
										"Nome"=>$reProdutos['nome'],
										"Foto"=>$reProdutos['imagem'],
										"Link"=>$reProdutos['link'],
										"ProdutosCategoria"=>$reProdutos['produtos_categoria']
									];
				
				$p++;
				
			} else {
				$aProdutos['Outros'][$i] = 	[
										"Id"=>$reProdutos['id'],
										"Nome"=>$reProdutos['nome'],
										"Foto"=>$reProdutos['imagem'],
										"Link"=>$reProdutos['link'],
										"ProdutosCategoria"=>$reProdutos['produtos_categoria']
									];
				
				$i++;
				
			}
		}
		
	}
mysqli_free_result($queryProdutos);
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
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/social-style.css">
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
			
				<div class="container-fluid">
					
					<br><br>
					
					<div class="row">
						<div class="col-md-12"><br><br><div id="areaTitulos"><h1 class="tit-categorias"><?=$vCategoriaNome?></h1></div><br><br></div>
					</div>

					<?php
					echo '<div class="row">';
						
						if (isset($aProdutos['Outros']) && count($aProdutos['Outros'])>0) {
							foreach ($aProdutos['Outros'] AS $aDados) {
								
								echo '<div class="col-6 col-sn-4 col-md-3">';
									
									echo '<a href="' . $vUrlPadrao . '/produtos/categoria/' . $aDados['Link'] . '" title="' . $aDados['Nome'] . '" class="categorias">';
									echo '	<article class="home-categorias">';
										echo '<figure class="categorias-img"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $aDados['Foto'] . '" style="width: 100%" border="0"></figure>';
										echo '<h2>' . $aDados['Nome'] . '</h2>';
									echo '	</article>';
									echo '</a>';
							
								echo '</div>';
									
							}
						}
						
					echo '</div>';
					
					echo '<div class="row">';
						
						if (isset($aProdutos['Proprio']) && count($aProdutos['Proprio'])>0) {
							foreach ($aProdutos['Proprio'] AS $aDados) {
								
								echo '<div class="col-12 col-sn-6 col-md-6">';
									
									echo '<a href="' . $vUrlPadrao . '/produtos/categoria/' . $aDados['Link'] . '" title="' . $aDados['Nome'] . '" class="categorias">';
									echo '	<article class="home-categorias">';
										echo '<figure style="height: 220px; max-height: 220px; margin: auto; width: 90%"><img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $aDados['Foto'] . '" style="width: 100%" border="0"></figure>';
										echo '<h2>' . $aDados['Nome'] . '</h2>';
									echo '	</article>';
									echo '</a>';
							
								echo '</div>';
									
							}
						}
						
					echo '</div>';
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