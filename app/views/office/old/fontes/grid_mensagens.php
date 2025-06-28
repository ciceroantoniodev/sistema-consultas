<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";
include "../documentos/include/funcoes.php";

$vKey = isset($_GET['key']) ? $_GET['key'] : NULL;
$vQry = isset($_GET['qry']) ? $_GET['qry'] : NULL;

$vID_Usuario = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vTipo = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$vStatus = isset($_GET['status']) ? $_GET['status'] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="docs/style/geral_.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="docs/style/formularios_.css" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="docs/js/menu_redirect.js"></script>

</head>

<body>
<?php
if ($vKey != $vQry) {
	$vSQL = "SELECT * FROM sysc_mensagensenviadas WHERE (nome LIKE '%" . $vQry . "%') OR (email_proprio LIKE '%" . $vQry . "%') OR (bairro LIKE '%" . $vQry . "%') OR (cidade LIKE '%" . $vQry . "%') ORDER BY " . $arrayORDER[($vOrder-1)][1];

} else {
	$vSQL = "SELECT * FROM sysc_mensagensenviadas WHERE (id_usuario=" . $vID_Usuario . ") OR (id_destinatario=" . $vID_Usuario . ") ORDER BY id DESC";

}

$linha = 1;
$cor = 1;

echo '<form name="frmGrid">';
echo '<table width="100%" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr>';

echo '<td align="center" class="area-grid-cabeca"><div align="center"><input type="checkbox" name="formMARCARTODOS" value="0" onClick="fMarcarTodos()" /></div></td>';

echo '<td align="center" class="area-grid-cabeca">ID</td>';
echo '<td align="center" class="area-grid-cabeca">ASSUNTO</td>';
echo '<td align="center" class="area-grid-cabeca">REMETENTE</td>';
echo '<td align="center" class="area-grid-cabeca">PRIORIDADE</td>';
echo '<td align="center" class="area-grid-cabeca">DATA</td>';
echo '<td align="center" class="area-grid-cabeca">HORA</td>';
echo '<td align="center" class="area-grid-cabeca">LIDA?</td></tr>';

$z = 1;

$vQUERY = $vConexao->query($vSQL) or die("Falha na execução da consulta.");
	while ($vRE = mysqli_fetch_assoc($vQUERY)) {
		if ($cor == 1) {
			$vColor = "#ffffff";
			$cor = 2;
			
		} else {
			$vColor = "#f8f8f8";
			$cor = 1;
			
		}
		
		echo '<tr id="tr' . $z . '" bgcolor="' . $vColor . '" onMouseOver="mOvr(this, ' . $z . ', \'#FFF8DC\')" onMouseOut="mOut(this, ' . $z . ', \'' . $vColor . '\')">';
		
//		if (strpos("AB" . $vusuarioACESSOS, "4") > 0) {
			echo '<td class="area-grid-cel"><div align="center">';
			echo '<input type="checkbox" name="formEXCLUIR" value="' . $vRE['id'] . '" />';
			echo '</div></td>';
			
//		}
		
		echo '<td class="area-grid-cel borderRIGHT"><div align="center">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';
			echo StrZero(trim($vRE['id']), 6);
			echo '</a>';
		echo '</div></td>';
		
		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';
			echo trim($vRE['assunto']);
			echo '</a>';
		echo '</td>';
		
		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';

			if ($vStatus == "E") {
				echo strtoupper($vRE['destinatario']);

			} else {
				echo strtoupper($vRE['remetente']);

			}

			echo '</a>';
		echo '</td>';
		
		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';
			
			if (strtoupper($vRE['prioridade']) == "URGENTE") {
				echo '<font color="#e04430">';
				
			} elseif (strtoupper($vRE['prioridade']) == "BAIXA") {
				echo '<font color="#999999">';
				
			} elseif (strtoupper($vRE['prioridade']) == "MÉDIA") {
				echo '<font color="#4db849">';
				
			} else {
				echo '<font color="#333333">';
				
			}
			
			echo $vRE['prioridade'];
			echo '</font>';
			
			echo '</a>';
		echo '</td>';
		
		echo '<td class="area-grid-cel borderRIGHT"><div align="center">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';
			echo strftime("%d/%m/%Y", strtotime($vRE['data_hora']));
			echo '</a>';
		echo '</div></td>';
		
		echo '<td class="area-grid-cel borderRIGHT">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';
			echo strftime("%H:%M:%S", strtotime($vRE['data_hora']));
			echo '</a>';
		echo '</td>';
		
		echo '<td class="area-grid-cel borderRIGHT borderRIGHT"><div align="center">';
			echo '<a href="ver_mensagem.php?id=' . $vID_Usuario . '&ida=' . $vRE['id'] . '&acao=alterar" target="main" class="grid">';
			
			if ($vRE['lida'] == "S") {
				echo '<font color="#999999">SIM</font>';
				
			} else {
				echo '<font color="#e04430">NÃO</font>';
				
			}
			
			echo '</a>';
		echo '</div></td>';
		
		echo '</tr>';
		
		$z++;
		
	}
mysqli_free_result($vQUERY);

echo '</tbody></tfoot></tfoot></table></div></form>';
?>
</body>
</html>
