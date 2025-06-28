<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vgetTIPO = isset($_GET['tipo']) ? $_GET['tipo'] : NULL;
$vgetOPCAO = isset($_GET["op"]) ? $_GET["op"] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema de Gestão para Associação MDA" />
	<meta name="keywords" content="associação, mda, sistema, gerenciamento, gestão, células" />
	<style type="text/css">
		<!--
		body { background: #4c4c4c; text-align: center}
		div { height: 29px; border-bottom: #666666 2px solid; font-family: tahoma, arial; font-size: 22px; }
		
		a.go:link    {color: #EEEE00; text-decoration: none;}
		a.go:visited {color: #EEEE00; text-decoration: none}
		a.go:hover   {color: #305fb3; text-decoration: none}
		-->
	</style>	
</head>
<body>
<div>
<?php
echo '<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)" class="go">RETORNAR</a>';
?>
</div>
</body>
</html>