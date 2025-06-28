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

$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vID_Class = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;
$vAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vTituloSecao = "DADOS DO ANÚNCIO EM CLASSIFICADOS";


// ***********************************************************
// *
// *
// * Desabilitar anúncio
// *
// *
// ***********************************************************


if ($vAcao == "desativar") {
	$vformMOTIVO = isset($_POST["formMOTIVO"]) ? $_POST["formMOTIVO"] : NULL;
	$vformDATADIA = isset($_POST["formDATADIA"]) ? $_POST["formDATADIA"] : NULL;
	$vformDATAMES = isset($_POST["formDATAMES"]) ? $_POST["formDATAMES"] : NULL;
	$vformDATAANO = isset($_POST["formDATAANO"]) ? $_POST["formDATAANO"] : NULL;
	
	$vDATA_DESATIVA = date("Y-m-d H:i:s");
	
	if (strpos($vformMOTIVO, "vendido") > 0) {
		if ($vformDATADIA == "") { $vformDATADIA = "00"; }
		if ($vformDATAMES == "") { $vformDATAMES = "00"; }
		if ($vformDATAANO == "") { $vformDATAANO = "00000"; }
		
		$vMotivoComplemento = " " . StrZero($vformDATADIA, 2) . "-" . StrZero($vformDATAMES, 2) . "-" . StrZero($vformDATAANO, 4);

	} else {
		$vMotivoComplemento = "";

	}
	
	if ($vformMOTIVO != "nao") {
		$vConexao->query("UPDATE sysc_classificados SET ativo='N', desativado_motivo='" . $vformMOTIVO . $vMotivoComplemento . "', desativado_data='" . $vDATA_DESATIVA . "' WHERE id=" . $vID_Class) or die("Falha na execução da consulta.");

	} else {
		$vAcao = "nao";

	}

}


// ***********************************************************
// *
// *
// * Pega dados complementares na tabela de Usuários
// *
// *
// ***********************************************************


$vQUERY = $vConexao->query("SELECT * FROM sysc_classificados WHERE id=" . $vID_Class) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	$vformCATEGORIA = $vRE['categoria'];
	$vformID_CATEGORIA = $vRE['id_categoria'];
	$vformTITULO = $vRE['titulo'];
	$vformPRECO = $vRE['preco'];
	$vformESTADO = $vRE['estado'];
	$vformDESCRICAO = $vRE['descricao'];
	$vformFOTO1 = $vRE['foto1'];
	$vformFOTO2 = $vRE['foto2'];
	$vformFOTO3 = $vRE['foto3'];
	$vformFOTO4 = $vRE['foto4'];
	$vformATIVO = $vRE['ativo'];
	$vformDESATIVADO_MOTIVO = $vRE['desativado_motivo'];
	$vformDESATIVADO_DATA = $vRE['desativado_data'];	
	$vformDATA_EXPIRA = $vRE['data_expira'];	
mysqli_free_result($vQUERY);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <script language="JavaScript" type="text/javascript" src="js/funcoes_geral.js"></script>
	<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
	
	.ul1 {
		background: #dddddd;
		padding-top: 3px;
		padding-left: 5px;
		height: 20px;
	}
	
	.ul2 {
		background: #ffffff;
		padding-left: 17px;
	}
	
	#areaSelect {
		height: 200px;
		width: 350px;
		overflow: auto;
		border: #cccccc 1px solid;
		position: absolute;
		visibility: hidden;
	}
	
	.form_ {
		height: 25px;
		border: #dddddd 1px solid;
		background: #f4f4f4;
		font-size: 16px;
		padding-top: 3px;
		padding-left: 10px;
		padding-right: 10px;
	}
	
	.form_textarea {
		width:510px;
		height: 150px;
		border: #dddddd 1px solid;
		background: #f4f4f4;
	}
	
	.submit_definir  {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 20px;
		color: #ffffff;
		padding: 2px;
		padding-left: 15px;
		padding-right: 15px;
		border-top: #ffffff 1px solid;
		border-right: #ab2b34 2px solid;
		border-bottom: #ab2b34 2px solid;
		border-left: #ffffff 1px solid;
		margin-left: 10px;
		float: left;		
		}
		
	.del {
		background: #FFE9E9;
		text-align: center;
		font-size: 16px;
		color: #A20505;
		border: #A20505 2px solid;
		padding: 20px;
		width: 500px;
		display: table;
	}
   -->	
    </style>
	
	<?php
	if ($vAcao == "excluir") {
		echo '<script language="JavaScript">';
		echo 'location.href = "classificados.php?id=' . $vgetIDUSUARIO . '&tp=' . $vgetTIPO . '"';
		echo '</script>';

	}
	?>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>
  
<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<div align="center" id="boxEIXO">
		<div id="form-cadastros" class="widthVAR">
			<a href="javascript: history.go(-<?php echo $vBotaoVoltar ?>)"><div class="botao-voltar"><img src="images/botao_voltar.gif" height="30" /></div></a><div align="center" class="form-cadastros-head"><?php echo $vTituloSecao ?></div>
			
			<div class="clear">&nbsp;</div>
			
			<div align="center">
				<table border="0" cellspacing="0" cellpadding="0" width="90%">
					<tr>
						<td valign="top" align="left">
						
							<div align="center">
								<?php
								if ($vformATIVO == "N") {
									echo '<div class="del">';
									echo '<span style="font-weight: bold">Seu anúncio foi desativado pelo seguinte motivo:</span><br /><br />';
									echo 'Motivo: ' . $vformDESATIVADO_MOTIVO;
									echo '<br />Data: ' . strftime("%d/%m/%Y", strtotime($vformDESATIVADO_DATA));
									echo '</div>';

								} else {
									if ($vAcao == "" || $vAcao == "nao") {
										echo '<a href="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' .$vID_Class . '&tp=' .$vgetTIPO . '&acao=del"><div class="submit_definir">Desativar Anúncio</div></a>';
										echo '<a href="classificados_cadastrar.php?id=' . $vgetIDUSUARIO . '&ida=' .$vID_Class . '&tp=' . $vgetTIPO . '&acao=alterar"><div class="submit_definir">Alterar Dados</div></a>';
										
									} else if ($vAcao == "del") {
										echo '<div class="del">';
										echo '<span style="font-weight: bold">Tem certeza que deseja desabilitar este anúncio?</span><br />Informe o motivo:<br /><br /><br />';
										echo '<form name="formClassificados" action="classificados_ver.php?id=' . $vgetIDUSUARIO . '&ida=' . $vID_Class . '&acao=desativar&tp=' . $vgetTIPO . '" method="post">';
										echo '<div align="left" style="margin-left: 50px">';
										echo '<input type="radio" name="formMOTIVO" value="nao" checked="checked" /> Não Desabilitar<br />';
										echo '<input type="radio" name="formMOTIVO" value="Desabilitado temporariamente" /> Desabilitar temporariamente<br />';
										echo '<input type="radio" name="formMOTIVO" value="Não tenho mais interesse em expor" /> Não tenho mais interesse em expor<br />';
										echo '<input type="radio" name="formMOTIVO" value="Anúncio vendido em:" /> Anúncio vendido em: <input type="text" name="formDATADIA" value="' . date("d") . '" size="2" maxlength="2" class="form_" />/<input type="text" name="formDATAMES" value="' . date("m") . '" size="2" maxlength="2" class="form_" />/<input type="text" name="formDATAANO" value="' . date("Y") . '" size="4" maxlength="4" class="form_" /><br />';
										echo '</div>';
										echo '<br /><input type="submit" value="   Enviar   " class="submit_definir" />';
										echo '</form>';
										echo '</div>';

									}
								}
								?>
								
								<div class="clear">&nbsp;</div>
								<div class="clear">&nbsp;</div>										
							</div>
							
							<table cellspacing="0" cellpadding="0" border="0">
								<tr>
									<td colspan="3">Categoria:</td>
								</tr>
								<tr>
									<td colspan="3"><div class="form_"><?php echo $vformCATEGORIA ?></div></td>
								</tr>
								<tr><td colspan="3"><br />Título:</td></tr>
								<tr>
									<td colspan="3"><div class="form_"><?php echo $vformTITULO ?></div></td>
								</tr>
								<tr><td colspan="3"><br />Preço:</td></tr>
								<tr>
									<td colspan="3"><div class="form_"><?php echo $vformPRECO ?></div></td>
								</tr>
								<tr><td colspan="3"><br />Estado do Produto:</td></tr>
								<tr>
									<td colspan="3"><div class="form_"><?php echo strtoupper($vformESTADO) ?></div></td>
								</tr>
								<tr><td colspan="3"><br />Descrição:</td></tr>
								<tr>
									<td colspan="3" style="display: table; color: #104E8B; background: #f9f9f9; padding: 10px; border: #dddddd 1px solid;"><?php echo $vformDESCRICAO ?></td>
								</tr>
								<tr><td colspan="3"><br />Fotos:</td></tr>
								<tr>
									<td colspan="3">
										<table>
											<tr>
												<td>
													<?php
													if (fSeImagem($vformFOTO1)) {
														if (file_exists("../documentos/fotos/classificados/" . $vformFOTO1)) {
															echo '<img src="../documentos/fotos/classificados/' . $vformFOTO1 . '" width="200" border="0" />';
														}
													}
													?>
												</td>
												<td>
													<?php
													if (fSeImagem($vformFOTO2)) {
														if (file_exists("../documentos/fotos/classificados/" . $vformFOTO2)) {
															echo '<img src="../documentos/fotos/classificados/' . $vformFOTO2 . '" width="200" border="0" />';

														}
													}
													?>
												</td>
												<td>
													<?php
													if (fSeImagem($vformFOTO3)) {
														if (file_exists("../documentos/fotos/classificados/" . $vformFOTO3)) {
															echo '<img src="../documentos/fotos/classificados/' . $vformFOTO3 . '" width="200" border="0" />';
														}
													}
													?>
												</td>
												<td>
													<?php
													if (fSeImagem($vformFOTO4)) {
														if (file_exists("../documentos/fotos/classificados/" . $vformFOTO4)) {
															echo '<img src="../documentos/fotos/classificados/' . $vformFOTO4 . '" width="200" border="0" />';
														}
													}
													?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							
							<div class="clear">&nbsp;</div>
							<div class="clear">&nbsp;</div>

						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
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