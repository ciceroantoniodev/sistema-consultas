<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vID_Cadastro = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vPagina = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
$vAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vImagem_Rodape = "";
$vPosicao = 0;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

if ($vformACAO == "atualizar") {
	$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;
	$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
	$vformCIDADE = isset($_POST["formCIDADE"]) ? $_POST["formCIDADE"] : NULL;
	$vformTIPO = isset($_POST["formTIPO"]) ? $_POST["formTIPO"] : NULL;
	$vformENDERECO = isset($_POST["formENDERECO"]) ? $_POST["formENDERECO"] : NULL;
	$vformENDERECO_NUM = isset($_POST["formENDERECO_NUM"]) ? $_POST["formENDERECO_NUM"] : NULL;
	$vformBAIRRO = isset($_POST["formBAIRRO"]) ? $_POST["formBAIRRO"] : NULL;
	$vformCEP = isset($_POST["formCEP"]) ? $_POST["formCEP"] : NULL;
	
	$vformLATITUDE = isset($_POST["formLATITUDE"]) ? $_POST["formLATITUDE"] : NULL;
	$vformLONGITUDE = isset($_POST["formLONGITUDE"]) ? $_POST["formLONGITUDE"] : NULL;
	
	$vQUERY = $vConexao->query("SELECT * FROM sysc_mapa WHERE id_cadastro=" . $vID_Cadastro) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		if ($vRE == "") {
			
			$dbCAMPOS = "id_cadastro, nome, estado, cidade, tipo, endereco, endereco_num, bairro, cep, longitude, latitude";

			
			$dbVALORES = "0" . $vID_Cadastro;
			$dbVALORES .= ",'" . $vformNOME . "'";
			$dbVALORES .= ",'" . $vformESTADO . "'";
			$dbVALORES .= ",'" . $vformCIDADE . "'";
			$dbVALORES .= ",'" . $vformTIPO . "'";
			$dbVALORES .= ",'" . $vformENDERECO . "'";
			$dbVALORES .= ",'" . $vformENDERECO_NUM . "'";
			$dbVALORES .= ",'" . $vformBAIRRO . "'";
			$dbVALORES .= ",'" . $vformCEP . "'";
			$dbVALORES .= ",'" . $vformLONGITUDE . "'";
			$dbVALORES .= ",'" . $vformLATITUDE . "'";

			$dbSALVAR = $vConexao->query("INSERT INTO sysc_mapa (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());
			
		} else {
			$vConexao->query("UPDATE sysc_mapa SET nome='" . $vformNOME . "', 
													estado='" . $vformESTADO . "', 
													cidade='" . $vformCIDADE . "', 
													tipo='" . $vformTIPO . "', 
													endereco='" . $vformENDERECO . "', 
													endereco_num='" . $vformENDERECO_NUM . "', 
													bairro='" . $vformBAIRRO . "', 
													cep='" . $vformCEP . "', 
													longitude='" . $vformLONGITUDE . "', 
													latitude='" . $vformLATITUDE . "' WHERE id_cadastro=" . $vID_Cadastro) or die(mysqli_error());			

		}
	mysqli_free_result($vQUERY);	
}



//---------------------------------------------------
//
// Pega o limite de fotos no Cadastro Geral
//
//---------------------------------------------------


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="../documentos/js/funcoes-geral.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
	
	table { font-family: tahoma, arial; font-size: 13px; }
	
	.form_button {
		background: #ff6600;
		color: #ffffff;
		font-size: 20px;
		padding: 5px;
		border: none;
		border-bottom: #ff3333 1px solid;
		border-right: #ff3333 1px solid;
		margin-top: 10px;
		width: 240px;
	}
	
	.coods {
		font-size: 22px;
		background: #dddddd;
		width: 150px;
		margin-top: 5px;
		border: #999999 1px solid;
		padding: 3px;
	}
    -->
    </style>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>
  
<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<div align="center">
		<div class="clear">&nbsp;</div>
		
		<div class="titulo-escritorio">Personalização do Design: Mapa do Google</div>

		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>

		<form action="design_mapa.php?id=<?php echo $vID_Cadastro ?>&pg=<?php echo $vPagina ?>&acao=atualizar" method="post" name="formMapa">
			<input type="hidden" name="formACAO" value="atualizar" />
			<input type="hidden" name="formLATITUDE" id="frmLatitude" value="" />
			<input type="hidden" name="formLONGITUDE" id="frmLongitude" value="" />
			
			<table border="0" width="800" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<div id="areaENVIAR">&nbsp;</div>
						
							<?php
							$vQUERY = $vConexao->query("SELECT * FROM sysc_mapa WHERE id_cadastro=" . $vID_Cadastro) or die("Falha na execução da consulta.");
								$vRE = mysqli_fetch_array($vQUERY);
								
								if ($vRE != "") {
									$vformNOME = $vRE['nome'];
									$vformCIDADE = $vRE['cidade'];
									$vformESTADO = $vRE['estado'];
									$vformENDERECO = trim($vRE['tipo']) . " " . trim($vRE['endereco']);
									$vformENDERECO_NUM = $vRE['endereco_num'];
									$vformCEP = $vRE['cep'];
									$vformBAIRRO = $vRE['bairro'];
									
									$vLocalizacao = str_replace("-", " ", $vformENDERECO . ", " . $vformENDERECO_NUM) . " - " . str_replace("-", " ", $vformBAIRRO) . " - " . str_replace("-", " ", $vformCIDADE) . " - " . $vformESTADO;

								} else {
									mysqli_free_result($vQUERY);
									
									$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrogeral WHERE id=" . $vID_Cadastro) or die("Falha na execução da consulta.");
									
									$vRE = mysqli_fetch_array($vQUERY);
									
									if ($vRE != "") {
										$vformNOME = $vRE['fantasia'];
										$vformCIDADE = $vRE['cidade'];
										$vformESTADO = $vRE['estado'];
										$vformENDERECO = $vRE['endereco'];
										$vformENDERECO_NUM = $vRE['endereco_num'];
										$vformCEP = $vRE['cep'];
										$vformBAIRRO = $vRE['bairro'];
										
										$vLocalizacao = str_replace("-", " ", $vformENDERECO . ", " . $vformENDERECO_NUM) . " - " . str_replace("-", " ", $vformBAIRRO) . " - " . str_replace("-", " ", $vformCIDADE) . " - " . $vformESTADO;
									}

								}
							mysqli_free_result($vQUERY);

							$arrayCidades = Array("AC","AL","AM","AP","BA","CE","DF","ES","GO","MA","MG","MS","MT","PA","PB","PE","PI","PR","RJ","RN","RO","RR","RS","SC","SE","SP","TO");

							$arrayTipos = Array("Rua","Avenida","Travessa","Br","Vila","Setor","Aeroporto","Alameda","Área","Campo","Chácara","Colônia","Condomínio","Conjunto","Distrito","Esplanada","Estação","Estrada","Favela","Fazenda","Feira","Jardim","Ladeira","Lago","Lagoa","Largo","Loteamento","Morro","Núcleo","Parque","Passarela","Pátio","Praça","Quadra","Recanto","Residencial","Rodovia","Sítio","Trecho","Trevo","Vale","Vereda","Via","Viaduto","Viela","Outros");
							
							echo '<input type="hidden" name="formNOME" value="' . $vformNOME . '" />';
							?>

							<table>
								<tr>
									<td align="right">UF:</td>
									<td>
										<select name="formESTADO" class="form_co">
											<?php
											$vEcho = "";
											for ($i = 0; $i < count($arrayCidades); $i++) {
												if ($vformESTADO ==  $arrayCidades[$i]) {
													$vEcho .= '<option selected="selected" value="' . $arrayCidades[$i] . '">' . $arrayCidades[$i] . '</option>';
													
												} else {
													$vEcho .= '<option value="' . $arrayCidades[$i] . '">' . $arrayCidades[$i] . '</option>';
													
												}

											}
											echo $vEcho;
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">Cidade:</td>
									<td><input type="text" name="formCIDADE" value="<?php echo $vformCIDADE ?>" size="40" class="form_co" /></td>
								</tr>
								<tr>
									<td align="right">Tipo:</td>
									<td>
										<select name="formTIPO" class="form_co">
											<option value=""></option>
											<?php
											$vTipoOn = "";
											$vEcho = "";
											for ($i = 0; $i < count($arrayTipos); $i++) {
												if (strpos(strtolower("##".$vformENDERECO), strtolower($arrayTipos[$i])) > 0) {
													$vEcho .= '<option selected="selected" value="' . $arrayTipos[$i] . '">' . $arrayTipos[$i] . '</option>';
													$vTipoOn = $arrayTipos[$i];
													
												} else {
													$vEcho .= '<option value="' . $arrayTipos[$i] . '">' . $arrayTipos[$i] . '</option>';

												}

											}
											echo $vEcho;
											
											if ($vTipoOn != "") {
												$vformENDERECO = str_replace($vTipoOn, "", $vformENDERECO);
												$vformENDERECO = str_replace(strtolower($vTipoOn), "", $vformENDERECO);
												$vformENDERECO = str_replace(strtoupper($vTipoOn), "", $vformENDERECO);

											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td align="right">Endereço:</td>
									<td><input type="text" name="formENDERECO" value="<?php echo trim($vformENDERECO) ?>" size="50" class="form_co" /></td>
								</tr>
								<tr>
									<td align="right">Endereço Número:</td>
									<td><input type="text" name="formENDERECO_NUM" value="<?php echo $vformENDERECO_NUM ?>" size="10" class="form_co" /></td>
								</tr>
								<tr>
									<td align="right">Bairro:</td>
									<td><input type="text" name="formBAIRRO" value="<?php echo $vformBAIRRO ?>" size="30" class="form_co" /></td>
								</tr>
								<tr>
									<td align="right">Cep:</td>
									<td><input type="text" name="formCEP" value="<?php echo $vformCEP ?>" size="15" class="form_co" /></td>
								</tr>
							</table>
							
							<iframe src="design_mapa2.php?local=<?php echo $vLocalizacao ?>" scrolling="no" frameborder="0" id="idFrame" name="target_" style="border: none; width:1px; height:1px;"></iframe></div>
							
					</td>
					<td style="font-size: 16px; border-left: #999999 2px solid; padding-left: 20px">
						Latitude:
						<div id="latitude" class="coods"></div>
						
						<div class="clear">&nbsp;</div>
						<div class="clear">&nbsp;</div>
						
						Longitude:
						<div id="longitude" class="coods"></div>
						
						<div class="clear">&nbsp;</div>
						
						<a href=""><div class="ver_mapa">Ver no Mapa</div></a>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><br /><br /><input type="button" value="  Atualizar Dados  " class="form_button" onClick="javascript: submit();" /></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>