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

$vTituloSecao = "CADASTRAR NOVA MENSAGEM";

$vgetIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;

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

include("fckeditor/fckeditor.php");
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
	
	<script language="JavaScript" type="text/javascript">
	function fValidaForm() {
		if (document.frmMensagens.formDESTINO.value.length == 0) {
			fBoxDialogo("Selecione uma Destinatário no campo ENVIAR PARA.");
			document.frmMensagens.formDESTINO.value = '';
			document.frmMensagens.formDESTINO.focus();
			return false;
		}
		
		if (document.frmMensagens.formDESTINO.value == "email") {
			if (document.frmMensagens.formNOME.value.length == 0) {
				fBoxDialogo("O campo PARA não pode ser vazio!");
				document.frmMensagens.formNOME.value = '';
				document.frmMensagens.formNOME.focus();
				return false;
			}
			
			if (document.frmMensagens.formEMAIL.value.length == 0) {
				fBoxDialogo("O campo E-MAIL não pode ser vazio!");
				document.frmMensagens.formEMAIL.value = '';
				document.frmMensagens.formEMAIL.focus();
				return false;
			}
		}
		
		if (document.frmMensagens.formASSUNTO.value.length == 0) {
			fBoxDialogo("O campo ASSUNTO não pode ser vazio!");
			document.frmMensagens.formASSUNTO.value = '';
			document.frmMensagens.formASSUNTO.focus();
			return false;
		}

	}
	</script>
	
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
	<form action="cad_mensagens.php?id=<?php echo $vgetIDUSUARIO ?>&ida=<?php echo $vgetIDA ?>&go=<?php echo $vBotaoVoltar ?>" method="post" style="margin-top: 0px; margin-bottom: 0pt" name="frmMensagens" onSubmit="return fValidaForm()">
		<input name="formACAO" type="hidden" value="novo" />
		
		<div id="form-cadastros" class="widthVAR">
			<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head"><?php echo $vTituloSecao ?></div>
			
			<div class="clear"></div>
			
			<?php
			if ($vSALVAR == "S") {
				echo '<div id="areaAVISOS"><div style="padding: 5px;">MENSAGEM ENVIADA COM SUCESSO!</div></div>';
				
			}
			?>
			
			<div align="left" id="area-historico-corpoL">
				<strong>Enviar para:</strong><br /><br />
				<div id="boxEIXO">
					<select name="formDESTINO" class="form_select" tabindex="1" onChange="fAtualizaDestino(document.frmMensagens.formDESTINO.options[document.frmMensagens.formDESTINO.selectedIndex].value)">
						<option value="">...</option>
						<option value="cadastro">SETOR DE CADASTRO</option>
						<option value="suporte">SUPORTE TÉCNICO</option>
						<option value="financeiro">SUPORTE FINANCEIRO</option>
						<option value="email">E-MAIL</option>
					</select>
				</div>
				
				<div class="clear"></div>
				
				<div id="areaDIRECT"></div>
				
				<div id="areaEMAIL" class="displayNONE"><br /><strong>Para: </strong><input type="text" name="formNOME" size="30" tabindex="2" maxlength="80" value="" class="form_co" /><br /><strong>E-mail: </strong><input type="text" name="formEMAIL" size="35" tabindex="3" maxlength="250" value="" class="form_co" /><br /></div>
				
				<div class="clear"><br /></div>
				
				<div class="form-mensagens-nomes"><strong>Prioridade:</strong></div>
				
				<div class="clear"><br /></div>
				
				<div class="form-mensagens-edicao">
					<input type="radio" name="formPRIORIDADE" tabindex="4" value="NORMAL" <?php echo $vCHECKED_NORMAL ?> /> Normal
					<input type="radio" name="formPRIORIDADE" tabindex="5" value="BAIXA" <?php echo $vCHECKED_BAIXA ?> /> Baixa
					<input type="radio" name="formPRIORIDADE" tabindex="6" value="MÉDIA" <?php echo $vCHECKED_MEDIA ?> /> Média
					<input type="radio" name="formPRIORIDADE" tabindex="7" value="URGENTE" <?php echo $vCHECKED_URGENTE ?> /> Urgente
				</div>
				 
				<div class="clear"><br /></div>
				
				<div>
					<strong>Assunto:</strong><br />
					<textarea name="formASSUNTO" tabindex="9" rows="2" cols="47" class="form_textarea_editor width340"><?php echo $vformASSUNTO ?></textarea>
				</div>
				 
				<div class="clear"><br /></div>
				
				<input type="submit" value="  Enviar Mensagem  " tabindex="10" class="submit_" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" Cancelar Mensagem " tabindex="11" class="submit_reset" onClick="<?php echo 'javascript: history.go(-' . $vBotaoVoltar . ')' ?>" />
			</div>
			
			<div align="left" id="form-mensagens-corpoR">
				<strong>&nbsp;Mensagem:</strong><br /><br />
				<?php
				$sBasePath = "fckeditor/";

				$oFCKeditor = new FCKeditor('formMENSAGEM') ;
				$oFCKeditor->BasePath	= $sBasePath ;
				$oFCKeditor->Width = 580;
				$oFCKeditor->Height = 340;
				$oFCKeditor->ToolbarSet = "Basic";
				$oFCKeditor->Value = $vformMENSAGEM;
				$oFCKeditor->Create();
				?>
				
			</div>
			
			<div class="clear">&nbsp;</div>
				
		</div>
	</form>
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