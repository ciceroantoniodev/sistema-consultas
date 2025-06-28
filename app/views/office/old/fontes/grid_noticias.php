<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vgetKEY = isset($_GET['key']) ? $_GET['key'] : NULL;
$vgetQRY = isset($_GET['qry']) ? $_GET['qry'] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Conferências do Modelo de Discipulado Apostólico - MDA" />
	<meta name="keywords" content="mda, conferência, modelo, discipulado, apostólico, sistema, gerenciamento" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" media="all" />

</head>

<body>
<?php
if ($vgetKEY != $vgetQRY) {
	$dbSQL = "SELECT * FROM sysc_noticias WHERE (titulo LIKE '%" . $vgetQRY . "%') OR (categoria LIKE '%" . $vgetQRY . "%') ORDER BY id DESC";
	
} else {
	$dbSQL = "SELECT * FROM sysc_noticias WHERE (titulo LIKE '" . $vgetKEY . "%') ORDER BY id DESC";
	
}

$dbQUERY = $vConexao->query($dbSQL) or die("Falha na execução da consulta.");

$syscCOR = 1;

echo '<form name="frmGrid" style="margin: 0px">';
echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr height="40">';
echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';

echo '<td align="center" class="area-grid-cabeca">ID</td>';
echo '<td align="center" class="area-grid-cabeca">TÍTULO</td>';
echo '<td align="center" class="area-grid-cabeca">CATEGORIA</td>';
echo '<td align="center" class="area-grid-cabeca">VISUALIZAÇÕES</td>';
echo '<td align="center" class="area-grid-cabeca">COMENTÁRIOS</td>';
echo '<td align="center" class="area-grid-cabeca">DESTAQUE<br />NA HOME?</td>';
echo '<td align="center" class="area-grid-cabeca">ORDEM<br />DESTAQUE</td></tr>';

while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
	$syscIMAGENS = 0;
	
	if ($syscCOR == 1) {
		echo '<tr bgcolor="#ffffff">';
		$syscCOR = 2;
		
	} else {
		echo '<tr bgcolor="#f8f8f8">';
		$syscCOR = 1;
		
	}
	
	echo '<td class="area-grid-cel"><div align="center">';
	echo '<input type="checkbox" name="formEXCLUIR" value="' . $dbRE['id'] . '" />';
	echo '</div></td>';

	echo '<td class="area-grid-cel"><div align="center">';
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo StrZero($dbRE['id'], 6);
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo substr(trim($dbRE['titulo']), 0, 40);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['categoria']);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel"><div align="right">';
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['visualizacoes'];
		echo '</a>&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '</div></td>';

	echo '<td class="area-grid-cel"><div align="right">';
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['comentarios']);
		echo '</a>&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '</div></td>';

	echo '<td class="area-grid-cel"><div align="center">';
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		
		if ($dbRE['destaque_externo'] == "S") {
			echo 'Sim';
			
		} else {
			echo '<font color="#999999">Não</font>';
		
		}
		
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel borderRIGHT"><div align="center">';	
		echo '<a href="cad_noticias.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['ordem_externo'];
		echo '</a>';
	echo '</div></td>';

	echo '</tr>';
}

echo '<tr bgcolor="#cccccc"><td colspan="10" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';
?>
</body>
</html>