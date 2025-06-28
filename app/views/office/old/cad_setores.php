<?php
header("Content-Type: text/html; charset=UTF-8",true);

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;
$vgetAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;
$vgetIdCargo = isset($_GET["ida"]) ? $_GET["ida"] : NULL;

$vformTIPO = "";
$vformNOME = "";
$vformEMAIL = "";
$vformATIVO = "";

$vLinkRetorno = ' / <a href="javascript: showDIRECT(\'\', \'ger_setores.php?idu=' . fId("c", $_GET["idu"]) . '\', \'areaConteudo\')">GERENCIAMENTO DE SETORES</a> ';

if ($vgetAcao == "alterar") {
	$queryCargos = $vConexao->query("SELECT * FROM sysc_cargos WHERE id=" . $vgetIdCargo) or die (mysql_error());

		$reCargos = mysqli_fetch_array($queryCargos);
		
		$vformTIPO = $reCargos['tipo'];
		$vformNOME = $reCargos['cargo'];
		$vformEMAIL = $reCargos['email'];
		$vformATIVO = $reCargos['ativo'];

	mysqli_free_result($queryCargos);
	
} else {
	$vgetAcao = "novo";
	
}

if ($vformATIVO == "S") {
	$syscATIVARSIM = 'checked="checked"';
	$syscATIVARNAO = '';
	
} else {
	$syscATIVARSIM = '';
	$syscATIVARNAO = 'checked="checked"';
	
}


if ($vformTIPO == "cargo") {
	$vTipoCargo = 'checked="checked"';
	$vTipoSetor = '';
	$vTxtNome = 'Cargo:';
	
} else {
	$vTipoCargo = 'checked="checked"';
	$vTipoSetor = 'checked="checked"';
	$vTxtNome = 'Setor:';
	
}

if ($vgetAcao == "alterar") {
	$syscTITULOSECAO = "Altera&ccedil;&atilde;o de Dados";
	
} else {
	$syscTITULOSECAO = "Cadastrar Novo Registro";
	
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SysControle - Sistema Gerenciador de Conteúdo</title>
		<meta http-equiv="content-language" content="pt-br">
		
		<meta name="robots" content="noindex, nofollow">
		<meta name="author" content="SAMSITE Web Design Sistemas">
		<meta name="reply-to" content="suporte@samsite.com.br">
			
		<style type="text/css">
		<!--
		html {height:100%; overflow-y: auto;}

		.table {height:100%;}
		
		td {font-weight: bold; color: #333333; padding: 2px}

		-->
		</style>

	</head>

	<body>
		<div id="area-principal">
			<div id="area-apostar">
				<div align="center">
					<div class="area-quero-apostas">
						<div align="left" style="margin: 30px;">
							<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">IN&Iacute;CIO</a> <?php echo $vLinkRetorno ?> / <?php echo $syscTITULOSECAO ?></div><br /><br />
							
							<div class="Titulo-Interno"><?php echo $syscTITULOSECAO ?></div><br /><br /><br />

							<div id="area-cadastro">   

								<form action="salvar_setores.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>" method="post" target="SalvarForm" name="frmCadSetores" onSubmit="return fValidaForm(this)">
									<input name="formACAO" type="hidden" value="<?php echo $vgetAcao ?>" />
									<input name="formID_CARGO" type="hidden" value="<?php echo $vgetIdCargo ?>" />
									
									<div id="boxEIXO"></div>
									
									<table cellspacing="0" cellpadding="5" border="0" class="letras_">
										<thead></thead>
										<tbody>
											<tr><td colspan="2">&nbsp;</td></tr> 
											<tr> 
												<td align="right" valign="middle">Tipo:</td>
												<td valign="middle"> 
													<input type="radio" name="formTIPO" value="cargo" <?php echo $vTipoCargo ?>> CARGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="formTIPO" value="setor" <?php echo $vTipoSetor ?>> SETOR
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr> 
											<tr> 
												<td align="right" valign="middle">Nome do <?php echo $vTxtNome ?></td>
												<td valign="middle"> 
													<input type="text" name="formNOME" size="50" maxlength="100" value="<?php echo $vformNOME ?>" class="form-edit">
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr> 
											<tr> 
												<td align="right" valign="middle">E-Mail:</td>
												<td valign="middle"> 
													<input type="text" name="formEMAIL" size="50" maxlength="150" value="<?php echo $vformEMAIL ?>" class="form-edit">
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr> 
											<tr> 
												<td align="right" valign="middle">Ativo?</td>
												<td valign="middle"> 
													<input type="radio" name="formATIVO" value="S" <?php echo $syscATIVARSIM ?> /> SIM&nbsp;&nbsp;
													<input type="radio" name="formATIVO" value="N" <?php echo $syscATIVARNAO ?> /> N&Atilde;O
												</td>
											</tr>
											<tr> 
												<td colspan="2" align="center" valign="middle" height="21">
													<div class="clear"><br /></div>
													
													<div id="area-aviso"></div>
													
													<div class="clear"><br /></div>

													<input type="submit" value="     Salvar     " class="formSUBMIT" onClick="fSalvarOk()">
												</td>
											</tr>
										</tbody>
										<tfoot></tfoot>
									</table>
									
								</form>						

								<iframe src="vazio.php" name="SalvarForm" scrolling="yes" frameborder="0" width="1" height="1"></iframe>
							</div>

							<div id="boxDIALOGO"></div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</body>
</html>