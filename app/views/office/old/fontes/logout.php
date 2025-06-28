<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";

$f_usuario = isset($_POST["formUSUARIO"]) ? $_POST["formUSUARIO"] : NULL;
$f_senha = isset($_POST["formSENHA"]) ? $_POST["formSENHA"] : NULL; 

$f_usuario = str_replace("'", "''", $f_usuario);
$f_senha = str_replace("'", "''", $f_senha);

$vLocal = isset($_GET["local"]) ? $_GET["local"] : NULL; 

$_SESSION['syscID'] = "";
$_SESSION['syscNOME'] = "";
$_SESSION['syscTIPO'] = "";
$_SESSION['syscNIVEL'] = "";
?>
<html>
	<head>
		<title></title>
		<script language="JavaScript" type="text/javascript">
			window.top.location.href = "../index.php?local=<?php echo $vLocal ?>";
		</script>
	</head>
	<body>
	</body>
</html>