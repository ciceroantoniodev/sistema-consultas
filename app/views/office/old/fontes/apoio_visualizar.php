<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$vgetTIPO = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$vgetFILENAME = isset($_GET['id']) ? $_GET['id'] : NULL;
$vgetOPCAO = isset($_GET["op"]) ? $_GET["op"] : NULL;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>::: sysMDA - Sistema de Gestão para Associação MDA :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema de Gestão para Associação MDA" />
	<meta name="keywords" content="associação, mda, sistema, gerenciamento, gestão" />
	<link rel="shortcut icon" href="favicon.ico"> 
	<link href="docs/style/geral_.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<frameset border=0 frameSpacing=0 rows="30,*" frameBorder=no>
	<frame src="go_pdf.php?tipo=<?php echo $vgetTIPO ?>&op=<?php echo $vgetOPCAO ?>" id="topo" name="topo" marginWidth="0" marginHeight="0" frameBorder=no noResize scrolling=no>
	<frame src="ler_pdf.php?arq=<?php echo $vgetFILENAME  ?>&tipo=<?php echo $vgetTIPO ?>" name="main" marginWidth="0" marginHeight="0" frameBorder=no noResize scrolling=auto>
</frameset>
<noframes></noframes>
</html>
