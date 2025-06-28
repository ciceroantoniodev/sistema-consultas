<?php
header("Content-Type: text/html; charset=UTF-8",true);

$vUrl = isset($_GET["url"]) ? strtolower($_GET["url"]) : "";

session_start();

include "conexao.php";
include "documentos/include/funcoes.php";

$vLogado = false;

$f_usuario = isset($_POST["formUsuario"]) ? $_POST["formUsuario"] : NULL;
$f_senha = isset($_POST["formSenha"]) ? $_POST["formSenha"] : NULL; 

$f_usuario = str_replace("'", "''", $f_usuario);
$f_senha = str_replace("'", "''", $f_senha);

$vDT_CADASTRO = date("Y-m-d H:i:s"); 
//echo '<div style="color: #ff0000">';

$qryUsuarios = $vConexao->query("SELECT * FROM sysc_usuarios WHERE (usuario='" . $f_usuario . "') AND (senha='" . hash('sha512', $f_senha) . "')") or die("Falha na execução da consulta.");
	$reUsuarios = mysqli_fetch_array($qryUsuarios);
	
	if ($reUsuarios == "") {
		header("Location: https://www.petrolinapíscinas.com.br/LembrarSenha");
		
	} else {
		$vID = $reUsuarios['id'];
			
		
		// ***********************************************************
		// **
		// ** 
		// ** Cria variáveis de seção e redireciona
		// **
		// **
		// ***********************************************************

		
		$_SESSION['syscID'] = $vID;
		$_SESSION['syscNOME'] = $reUsuarios['nome'];
		$_SESSION['syscFUNCAO'] = strtolower($reUsuarios['funcao']);
		$_SESSION['syscFOTO'] = trim($reUsuarios['foto']);
		$_SESSION['syscSEXO'] = trim($reUsuarios['sexo']);
		
		
		$vAlertas = "";
		
		if ($reUsuarios['funcao'] == "administrador") {
			$qryChamados = $vConexao->query("SELECT * FROM sysc_chamados WHERE pendente='S'") or die("Falha na execução da consulta.");
				$reChamados = mysqli_num_rows($qryChamados);
				
				if ($reChamados > 0) {
					$vAlertas .= "S";
					
				} else {
					$vAlertas .= "N";
					
				}
				
			mysqli_free_result($qryChamados);
			
		} else {
			$vAlertas .= "N";

		}
	
		
		// S - dados de recebimento
		// S - validação de e-mail
		// S - validação RG
		// S - validação CPF
		// S - verifica pagamentos de adesão
		// S - chamados pendentes
		$_SESSION['syscALERTAS'] = $vAlertas;

		$vLogado = true;
//		header("Location: default.php?idu=" . fId("c", $vID));
		
	}
mysqli_free_result($qryUsuarios);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php
		if ($vLogado) {
			echo '<script type="text/javascript">';
			echo 'window.location = "default.php?idu=' . fId("c", $vID) . '";';
			echo '</script>';
			
		}
		?>
		
	</head>
	<body>
	</body>
</html>