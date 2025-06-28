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
	$dbSQL = "SELECT * FROM sysc_cadastrogeral WHERE (titulo LIKE '%" . $vgetQRY . "%') OR (categoria LIKE '%" . $vgetQRY . "%') ORDER BY id DESC";
	
} else {
	$dbSQL = "SELECT * FROM sysc_cadastrogeral WHERE (fantasia LIKE '" . $vgetKEY . "%') ORDER BY id DESC";
	
}

$dbQUERY = $vConexao->query($dbSQL) or die("Falha na execução da consulta.");

$syscCOR = 1;

echo '<form name="frmGrid" style="margin: 0px">';
echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr height="40">';
echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';

echo '<td align="center" class="area-grid-cabeca">ID</td>';
echo '<td align="center" class="area-grid-cabeca">NOME FANTASIA</td>';
echo '<td align="center" class="area-grid-cabeca">BAIRRO</td>';
echo '<td align="center" class="area-grid-cabeca">CIDADE</td>';
echo '<td align="center" class="area-grid-cabeca">FONE</td>';
echo '<td align="center" class="area-grid-cabeca">ANÚNCIO</td>';
echo '<td align="center" class="area-grid-cabeca">EXPIRAÇÃO</td></tr>';

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
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo StrZero($dbRE['id'], 6);
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo substr(trim($dbRE['fantasia']), 0, 40);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['bairro']);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel"><div align="left">';
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['cidade'] . '/' . $dbRE['estado'];
		echo '</a>&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '</div></td>';

	echo '<td class="area-grid-cel"><div align="left">';
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		
		if (trim($dbRE['fone1']) >= 7) {
			echo '(' . trim($dbRE['dddfone1']) . ') ';
			echo substr(trim($dbRE['fone1']), 0, strlen(trim($dbRE['fone1']))-4) . '-' . substr(trim($dbRE['fone1']), strlen(trim($dbRE['fone1']))-4);

		} else if (trim($dbRE['fone2']) >= 7) {
			echo '(' . trim($dbRE['dddfone2']) . ') ';
			echo substr(trim($dbRE['fone2']), 0, strlen(trim($dbRE['fone2']))-4) . '-' . substr(trim($dbRE['fone2']), strlen(trim($dbRE['fone2']))-4);
			
		} else if (trim($dbRE['celular1']) >= 7) {
			echo '(' . trim($dbRE['dddcelular1']) . ') ';
			echo substr(trim($dbRE['celular1']), 0, strlen(trim($dbRE['celular1']))-4) . '-' . substr(trim($dbRE['celular1']), strlen(trim($dbRE['celular1']))-4);
			
		} else if (trim($dbRE['celular2']) >= 7) {
			echo '(' . trim($dbRE['dddcelular2']) . ') ';
			echo substr(trim($dbRE['celular2']), 0, strlen(trim($dbRE['celular2']))-4) . '-' . substr(trim($dbRE['celular2']), strlen(trim($dbRE['celular2']))-4);
			
		} else if (trim($dbRE['fax']) >= 7) {
			echo '(' . trim($dbRE['dddfax']) . ') ';
			echo substr(trim($dbRE['fax']), 0, strlen(trim($dbRE['fax']))-4) . '-' . substr(trim($dbRE['fax']), strlen(trim($dbRE['fax']))-4);
			
		}
		
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel"><div align="left">&nbsp;&nbsp;&nbsp;';
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['anuncio'];
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel borderRIGHT"><div align="center">';	
		echo '<a href="cad_anuncio.php?local=' . $getLOCAL . '&ida=' . $dbRE['id'] . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&acao=alterar" target="main" class="grid">';
		echo strftime("%d/%m/%Y", strtotime($dbRE['data_expira']));
		echo '</a>';
	echo '</div></td>';

	echo '</tr>';
}

echo '<tr bgcolor="#cccccc"><td colspan="10" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';
?>
</body>
</html>