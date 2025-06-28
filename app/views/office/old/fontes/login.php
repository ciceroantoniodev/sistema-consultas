<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";

$f_usuario = isset($_POST["formUSUARIO"]) ? $_POST["formUSUARIO"] : NULL;
$f_senha = isset($_POST["formSENHA"]) ? $_POST["formSENHA"] : NULL; 

$f_usuario = str_replace("'", "''", $f_usuario);
$f_senha = str_replace("'", "''", $f_senha);

$vLocal = isset($_POST["local"]) ? $_POST["local"] : NULL; 

$vAcao = 1;

$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE usuario='" . $f_usuario . "' AND senha='" . hash('sha512', $f_senha) . "'") or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	if ($vRE == "") {
		echo '<script language="JavaScript" type="text/javascript">';
		echo '	alert("Nome de Usuário ou Senha incorreto!");';
		echo '	history.go(-1);';
		echo '</script>';

	} else {
		$vgetTIPO = $vRE['tipo'];
		$vNivel = $vRE['nivel'];
		
		$vID = $vRE['id'];
		
		$_SESSION['syscID'] = $vID;
		$_SESSION['syscNOME'] = $vRE['nome'];
		$_SESSION['syscTIPO'] = trim($vgetTIPO);
		$_SESSION['syscNIVEL'] = trim($vNivel);
		$_SESSION['syscROTINAS'] = trim($vRE['rotinas']);
		$_SESSION['syscFRANQUIA'] = $vRE['id_franquia'];

		echo '<script language="JavaScript" type="text/javascript">';
		echo '	window.top.location.href = "default.php?local=' . $vLocal . '"';
		echo '</script>';
	}
mysqli_free_result($vQUERY);
?>