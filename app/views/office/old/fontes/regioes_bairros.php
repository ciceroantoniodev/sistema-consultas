<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";

$vgetID = isset($_GET["idc"]) ? $_GET["idc"] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="js/menu_redirect.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
	
	.border1 {
		border-top: #999999 1px solid;
		border-left: #999999 1px solid;
		border-right: #999999 1px solid;
		font-size: 24px;
	}
	
	.border2 {
		background: url(images/bg_grid.png) repeat-x;
		height: 37px;
		border-left: #999999 1px solid;
		border-right: #999999 1px solid;
	}
	
	.border3 {
		background: url(images/bg_grid.png) repeat-x;
		height: 37px;
		border-right: #999999 1px solid;
	}
    -->	
    </style>
</head>
  
<body>
	<div align="left">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td class="border1" colspan="3">BAIRROS</td>
			</tr>
			<tr>
				<td class="border2">NOME</td>
				<td class="border3">FONE</td>
				<td class="border3">ATUAL PRESIDENTE</td>
			</tr>
			
			<?php
			$vQUERY = $vConexao->query("SELECT sysc_cadastrobairros.*, sysc_cadastroassociacao.dddfone, sysc_cadastroassociacao.fone, sysc_cadastroassociacao.presidente FROM sysc_cadastrobairros INNER JOIN sysc_cadastroassociacao ON sysc_cadastrobairros.id=sysc_cadastroassociacao.id_bairro WHERE sysc_cadastrobairros.id_cidade=" . $vgetID . " ORDER BY nome") or die("Falha na execução da consulta.");
				while ($vRE = mysqli_fetch_assoc($vQUERY)) {
					$vBairroID = $vRE['id'];
					$vBairroNome = $vRE['nome'];
					$vBairroFone = $vRE['dddfone'] . $vRE['fone'];
					$vBairroPresidente = $vRE['presidente'];
					
					echo '<tr>';
					echo '<td>' . $vBairroNome . '</td>';
					echo '<td>' . $vBairroFone . '</td>';
					echo '<td>' . $vBairroPresidente . '</td>';
					echo '</tr>';
				}
			mysqli_free_result($vQUERY);
			?>
			
		</table>
	</div>
</body>
</html>