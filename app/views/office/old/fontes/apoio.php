<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { $vBotaoVoltar = 1; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="js/menu_redirect.js"></script>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>

<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";

	$vDelTabela = "sysc_classificados";
	$vDelCampo = "titulo";

	echo '<br /><br /><div align="center"><div class="form-listagem"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
	echo '<tr><td class="form-cadastros-head" colspan="7"><div align="center">MATERIAL DE APOIO</div></td></tr>';
	echo '<tr><td><div id="areaDIRECT"></div></td></tr>';
	echo '</tbody></tfoot></tfoot></table></div></div><br /><br />';

	?>
	<script type="text/javascript">showDIRECT("", "grid_apoio.php?id=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>&key=", "areaDIRECT");</script>

</body>
</html>
