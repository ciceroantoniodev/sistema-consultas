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

//------------------> INÍCIO DA INCLUSÃO NO BANCO

$vSalvar = "N";
$vError = 10;
$vMensagem = "";
$vTexto = "Caso já tenha efetuado o depósito do valor correspondente à aquisição dos códigos, envie o comprovante para confirmação e liberação dos mesmos. Segue os dados da conta e o detalhamento da aquisição.";

$vData = date("Y-m-d H:i:s");

$arrayDESCRICAO = Array();
$arrayIDPRODUTO = Array();
$arrayIDPEDIDO = Array();
$arrayQUANTIDADE = Array();
$arrayVALORES = Array();
$arrayCOMPROVANTE = Array();
$arrayDATA = Array();

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

if ($vformACAO == "excluir") {
	$vgetACAO = "confirmar";

}

if ($vgetACAO == "salvar") {
	$vAquisicaoTitulo = "Sua solicitação foi efetuada com sucesso";
	
	$x = 0;

	for ($i = 0; $i <= 10; $i++) {
		$vCampoDescricao = "formDESCRICAO" . $i;
		$vCampoId = "formIDPRODUTO" . $i;
		$vCampoQuantidade = "formQUANTIDADE" . $i;
		$vCampoValores = "formVALORES" . $i;
		
		if (isset($_POST[$vCampoDescricao])) {
			if (trim("".$_POST[$vCampoDescricao]) != "") { 
				$arrayDESCRICAO[$x] = $_POST[$vCampoDescricao];
				$arrayIDPRODUTO[$x] = $_POST[$vCampoId];
				$arrayQUANTIDADE[$x] = $_POST[$vCampoQuantidade];
				$arrayVALORES[$x] = $_POST[$vCampoValores];
				
				$x++;
				
			}
			
		}
		
	}
	
	for ($i = 0; $i < count($arrayDESCRICAO); $i++) {
		$dbVALORES = "0" . $vgetIDFRANQUIA;
		$dbVALORES .= ",0" . $getIDCIDADE;
		$dbVALORES .= ",0" . $arrayIDPRODUTO[$i];
		$dbVALORES .= ",0" . $vgetIDUSUARIO;
		$dbVALORES .= ",'" . $vgetTIPO . "'";
		$dbVALORES .= ",'" . $arrayDESCRICAO[$i] . "'";
		$dbVALORES .= ",0" . $arrayQUANTIDADE[$i];
		$dbVALORES .= ",0" . $arrayVALORES[$i];
		$dbVALORES .= ",0" . ($arrayVALORES[$i]*$arrayQUANTIDADE[$i]);
		$dbVALORES .= ",'S'";
		$dbVALORES .= ",'COMPROVAR'";
		$dbVALORES .= ",'0000-00-00'";
		$dbVALORES .= ",'" . $vData . "'";

		$dbCAMPOS = "id_franquia, id_cidade, id_produto, id_usuario, origem, descricao, quantidade, vlr_unitario, vlr_total, pendente, status, data_confirmacao, data_cad";
		
		$dbSALVAR = $vConexao->query("INSERT INTO sysc_financeiropedidos (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());

	}
	
} else if ($vgetACAO == "confirmar") {
	$vAquisicaoTitulo = "EXISTE UMA SOLICITAÇÃO EM ANDAMENTO";
	

} else if ($vgetACAO == "comprovante") {
	$vformPEDIDOS = isset($_POST["formIDPEDIDOS"]) ? $_POST["formIDPEDIDOS"] : NULL;

	$uploadDIR = '../documentos/comprovantes/';
	
	$vformFILE = $_FILES["formFILE"]['name'];
	$vformTEMP = $_FILES["formFILE"]['tmp_name'];
	
	$uploadOK = 20;
	
	// Pega extensão do arquivo
	preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $vformFILE, $vFileExtensao);

	// Gera um nome único para a imagem
	$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

	// Caminho de onde a imagem ficará
	$imagem_dir = $uploadDIR . $imagem_nome;

	// Faz o upload da imagem
	move_uploaded_file($vformTEMP, $imagem_dir);
	
	$imagem_nome = fImagemRedimensionar($imagem_nome, 300, "../documentos/comprovantes");
	
	$vSQL = "UPDATE sysc_financeiropedidos SET status='CONFIRMAR', data_confirmacao='" . date("Y-m-d H:i:s") . "', comprovante='" . $imagem_nome . "' WHERE ";
	
	if (strpos("#".$vformPEDIDOS, "][") > 0) {
		$vformPEDIDOS = str_replace("][", ") OR (id=", $vformPEDIDOS);
		$vformPEDIDOS = str_replace("[", "(id=", $vformPEDIDOS);
		$vformPEDIDOS = str_replace("]", ")", $vformPEDIDOS);
		
	} else {
		$vformPEDIDOS = str_replace("[", "(id=", $vformPEDIDOS);
		$vformPEDIDOS = str_replace("]", ")", $vformPEDIDOS);
	}
	
	$vSQL .= $vformPEDIDOS;
	
	$vConexao->query($vSQL) or die("Falha na execução da consulta.");

	$vAquisicaoTitulo = "EXISTE UMA SOLICITAÇÃO EM ANDAMENTO";

}

if ($vgetTIPO == "franquia") {
	$vSQL = "SELECT * FROM sysc_financeiropedidos WHERE (origem='" . $vgetTIPO . "') AND (id_franquia=" . (int)$vgetIDFRANQUIA . ") AND (pendente='S')";
	
} else {
	$vSQL = "SELECT * FROM sysc_financeiropedidos WHERE (origem='" . $vgetTIPO . "') AND (id_usuario=" . (int)$vgetIDUSUARIO . ") AND (pendente='S')";

}

$vQUERY = $vConexao->query($vSQL) or die("Falha na execução da consulta.");
	$x = 0;
	
	while ($vRE = mysqli_fetch_assoc($vQUERY)) {
		$arrayDESCRICAO[$x] = $vRE['descricao'];
		$arrayIDPEDIDO[$x] = $vRE['id'];
		$arrayIDPRODUTO[$x] = $vRE['id_produto'];
		$arrayQUANTIDADE[$x] = $vRE['quantidade'];
		$arrayVALORES[$x] = $vRE['vlr_unitario'];
		$arrayCOMPROVANTE[$x] = $vRE['comprovante'];
		$arrayDATA[$x] = $vRE['data_confirmacao'];

		$x++;

		if ($vgetACAO == "salvar") {
			$vNotificacao = '<span style=\"font-weight: bold\">Descrição:</span> <span style=\"color: #da251d\">' . $vRE['descricao'] . '</span><br />';
			$vNotificacao .= '<span style=\"font-weight: bold\">Valor Unitário:</span> <span style=\"color: #da251d\">R$ ' . number_format($vRE['vlr_unitario'], 2, ",", ".") . '</span><br />';
			$vNotificacao .= '<span style=\"font-weight: bold\">Quantidade:</span> <span style=\"color: #da251d\">' . $vRE['quantidade'] . '</span><br />';
			$vNotificacao .= '<span style=\"font-weight: bold\">Valor Total:</span> <span style=\"color: #da251d\">R$ ' . number_format(($vRE['vlr_unitario']*$vRE['quantidade']), 2, ",", ".") . '</span><br />';

			if ($vgetTIPO == "franquia") {
				$dbVALORES = "0" . $vgetIDUSUARIO;
				$dbVALORES .= ",0" . $vRE['id'];
				$dbVALORES .= ",0" . $vgetIDUSUARIO;
				$dbVALORES .= ",'usuario'";
				$dbVALORES .= ",'PORTAL MEU BAIRRO TEM'";
				$dbVALORES .= ",'" . $vNotificacao . "'";
				$dbVALORES .= ",'" . date("Y-m-d") . "'";
				$dbVALORES .= ",'" . date("H:i:s") . "'";
				$dbVALORES .= ",'codigo'";
				$dbVALORES .= ",'AQUISIÇÃO DE CÓDIGOS'";
				$dbVALORES .= ",'N'";
				$dbVALORES .= ",''";
				$dbVALORES .= ",'0000-00-00 00:00:00'";

			}
			
			$dbCAMPOS = "id_usuario, id_origem, id_destinatario, destino, remetente, mensagem, data, hora, tipo, aviso, lida, quem_leu, dt_lida";

			$dbSALVAR = $vConexao->query("INSERT INTO sysc_notificacoes (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());
		}
	}
mysqli_free_result($vQUERY);

if ($vformACAO == "excluir") {
	for ($i = 0; $i < count($arrayDESCRICAO); $i++) {
		$vConexao->query("UPDATE sysc_financeiropedidos SET pendente='S', status='COMPROVAR', data_confirmacao='0000-00-00 00:00:00', comprovante='' WHERE id=" . $arrayIDPEDIDO[$i]) or die("Falha na execução da consulta.");

		if (file_exists("../documentos/comprovantes/" . $arrayCOMPROVANTE[$i])) {
			$vUnLink = unlink("../documentos/comprovantes/" . $arrayCOMPROVANTE[$i]) or die (mysqli_error());

		}
		
		$arrayCOMPROVANTE[$i] = "";
		$arrayDATA[$i] = "0000-00-00 00:00:00";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>:: Portal Meu Bairro Tem - Acesse, Conheça, Valorize :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="Sistema para Gerenciamento de Células" />
	<meta name="keywords" content="rede, células, igreja, pastor, apostólico, sistema, gerenciamento, gestão" />
	
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="../documentos/js/funcoes-geral.js"></script>
	<script type="text/javascript" src="js/menu_redirect.js"></script>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
	
	<script type="text/javascript">
	function fBotaoSubmit() {
		document.getElementById("BotaoSubmit").style.display = "block";
	}
	</script>
	
	<style type="text/css">
	<!--
	.form-listagem {
		border: 1px #ccc solid;
		font-size: 13px;
		display: table;
		background: #fff;
		width: 700px;
	}
	
	.titulo {
		font-size: 24px;
		color: #DF013A;
		margin-top: 10px;
		margin-bottom: 15px;
	}
	
	.divConta {
		float: left;
	}
	
	.divDetalhes {
		float: right;
	}
	
	.td1 {
		border-top: #dddddd 1px solid;
		border-left: #dddddd 1px solid;
		
	}
	
	.td2 {
		border-top: #dddddd 1px solid;
		border-left: #dddddd 1px solid;
		border-right: #dddddd 1px solid;
		
	}
	
	.td3 {
		border-top: #dddddd 1px solid;
		
	}
	
	.td4 {
		border-top: #dddddd 1px solid;
		border-left: #ffffff 1px solid;
		
	}
	
	.form_file {
		background: #dddddd;
		border: #cccccc 1px solid;
		margin-top: 5px;
		margin-right: 30px;
	}
	
	.submit_codigos  {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 18px;
		color: #ffffff;
		background: #FF8000;
		height: 30px;
		border: none;
		border-right: #df7401 1px solid;
		border-bottom: #df7401 1px solid;
		width: 150px;
		height: 35px;
		margin: 10px;
	}

	.submit_excluir  {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 16px;
		color: #ffffff;
		background: #FF8000;
		height: 30px;
		border: none;
		border-right: #df7401 1px solid;
		border-bottom: #df7401 1px solid;
		width: 200px;
		height: 30px;
		margin: 10px;
	}

	-->
	</style>

</head>

<body>
<?php
$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

include "_submenus.php";

$vTotal = 0;
$vIdsPedidos = "";
$vComprovanteImagem = "";
$vComprovanteData = "";

$vECHO = '<table cellspacing="0" cellpadding="2" border="0">';
$vECHO .= '<tr bgcolor="#999999"><td colspan="4" class="td2"><div align="center" style="font-size: 16px">DETALHAMENTO</div></td></tr>';
$vECHO .= '<tr bgcolor="#dddddd"><td class="td1" width="40"><div align="center">QTD</div></td><td class="td4" width="120"><div align="center">DESCRIÇÃO</div></td><td class="td4" width="100"><div align="center">VLR.UNITÁRIO</div></td><td class="td4" width="100"><div align="center">VLR.TOTAL</div></td></tr>';

for ($i = 0; $i < count($arrayDESCRICAO); $i++) {
	$vECHO .= '<tr>';
	$vECHO .= '<td class="td1"><div align="center">' . $arrayQUANTIDADE[$i] . '</div></td>';
	$vECHO .= '<td class="td1">' . $arrayDESCRICAO[$i] . '</td>';
	$vECHO .= '<td class="td1"><div align="right">R$ ' . number_format($arrayVALORES[$i], 2, ",", ".") . '</div></td>';
	$vECHO .= '<td class="td2"><div align="right">R$ ' . number_format(($arrayVALORES[$i]*$arrayQUANTIDADE[$i]), 2, ",", ".") . '</div></td>';
	$vECHO .= '</tr>';
	
	$vTotal = ($vTotal+(($arrayVALORES[$i]*$arrayQUANTIDADE[$i])));
	$vIdsPedidos .= "[" . $arrayIDPEDIDO[$i] . "]";
	$vComprovanteImagem = $arrayCOMPROVANTE[$i];
	$vComprovanteData = strftime("%d/%m/%Y", strtotime($arrayDATA[$i]));

}

$vECHO .= '<tr><td colspan="4" class="td3"><div align="right" style="font-size: 16px; font-weight: bold">TOTAL GERAL: R$ ' .  number_format($vTotal, 2, ",",".") . '</div></td></tr>';
$vECHO .= '</table>';

if (fSeImagem($vComprovanteImagem)) {
	$vTexto = "<div style='color: #0431B4'>O seu comprovante foi enviado em <span style='font-weight: bold'>" . $vComprovanteData . "</span>. Aguarde um prazo máximo de 48h para confirmação e liberação dos seus códigos.</div>";
	
}

echo '<form action="salvar_codigos.php?local=' . $getLOCAL . '&r=' . $vgetROTINAS. '&n=' . $vgetNIVEL . '&tp=' . $vgetTIPO . '&idu=' . $vgetIDUSUARIO . '&idf=' . $vgetIDFRANQUIA . '&ida=' . $vgetIDVENDEDOR . '&acao=comprovante" method="post" enctype="multipart/form-data" name="frmAdquirirCodigos">';
echo '<input type="hidden" name="formACAO" value="" />';

echo '<br /><br /><div align="center"><div class="form-listagem"><table width="700" cellspacing="0" cellpadding="0" border="0"><thead></thead></tbody>';
echo '<tr><td class="form-cadastros-head" colspan="7"><a href="javascript: history.go(-' . $vBotaoVoltar . ')"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center">AQUISIÇÃO DE CÓDIGOS</div></td></tr>';
echo '<tr><td class="area-grid-barra">';

echo '<div align="center" class="titulo">' . $vAquisicaoTitulo . '</div>';
echo $vTexto;

echo '<div class="clear">&nbsp;</div>';

echo '<div class="divConta">';

if (fSeImagem($vComprovanteImagem)) {
	echo '<div><img src="../documentos/comprovantes/' . $vComprovanteImagem . '" width="300" border="0" /></div>';
	
} else {
	echo '<strong>Titular:</strong> CICERO ANTÔNIO DA SILVA<br />';
	echo '<strong>Banco:</strong> CAIXA ECONÔMICA FEDERAL<br />';
	echo '<strong>Agência:</strong> 0812<br />';
	echo '<strong>Conta Poupança:</strong> 00117071-7<br />';
	echo '<strong>Op.:</strong> 013<br />';
	echo '<strong>Valor:</strong> R$ ' . number_format($vTotal, 2, ",",".") . '<br />';
}

echo '</div>';

echo '<div class="divDetalhes">';
echo $vECHO;
echo '</div>';

echo '<div class="clear">&nbsp;</div>';

echo '<input type="hidden" name="formIDPEDIDOS" value="' . $vIdsPedidos . '" />';

echo '</td></tr>';
echo '<tr><td class="td1" height="50" valign="middle">';

if (fSeImagem($vComprovanteImagem)) {
	echo '<input type="hidden" name="formACAO" value="excluir" />';
	echo '<div align="center"><input type="submit" value="Excluir Comprovante" class="submit_excluir" /><br /><em><strong>Atenção:</strong> Se o comprovante for excluído, seu pedido ficará em aberto até que seja enviado um novo comprovante.</em></div><br />';
	
} else {
	echo '&nbsp;&nbsp;&nbsp;Enviar Comprovante: <input type="file" name="formFILE" class="form_file" onChange="fBotaoSubmit()" /><div align="center" id="BotaoSubmit" style="display: none"><input type="submit" value="Enviar" class="submit_codigos" /></div>';

}

echo '</td></tr>';
echo '</tbody></tfoot></tfoot></table></div></div><br /><br />';

echo '</form>';
?>
</body>
</html>
