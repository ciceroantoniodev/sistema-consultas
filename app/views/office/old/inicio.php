<?php
header("Content-Type: text/html; charset=UTF-8",true);

session_start();

include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;

if (fSeImagem($_SESSION['syscFOTO']) && file_exists("images/photos/" . $_SESSION['syscFOTO'])) {
	$vFotoPerfil = "images/photos/" . $_SESSION['syscFOTO'];

} else {
	if ($_SESSION['syscSEXO'] == "F") {
		$vFotoPerfil = "images/semfoto_feminino.jpg";
		
	} else {
		$vFotoPerfil = "images/semfoto_masculino.jpg";
		
	}
}

$vNomePerfil = str_replace(" ", ";", trim($_SESSION['syscNOME']));

$vAlertaBanco = substr($_SESSION['syscALERTAS'], 0, 1);
$vAlertaEmail = substr($_SESSION['syscALERTAS'], 1, 1);
$vAlertaRg = substr($_SESSION['syscALERTAS'], 2, 1);
$vAlertaCpf = substr($_SESSION['syscALERTAS'], 3, 1);
$vAlertaSituacao = substr($_SESSION['syscALERTAS'], 4, 1);
$vChamadosPendentes = substr($_SESSION['syscALERTAS'], 5, 1);

$arrayNome = explode(";", $vNomePerfil);

$vNomePerfil = $arrayNome[0];

if ((strlen($vNomePerfil)+strlen($arrayNome[1])) <= 20) { 
	$vNomePerfil .= " " . $arrayNome[1];
	
	if (count($arrayNome) > 2) {
		if ((strlen($vNomePerfil)+strlen($arrayNome[2])) <= 20) { 
			if (strlen($arrayNome[2]) > 3) {
				$vNomePerfil .= " " . $arrayNome[2];

			}
		}
	}

}

include "conexao.php";

$vValorInvestimento = 0;
$vValorRetorno = 0;
$vQuantRetorno = 0;
$vTxtRetorno = " Saque";
$vValorComissao = 0;
$vValorSaldo = 0;

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SysControle - Sistema Gerenciador de Conteúdo</title>
		<meta http-equiv="content-language" content="pt-br">
		
		<meta name="robots" content="index, follow">
		<meta name="author" content="SAMSITE Web Design Sistemas">
		<meta name="reply-to" content="suporte@samsite.com.br">
		
		<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div id="areaConteudo">
			
			<div align="center" style="margin-top: 120px;">
				<?php
				if (strpos("_".$_SESSION['syscALERTAS'], "S") > 0) {
					echo '<div id="areaAlertas">';
					
						if ($vChamadosPendentes == "S") {
							echo '<div style="clear: both"><div style="float: left; margin-right: 10px"><img src="images/icone_exclamacao.png" border="0" width="25" /></div><div style="float: left; padding-top: 5px">Voc&ecirc; possue <span style="font-weight: bold">CHAMADOS</span> pendentes. <a href="javascript: showDIRECT(\'\', \'chamados.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="home target="direcionar">Clique aqui</a> para visualizar..</div></div>';
						}
						
						if ($vAlertaSituacao == "S") {
							echo '<div style="clear: both"><div style="float: left; margin-right: 10px"><img src="images/icone_exclamacao.png" border="0" width="25" /></div><div style="float: left; padding-top: 5px">Pagamento da <span style="font-weight: bold">ADES&Atilde;O</span> ainda n&atilde;o confirmado. <a href="javascript: showDIRECT(\'\', \'meuplano.php?idu=' . fId("c", $vgetIDUSUARIO) . '\', \'areaConteudo\')" class="home target="direcionar">Envie aqui</a> o comprovante.</div></div>';
						}
						
						if ($vAlertaBanco == "S") {
							echo '<div style="clear: both"><div style="float: left; margin-right: 10px"><img src="images/icone_exclamacao.png" border="0" width="25" /></div><div style="float: left; padding-top: 5px">Atualize seus <span style="font-weight: bold">Dados de Recebimento</span> atrav&eacute;s do menu FINANCEIRO.</div></div>';
						}
						
						if ($vAlertaEmail == "S") {
							echo '<div style="clear: both"><div style="float: left; margin-right: 10px"><img src="images/icone_exclamacao.png" border="0" width="25" /></div><div style="float: left; padding-top: 5px">Seu <span style="font-weight: bold">E-MAIL</span> ainda n&atilde;o foi validado. <a href="enviar_mensagem.php?idu=' . fId("c", $vgetIDUSUARIO) . '&o=validar" class="home target="direcionar">Clique aqui</a>, caso n&atilde;o tenha recebido a mensagem de valida&ccedil;&atilde;o.</div></div>';
						}
						
						if ($vAlertaRg == "S") {
							echo '<div style="clear: both"><div style="float: left; margin-right: 10px"><img src="images/icone_exclamacao.png" border="0" width="25" /></div><div style="float: left; padding-top: 5px">Seu <span style="font-weight: bold">RG</span> ainda n&atilde;o foi validado. Envie atrav&eacute;s do menu GERENCIAMENTO / DADOS CADASTRAIS.</div></div>';
						}
						
						if ($vAlertaCpf	== "S") {
							echo '<div style="clear: both"><div style="float: left; margin-right: 10px"><img src="images/icone_exclamacao.png" border="0" width="25" /></div><div style="float: left; padding-top: 5px">Seu <span style="font-weight: bold">CPF</span> ainda n&atilde;o foi validado. Envie atrav&eacute;s do menu GERENCIAMENTO / DADOS CADASTRAIS.</div></div>';
						}
						
					echo '</div>';
					
					if ($vAlertaEmail == "S") {
						echo '<div id="area-tabela-salvar" style="display: none; width: 700px; margin-top: 20px; margin-bottom: 20px; background: #A9E2F3; border: #2ECCFA 5px solid; padding: 20px; font-size: 20px; color: #045FB4"><div align="center">Mensagem de valida&ccedil;&atilde;o enviada com sucesso! Verique seu e-mail.</div></div>';
						
					}
				}
				?>
				
				<div class="clear"><br /><br /><br /></div>

				<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>

				<div class="clear"><br /><br /></div>

			</div>
		</div>
	</body>
</html>