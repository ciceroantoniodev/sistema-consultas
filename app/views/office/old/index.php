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
		
		<link rel="icon" type="image/x-icon" href="/favicon.ico" />

		<script type="text/javascript" src="<?php echo $vUrlPadrao ?>/app/office/documentos/js/jquery.js"></script>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $vUrlPadrao ?>/app/office/documentos/css/estilo.css"/>
		
		<style type="text/css">
		<!--
		-->
		</style>
		
	</head>
	<body>
		<div id="pageContent">
			<header>
				<figure id="logo">
					<a href="../index.php"><img src="<?php echo $vUrlPadrao ?>/app/office/documentos/images/logo.png" border="0" width="150" /></a>
				</figure>
				
				<div class="clear"><br/></div>
				
				<div id="login">
				
					<form action="<?php echo $vUrlPadrao ?>/app/office/login.php" method="post">
						<label for="cUsuario" class="label_">Usu&aacute;rio:</label><br/><input type="text" id="cUsuario" size="25" class="edit-login" name="formUsuario" value="" /><br />
						<label for="cSenha" class="label_">Senha:</label><br /><input type="password" id="cSenha" size="20" class="edit-login" name="formSenha" value="" /><br/><br/>
						<input type="submit" id="cSubmit" value="Ok" class="submit_" /><br/>
					</form>
			
					<div class="clear"><br/></div>

				</div>
			</header>
			
		</div>

	</body>
</html>
