<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vKey = isset($_GET['key']) ? $_GET['key'] : NULL;
$vQry = isset($_GET['qry']) ? $_GET['qry'] : NULL;

$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
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
		$vSQL = "SELECT * FROM sysc_classificados WHERE id_usuario=" . $vgetIDUSUARIO . " ORDER BY titulo";

	}

	$vQUERY = $vConexao->query($vSQL) or die("Falha na execução da consulta.");

	$linha = 1;
	$cor = 1;

	echo '<form name="frmGrid">';
	echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
	echo '<tr>';

	echo '<td align="center" class="area-grid-cabeca">TÍTULO</td>';
	echo '<td align="center" class="area-grid-cabeca">CATEGORIA</td>';
	echo '<td align="center" class="area-grid-cabeca">ESTADO</td>';
	echo '<td align="center" class="area-grid-cabeca">PREÇO</td>';
	echo '<td align="center" class="area-grid-cabeca">IMAGENS</td>';
	echo '<td align="center" class="area-grid-cabeca">ATIVO</td></tr>';

	$z = 1;

	while ($vRE = mysqli_fetch_assoc($vQUERY)) {
		if ($cor == 1) {
			$vColor = "#ffffff";
			$cor = 2;

		} else {
			$vColor = "#f8f8f8";
			$cor = 1;

		}

		echo '<tr id="tr' . $z . '" bgcolor="' . $vColor . '" onMouseOver="mOvr(this, ' . $z . ', \'#FFF8DC\')" onMouseOut="mOut(this, ' . $z . ', \'' . $vColor . '\')">';

		echo '<td class="area-grid-cel">';
			echo '<a href="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' . $vRE['id'] . '&tp=' . $vgetTIPO . '" target="main" class="grid">';
			echo trim($vRE['titulo']);
			echo '</a>';
		echo '</td>';

		echo '<td class="area-grid-cel borderRIGHT"><div align="left">';
			echo '<a href="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' . $vRE['id'] . '&tp=' . $vgetTIPO . '" target="main" class="grid">';
			echo trim($vRE['categoria']);
			echo '</a>';
		echo '</div></td>';

		echo '<td class="area-grid-cel borderRIGHT"><div align="left">';
			echo '<a href="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' . $vRE['id'] . '&tp=' . $vgetTIPO . '" target="main" class="grid">';
			echo trim($vRE['estado']);
			echo '</a>';
		echo '</div></td>';

		echo '<td class="area-grid-cel borderRIGHT"><div align="right">';
			echo '<a href="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' . $vRE['id'] . '&tp=' . $vgetTIPO . '" target="main" class="grid">R$ ';
			echo number_format($vRE['preco'], 2, ",", ".");
			echo '</a>';
		echo '&nbsp;&nbsp;&nbsp;</div></td>';
		
		echo '<td class="area-grid-cel"><div align="center">';
			echo '<a href="web_enviarimagens.php?local=' . $getLOCAL . '&ida=' . $vRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tt=' . trim($vRE['titulo']) . '&tp=' . $vgetTIPO . '&o=classificados&acao=alterar" target="main" class="grid">';
			echo '<em>[ atualizar ]</em>';
			echo '</a>';
		echo '</div></td>';
		
		echo '<td class="area-grid-cel borderRIGHT"><div align="center">';
			echo '<a href="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' . $vRE['id'] . '&tp=' . $vgetTIPO . '" target="main" class="grid">';
			
			if ($vRE['ativo'] == "S") {
				echo 'SIM';
				
			} else {
				echo '<span style="color: #999999">NÃO</span>';
				
			}
			
			echo '</a>';
		echo '</div></td>';

		echo '</tr>';

		$z++;

	}

	echo '</tbody></tfoot></tfoot></table></div></form>';
	?>
</body>
</html>
