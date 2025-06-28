<?php
$vHTML = '<html>';
$vHTML .= '<head>';
$vHTML .= '	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>';
$vHTML .= '	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';
$vHTML .= '	<style type="text/css">';
$vHTML .= '	<!--';
$vHTML .= '	body {margin: 20px; color: #333333}';
$vHTML .= '	table {height:100%; border: #dddddd 5px solid; color: #333333}';
$vHTML .= '	td {padding-left: 5px; padding-right: 3px}';
$vHTML .= '	hr {border: none; border-top: #cccccc 2px solid;}';
$vHTML .= '	.att {font-family: tahoma, arial; font-size: 22px; margin-top: 10px; margin-bottom: 30px}';
$vHTML .= '	.corpo {font-family: tahoma, arial; font-size: 14px}';
$vHTML .= '	-->';
$vHTML .= '	</style>';
$vHTML .= '</head>';
$vHTML .= '<body bgcolor="#f4f4f4">';
$vHTML .= '	<div align="center">';
$vHTML .= '		<table bgcolor="#ffffff" width="70%" border="0">';
$vHTML .= '			<tr>';
$vHTML .= '				<td><img src="http://www.meubairrotem.com/documentos/imagens/meubairrotem-logomarca_topo.gif" border="0"></td>';
$vHTML .= '				<td align="right" valign="bottom" style="font-family: \'lucida sans\', tahoma, arial; color: #047ec4; font-size: 18px">Valorize o comércio e os serviços do seu bairro<br><br><a href="http://www.meubairrotem.com">www.meubairrotem.com</a></td>';
$vHTML .= '			</tr>';
$vHTML .= '			<tr>';
$vHTML .= '				<td colspan="2"><hr></td>';
$vHTML .= '			</tr>';
$vHTML .= '			<tr>';
$vHTML .= '				<td colspan="2" height="100%" align="left" valign="top">';
$vHTML .= '					<div align="justify">';
$vHTML .= '						<div class="att">Olá, ' . $vemailNOME . '</div>';
$vHTML .= '						<div class="corpo">' . $vemailTEXTO . '</div>';
$vHTML .= '					</div>';
$vHTML .= '				</td>';
$vHTML .= '			</tr>';
$vHTML .= '		</table>';
$vHTML .= '	</div>';
$vHTML .= '</body>';
$vHTML .= '</html>';

ini_set("SMTP", "108.167.188.124");

$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-15\r\n";
$header .= "From: [Portal Meu Bairro Tem] " . $vemailFROMNOME . " <" . $vemailFROMEMAIL . ">";

mail($vemailEMAIL, $vemailASSUNTO, $vHTML, $header);
?>