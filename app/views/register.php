<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>TCOMM</title>
		
		<meta http-equiv="content-language" content="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="description" content="TComm" />
		<meta name="robots" content="index, follow"> 
		
		<link rel="icon" type="image/x-icon" href="<?=URL?>/images/petrolina-piscinas-favicon.png" />
		
		<link href="https://fonts.googleapis.com/css?family=Dosis|Hammersmith+One|Open+Sans|Raleway:200" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

		<!-- Bootstrap -->
		<link href="<?=URL?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/social-style.css">
		<link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/fontawesome.min.css">

		<link rel="stylesheet" type="text/css" href="<?=URL?>/assets/css/style_register.css"/>
		
		<link rel="stylesheet" type="text/css" href="<?=URL?>/assets/css/media006.css"/>
		
		<style>
			input.form-control {
				color: #2929c2;
				font-size: 18px;
			}
		</style>
	</head>

	<body>
		<main class="main">
			<div class="header">
				<h2>TCOMM</h2>
				<h3>Atendimento: <a href="https://wa.me/+553188668912" target="_blank">+553188668912</a></h3>
			</div>

			<div class="area">
				<div class="card login">
					<div class="card-header">
						<h3 class="text-center">Cadastre-se</h3>
					</div>
					<div class="card-body">
						<?php 
						if (!$salvar) {
							?>

							<form class="form" action="<?=URL?>/Register/Salvar" method="post">
								
								<div class="form-group">
									<label for="name" class="form-label">Seu Nome: <span class="text-danger">*</span></label><br>
									<input type="text" name="name" id="name" value="<?=$formDados['name'] ?? '' ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="email" class="form-label">Seu Email: <span class="text-danger">*</span></label><br>
									<input type="email" name="email" id="email" value="<?=$formDados['email'] ?? '' ?>" onChange="document.getElementById('username').value = this.value" class="form-control" required>
								</div>

								<?=isset($mensagemErro['email']) ? '<div class="alert alert-danger mt-2" role="alert">'.$mensagemErro['email'].'</div>' : '' ?>

								<div class="form-group">
									<label for="contact" class="form-label">Seu N&uacute;mero de Contato: <span class="text-danger">*</span></label><br>
									<input type="text" name="contact" id="contact" value="<?=$formDados['contact'] ?? '' ?>" class="form-control" required>
								</div>
							
								<div class="d-grid gap-2" style="margin-top: 20px">
									<input type="submit" name="submit" class="btn btn-primary btn-lg" value="    Salvar Dados    ">
								</div>
							</form>
							<?php 
						}
						?>

					</div>
				</div>				
			</div>
			
			<div class="footer">
				<p>Aprenda mais sobre a plataforma no <a href="https://www.youtube.com/GlobalWpp" target="_blank">Youtube</a></p>
			</div>
		</main>

	</body>

</html>