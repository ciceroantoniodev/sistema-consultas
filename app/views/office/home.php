<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Sistema de Consultas</title>
		
		<meta http-equiv="content-language" content="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="description" content="Sistema de Consultas" />
		<meta name="robots" content="index, follow"> 

		<!-- Bootstrap -->
		<link href="<?=URL?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/social-style.css">
		<link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/fontawesome.min.css">

		<link rel="stylesheet" type="text/css" href="<?=URL?>/app/views/office/assets/css/style_index_01.css"/>

		<script src="<?=URL?>/app/views/office/assets/js/script_index.js"></script>
	</head>

	<body>
		<main class="main_">
			<div class="nav-topo">
				<div class="topo-logo">
					<div style="margin-left: 10px">SISTEMA</div>
					<div style="padding: 10px; font-size: 26px" onClick="expandMenu()"><i class="fas fa-bars"></i></div>
				</div>
				<div class="topo-perfil">
					<?=$dados["Nome"]?>
				</div>
			</div>
			<div class="nav-area">
				<div id="area_menu" class="area-menu">

					<table cellspacing="0" cellpadding="0" class="mn-table">
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/Agenda&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content"><i class="fas fa-filter"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/Agenda&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content">Agenda</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/Agendamento&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content"><i class="fas fa-filter"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/Agendamento&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content">Agendamento</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/Pacientes&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content"><i class="fas fa-file-invoice-dollar"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/Pacientes&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content">Pacientes</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/Profissionais&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content"><i class="fas fa-file-invoice-dollar"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/Profissionais&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content">Profissionais</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/Especialidades&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content"><i class="fas fa-file-invoice-dollar"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/Especialidades&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content">Especialidades</a></td>
						</tr>
						<?php
						//if ($dados['Mestre']==='S') {
							?>
							<tr class="mn-row">
								<td width="40px" class="mn-icone"><a href="<?=URL?>/office/usuarios" class="menu" target="area_content"><i class="fas fa-users"></i></a></td>
								<td class="mn-opc"><a href="<?=URL?>/office/usuarios" class="menu" target="area_content">Usuários</a></td>
							</tr>
							<?php 
						//}
						?>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/trocar_senha" class="menu" target="area_content"><i class="fas fa-user-lock"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/trocar_senha" class="menu" target="area_content">Trocar Senha</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/logout" class="menu" target="area_content"><i class="fas fa-power-off"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/logout" class="menu" target="area_content">Logout</a></td>
						</tr>
					</table>
				</div>
				<div class="area-content">
					<iframe src="" name="area_content" class="frame_" ></iframe>
				</div>
			</div>
		</main>
	</body>

</html>