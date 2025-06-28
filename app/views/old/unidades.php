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
			
			.foto-01 {
				margin: auto;
				width: 300px;
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
		
			<div class="container">
			
				<div class="row">
					<div class="col-md-12"><br/><br/><div id="areaTitulos"><h1 class="tit-categorias">Lojas</h1></div><br/><br/><br/></div>
				</div>
				
				<div class="row">
					<div class="col-md-6 text-center">
						<figure class="foto-01"><img src="docs/fotos/empresa/petrolina_piscinas_unidade_matriz.jpg" style="width: 100%" border="0"/></figure>
						<br><br>
						<h2>Matriz</h2>
						<h5>Av. da Integra&ccedil;&atilde;o, 42 - Gercino Coelho</h5>
						<h5>Petrolina/PE - Cep. 56306-150</h5>
						<h5>Fone: (87) 3867-0396</h5>
						<br/><br/>
					</div>
					<div class="col-md-6 text-center">
						<figure class="foto-01"><img src="docs/fotos/empresa/petrolina_piscinas_unidade_cohab.jpg" style="width: 100%" border="0"/></figure>
						<br><br>
						<h2>Filial Cohab</h2>
						<h5>Av. M&aacute;rio Rodrigues Coelho - Cohab IV</h5>
						<h5>Petrolina/PE - Cep. 56313-275</h5>
						<h5>Fone: (87) 99951 2080</h5>
						<br/><br/>
					</div>
				</div>
				
			</div><!--container-->

			<br/><br/>
			
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