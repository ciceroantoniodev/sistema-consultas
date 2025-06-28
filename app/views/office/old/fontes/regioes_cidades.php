<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "../documentos/include/conexao.php";

$vgetUF = isset($_GET["uf"]) ? $_GET["uf"] : NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="js/menu_redirect.js"></script>
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
	
	.areaTITULOS1 {
		background: #666666;
		color: #ffffff;
		font-weight: bold;
		font-size: 16px;
		height: 23px;
		padding-top: 2px;
		text-align: center;
		width: 250px;
		margin-left: -1px;
	}
	
	.areaICONES1 {
		background: #cccccc;
		color: #ffffff;
		font-weight: bold;
		font-size: 12px;
		height: 23px;
		padding-top: 3px;
		text-align: left;
		border: #999999 1px solid;
		width: 248px;
		margin-left: -1px;
		margin-bottom: -20px;
	}
	
    -->	
    </style>
</head>
  
<body style="margin: 0px;">
	<table cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td><div class="areaTITULOS1">CIDADES</div></td>
		</tr>
		<tr>
			<td>
				<div align="left" style="margin-bottom: 10px">
					<?php
						$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastrocidades WHERE estado='" . $vgetUF . "' ORDER BY nome") or die("Falha na execução da consulta.");
							while ($vRE = mysqli_fetch_assoc($vQUERY)) {
								$vCidadeID = $vRE['id'];
								$vCidadeNome = $vRE['nome'];
								
								echo '<div><input type="radio" name="formCIDADES" valeu="' . $vCidadeID . '" onClick="showDIRECT(\'\',\'regioes_bairros.php?idc=' . $vCidadeID . '\',\'areaBAIRROS\')" /> ' . $vCidadeNome . '</div>';
							}
						mysqli_free_result($vQUERY);
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td><div class="areaICONES1"><div class="botao_novo">&nbsp;Nova&nbsp;</div></div></td>
		</tr>
	</table>
</body>
</html>