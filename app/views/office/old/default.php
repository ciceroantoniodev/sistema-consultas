<?php
header("Content-Type: text/html; charset=UTF-8",true);

session_start();

$vFuncao = $_SESSION['syscFUNCAO'];

$vLocal = isset($_GET["local"]) ? $_GET["local"] : NULL;
$vLogOff = isset($_GET["log"]) ? $_GET["log"] : NULL;

if ($vLogOff == "of") {
	$_SESSION['syscID'] = "";
	$_SESSION['syscNOME'] = "";
	$_SESSION['syscFUNCAO'] = "";
	$_SESSION['syscFOTO'] = "";
	$_SESSION['syscSEXO'] = "";
	
	header("Location: ../index.php");
	
}

include "documentos/include/funcoes.php";
include "js_.php";


$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;


if (fSeImagem($_SESSION['syscFOTO']) && file_exists("../docs/fotos/usuarios/" . $_SESSION['syscFOTO'])) {
	$vFotoPerfil = "../docs/fotos/usuarios/" . $_SESSION['syscFOTO'];

} else {
	if ($_SESSION['syscSEXO'] == "F") {
		$vFotoPerfil = "images/semfoto_feminino.jpg";
		
	} else {
		$vFotoPerfil = "images/semfoto_masculino.jpg";
		
	}
}

$vNomePerfil = str_replace(" ", ";", trim($_SESSION['syscNOME']));

$arrayNome = explode(";", $vNomePerfil);

$vNomePerfil = $arrayNome[0];

if ((strlen($vNomePerfil)+strlen($arrayNome[1])) <= 20) { 
	$vNomePerfil .= " " . $arrayNome[1];
	
	if (count($arrayNome) > 2) {
		if ((strlen($vNomePerfil)+strlen($arrayNome[2])) <= 20) { 
			if (strlen($arrayNome[2]) > 3) {
				$vNomePerfil .= " " . $arrayNome[2];

			}
		}
	}

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
	
		<?php
		echo '<script type="text/javascript" src="js/funcoes_geral' . $jsGeral . '.js"></script>';
		echo '<script type="text/javascript" src="js/menu_redirect' . $jsReDirect . '.js"></script>';
		?>
		
		<style type="text/css">
		<!--
		*, html, body {
			margin:0;
			padding:0;
		}
		
		body {
			background: #fcfcfc; 
			font:  62.5%/1.2 Verdana, Helvetica, Arial, sans-serif;
		}
		-->
		</style>
		
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		
		<?php
		echo '<script type="text/javascript" language="javascript" src="js/funcoes_cadastro' . $jsCadastro . '.js"></script>';
		?>

		<link href="css/tooltip.css" rel="stylesheet" type="text/css" />
		<script src="js/tooltip.js" type="text/javascript"></script>
		
		<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
		
		<script type="text/javascript">
			var vOpcaoAnterior = "";
			
			function fMenu(vop) {
				var vOpcao = "menu-" + vop;
				var vOpcaoUp = "op-" + vop;
				
				var vPosicaoOpcao = fElementoPos(vOpcaoUp).left;
				document.getElementById(vOpcao).style.left = vPosicaoOpcao + "px";

				if (document.getElementById(vOpcao).style.display == "block") {

					document.getElementById(vOpcao).style.display = "none";
					
				} else {
					
					if (vOpcaoAnterior != "") {
						document.getElementById(vOpcaoAnterior).style.display = "none";
						
					}
					
					document.getElementById(vOpcao).style.display = "block";

				}
				
				vOpcaoAnterior = vOpcao;
			
			}
		</script>
		
		<style type="text/css">
		<!--
		a:link.submenu   { color: #ffffff; text-decoration: none; }
		a:visited.submenu { color: #ffffff; text-decoration: none; }
		a:hover.submenu  { color: #ffff00; text-decoration: none; }
		
		#area-topo {
			background: url(documentos/images/ground_topo_internas.jpg) center center;
		}
		
		#area-topo img {
			width: 100px;
			margin: 15px;
			margin-left: 20px;
		}
		
		div#area-menu {
			background: #0055a5;
			border-top: #160087 3px solid;
			color: #ffffff;
			height: 45px;
		}
		
		div#area-menu ul#menu { 
			font-size: 18px;
			margin-top: 10px;
			position: absolute;
		}
		
		div#area-menu ul#menu li.op-menu { 
			display: inline;
			margin: 20px;
		}
		
		div#area-menu ul#menu li.op-menu:hover { 
			border-bottom: #ffffff 1px solid;
			color: #ffff00
		}
		
		#area-perfil {
			display: table;
			float: right;
			top: 0;
			right: 0;
			height: 70px;
			position: absolute;
		}
		
		#area-perfil-Dados {
			display: table;
			height: 50px;
			float: left;
			font-family: Lucida Sans, Tahoma, Arial;
			font-size: 20px;
			color: #065b03;
			padding-top: 30px;
		}
		
		#area-perfil-Dados div.btn-sair {
			background: #044c01;
			border-radius: 10px;
			font-family: Lucida Sans, Tahoma, Arial;
			font-size: 14px;
			color: #ffffff;
			margin-top: 3px;
			padding: 2px;
			text-align: center;
			width: 50px
		}
		
		#area-perfil-Img {
			float: left;
			border: #81c17f 5px solid;
			border-radius: 50px;
			width: 60px;
			height: 60px;
			overflow: hidden;
			margin: 5px;
		}
		
		#area-perfil-Img img {
			margin: auto;
			width: 105%;
			height: 105%;
		}

		div#menu-gerenciamento {
			display: none;
			margin-top: 10px;
			position: absolute;

		}

		div#menu-financeiro {
			display: none; 
			margin-top: 10px;
			position: absolute;

		}

		div#menu-web {
			display: none; 
			margin-top: 10px;
			position: absolute;

		}

		ul.sub-menu {
			background: #0055a5;
			border-radius: 0px 0px 25px 25px;
			border-top: #160087 3px solid;
			border-bottom: #160087 3px solid;
			display: table;
			opacity: 1;
			position: absolute;
			padding-top: 10px;
			padding-left: 20px;
			width: 180px;
		}
		
		ul.sub-menu li {
			display: block;
			font-size: 16px;
			margin-bottom: 10px;
		}
		-->
		</style>
	</head>
	<body>
		<div id="area-topo">
			<img src="documentos/images/logo.png" border="0"/>
			
			<div id="area-perfil">
				<div id="area-perfil-Dados">Ol&aacute;, <?php echo $vNomePerfil ?><div align="right"><a href="default.php?log=of"><div class="btn-sair">Sair</div></a></div></div>
				<div id="area-perfil-Img"><img src="<?php echo $vFotoPerfil ?>" border="0" /></div>
			</div>
		</div>
		
		<div id="area-menu">
			<ul id="menu">
				<li class="op-menu"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">INÍCIO</a></li>
				<li id="op-gerenciamento" class="op-menu" onClick="fMenu('gerenciamento')">GERENCIAMENTO <img src="images/seta-down.gif" align="center" width="11" border="0"/>
					<div id="menu-gerenciamento">
						<ul class="sub-menu">
							<?php 
							if ($vFuncao == "administrador") {
								echo '	<li><a href="javascript: showDIRECT(\'\', \'dadosinstitucionais.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Dados Institucionais</a></li>';
							}
							?>
							
							<li><a href="javascript: showDIRECT('', 'dadoscadastrais.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">Dados Cadastrais</a></li>
							<li><a href="javascript: showDIRECT('', 'senhas.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">Mudar Senha</a></li>
							
							<?php 
							if ($vFuncao == "administrador") {
								echo '	<li><a href="javascript: showDIRECT(\'\', \'ger_fornecedores.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Fornecedores</a></li>';
								echo '	<li><a href="javascript: showDIRECT(\'\', \'usuarios.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Usu&aacute;rios</a></li>';
								echo '	<li><a href="javascript: showDIRECT(\'\', \'ger_setores.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Setores</a></li>';
								echo '	<li><a href="javascript: showDIRECT(\'\', \'chamados.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Chamados</a></li>';
							}
							?>
						</ul>
					</div>
				</li>
				<li id="op-financeiro" class="op-menu" onClick="fMenu('financeiro')">ESTOQUE <img src="images/seta-down.gif" align="center" width="11" border="0"/>
					<div id="menu-financeiro">
						<ul class="sub-menu">
							<li><a href="javascript: showDIRECT('', 'cad_produtos.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">Cadastro de Produtos</a></li>
							<li><a href="javascript: showDIRECT('', 'ger_produtos.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">Listagem de Produtos</a></li>
							<li><a href="javascript: showDIRECT('', 'cad_produtoscategorias.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">Cadastro de Grupos</a></li>
							<li><a href="javascript: showDIRECT('', 'ger_categorias.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="submenu">Grupos de Produtos</a></li>
						</ul>
					</div>
				</li>
				<li id="op-web" class="op-menu" onClick="fMenu('web')">WEB <img src="images/seta-down.gif" align="center" width="11" border="0"/>
					<?php 
					if ($vFuncao == "administrador") {
						echo '<div id="menu-web">';
						echo '	<ul class="sub-menu">';
						echo '		<li><a href="javascript: showDIRECT(\'\', \'conteudo.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Editar Conte&uacute;do</a></li>';
						echo '		<li><a href="javascript: showDIRECT(\'\', \'banners.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Banners</a></li>';
						echo '		<li><a href="javascript: showDIRECT(\'\', \'contatos.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Contatos</a></li>';	
						echo '		<li><a href="javascript: showDIRECT(\'\', \'ger_orcamentos.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="submenu">Or&ccedil;amentos</a></li>';	
						echo '		<li><a href="javascript: showDIRECT(\'\', \'web_galerias.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=geral\', \'areaConteudo\')" class="submenu">Galeria de Fotos</a></li>';	
						echo '		<li><a href="javascript: showDIRECT(\'\', \'ger_links.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=geral\', \'areaConteudo\')" class="submenu">Links</a></li>';	
						echo '		<li><a href="javascript: showDIRECT(\'\', \'ger_imagens.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=geral\', \'areaConteudo\')" class="submenu">Imagens</a></li>';	
						echo '	</ul>';
						echo '</div>';
					}
					?>
				</li>
			</ul>
		
		</div>

		<div id="areaConteudo">	</div>
		
		<script type="text/javascript" language="javascript">showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo');</script>

	</body>
</html>