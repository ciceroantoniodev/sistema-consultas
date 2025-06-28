<?php
header("Content-Type: text/html; charset=UTF-8",true);

session_start();

$vHeadTitle = "Panevale - Máquinas e Equipamentos";
$vHeadUrl = "http://www.panevale.com";
$vHeadImage = "www.panevale.com/docs/banners/banner-rede-social.jpg";

include_once("assets/include/conexao.php");
include_once("assets/include/funcoes.php");

include_once("route.php");

if (strpos("_".$sysParametros, "query_orcamento") > 0) {
	$_SESSION['sysOrcamento'] .= '['.$vIdProduto.']';
	
	echo '<a href="' . $vUrlPadrao . '/orcamento" class="orcamento"><div class="btn-add-orcamento"><span style="font-size: 18px">Produto Adicionado ao</span> Orçamento</div></a><br/><br/>';

} else if (strpos("_".$sysParametros, "delete_orcamento") > 0) {
	
	$vDelRelacao = $_SESSION['sysOrcamento'];
	$vDelRelacao = str_replace("][", "|", $vDelRelacao);
	$vDelRelacao = str_replace("[", "", $vDelRelacao);
	$vDelRelacao = str_replace("]", "", $vDelRelacao);
	
	$arrayRelacao = explode("|", $vDelRelacao);
	
	$vDelRelacao = "";

	foreach ($arrayRelacao AS $vDados) {
		
		if ($vDados != $vIdProduto) {
			$vDelRelacao .= '['.$vDados.']';

		}
		
	}

	$_SESSION['sysOrcamento'] = $vDelRelacao;
	

} else {
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
			
			<link rel="icon" type="image/x-icon" href="<?php echo $vUrlPadrao ?>/images/wl-aluminio-favicon.png" />
			
			<link href="https://fonts.googleapis.com/css?family=Dosis|Hammersmith+One|Open+Sans|Raleway:200" rel="stylesheet">

			<!-- Bootstrap -->
			<link href="<?php echo $vUrlPadrao ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
			<link href="<?php echo $vUrlPadrao ?>/assets/css/estilo008.css" rel="stylesheet">

			<script src="<?php echo $vUrlPadrao ?>/assets/js/geral002.js"></script>
			<script src="<?php echo $vUrlPadrao ?>/assets/js/query_redirect.js"></script>
			
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
				<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
			
			<style>
				<!--
				ul#empresa-fotos {         
					padding:0 0 0 0;
					margin:0 0 0 0;
				}
				
				ul#empresa-fotos li {     
					list-style:none;
					margin-bottom:25px;           
				}
				
				ul#empresa-fotos li img {
					cursor: pointer;
				}
				
				.modal-body {
					padding:5px !important;
				}
				
				.modal-content {
					border-radius:0;
				}
				
				.modal-dialog img {
					text-align:center;
					margin:0 auto;
					width: 800px;
				}
				
				.controls {
					width:80px;
					display:block;
					font-size:12px;
					padding-top:8px;
					font-weight:bold;          
				}
				
				.next {
					float:right;
					text-align:right;
				}
				
				/* override modal for demo only */
				
				.modal-dialog {
					padding-top: 20px;
					width: 800px;
				}
				
				
				@media screen and (min-width: 768px) {
					.modal-dialog { width:800px; padding-top: 20px;	}    
				}
				
				
				@media screen and (max-width:1500px) {
					#ads { display:none; }
				}
				-->
			</style>

			<link href="<?php echo $vUrlPadrao ?>/assets/css/media006.css" rel="stylesheet">
	  
		</head>
		<body>

			<?php
			include_once("topo.php");

			include_once( $vInclude );
			
			include_once("rodape.php");
			?>
			
		</body>
	</html>
<?php
}
?>