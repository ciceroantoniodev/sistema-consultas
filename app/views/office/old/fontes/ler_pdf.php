<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetTIPO = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$vgetFILENAME = isset($_GET['id']) ? $_GET['id'] : NULL;

$vgetTIPO = "apoio/" . $vgetFILENAME;

$vLENGTH = filesize($vgetTIPO);
header("Content-type: application/pdf");
header("Content-Length: $vLENGTH");
header("Content-Disposition: inline; filename=foo.pdf");
$vABRIRARQUIVO = readfile($vgetTIPO);
?>
<html>
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema de Gestão para Associação MDA" />
	<meta name="keywords" content="associação, mda, sistema, gerenciamento, gestão, células" />
	<link rel="shortcut icon" href="favicon.ico"> 
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>
<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	<div><br><br></div>
</body>
</html>