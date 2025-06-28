<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>TCOMM</title>
		
		<meta http-equiv="content-language" content="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="description" content="TComm" />
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
					<div style="margin-left: 10px">TCOMM</div>
					<div style="padding: 10px; font-size: 26px" onClick="expandMenu()"><i class="fas fa-bars"></i></div>
				</div>
				<div class="topo-perfil">
					<?=$dados["Nome"]?> (<?=$dados["Email"]?>)
				</div>
			</div>
			<div class="nav-area">
				<div id="area_menu" class="area-menu">

					<table cellspacing="0" cellpadding="0" class="mn-table">
						<?php
						if ($dados['Mestre']==='S') {
							?>
							<tr class="mn-row">
								<td width="40px" class="mn-icone"><a href="<?=URL?>/office/controlador" class="menu" target="area_content"><i class="fas fa-archive"></i></a></td>
								<td class="mn-opc"><a href="<?=URL?>/office/controlador" class="menu" target="area_content">Controlador</a></td>
							</tr>
							<tr class="mn-row">
								<td width="40px" class="mn-icone"><a href="<?=URL?>/office/revenda" class="menu" target="area_content"><i class="fas fa-store-alt"></i></a></td>
								<td class="mn-opc"><a href="<?=URL?>/office/revenda" class="menu" target="area_content">Revenda</a></td>
							</tr>
							<tr class="mn-row">
								<td width="40px" class="mn-icone"><a href="<?=URL?>/office/usuarios&rv=<?=codigoHash($dados['Revenda'])?>&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content"><i class="fas fa-users"></i></a></td>
								<td class="mn-opc"><a href="<?=URL?>/office/usuarios&rv=<?=codigoHash($dados['Revenda'])?>&idu=<?=codigoHash($dados['Id'])?>" class="menu" target="area_content">Usuários</a></td>
							</tr>
							<?php 
						}
						?>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/numeros" class="menu" target="area_content"><i class="fas fa-file-invoice-dollar"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/numeros" class="menu" target="area_content">Números</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/filtro" class="menu" target="area_content"><i class="fas fa-filter"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/filtro" class="menu" target="area_content">Filtro</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/sender_campanhas" class="menu" target="area_content"><i class="fas fa-paper-plane"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/sender_campanhas" class="menu" target="area_content">Sender Campanhas</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/sender_devices" class="menu" target="area_content"><i class="fas fa-mobile-alt"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/sender_devices" class="menu" target="area_content">Sender Devices</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/desbanimentos" class="menu" target="area_content"><i class="fas fa-ban"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/desbanimentos" class="menu" target="area_content">Desbanimentos</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/aplicativos" class="menu" target="area_content"><i class="fas fa-download"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/aplicativos" class="menu" target="area_content">Aplicativos</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/api" class="menu" target="area_content"><i class="fas fa-code"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/api" class="menu" target="area_content">API</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/trocar_senha" class="menu" target="area_content"><i class="fas fa-user-lock"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/trocar_senha" class="menu" target="area_content">Trocar Senha</a></td>
						</tr>
						<tr class="mn-row">
							<td width="40px" class="mn-icone"><a href="<?=URL?>/office/comprar" class="menu" target="area_content"><i class="fas fa-money-bill-wave"></i></a></td>
							<td class="mn-opc"><a href="<?=URL?>/office/comprar" class="menu" target="area_content">Comprar</a></td>
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