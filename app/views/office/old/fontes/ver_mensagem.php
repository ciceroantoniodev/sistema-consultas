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

$vIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;
$vformVOLTAR = isset($_POST["formVOLTAR"]) ? $_POST["formVOLTAR"] : NULL;

$vSQL = "select * from sysc_mensagensenviadas where id=" . $vIDA;

$vQUERY = $vConexao->query($vSQL) or die("Falha na execução da consulta.");

while ($vRE = mysqli_fetch_assoc($vQUERY)) {
	$vformDESTINO = $vRE['destino'];
	$vformASSUNTO = $vRE['assunto'];
	$vformID_DESTINATARIO = $vRE['id_destinatario'];
	$vformDESTINATARIO = $vRE['destinatario'];
	$vformPRIORIDADE = $vRE['prioridade'];
	$vformMENSAGEM = $vRE['descricao'];
	$vformENCAMINHAR = $vRE['encaminhar'];

	$vformDATA = strftime("%d/%m/%Y", strtotime($vRE['data_hora']));
	$vformHORA = strftime("%H:%M:%S", strtotime($vRE['data_hora']));

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
</head>

<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<div align="center">
		<form action="cad_mensagens.php?id=<?php echo $vgetIDUSUARIO ?>&go=<?php echo $vBotaoVoltar ?>" method="post" style="margin-top: 0px; margin-bottom: 0pt" name="frmMensagens" onSubmit="return fValidaCad()">
			<input name="formACAO" type="hidden" value="encaminhar" />
			<input name="formDESTINO" type="hidden" value="<?php echo $vformDESTINO ?>" />
			<input name="formID_DESTINATARIO" type="hidden" value="<?php echo $vformID_DESTINATARIO ?>" />
			<input name="formDESTINATARIO" type="hidden" value="<?php echo $vformDESTINATARIO ?>" />
			<input name="formPRIORIDADE" type="hidden" value="<?php echo $vformPRIORIDADE ?>" />
			<input name="formASSUNTO" type="hidden" value="<?php echo $vformASSUNTO ?>" />
			<input name="formMENSAGEM" type="hidden" value="<?php echo $vformMENSAGEM ?>" />
			
			<div id="form-cadastros" class="widthVAR">
				<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head">VISUALIZAÇÃO DE MENSAGEM</div>
				
				<?php
				if ($vSALVAR == "S") {
					echo '<div id="areaAVISOS"><div style="padding: 5px;">MENSAGEM ENVIADA COM SUCESSO!</div></div>';
					
				}
				?>
				
				<div class="clear"></div>
				
				<div id="area-igreja-Dados">
					<div align="left" id="form-mensagens-corpoL">
						<div class="form-mensagens-nomes floatLEFT"><strong>Destinatário:&nbsp;&nbsp;</strong></div>
						<div class="form-mensagens-edicao floatLEFT"><font color="#e04430">
						<?php
						echo strtoupper($vformDESTINO);

						if ((strtoupper($vformDESTINO) != "TODOS") && (strtoupper($vformDESTINO) != "SUPORTE")) {
							echo ':' . strtoupper($vformDESTINATARIO);
							
						}
						?>
						</font></div>
						 
						<div class="clear"><br /></div>
						
						<div class="form-mensagens-nomes floatLEFT"><strong>Prioridade:&nbsp;&nbsp;</strong></div>
						<div class="form-mensagens-edicao floatLEFT"><font color="#e04430"><?php echo $vformPRIORIDADE ?></font></div>
						 
						<div class="clear"><br /></div>
						
						<div>
							<strong>Assunto:&nbsp;&nbsp;</strong><font color="#e04430"><?php echo $vformASSUNTO ?></font><br />
						</div>
						 
						<div class="clear"><br /><br /></div>
						
						<?php
						if ($vformENCAMINHAR == "S") {
							echo '<input type="submit" value="  Encaminhar Mensagem  " tabindex="14" class="submit_" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

						}
						?>
						
						<input type="button" value="    Retornar    " tabindex="15" class="submit_reset" onClick="<?php echo 'javascript: history.go(-' . $vBotaoVoltar . ')' ?>" />
						
						<div class="clear"><br /></div>
					</div>
					
					<div align="left" id="form-mensagens-corpoR">
						<strong>Mensagem:</strong><br />
						<font color="#047ac4">
						
						<?php
						if (fSeImagem($vformMENSAGEM)) {
							if (file_exists("banners/".$vformMENSAGEM)) {
								echo '<img src="banners/' .$vformMENSAGEM . '" border="0" />';
								
							} else {
								echo $vformMENSAGEM;
								
							}
							
						} else {
							echo $vformMENSAGEM;

						}
						?>
						
						</font>
					</div>

				</div>
			</div>
		</form>
	</div>
</body>
</html>