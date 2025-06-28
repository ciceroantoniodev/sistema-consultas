<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fIdu(0, $_GET["idu"]) : NULL;
$vgetIDFRANQUIA = isset($_GET["idf"]) ? $_GET["idf"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vgetNIVEL = isset($_GET["n"]) ? $_GET["n"] : NULL;
$vgetIDVENDEDOR = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetACAO = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { $vBotaoVoltar = 1; }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="js/menu_redirect.js"></script>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>

<body>
<?php
$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

include "_submenus.php";

$vDelTabela = "sysc_usuarios";
$vDelCampo = "nome";

if ($vgetTIPO == "franquia") {
	$dbSQL = "SELECT * FROM sysc_codigos WHERE id_franquia=" . $vgetIDFRANQUIA . " ORDER BY id";
	
} else {
	$dbSQL = "SELECT * FROM sysc_codigos WHERE id_usuario=" . $vgetIDVENDEDOR . " ORDER BY id";
	
}

$dbQUERY = $vConexao->query($dbSQL) or die("Falha na execução da consulta.");

$syscLINHA = 1;
$syscCOR = 1;


echo '<br /><br /><div align="center"><div class="form-listagem"><table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr><td class="form-cadastros-head" colspan="7"><a href="javascript: history.go(-' . $vBotaoVoltar . ')"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center">GERENCIAMENTO DE CÓDIGOS</div></td></tr>';
echo '<tr><td class="area-grid-barra" colspan="7">';

echo '<div class="floatRIGHT"><form action="excluir_registros.php?local=' . $getLOCAL . '&tp=' . $vgetTIPO . '&idu=' . $vgetIDUSUARIO . '" method="post" name="frmGridExcluir"><input type="hidden" name="formDELTABELA" value="" /><input type="hidden" name="formDELCAMPO" value="" /><input type="hidden" name="formDEL" value="" /><input type="button" value="  Excluir Seleção " class="botao-excluir" onClick="fExcluirRegistros(\'' . $vDelTabela . '\',\'' . $vDelCampo . '\')" /></form></div>';
echo '<div class="floatRIGHT"><a href="codigos_adquirir.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&idf=' . $vgetIDFRANQUIA . '&r=' . $vgetROTINAS . '&n=' . $vgetNIVEL . '&tp=' . $vgetTIPO . '" class="rodape" target="main"><div class="botao-novo">&nbsp;&nbsp;&nbsp;ADQUIRIR&nbsp;&nbsp;&nbsp;</div></a></div>';

echo '<div id="divMEMBROS" class="floatRIGHT">&nbsp;</div>';

echo '</td></tr>';
echo '<tr><td>';

echo '<form name="frmGrid">';
echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr>';

//if (strpos("AB" . $vusuarioACESSO, "4") > 0) {
	echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';
	
//}

echo '<td align="center" class="area-grid-cabeca">ID</td>';
echo '<td align="center" class="area-grid-cabeca">NOME COMPLETO</td>';
echo '<td align="center" class="area-grid-cabeca">CPF</td>';
echo '<td align="center" class="area-grid-cabeca">CIDADE</td>';
echo '<td align="center" class="area-grid-cabeca">ESTADO</td>';
echo '<td align="center" class="area-grid-cabeca">FONE</td>';
echo '<td align="center" class="area-grid-cabeca">E-MAIL</td>';
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
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo StrZero($dbRE['id'], 6);
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['nome']) . " " . trim($dbRE['sobrenome']);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['cpf_cnpj'];
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['cidade'];
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel"><div align="center">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo $dbRE['estado'];
		echo '</a>';
	echo '</div></td>';

	echo '<td class="area-grid-cel"><div align="center">';
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		
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
		echo '<a href="cad_usuarios.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo trim($dbRE['email_proprio']);
		echo '</a>';
	echo '</td>';

	echo '<td class="area-grid-cel borderRIGHT">';
		echo '<a href="ger_codigos.php?local=' . $getLOCAL . '&idu=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '&ida=' . $dbRE['id'] . '&acao=alterar" target="main" class="grid">';
		echo 'Gerar Códigos';
		echo '</a>';
	echo '</td>';

	echo '</tr>';
}

echo '<tr bgcolor="#cccccc"><td colspan="10" class="area-grid-fechar">&nbsp;</td></tr></tbody></tfoot></tfoot></table></div></form>';

echo '</div></td></tr>';
echo '</tbody></tfoot></tfoot></table></div></div><br /><br />';
?>

<script type="text/javascript">showDIRECT("", "grid_vendedores.php?local=<?php echo $getLOCAL ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>&key=", "areaDIRECT");</script>

</body>
</html>
