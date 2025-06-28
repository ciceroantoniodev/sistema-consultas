<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

$vgetKEY = isset($_GET['key']) ? $_GET['key'] : NULL;
$vgetQRY = isset($_GET['qry']) ? $_GET['qry'] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Sistema MDA :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Conferências do Modelo de Discipulado Apostólico - MDA" />
	<meta name="keywords" content="mda, conferência, modelo, discipulado, apostólico, sistema, gerenciamento" />
	<link rel="stylesheet" type="text/css" href="documentos/css/estilo.css" media="all" />
	<script type="text/javascript" src="documentos/js/menu_redirect.js"></script>

</head>

<body>
<?php
if ($vgetKEY != $vgetQRY) {
	$dbSQL = "SELECT * FROM sysc_usuarios WHERE (id_cliente=" . $vusuarioIDC . ") AND ((nome LIKE '%" . $vgetQRY . "%') or (sobrenome LIKE '%" . $vgetQRY . "%') or (cpf LIKE '%" . $vgetQRY . "%') or (cidade LIKE '%" . $vgetQRY . "%') or (estado LIKE '%" . $vgetQRY . "%') or (fone LIKE '%" . $vgetQRY . "%') or (celular LIKE '%" . $vgetQRY . "%') or (email_proprio LIKE '%" . $vgetQRY . "%')) order by nome";
	
} else {
	$dbSQL = "SELECT * FROM sysc_usuarios WHERE tipo='vendedor' ORDER BY nome";
	
}

$dbQUERY = $vConexao->query($dbSQL) or die("Falha na execução da consulta.");

$syscLINHA = 1;
$syscCOR = 1;

echo '<form name="frmGrid">';
echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr>';

//if (strpos("AB" . $vusuarioACESSO, "4") > 0) {
	echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';
	
//}

echo '<td align="center" class="area-grid-cabeca">ID</td>';
echo '<td align="center" class="area-grid-cabeca">NOME COMPLETO</td>';
echo '<td align="center" class="area-grid-cabeca">CIDADE</td>';
echo '<td align="center" class="area-grid-cabeca">FONE</td>';
echo '<td align="center" class="area-grid-cabeca">AÇÃO</td></tr>';

while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
	if ($syscCOR == 1) {
		echo '<tr bgcolor="#ffffff">';
		$syscCOR = 2;
		
	} else {
		echo '<tr bgcolor="#f8f8f8">';
		$syscCOR = 1;
		
	}
	
//	if (strpos("AB" . $vusuarioACESSO, "4") > 0) {
		echo '<td class="area-grid-cel"><div align="center">';
		echo '<input type="checkbox" name="formEXCLUIR" value="' . $dbRE['id'] . '" />';
		echo '</div></td>';
		
//	}

	echo '<td class="area-grid-cel"><div align="center">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&r=' . $vgetROTINAS . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo StrZero($dbRE['id'], 6);
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&r=' . $vgetROTINAS . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['nome']) . " " . trim($dbRE['sobrenome']);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel"><div align="center">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&r=' . $vgetROTINAS . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		
		if (trim($dbRE['fone']) >= 7) {
			echo '(' . trim($dbRE['dddfone']) . ') ';
			echo substr(trim($dbRE['fone']), 0, strlen(trim($dbRE['fone']))-4) . '-' . substr(trim($dbRE['fone']), strlen(trim($dbRE['fone']))-4);

		} else if (trim($dbRE['celular']) >= 7) {
			echo '(' . trim($dbRE['dddcelular']) . ') ';
			echo substr(trim($dbRE['celular']), 0, strlen(trim($dbRE['celular']))-4) . '-' . substr(trim($dbRE['celular']), strlen(trim($dbRE['celular']))-4);
			
		}
		
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&r=' . $vgetROTINAS . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['cidade']);
		echo '/';
		echo $dbRE['estado'];
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel borderRIGHT">';
		echo '<a href="ger_codigos.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&r=' . $vgetROTINAS . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo 'Gerar Códigos';
		echo '</a>';
	echo '</td>';

	echo '</tr>';
}

echo '<tr bgcolor="#cccccc"><td colspan="10" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';

?>
</body>
</html>