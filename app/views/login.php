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
		<link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/fontawesome.min.css">

		<link rel="stylesheet" type="text/css" href="<?=URL?>/assets/css/style_login.css"/>
		
		<link rel="stylesheet" type="text/css" href="<?=URL?>/assets/css/media.css"/>
		<style>
			.form-label {
				margin: 0px;
				padding: 0px;
			}
			
			input.form-control {
				padding-left: 30px;
			}

			.icon-user {
				background-image: url('<?=URL?>/assets/images/user-icon.svg');
				background-size: 25px 25px;
				background-position: 3px 5px;
				background-repeat: no-repeat;			
			}
			
			.icon-pass {
				background-image: url('<?=URL?>/assets/images/lock-icon.svg');
				background-size: 25px 25px;
				background-position: 3px 5px;
				background-repeat: no-repeat;
			}
		</style>
	</head>

	<body>
		<main class="main">
			<div class="header">
				<h2><span style="color:rgb(252, 252, 173); font-size: 35px; letter-spacing: 8px;">SISTEMA</span><br>Gerenciador de<br>Consultas</h2>
			</div>

			<div class="area">
				<h3 class="text-center">Login</h3>
				<form class="form" action="<?=URL?>/office/Login" method="post">
					
					<?=(isset($error) ? '<div class="alert alert-danger mt-3">Usuário ou Senha inválidos!</div>' : '')?>

					<div class="form-group">
						<label for="username" class="form-label">&nbsp;</label>
						<input type="text" name="username" id="username" placeholder="Usuário" class="form-control icon-user" required>
					</div>
					<div class="form-group">
						<label for="password" class="form-label">&nbsp;</label>
						<input type="password" name="password" id="password" placeholder="Senha" class="form-control icon-pass" required>
					</div>
					<div class="d-grid gap-2 mt-4">
						<input type="submit" name="submit" class="btn btn-primary btn-md" value="    Acessar    ">
					</div>
				</form>
			</div>
			
		</main>

	</body>

</html>