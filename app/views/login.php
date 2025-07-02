<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Sistema de Consultas</title>
		
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

		<link rel="stylesheet" type="text/css" href="<?=URL?>/assets/css/style_login.css"/>
		
		<link rel="stylesheet" type="text/css" href="<?=URL?>/assets/css/media006.css"/>
		
	</head>

	<body>
		<main class="main">
			<div class="header">
				<h2>Sistema<br>de<br>Consultas</h2>
			</div>

			<div class="area">
				<h3 class="text-center">Login</h3>
				<form class="form" action="<?=URL?>/office/Login" method="post">
					
					<div class="form-group">
						<label for="username" class="form-label">Usuário:</label><br>
						<input type="text" name="username" id="username" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password" class="form-label">Senha:</label><br>
						<input type="password" name="password" id="password" class="form-control" required>
					</div>
					<div class="form-group d-flex justify-content-between" style="margin-top: 10px">
						<div>
							<input type="submit" name="submit" class="btn btn-primary btn-md" value="    Acessar    ">
						</div>
					</div>
				</form>
			</div>
			
		</main>

	</body>

</html>