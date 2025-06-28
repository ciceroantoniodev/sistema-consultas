<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";

$vKey = isset($_GET['key']) ? $_GET['key'] : NULL;
$vQry = isset($_GET['qry']) ? $_GET['qry'] : NULL;

$vID_Usuario = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vTipo = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>::: sysREDE - Gestão de Células :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="docs/style/geral_.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="docs/style/formularios_.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
	<?php
	if ($vQry != "") {
		$vSQL = "SELECT * FROM sysc_classificados WHERE (nome LIKE '%" . $vQry . "%') ORDER BY titulo";

	} else {
		$vSQL = "SELECT * FROM sysc_classificados WHERE id_usuario=" . $vID_Usuario . " ORDER BY titulo";

	}

	$vQUERY = $vConexao->query($vSQL) or die("Falha na execução da consulta.");

	$linha = 1;
	$cor = 1;

	echo '<form name="frmGrid">';
	echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
	echo '<tr>';

	echo '<td align="center" class="area-grid-cabeca">TÍTULO</td>';
	echo '<td align="center" class="area-grid-cabeca">DESCRIÇÃO</td>';
	echo '<td align="center" class="area-grid-cabeca">TIPO</td></tr>';

	echo '<tr id="tr1" bgcolor="#ffffff" onMouseOver="mOvr(this, 1, \'#FFF8DC\')" onMouseOut="mOut(this, 1, \'#ffffff\')">';

		echo '<td class="area-grid-cel" width="400">';
			echo '<a href="ler_pdf.php?id=seja_um_consultor.pdf&tipo=pdf" target="main" class="grid">';
			echo 'COMO SE TORNAR UM CONSULTOR';
			echo '</a>';
		echo '</td>';

		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ler_pdf.php?id=seja_um_consultor.pdf&tipo=pdf" target="main" class="grid">';
			echo 'Arquivo contendo orientações de como fazer parte da nossa equipe de Consultores Independentes, para se obter lucros com a venda de nossos produtos virtuais.';
			echo '</a>';
		echo '</td>';
			
		echo '<td class="area-grid-cel borderRIGHT" width="100"><div align="center">';
			echo '<a href="ler_pdf.php?id=seja_um_consultor.pdf&tipo=pdf" target="main" class="grid">';
			echo 'Arquivo PDF<br />';
			echo '<img src="images/icone_pdf.png" border="0" width="50" vspace="10" />';
			echo '</a>';
		echo '</div></td>';

	echo '</tr>';

	echo '<tr id="tr1" bgcolor="#f4f4f4" onMouseOver="mOvr(this, 1, \'#FFF8DC\')" onMouseOut="mOut(this, 1, \'#f4f4f4\')">';

		echo '<td class="area-grid-cel" width="400">';
			echo '<a href="ler_pdf.php?id=apresentacao_meubairrotem.pdf&tipo=pdf" target="main" class="grid">';
			echo 'APRESENTAÇÃO';
			echo '</a>';
		echo '</td>';

		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ler_pdf.php?id=apresentacao_meubairrotem.pdf&tipo=pdf" target="main" class="grid">';
			echo 'Uma breve apresentação de Quem Somos e quais os nossos objetivos.';
			echo '</a>';
		echo '</td>';
			
		echo '<td class="area-grid-cel borderRIGHT" width="100"><div align="center">';
			echo '<a href="ler_pdf.php?id=apresentacao_meubairrotem.pdf&tipo=pdf" target="main" class="grid">';
			echo 'Arquivo PDF<br />';
			echo '<img src="images/icone_pdf.png" border="0" width="50" vspace="10" />';
			echo '</a>';
		echo '</div></td>';

	echo '</tr>';

	echo '<tr id="tr1" bgcolor="#ffffff" onMouseOver="mOvr(this, 1, \'#FFF8DC\')" onMouseOut="mOut(this, 1, \'#ffffff\')">';

		echo '<td class="area-grid-cel" width="400">';
			echo '<a href="ler_pdf.php?id=planos_meubairrotem.pdf&tipo=pdf" target="main" class="grid">';
			echo 'PLANOS - TIPOS DE ANÚNCIOS';
			echo '</a>';
		echo '</td>';

		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ler_pdf.php?id=planos_meubairrotem.pdf&tipo=pdf" target="main" class="grid">';
			echo 'Além do plano gratuito, temos planos que darão ao anúncio maior visibilidade e destaques exclusivos dentro do Portal. Conheça nossos planos GOLD e PREMIUM.';
			echo '</a>';
		echo '</td>';
			
		echo '<td class="area-grid-cel borderRIGHT" width="100"><div align="center">';
			echo '<a href="ler_pdf.php?id=planos_meubairrotem.pdf&tipo=pdf" target="main" class="grid">';
			echo 'Arquivo PDF<br />';
			echo '<img src="images/icone_pdf.png" border="0" width="50" vspace="10" />';
			echo '</a>';
		echo '</div></td>';

	echo '</tr>';

	echo '</tbody></tfoot></tfoot></table></div></form>';
	?>
</body>
</html>
