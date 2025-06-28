<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vgetIDOFERTA = isset($_GET['ida']) ? $_GET['ida'] : NULL;
$vgetIDUSUARIO = isset($_GET['idu']) ? $_GET['idu'] : NULL;
$vTipo = isset($_GET['tp']) ? $_GET['tp'] : NULL;

$vOfertas = isset($_GET['ofertas']) ? $_GET['ofertas'] : NULL;

$vAcao = isset($_GET['acao']) ? $_GET['acao'] : NULL;

$vTituloSecao = "CADASTRAR NOVA OFERTA";

$f_descricao = "";
$f_preco_atual = "0";
$f_preco_oferta = "0";
$f_preco_parcelado = "0";
$f_preco_parcelas = "0";
$f_preco_condicao = "avista";
$f_preco_descricao = "à vista";
$f_tipo = "preco";
$f_tipo_outro = "";
$f_data_fim = date("Y-m-d");
 
$vCheckedTipoPreco = "checked";
$vCheckedTipoOutros = "";

$vCheckedCondicaoAvista = "checked";
$vCheckedCondicaoAprazo = "";

$vCheckedAtivoSim = "";
$vCheckedAtivoNao = "checked";

$vOnLoad = "";

if ($vAcao == "alterar") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_cadastroofertas WHERE id=" . $vgetIDOFERTA) or die("Falha na execução da consulta.");
		$vRE = mysqli_fetch_array($vQUERY);

		if ($vRE != "") {
			$f_descricao = $vRE['descricao'];
			$f_preco_atual = "0" . $vRE['preco_atual'];
			$f_preco_oferta = "0" . $vRE['preco_oferta'];
			$f_preco_parcelado = "0" . $vRE['preco_parcelado'];
			$f_preco_parcelas = "0" . $vRE['preco_parcelas'];
			$f_preco_condicao = $vRE['preco_condicao'];
			$f_preco_descricao = $vRE['preco_descricao'];
			$f_tipo = $vRE['tipo'];
			$f_tipo_outro = $vRE['tipo_outro'];
			$f_liberado = $vRE['liberado'];
			$f_data_fim = $vRE['data_fim'];
			$vformIMAGEM = $vRE['imagem'];
			
			if ($f_liberado == "S") {
				$vCheckedAtivoSim = "checked";
				$vCheckedAtivoNao = "";

			} else {
				$vCheckedAtivoSim = "";
				$vCheckedAtivoNao = "checked";

			}

			if ($f_tipo == "preco") {
				$vCheckedTipoPreco = "checked";
				$vCheckedTipoOutros = "";

			} else {
				$vCheckedTipoPreco = "";
				$vCheckedTipoOutros = "checked";

			}

			if ($f_preco_condicao == "avista") {
				$vCheckedCondicaoAvista = "checked";
				$vCheckedCondicaoAprazo = "";
				
			} else {
				$vCheckedCondicaoAvista = "";
				$vCheckedCondicaoAprazo = "checked";

			}

		}

	mysqli_free_result($vQUERY);
  
	$vTituloSecao = "ATUALIZAR DADOS EM OFERTA";
	$vOnLoad = "onLoad='javascript: fVisualizar()'";
  
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
	
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />

	<script type="text/javascript" src="js/funcoes_geral.js"></script>
	
	<script language="JavaScript" type="text/javascript">
	function fVisualizar() {
		document.getElementById("descricao").innerHTML = document.frmOfertas.txt_descricao.value;
		
		if (document.frmOfertas.formIMAGEM.value.length > 0) {
			document.getElementById("imagem").innerHTML = "<img src='../documentos/fotos/ofertas/" + document.frmOfertas.formIMAGEM.value + "' width='120' height='120' border='0' />";

		}

		if (document.frmOfertas.radio_ofertatipo[0].checked) {
			document.getElementById("div_preco").style.display = "block";
			document.getElementById("div_outros").style.display = "none";
			document.getElementById("oferta_dinamica").style.display = "none";
			document.getElementById("valor_normal").style.display = "block";
			document.getElementById("valor_oferta").style.display = "block";
			document.getElementById("condicao").style.display = "block";
			document.getElementById("preco_normal").innerHTML = "De: R$ " + document.frmOfertas.txt_preco_normal.value;

			if (document.frmOfertas.radio_condicao[0].checked) {
				document.getElementById("quantas_parcelas").style.display = "none";
				document.getElementById("valor_parcela").style.display = "none";
				document.getElementById("condicao_aprazo").style.display = "none";
				document.getElementById("preco_oferta").innerHTML = "Por: R$ " + document.frmOfertas.txt_preco_oferta.value + " <span style='color: #333333; font-size: 12px'>à vista</span>";
				
			} else {
				document.getElementById("quantas_parcelas").style.display = "block";
				document.getElementById("valor_parcela").style.display = "block";
				document.getElementById("condicao_aprazo").style.display = "block";
				document.getElementById("preco_oferta").innerHTML = "Por: R$ " + document.frmOfertas.txt_preco_oferta.value + " <span style='color: #333333; font-size: 12px'>à vista ou</span> " + document.frmOfertas.txt_parcelas.value + " X R$ " + document.frmOfertas.txt_valor_parcela.value + " <span style='color: #333333; font-size: 12px'>" + document.frmOfertas.txt_descricaocondicao.value + "</span>";
			}
		} else {
			document.getElementById("div_preco").style.display = "none";
			document.getElementById("div_outros").style.display = "block";
			document.getElementById("div_outros").innerHTML = "<span style='font-size: 11px; color: #333333'>" + document.frmOfertas.txt_ofertadinamica.value + "</span>";
			document.getElementById("valor_normal").style.display = "none";
			document.getElementById("valor_oferta").style.display = "none";
			document.getElementById("condicao").style.display = "none";
			document.getElementById("quantas_parcelas").style.display = "none";
			document.getElementById("valor_parcela").style.display = "none";
			document.getElementById("condicao_aprazo").style.display = "none";
			document.getElementById("oferta_dinamica").style.display = "block";

		}

	}

	function fValidaForm() {
		hoje = new Date();
		if (document.frmOfertas.txt_descricao.value.length == 0) {
			fBoxDialogo('o campo DESCRIÇÃO não pode ser vazio');
			document.frmOfertas.txt_descricao.value = '';
			document.frmOfertas.txt_descricao.focus();
			return false;
		}
	}
	</script>
	
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>
  
<body <?php echo $vOnLoad ?> style="margin: 0px;">
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;

	include "_submenus.php";
	?>
	<div align="center" id="boxEIXO">
		<form action="salvar_ofertas.php?local=<?php echo $getLOCAL ?>&ida=<?php echo $vgetIDOFERTA ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vTipo ?>&ofertas=<?php echo $vOfertas ?>" method="post" style="margin-top: 0px; margin-bottom: 0pt" name="frmOfertas" target="target_" onSubmit="return fValidaForm()">
			<input name="formACAO" type="hidden" value="<?php echo $vAcao ?>" />
			
			<div id="form-cadastros" class="widthVAR">
				<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head"><?php echo $vTituloSecao ?></div>
				
				<div class="clear"></div>
				
				<?php
				if ($vSALVAR == "S") {
					echo '<div id="areaAVISOS"><div style="padding: 5px;">MENSAGEM ENVIADA COM SUCESSO!</div></div>';
					
				}
				?>
			
				<input name="id" type="hidden" value="<?php echo $vgetIDOFERTA ?>">
				<input name="acao" type="hidden" value="<?php echo $vAcao ?>">
				<input name="formIMAGEM" type="hidden" value="<?php echo $vformIMAGEM ?>">

				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="letras_">
					<tr>
						<td valign="top" align="center">
							<table cellspacing="0" cellpadding="0" border="0" class="letras_">
								<tr> 
									<td valign="middle"> 
										Ativo:&nbsp;&nbsp;
										<input type="radio" name="radio_liberado"  value="S" <?php echo $vCheckedAtivoSim ?> onClick="fVisualizar()">Sim
										<input type="radio" name="radio_liberado"  value="N" <?php echo $vCheckedAtivoNao ?> onClick="fVisualizar()">Não
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										Oferta do tipo:&nbsp;&nbsp;
										<input type="radio" name="radio_ofertatipo"  value="preco" <?php echo $vCheckedTipoPreco ?> onClick="fVisualizar()">Preço
										<input type="radio" name="radio_ofertatipo"  value="outros" <?php echo $vCheckedTipoOutros ?> onClick="fVisualizar()">Outros
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<br>Descrição:<BR>
										<textarea name="txt_descricao" cols="50" rows="3" class="form_" onChange="fVisualizar()"><?php echo $f_descricao ?></textarea>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="valor_normal" style="display: block">
											<br>Oferta Válida Até:<br>
											<input type="text" name="txt_datafim_dia" size="2" maxlength="2" value="<?php echo strftime("%d", strtotime($f_data_fim)) ?>" class="form_" onChange="fVisualizar()">/
											<input type="text" name="txt_datafim_mes" size="2" maxlength="2" value="<?php echo strftime("%m", strtotime($f_data_fim)) ?>" class="form_" onChange="fVisualizar()">/
											<input type="text" name="txt_datafim_ano" size="4" maxlength="4" value="<?php echo strftime("%Y", strtotime($f_data_fim)) ?>" class="form_" onChange="fVisualizar()">
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="valor_normal" style="display: block">
											<br>Valor Normal:<br>
											<input type="text" name="txt_preco_normal" size="20" maxlength="8" value="<?php echo number_format($f_preco_atual, 2, ".", ",") ?>" class="form_" onChange="fVisualizar()">
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="valor_oferta" style="display: block">
											<br>Valor da Oferta:<br>
											<input type="text" name="txt_preco_oferta" size="20" maxlength="8" value="<?php echo number_format($f_preco_oferta, 2, ".", ",") ?>" class="form_" onChange="fVisualizar()">
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="condicao" style="display: block">
											<br>Condição?:&nbsp;&nbsp;
											<input type="radio" name="radio_condicao" value="avista" <?php echo $vCheckedCondicaoAvista ?> onClick="fVisualizar()">À Vista
											<input type="radio" name="radio_condicao" value="aprazo" <?php echo $vCheckedCondicaoAprazo ?> onClick="fVisualizar()">À Prazo
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="quantas_parcelas" style="display: none">
											<br>Quantas Parcelas?:<br>
											<input type="text" name="txt_parcelas" size="10" maxlength="2" value="<?php echo $f_preco_parcelas ?>" class="form_" onChange="fVisualizar()">
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="valor_parcela" style="display: none">
											<br>Valor da Parcela:<br>
											<input type="text" name="txt_valor_parcela" size="20" maxlength="20" value="<?php echo number_format($f_preco_parcelado, 2, ".", ",") ?>" class="form_" onChange="fVisualizar()">
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="condicao_aprazo" style="display: none">
											<br>Descrição da Condição à prazo:<br>
											<textarea name="txt_descricaocondicao" cols="50" rows="2" class="form_" onChange="fVisualizar()"><?php echo $f_preco_descricao ?></textarea>
										</div>
									</td>
								</tr>
								<tr> 
									<td valign="middle"> 
										<div id="oferta_dinamica" style="display: none">
											<br>Dinâmica/Condição da Oferta:<br>
											<textarea name="txt_ofertadinamica" cols="50" rows="5" class="form_" onChange="fVisualizar()"><?php echo $f_tipo_outro ?></textarea>
										</div>
									</td>
								</tr>
								<tr> 
									<td align="center" valign="middle" height="21">
										<br><br> 
										<input type="submit" value="    Atualizar Dados    " class="submit_">&nbsp;&nbsp;&nbsp;
										<input type="button" value="   Visualizar Anúncio    " class="submit_">&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
							</table><br>
						</td>
						<td width="195" style="border-left: #cccccc 1px solid; padding: 10px">
							<div align="center">
								<div id="imagem" style="width: 120px; height: 120px; background: #dddddd; text-align: center"><img src="../documentos/imagens/sem_imagem.gif" border="0"></div>
								<div id="descricao" style="margin: 5px; font-size: 12px; color: #333333; font-weight: bold">Descricao</div>

								<div id="div_preco">
									<div id="preco_normal" style="margin: 5px; font-size: 12px; color: #005ac0">De: R$ 0,00</div>
									<div id="preco_oferta" style="display: inline; margin: 5px; font-size: 14px; color: #005ac0">Por: R$ 0,00
										<div id="preco_avista" style="display: inline"><span style="color: #005ac0; font-size: 12px">à vista</span></div>
										<div id="preco_aprazo" style="display: none"><span style="color: #005ac0; font-size: 12px">à vista ou <span style="color: #005ac0">1&nbsp;X&nbsp;R$ 0,00</span>&nbsp;sem juros no cartao de créditos</span></div>
									</div>
								</div>
								<div align="left" id="div_outros" style="display: none">
									<div align="left" style="margin: 5px; font-size: 12; color: #005ac0"><?php echo $f_tipo_outro ?></div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</form>
		<iframe src="../vazio.php" scrolling="no" frameborder="0" id="idFrame" name="target_" style="border: none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe></div>
		<br><br>
	</div>

	<div id="boxDIALOGO"></div>

	<script type="text/javascript">
		document.getElementById("boxDIALOGO").style.top = (fElementoPos("boxEIXO").top-70) + "px";

		document.getElementById("campo2").style.display = "none";
		document.getElementById("campo3").style.display = "none";
		document.getElementById("campo4").style.display = "none";
	</script>
</body>
</html>
