<?php
$syscHTML = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
$syscHTML .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
$syscHTML .= '<head>';
$syscHTML .= '	<title>:::: Petrolina Piscinas :::: </title>';
$syscHTML .= '	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />';
$syscHTML .= '</head>';
$syscHTML .= '<body style="margin: 0px; background: #f4f4f4; font-family: tahoma, arial">';
$syscHTML .= '	<div align="center" style="height: 110px;text-align: center; margin-bottom: 30px;background: #0055a2;border-bottom: #211f60 5px solid;width: 100%; color: #ffffff; font-family: tahoma, arial; font-size: 24px"><div style="font-size: 44px; font-weight: bold; padding-top: 10px">PETROLINA PISCINAS</div><div>Divers&atilde;o Para Toda Fam&iacute;lia</div></div>';
$syscHTML .= '	<div style="margin-left: 40px; margin-right: 40px; font-size: 14px">';
$syscHTML .= '		<div align="left" style="font-size: 24px">Ol&aacute;, <font color="#ff0000">'. $mailNome . '</font></div>';
$syscHTML .= '		<div>&nbsp;</div>';
$syscHTML .= '		<div>&nbsp;</div>';
$syscHTML .= $mailConteudo;
$syscHTML .= '		<div>&nbsp;</div>';
$syscHTML .= '		<div align="left"><strong style="color: #057336; font-size: 16px">' . $mailAssinatura . '</strong><br /></div>';
$syscHTML .= '		<div>&nbsp;</div>';
$syscHTML .= '		<div>&nbsp;</div>';
$syscHTML .= '		<div>&nbsp;</div>';
$syscHTML .= '		<div align="center" style="font-size: 16px; font-style: italic; color: #666666; border-top: #dddddd 1px solid"><br />Esta é uma mensagem automática, favor não responder este e-mail.</div>';
$syscHTML .= '		<div><span style="color: #f4f4f4">.</span></div>';
$syscHTML .= '		<div><span style="color: #f4f4f4">.</span></div>';
$syscHTML .= '	</div>';
$syscHTML .= '</body>';
$syscHTML .= '</html>';

$header = "MIME-Version: 1.1\n";
$header .= "Content-type: text/html; charset=UTF-85\n";
$header .= "From: Não Responder <atendimento@petrolinapiscinas.com.br>\n";
$header .= "Return-Path: atendimento@petrolinapiscinas.com.br\n";

//ini_set("SMTP", "177.71.93.126");

$mailEnviar = mail("$mailDestinatario", "$mailAssunto", $syscHTML, $header, "-ratendimento@petrolinapiscinas.com.br");
?>

