<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetURL = isset($_GET["url"]) ? $_GET["url"] : NULL;
$vgetTITULO = isset($_GET["tt"]) ? $_GET["tt"] : NULL;

$vgetIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vgetIDOFERTA = isset($_GET['ida']) ? $_GET['ida'] : NULL;
$vgetIDUSUARIO = isset($_GET['idu']) ? $_GET['idu'] : NULL;
$vgetTIPO = isset($_GET['tp']) ? $_GET['tp'] : NULL;
$vAcao = isset($_GET['acao']) ? $_GET['acao'] : NULL;

$arrayCAMPOS = array();

$syscMARGINTOP = "80px";
$syscMARGINLEFT = "80px";

if ($vgetORIGEM == "classificados") {
	$syscTITULOSECAO = "ENVIAR IMAGENS PARA CLASSIFICADOS";
	$syscDB = "sysc_classificados";	
	$arrayCAMPOS[0] = "foto1";
	$arrayCAMPOS[1] = "foto2";
	$arrayCAMPOS[2] = "foto3";
	$arrayCAMPOS[3] = "foto4";
	$vgetPASTA = "../documentos/fotos/classificados";
	
} elseif ($vgetORIGEM == "ofertas") {
	$syscTITULOSECAO = "ENVIAR IMAGENS PARA UMA OFERTA";
	$syscDB = "sysc_cadastroofertas";
	$arrayCAMPOS[0] = "imagem";
	$arrayCAMPOS[1] = "foto1";
	$arrayCAMPOS[2] = "foto2";
	$arrayCAMPOS[3] = "foto3";
	$arrayCAMPOS[4] = "foto4";
	$vgetPASTA = "../documentos/fotos/ofertas";
	
}

if ($vAcao == "deletar") {
	$vgetARQUIVO = isset($_GET["arq"]) ? $_GET["arq"] : NULL;
	$vgetCAMPO = isset($_GET["campo"]) ? $_GET["campo"] : NULL;
	
	if ($vgetORIGEM == "classificados") {
		if (file_exists("../documentos/fotos/classificados/" . $vgetARQUIVO)) {
			$vUnLink = unlink("../documentos/fotos/classificados/" . $vgetARQUIVO) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_classificados SET " . $vgetCAMPO . "='' WHERE id=" . $vgetIDOFERTA) or die (mysqli_error());
				
		}
		
	} elseif ($vgetORIGEM == "ofertas") {
		if (file_exists("../documentos/fotos/ofertas/" . $vgetARQUIVO)) {
			$vUnLink = unlink("../documentos/fotos/ofertas/" . $vgetARQUIVO) or die (mysqli_error());
			
			$vConexao->query("UPDATE sysc_cadastroofertas SET " . $vgetCAMPO . "='' WHERE id=" . $vgetIDOFERTA) or die (mysqli_error());
				
		}
		
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script language="Javascript" src="./documentos/js/funcoes.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" media="all" />
	<style type="text/css">
	<!--
	html {height:100%;}

	.table {height:100%;}
	
	td {padding-left: 3px; padding-right: 3px}
	
	.form_file    {
				font-size: 12px;
				color: #e04430;
				height: 25px;
				font-family: arial, verdana, helvetica, sans-serif;
				margin-bottom: 6px;
				border-right: #698593 1px solid;
				border-top: #698593 1px solid;
				border-left: #698593 1px solid;
				border-bottom: #698593 1px solid;
				}

	
	.enviar {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 12px;
				color: #ffffff;
				height: 25px;
				border-style: solid;
				background: url(http://www20.syscontrole.com.br/documentos/images/ground_submit.gif) repeat-x;
				border-right: #047ac4 1px solid;
				border-top: #5cbedc 1px solid;
				border-left: #5cbedc 1px solid;
				border-bottom: #047ac4 1px solid;
				padding-left: 10px;
				padding-right: 10px;
				}

	-->
	</style>

	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
	<script type="text/javascript" src="js/funcoes_geral.js"></script>
</head>

<body style="margin: 0px; font-family: tahoma, arial">
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

	include "_submenus.php";
	?>

	<div id='ImagemLoading'></div>

	<div align="center" id="boxEIXO">
		<form action="salvar_enviarimagens.php?local=<?php echo $getLOCAL ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>&o=<?php echo $vgetORIGEM ?>" target="target_" method="post" enctype="multipart/form-data" style="margin: 0px" name="frmEnviarImagens">
			<input type="hidden" name="formPASTA" value="<?php echo $vgetPASTA ?>" />
			<input type="hidden" name="formFILES" value="<?php echo count($arrayCAMPOS) ?>" />
			<input type="hidden" name="formIDOFERTA" value="<?php echo $vgetIDOFERTA ?>" />
			<input type="hidden" name="formTITULO" value="<?php echo $vgetTITULO ?>" />

			<div id="form-cadastros" class="widthVAR">
				<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head"><?php echo $syscTITULOSECAO ?></div>
				
				<div class="clear"></div>
				
				<?php
				if ($vSALVAR == "S") {
					echo '<div id="areaAVISOS"><div style="padding: 5px;">MENSAGEM ENVIADA COM SUCESSO!</div></div>';
					
				}
				?>
			
				<div align="left" style="border-top: #cccccc 1px solid; border-bottom: #cccccc 1px solid; background: #dddddd; font-size: 14px; height: 25px; padding-top: 5px; color: #666666">
					&nbsp;&nbsp;&nbsp;Descrição: <strong><?php echo $vgetTITULO ?></strong>
					<div style="clear: right"></div>
				</div>
				
				<div align="left" style="margin: 10px">
					<?php
					echo '<div align="center" style="color: #666666; font-size: 13px"><em><span style="color: #ff0000; font-weight: bold">ATENÇÃO:</span> As imagens não podem ultrapassar o tamanho de 500 pixels e o peso em bytes não pode ser maior que 150 Kb. Caso contrário, o sistema fará um redimensionamento automático e isto poderá acarretar na perca de qualidade nas imagens.</em></div>';
					$dbSQL = "SELECT * FROM " . $syscDB . " WHERE id=" . $vgetIDA;
					
					$dbQUERY = $vConexao->query($dbSQL) or die("Falha na execução da consulta.");

					if (count($arrayCAMPOS) > 4) {
						$syscHEIGHT = 100;
						$syscWIDTH = 180;
						$syscSIZE = 5;
						$syscMARGIN = 15;

					} else {
						$syscHEIGHT = 150;
						$syscWIDTH = 200;
						$syscSIZE = 20;
						$syscMARGIN = 20;

					}
					
					while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
						for ($i = 0; $i < count($arrayCAMPOS); $i++) {
							
							$resCAMPO = $dbRE[$arrayCAMPOS[$i]];
							
							if ($i > 0) {
								echo '<hr style="width: 600px; border: none; border-bottom: 2px #cccccc solid" />';
							
							}
							
							echo '<div align="center">';
							
							echo '<h3>IMAGEM 0' . ($i + 1) . '</h3>';

							if (fSeImagem($resCAMPO) && file_exists("../documentos/" . $vgetPASTA . "/" . $resCAMPO)) {
								echo '<img src="../documentos/' . $vgetPASTA . '/' . $resCAMPO . '" border="0" /><br /><br />';
								echo '<div class="botao-red"><a href="web_enviarimagens.php?local=' . $getLOCAL . '&ida=' . $vgetIDOFERTA . '&idu=' . $vgetIDUSUARIO . '&tt=' . $vgetTITULO . '&tp=' . $vgetTIPO . '&o=' . $vgetORIGEM . '&acao=deletar&campo=' . $arrayCAMPOS[$i] . '&arq=' . $resCAMPO . '" class="rodape">&nbsp;&nbsp;Excluir Imagem&nbsp;&nbsp;</a></div>';

							} else {
								echo '<div id="divImagem' . $i . '"><div style="height: 150px; width: ' . $syscWIDTH . 'px; background: #dddddd; text-align: center; font-size: 13px; color: #666666"><br /><br /><br /><br /><em>sem imagem</em></div></div><br />';
								echo '<div id="divInput' . $i . '"><input type="file" name="formFILE' . ($i + 1) . '" size="' . $syscSIZE . '" class="form_file" onChange="javascript: fSubmit()" /></div>';
								
							}
							
							echo '</div>';

						}
					}
//beleza100
					?>
					
				</div><br /><br />
			</div>
		</form>
		<iframe src="../vazio.php" scrolling="no" frameborder="0" id="idFrame" name="target_" style="border: none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe></div>
	</div>
	
	<br style="clear: left" /><br />
	
	<script type="text/javascript">
	function fSubmit() {
		fLoading();
		document.frmEnviarImagens.submit();
	}
	</script>

</body>
</html>