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
		
		<link rel="icon" type="image/x-icon" href="<?php echo $vUrlPadrao ?>/images/wl-aluminio-favicon.png" />
		
		<link href="https://fonts.googleapis.com/css?family=Dosis|Hammersmith+One|Open+Sans|Raleway:200" rel="stylesheet">

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
					<div class="col-md-12"><br/><br/><div id="areaTitulos"><h1 class="tit-categorias">Representantes</h1></div><br/><br/><br/></div>
				</div>
				
				
				<div id="areaDirect">
					<?php
					$c = 1;
					$vformEstado = 'CE';

					$queryRepresentantes = $vConexao->query("SELECT * FROM sysc_usuarios WHERE ativo='S' AND cargo='Representante' AND obs LIKE '%[$vformEstado]%' ORDER BY nome") or die ("Falha ao tentar conexão com Representantes");
						while ($reRepresentantes = mysqli_fetch_assoc($queryRepresentantes)) {
							if ($c <= 1) {
								echo '<div class="row">';
								
							}
							
							$vContatos = "<strong>Contato:</strong> ";
							
							if (strlen(trim($reRepresentantes['celular1'])) >= 7) {
								$vCelular = trim(str_replace("-", "", str_replace("_", "", $reRepresentantes['celular1'])));
								
								$vContatos .= '(' . trim($reRepresentantes['dddcelular1']) . ') ' . substr($vCelular, 0, (strlen($vCelular)-4)) . '-' . substr($vCelular, (strlen($vCelular)-4));
								
								if (trim($reRepresentantes['operadora1']) != "") {
									$vContatos .= " " . trim($reRepresentantes['operadora1']);
								
								}

							} else {
								$vCelular = "";

							}
							
							if (strlen(trim($reRepresentantes['celular2'])) >= 7) {
								if ($vCelular != "") {
									$vContatos .= " / ";
									
								}
								
								$vCelular = trim(str_replace("-", "", str_replace("_", "", $reRepresentantes['celular2'])));
								
								$vContatos .= '(' . trim($reRepresentantes['dddcelular2']) . ') ' . substr($vCelular, 0, (strlen($vCelular)-4)) . '-' . substr($vCelular, (strlen($vCelular)-4));
								
								if (trim($reRepresentantes['operadora2']) != "") {
									$vContatos .= " " . trim($reRepresentantes['operadora2']);
								
								}

							} else {
								$vCelular = "";

							}
							
							if (strlen(trim($reRepresentantes['celular3'])) >= 7) {
								if ($vCelular != "") {
									$vContatos .= " / ";
									
								}
								
								$vCelular = trim(str_replace("-", "", str_replace("_", "", $reRepresentantes['celular3'])));
								
								$vContatos .= '(' . trim($reRepresentantes['dddcelular3']) . ') ' . substr($vCelular, 0, (strlen($vCelular)-4)) . '-' . substr($vCelular, (strlen($vCelular)-4));
								
								if (trim($reRepresentantes['operadora3']) != "") {
									$vContatos .= " " . trim($reRepresentantes['operadora3']);
								
								}

							} else {
								$vCelular = "";

							}
							
							if (strlen($vContatos) > 25) {
								$vContatos = str_replace("Contato:", "Contatos:", $vContatos);
								
							}
							
							echo '<div class="col-md-6">';
							echo '	<figure class="fig-repres-user"><img src="' . $vUrlPadrao . '/docs/fotos/usuarios/' . $reRepresentantes['foto'] . '" border="0" alt=""/></figure>';
							echo '	<div class="area-repres-dados">';
							echo '		<h2 class="nome-representantes">' . $reRepresentantes['nome'] . '</h2>';
							echo '		<h4>' . $reRepresentantes['cargo'] . '</h4>';
							echo '		<p>' . $vContatos . '</p>';
							echo '		<p><strong>WhatsApp:</strong> ' . $reRepresentantes['whatsapp'] . '</p>';
							echo '		<p><strong>E-mail:</strong> ' . $reRepresentantes['email_proprio'] . '</p>';
							
							$vObs = '%%'.$reRepresentantes['obs'];
							
							while (true) {
								$vPos1 = strpos($vObs, "[");
								$vPos2 = strpos($vObs, "]");
								
								if ($vPos1 > 0 && $vPos2 > 0) {
									$vStr1 = substr($vObs, 0, $vPos1);
									$vStr2 = substr($vObs, ($vPos2+1));
									
									$vObs = $vStr1 . $vStr2;

								} else {
									if ($vPos1 > 0 || $vPos2 > 0) {
										$vObs = str_replace("[", "", $vObs);
										$vObs = str_replace("]", "", $vObs);
										
									} else {
										$vObs = str_replace("%%", "", $vObs);
										
										break;
										
									}
								}
							}
							
							echo '		<p>' . $vObs . '</p>';
							echo '	</div><br/><br/>';
							echo '</div>';
							
							$c++;
							
							if ($c >= 3) {
								echo '</div>';
								
								$c = 1;
								
							}
							
						}
					mysqli_free_result($queryRepresentantes);
					
					if ($c <= 2) {
						echo '</div>';
						
					}
					?>
				</div><!--areaDirect-->
				
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