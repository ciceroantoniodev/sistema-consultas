<?php
$vUrl = isset($_GET["url"]) ? strtolower($_GET["url"]) : "";

//include "app/lib/dados.php";

$vLocalhost = "http://localhost/sistema-consultas";

define("URL", $vLocalhost);


$vDir = str_replace("\\", "/", __DIR__);
$vDir = str_replace("/app/config", "", $vDir);

define("LOCAL", $vDir);


$aUrl = explode("/", $vUrl);

$vController = isset($aUrl[0]) ? strtolower($aUrl[0]) : "";
$vAction = isset($aUrl[1]) ? strtolower($aUrl[1]) : "";
$vParameters = isset($aUrl[2]) ? strtolower($aUrl[2]) : "";

$vHeadUrl = $vLocalhost . "/" . $vController;

if ($vController === "office"){

	switch ($vAction) {
		case "home":
			$includeController = "app/controllers/HomeController.php";
			break;

		case "inicio":
			$includeController = "app/controllers/InicioController.php";
			break;

		case "usuarios":
			$includeController = "app/controllers/UsuariosController.php";
			break;

		case "pacientes":
			$includeController = "app/controllers/PacientesController.php";
			break;

		case "login":
			$includeController = "app/controllers/LoginController.php";
			break;

		case "logout":
			$includeController = "app/controllers/LogoutController.php";
			break;

		case "agendamento":
			$includeController = "app/controllers/AgendamentoController.php";
			break;

		case "profissionais":
			$includeController = "app/controllers/ProfissionaisController.php";
			break;

		case "especialidades";
			$includeController = "app/controllers/EspecialidadesController.php";
			break;

		default:
			$includeController = "app/controllers/HomeController.php";
			break;
	}
	
} else {

	if ($vController == "register") {
		$includeController = "app/controllers/RegisterController.php";

	} else {
		$includeController = "app/views/login.php";
		
		
	}
	
}
