<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vTituloSecao = "CADASTRAR NOVO ANUNCIANTE";

$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

$vformDESTINO = isset($_POST["formDESTINO"]) ? $_POST["formDESTINO"] : NULL;
$vformPRIORIDADE = isset($_POST["formPRIORIDADE"]) ? $_POST["formPRIORIDADE"] : NULL;
$vformASSUNTO = isset($_POST["formASSUNTO"]) ? $_POST["formASSUNTO"] : NULL;
$vformMENSAGEM = isset($_POST["formMENSAGEM"]) ? $_POST["formMENSAGEM"] : NULL;
$vformNOME = isset($_POST["formNOME"]) ? $_POST["formNOME"] : NULL;
$vformEMAIL = isset($_POST["formEMAIL"]) ? $_POST["formEMAIL"] : NULL;
$vformID_PASTOR = isset($_POST["formID_PASTOR"]) ? $_POST["formID_PASTOR"] : NULL;
$vformID_PESSOA = isset($_POST["formID_PESSOA"]) ? $_POST["formID_PESSOA"] : NULL;

if ($vformDESTINO == "email") {
	if ($vformNOME == "") {
		$vDESTINATARIO = "E-Mail: " . $vformEMAIL;
		
	} else {
		$vDESTINATARIO = $vformNOME;
		
	}

} else if ($vformDESTINO == "financeiro") {
	$vDESTINATARIO = "Suporte Financeiro";

} else if ($vformDESTINO == "suporte") {
	$vDESTINATARIO = "Suporte Técnico";

} else {
	$vDESTINATARIO = "Setor de Cadastro";

}

$vDATA_HORA = date("Y-m-d H:i:s"); 

if ($vformACAO == "novo") {
	$dbVALORES = "0" . $vgetIDUSUARIO;
	$dbVALORES .= ",0"; // id_destinatario
	$dbVALORES .= ",0"; // id_notificacao
	$dbVALORES .= ",'" . $vformDESTINO . "'";
	$dbVALORES .= ",'" . $vformASSUNTO . "'";
	$dbVALORES .= ",'" . $_SESSION['syscNOME'] . "'";
	$dbVALORES .= ",'" . $vDESTINATARIO . "'";
	$dbVALORES .= ",'" . $vformPRIORIDADE . "'";
	$dbVALORES .= ",'" . $vformMENSAGEM . "'";
	$dbVALORES .= ",'" . $vformEMAIL . "'";
	$dbVALORES .= ",'N'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",'N'";
	$dbVALORES .= ",'" . $vDATA_HORA . "'";
	
	$dbCAMPOS = "id_usuario, id_destinatario, id_notificacao, destino, assunto, remetente, destinatario, prioridade, descricao, email, lida, status, historico, encaminhar, data_hora";
	
	//$dbSALVAR = $vConexao->query("INSERT INTO sysc_mensagensenviadas (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());

	// ***********************************************************
	// * Pegando a ID do novo registro incluso
	// ***********************************************************

	$vQUERY = $vConexao->query("SELECT * FROM sysc_mensagensenviadas WHERE (id_usuario=" . $vgetIDUSUARIO . ") AND (destino='" . $vformDESTINO . "') AND (destinatario='" . $vDESTINATARIO . "') AND (data_hora='" . $vDATA_HORA . "')") or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);
		
		$vID_MENSAGEM = 0;
		
		if ($vRE != "") {
			$vID_MENSAGEM = $vRE['id'];

		}
	mysqli_free_result($vQUERY);

	if ($vformDESTINO == "email") {
		$vemailNOME = $vformNOME;
		$vemailTEXTO = $vformMENSAGEM;
		$vemailEMAIL = $vformEMAIL;
		
		if (trim($vformASSUNTO) != "") {
			$vemailASSUNTO = trim($vformASSUNTO);

		} else {
			$vemailASSUNTO = "MENSAGEM ENVIADA ATRAVÉS DO PORTAL MEU BAIRRO TEM";

		}
		
		$vemailFROMNOME = "Portal Meu Bairro Tem";
		$vemailFROMEMAIL = "suporte@meubairrotem.com";
		
		$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO) or die("Falha na execução da consulta.");
			$vRE = mysqli_fetch_array($vQUERY);
			
			if ($vRE != "") {
				if (trim($vRE['nome']) != "") {
					$vemailFROMNOME = $vRE['nome'];

				}
				
				if (trim($vRE['email_proprio']) != "") {
					$vemailFROMEMAIL = $vRE['email_proprio'];

				}

			}
		mysqli_free_result($vQUERY);
		
//		include "enviar_email.php";
		
	} else {
		// ***********************************************************
		// *
		// *
		// * Inicia gravação na tabela NOTIFICAÇÕES
		// *
		// *
		// ***********************************************************

		
		$dbCAMPOS = "id_usuario, id_origem, id_destinatario, destino, remetente, mensagem, data, hora, tipo, aviso, lida";
		
		$dbVALORES = "0" . $vgetIDUSUARIO;
		$dbVALORES .= ",0" . $vID_MENSAGEM;
		
		if ($vformDESTINO == "pastor") {
			$dbVALORES .= ",0" . $vformID_PASTOR;

		} elseif ($vformDESTINO == "pessoa") {
			$dbVALORES .= ",0" . $vformID_PESSOA;
			
		} else {
			$dbVALORES .= ",0";
			
		}
		
		$dbVALORES .= ",'" . $vformDESTINO . "'";
		$dbVALORES .= ",'" . $_SESSION['syscNOME'] . "'";
		$dbVALORES .= ",'" . $vformMENSAGEM . "'";
		$dbVALORES .= ",'" . date("Y-m-d") . "'";
		$dbVALORES .= ",'" . date("H:i:s") . "'";
		
		if ($vformPRIORIDADE == "SUPORTE") {
			$dbVALORES .= ",'notificacao'";
			$dbVALORES .= ",'" . strtolower($vformASSUNTO) . "'";
			
		} else {
			$dbVALORES .= ",'mensagem'";
			$dbVALORES .= ",''";
			
		}
		
		$dbVALORES .= ",'N'";
		
		$dbSALVAR = $vConexao->query("INSERT INTO sysmda_notificacoes (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());
	}

	// ***********************************************************


	$vSALVAR = "S";

	$vformDESTINO = "todos";
	$vformPRIORIDADE = "NORMAL";
	$vformEMAIL = "";
	$vformASSUNTO = "";
	$vformMENSAGEM = "";
	
}

if ($vformACAO == "encaminhar") {
	$vformDESTINO = isset($_POST["formDESTINO"]) ? $_POST["formDESTINO"] : NULL;
	$vformID_DESTINATARIO = isset($_POST["formID_DESTINATARIO"]) ? $_POST["formID_DESTINATARIO"] : NULL;
	$vformDESTINATARIO = isset($_POST["formDESTINATARIO"]) ? $_POST["formDESTINATARIO"] : NULL;
	$vformPRIORIDADE = isset($_POST["formPRIORIDADE"]) ? $_POST["formPRIORIDADE"] : NULL;
	$vformASSUNTO = isset($_POST["formASSUNTO"]) ? $_POST["formASSUNTO"] : NULL;
	$vformMENSAGEM = isset($_POST["formMENSAGEM"]) ? $_POST["formMENSAGEM"] : NULL;
	
	if ($vformDESTINO == "grupo") {
		$vformDESTINO_GRUPO = $vformDESTINATARIO;
		
	}
	
	if ($vformDESTINO == "membto") {
		$vformDESTINO_MEMBRO = $vformDESTINATARIO;
		
	}
	
	if ($vformDESTINO == "membto") {
		$vformDESTINO_EMAIL = $vformDESTINATARIO;
		
	}

	$vTituloSecao = "ENCAMINHAR MENSAGEM";
}

if (strtoupper($vformPRIORIDADE) == "BAIXA") {
	$vCHECKED_BAIXA = 'checked="checked"';
	$vCHECKED_MEDIA = '';
	$vCHECKED_NORMAL = '';
	$vCHECKED_URGENTE = '';

	
} elseif (strtoupper($vformPRIORIDADE) == "MÉDIA") {
	$vCHECKED_BAIXA = '';
	$vCHECKED_MEDIA = 'checked="checked"';
	$vCHECKED_NORMAL = '';
	$vCHECKED_URGENTE = '';
	
} elseif (strtoupper($vformPRIORIDADE) == "URGENTE") {
	$vCHECKED_BAIXA = '';
	$vCHECKED_MEDIA = '';
	$vCHECKED_NORMAL = '';
	$vCHECKED_URGENTE = 'checked="checked"';
	
} else {
	$vCHECKED_BAIXA = '';
	$vCHECKED_MEDIA = '';
	$vCHECKED_NORMAL = 'checked="checked"';
	$vCHECKED_URGENTE = '';
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />

	<script type="text/javascript" src="js/funcoes_geral.js"></script>
	<script type="text/javascript" src="js/menu_redirect.js"></script>
	
	<script type="text/javascript">
	function fAtualizaDestino(nn) {
		document.getElementById('areaEMAIL').style.display = "none";
		document.getElementById('areaDIRECT').style.display = "none";
		
		if (nn == "email") {
			document.getElementById('areaEMAIL').style.display = "block";

		}
	}
	</script>
	
	<?php
	if ($vSALVAR == "S") {
		echo '<script type="text/javascript">';
		echo 'setTimeout("fAVISOS()",5000);';
		echo '</script>';
		
	}
	?>

	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>

	<script language="JavaScript" type="text/javascript">
	//---------------------------------
	// Função fSegmentos() 
	//--------------------

	function fSegmentos(nnn) {
		if (nnn == 2) {
			document.getElementById('idCOMM').style.display = "none";
			document.getElementById('idSERV').style.display = "block";

		} else {
			document.getElementById('idCOMM').style.display = "block";
			document.getElementById('idSERV').style.display = "none";
		}
	}

	//---------------------------------
	// Função fConfirmeSenha()
	//--------------------

	function fConfirmeSenha() {
	  var s1 = document.getElementById('senhaX').value;
	  var s2 = document.getElementById('senhaC').value;
	  if (s2 != s1)
	  {
		alert('SENHA não confere');
		document.frmAnuncio.formSENHA.value = '';
		document.frmAnuncio.formSENHA.focus();
		return false;
	  }
	}
	</script>
	
	<style type="text/css">
		<!--
		#AreaAviso {
			background: #e04430;
			width: 940px;
			padding: 20px;
			border: #ffffff 2px solid;
			font-size: 20px;
			color: #ffff00;
			display: none;
			text-align: center;
		}
		
		#AreaAvisoTitulo {
			color: #ffffff;
			font-size: 38px;
			text-align: center;
		}
		-->
	</style>
</head>

<body>
<?php
$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

include "_submenus.php";
?>

<div align="center">
	<div id="form-cadastros" class="widthVAR">
		<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head"><?php echo $vTituloSecao ?></div>

		<form action="salvar_anuncio.php?local=<?php echo $getLOCAL ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>&r=<?php echo $vgetROTINAS ?>" method="post" target="target_" name="frmAnuncio" id="form-anuncio">
			<input name="formACAO" type="hidden" value="novo" />
			<input type="hidden" name="hidd_cadastro" value="ok" />

			<div class="clear">&nbsp;</div>					
			<div class="clear">&nbsp;</div>
			
			<input type="hidden" name="formIDCIDADE" value="<?php echo $getIDCIDADE ?>" />
			
			<div align="center" id="AreaAviso">
				<div id="AreaAvisoTitulo">ATENÇÃO</div>
				<br /><br />
				<div id="AreaAvisoMensagem">&nbsp;</div>
			</div>
			
			<table border="0">
				<tr>
					<td width="120" align="right">Cidade:</td>
					<td width="380">
						<span style="font-size: 18px; color: #e04430; font-family: tahoma, arial">
						<?php
						$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrocidades WHERE id=" . $getIDCIDADE) or die("Falha na execução da consulta.");							
							$vRE = mysqli_fetch_array($vQUERY);
							
							echo $vRE['nome'] . '/' . $vRE['estado'];
							echo '<input type="hidden" name="formCIDADE" value="' . $vRE['nome'] . '" />';
							echo '<input type="hidden" name="formUF" value="' . $vRE['estado'] . '" />';
						mysqli_free_result($vQUERY);
						?>
						</span>
					</td>
					<td width="400" rowspan="10" valign="top" align="left" style="border-left: #dddddd 1px solid; padding-left: 20px;">
						<div align="left">
							<?php
							$arrayCOMERCIO = Array();
							$arraySERVICOS = Array();
							$arrayCATEGORIAS = Array();
							
							$i = 0;
							$y = 0;
							
							$vQUERY = $vConexao->query("SELECT * FROM sysc_categorias WHERE nivel=2 ORDER BY nome") or die("Falha na execução da consulta.");
								while ($vRE = mysqli_fetch_assoc($vQUERY)) {
									$arrayCATEGORIAS[$i] = Array($vRE['id'], $vRE['nome']);
									$i++;

								}
							mysqli_free_result($vQUERY);
							?>
							
							<div class="form-campos-texto">Modalidade:</div>
							<input type="radio" name="formTIPO" value="comercio" checked="checked" /><span style="font-size: 16px">COMÉRCIO</span>&nbsp;&nbsp;&nbsp;<input type="radio" name="formTIPO" value="servicos" /><span style="font-size: 16px">SERVIÇOS</span><br />
							
							<div class="clear">&nbsp;</div>
							
							<div class="form-campos-texto">Categoria:</div>
							
							<div>
								<select name="formCATEGORIA" class="form_" onChange="showDIRECT(document.frmAnuncio.formCATEGORIA.options[document.frmAnuncio.formCATEGORIA.selectedIndex].value, '_getcategorias.php?idu=<?php echo $vgetIDUSUARIO ?>','directCATEGORIAS')">
									<option value="">...</option>
									<?php
									for ($i=0; $i < count($arrayCATEGORIAS); $i++) {
										echo '<option value="' . $arrayCATEGORIAS[$i][0] . '">';
										echo $arrayCATEGORIAS[$i][1];
										echo '</option>';
									}
									?>
								</select>
							</div>
							
							<div class="clear">&nbsp;</div>
							
							<div id="directCATEGORIAS"></div>
						</div>	

						<div class="clear">&nbsp;</div>
						<div class="clear">&nbsp;</div>

						<input type="submit" value="   Enviar Formulário   " class="submit_" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" value="  Limpar Formulário  " class="submit_reset" />

					</td>
				</tr>
				<tr>
					<td align="right">Bairro:</td>
					<td>
						<select name="formBAIRRO" class="form_">
						<?php
						$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrobairros WHERE (id_cidade=" . $getIDCIDADE . ") ORDER BY nome") or die("Falha na execução da consulta.");							
							while ($vRE = mysqli_fetch_assoc($vQUERY)) {
								if ($vRE['id'] == $getIDBAIRRO) {
									echo '<option value="' . $vRE['id']. '" selected="selected">';
									
								} else {
									echo '<option value="' . $vRE['id']. '">';
									
								}
								
								echo $vRE['nome'];
								echo '</option>';

							}
						mysqli_free_result($vQUERY);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Nome Fantasia:</td>
					<td><input type="text" name="formNOME" size="40" maxlength="80" class="form_" /></td>
				</tr>
				<tr>
					<td align="right">Dt. Nascimento:</td>
					<td>
						<select name="formDIA_NASCIMENTO" class="form_">
							<option value=""></option>
							<option value="1">01</option>
							<option value="2">02</option>
							<option value="3">03</option>
							<option value="4">04</option>
							<option value="5">05</option>
							<option value="6">06</option>
							<option value="7">07</option>
							<option value="8">08</option>
							<option value="9">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>/
						<select name="formMES_NASCIMENTO" class="form_">
							<option value=""></option>
							<option value="1">Janeiro</option>
							<option value="2">Fevereiro</option>
							<option value="3">Março</option>
							<option value="4">Abril</option>
							<option value="5">Maio</option>
							<option value="6">Junho</option>
							<option value="7">Julho</option>
							<option value="8">Agosto</option>
							<option value="9">Setembro</option>
							<option value="10">Outubro</option>
							<option value="11">Novembro</option>
							<option value="12">Dezembro</option>
						</select>/
						<select name="formANO_NASCIMENTO" class="form_">
							<option value=""></option>
							<?php
							for ($i = 0; $i < 100; $i++) {
								echo '<option value="' . (date("Y")-$i) .'">' . (date("Y")-$i) . '</option>';
							}
							?>
						</select>						
					</td>
				</tr>
				<tr>
					<td align="right">Endereço:</td>
					<td><input type="text" name="formENDERECO" size="40" maxlength="50" class="form_" /></td>
				</tr>
				<tr>
					<td align="right">Número:</td>
					<td><input type="text" name="formENDERECO_NUM" size="5" maxlength="5" class="form_" /></td>
				</tr>
				<tr>
					<td align="right">CEP:</td>
					<td><input type="text" name="formCEP" size="10" maxlength="8" class="form_" onkeypress="return fApenasNumero(event)" /></td>
				</tr>
				<tr>
					<td align="right">Fone:</td>
					<td><input type="text" name="formDDDFONE" size="2" maxlength="2" class="form_" onkeypress="return fApenasNumero(event)" /> - <input type="text" name="formFONE" size="10" maxlength="10" class="form_" onkeypress="return fApenasNumero(event)" />&nbsp;(ex: 11-99999999)</td>
				</tr>
				<tr>
					<td align="right">Celular:</td>
					<td><input type="text" name="formDDDCELULAR" size="2" maxlength="2" class="form_" onkeypress="return fApenasNumero(event)" /> - <input type="text" name="formCELULAR" size="10" maxlength="10" class="form_" onkeypress="return fApenasNumero(event)" /> (ex: 11-99999999)<br /></td>
				</tr>
				<tr>
					<td align="right">Email:</td>
					<td><input type="text" name="formEMAIL" size="40" maxlength="150" class="form_" id="$f_email" /></td>
				</tr>
			</table>
			
			<div class="clear">&nbsp;</div>
			<div class="clear">&nbsp;</div>

			<iframe src="../vazio.php" scrolling="no" frameborder="0" id="idFrame" name="target_" style="border: none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe></div>

			<div class="clear">&nbsp;</div>
			<div class="clear">&nbsp;</div>
			
		</form>
		

		
	</div>
</div>

<div id="boxDIALOGO"></div>

<script type="text/javascript">
	document.getElementById("boxDIALOGO").style.top = (fElementoPos("boxEIXO").top-150) + "px";

	document.getElementById("campo2").style.display = "none";
	document.getElementById("campo3").style.display = "none";
	document.getElementById("campo4").style.display = "none";
</script>

<?php
if ($vformACAO == "encaminhar") {
	echo '<script type="text/javascript">';
	echo 'fSelectDestino(' . $vDESTINO_NUM . ')';
	echo '</script>';
}
?>
</body>
</html>