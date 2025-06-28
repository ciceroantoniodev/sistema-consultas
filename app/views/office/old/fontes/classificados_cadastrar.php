<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetIDUSUARIO = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetTIPO = isset($_GET["pg"]) ? $_GET["pg"] : NULL;
$vAcao = isset($_GET["acao"]) ? $_GET["acao"] : NULL;

$vSALVAR = "N";

$vBotaoVoltar = isset($_GET['go']) ? $_GET['go'] : NULL;

if ((int)$vBotaoVoltar < 1) { 
	$vBotaoVoltar = 1;
	
} else {
	$vBotaoVoltar = ((int)$vBotaoVoltar + 1);
	
}

$vTituloSecao = "CADASTRAR NOVO ANÚNCIO EM CLASSIFICADOS";

// ***********************************************************
// *
// *
// * Pega dados complementares na tabela de Usuários
// *
// *
// ***********************************************************


$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);
	
	$vID_Cidade = $vRE['id_cidade'];
	$vID_Bairro = $vRE['id_bairro'];

mysqli_free_result($vQUERY);


// ***********************************************************
// *
// *
// * Inicia gravação dos Classificados
// *
// *
// ***********************************************************


$vImagem_Topo = "";
$vPosicao = 0;

$uploaddir = '../documentos/fotos/classificados/';

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;
$vformIDCLASS = isset($_POST["formIDCLASS"]) ? $_POST["formIDCLASS"] : NULL;
$vformCATEGORIA = isset($_POST["formCATEGORIA"]) ? $_POST["formCATEGORIA"] : NULL;
$vformID_CATEGORIA = isset($_POST["formID_CATEGORIA"]) ? $_POST["formID_CATEGORIA"] : NULL;
$vformTITULO = isset($_POST["formTITULO"]) ? $_POST["formTITULO"] : NULL;
$vformPRECO = isset($_POST["formPRECO"]) ? $_POST["formPRECO"] : NULL;
$vformESTADO = isset($_POST["formESTADO"]) ? $_POST["formESTADO"] : NULL;
$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : NULL;

if ($vformACAO == "salvar") {
	
	$vDATA_CAD = date("Y-m-d H:i:s");
	
	$dbCAMPOS = "id_cidade, id_bairro, id_categoria, id_usuario, categoria, titulo, estado, preco, descricao, foto1, foto2, foto3, foto4, ativo, data_cad";

	$dbVALORES = "0" . $vID_Cidade;
	$dbVALORES .= ",0" . $vID_Bairro;
	$dbVALORES .= ",0" . $vformID_CATEGORIA;
	$dbVALORES .= ",0" . $vgetIDUSUARIO;
	$dbVALORES .= ",'" . $vformCATEGORIA . "'";
	$dbVALORES .= ",'" . $vformTITULO . "'";
	$dbVALORES .= ",'" . $vformESTADO . "'";
	$dbVALORES .= ",0" . str_replace(",", ".", $vformPRECO);
	$dbVALORES .= ",'" . $vformDESCRICAO . "'";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",''";
	$dbVALORES .= ",'S'";
	$dbVALORES .= ",'" . $vDATA_CAD . "'";		// data_cad

	$dbSALVAR = $vConexao->query("INSERT INTO sysc_classificados (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysqli_error());

} else if ($vformACAO == "alterar") {
	$vConexao->query("UPDATE sysc_classificados SET 
							id_categoria=0" . (int)$vformID_CATEGORIA . ", 
							categoria='" . $vformCATEGORIA . "',
							titulo='" . $vformTITULO . "', 
							estado='" . $vformESTADO . "',
							preco=0" . str_replace(",", ".", $vformPRECO) . ",
							descricao='" . $vformDESCRICAO . "' WHERE id=" . $vformIDCLASS) or die(mysqli_error());

}

if ($vAcao == "alterar") {
	$vQUERY = $vConexao->query("SELECT * FROM sysc_classificados WHERE id=" . $vgetIDA) or die("Falha na execução da consulta.");
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
		
	mysqli_free_result($vQUERY);
	
	$vformACAO = "alterar";

} else {
	$vformACAO = "salvar";

}

if ($vformESTADO == "reformado") {
	$CheckedNovo = '';
	$CheckedUsado = '';
	$CheckedReformado = 'checked="checked"';

} else if ($vformESTADO == "usado") {
	$CheckedNovo = '';
	$CheckedUsado = 'checked="checked"';
	$CheckedReformado = '';

} else {
	$CheckedNovo = 'checked="checked"';
	$CheckedUsado = '';
	$CheckedReformado = '';

}
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
	}
	
	.form_textarea {
		width:580px;
		height: 200px;
		border: #dddddd 1px solid;
		background: #f4f4f4;
	}
	
	.form_button {
		height: 25px;
		width: 25px;
		border: none;
		background: url(images/botao_seta_baixo.gif);
	}

	.div-input-file{
		height:108px;
		width:108px;
		margin-top:40px;
		float: left;
		margin-right: 20px;
	}

	.div-output-file {
		height:80px;
		width:80px;
		margin-top:40px;
		float: left;
		margin-right: 20px;
		display: none;
		background: #f4f4f4;
		border: #cccccc 1px solid;
		text-align: center;
		font-size: 12px;
	}

	.file-original{
		opacity: 0.0;
		-moz-opacity: 0.0;
		filter: alpha(opacity=00);
		font-size:18px;
		height:108px;
		width:108px;
		position: absolute;
	}

	.div-input-falso {
		margin-top:-28px;
		width:108px;
		height:108px;
		border: none;
	}

	.filefalso {
		width:108px;
		height:108px;
		border: none;
		background:url(images/icone_adicionarfoto.gif) no-repeat 100% 1px;
	}
	
	#file1 { display: block; }
	#file2 { display: none; }
	#file3 { display: none; }
	#file4 { display: none; }
	#file5 { display: none; }
	#file6 { display: none; }
	#file7 { display: none; }
	
	#out1 { display: none; }
	#out2 { display: none; }
	#out3 { display: none; }
	#out4 { display: none; }
	#out5 { display: none; }
	#out6 { display: none; }
	#out7 { display: none; }
    -->	
    </style>
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
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top" align="left">
						
							<?php
							$vQUERY = $vConexao->query("SELECT * FROM sysc_classificadoscategorias ORDER BY nome") or die("Falha na execução da consulta.");

								$vEcho = "<div id='areaSelect'>";
								$arrayCategorias = Array();
								$i = 0;

								while ($vRE = mysqli_fetch_assoc($vQUERY)) {
									$vClassID = $vRE['id'];
									$vClassIdPai = $vRE['id_pai'];
									$vClassNome = $vRE['nome'];
									$vClassNivel = $vRE['nivel'];

									if ($vRE['nivel'] == 2) {
										$arrayCategorias[$i] = StrZero($vClassIdPai, 10) . StrZero($vClassNivel, 3) . "|" . $vClassNome . ";" . $vClassID;
										
									} else {
										$arrayCategorias[$i] = StrZero($vClassID, 10) . StrZero($vClassNivel, 3) . "|" . $vClassNome . ";" . $vClassID;
										
									}
									
									$i++;

								}
								
								sort($arrayCategorias);
								
								for ($i = 0; $i < count($arrayCategorias); $i++) {
									$vNomeCategoria = substr($arrayCategorias[$i], (strpos($arrayCategorias[$i], "|")+1));
									$vIdCategoria = substr($vNomeCategoria, strpos($vNomeCategoria, ";")+1);
									$vNomeCategoria = substr($vNomeCategoria, 0, (strpos($vNomeCategoria, ";")));
									
									if (strpos($arrayCategorias[$i], "002|") > 0) {
										$vEcho .= '<div class="ul2" id="cat' . $i . '" onMouseOver="mOvr(\'cat' . $i . '\', \'#FCEE82\')" onMouseOut="mOut(\'cat' . $i . '\', \'#ffffff\')"><a href="javascript: fSelectCategoria(' . $vIdCategoria . ', \'' . $vNomeCategoria . '\')">' . $vNomeCategoria . '</a></div>';

									} else {
										$vEcho .= '<div class="ul1">&raquo; ' . $vNomeCategoria . '</div>';

									}
								}
								
								$vEcho .= "</div>";
								
							mysqli_free_result($vQUERY);
							?>

							<form name="formClassificados" action="classificados_cadastrar.php?id=<?php echo $vgetIDUSUARIO ?>&ida=<?php echo $vgetIDA ?>&acao=<?php echo $vAcao ?>&tp=<?php echo $vgetTIPO ?>&go=<?php echo $vBotaoVoltar ?>" method="post" enctype="multipart/form-data" onSubmit="return fValidarForm()">
								<input type="hidden" name="formACAO" value="<?php echo $vformACAO ?>" />
								<input type="hidden" name="formIDCLASS" value="<?php echo $vgetIDA ?>" />
								
								<table cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td colspan="3">Categoria:</td>
									</tr>
									<tr>
										<td width="354"><input name="formID_CATEGORIA" id="InputIdCategoria" type="hidden" value="" /><input name="formCATEGORIA" id="InputNomeCategoria" type="text" class="form_" size="47" /></td>
										<td align="left" style="background: #dddddd; width: 25px; height: 25px"><input type="button" value="" class="form_button" onClick="fOcultaCategorias()" /></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
										<?php
										echo $vEcho;
										?>
										
										</td>
									</tr>
									<tr><td colspan="3"><br />Título:</td></tr>
									<tr>
										<td colspan="3"><input name="formTITULO" type="text" class="form_" size="70" maxlength="150" value="<?php echo $vformTITULO ?>" /></td>
									</tr>
									<tr><td colspan="3"><br />Preço:</td></tr>
									<tr>
										<td colspan="3"><input name="formPRECO" type="text" class="form_" size="15" maxlength="11" value="<?php echo $vformPRECO ?>" /></td>
									</tr>
									<tr><td colspan="3"><br />Estado do Produto:</td></tr>
									<tr>
										<td colspan="3"><input name="formESTADO" type="radio" value="novo" <?php echo $CheckedNovo ?> />NOVO | <input name="formESTADO" type="radio" value="usado" <?php echo $CheckedUsado ?> />USADO | <input name="formESTADO" type="radio" value="reformado" <?php echo $CheckedReformado ?> />REFORMADO</td>
									</tr>
									<tr><td colspan="3"><br />Descrição:</td></tr>
									<tr>
										<td colspan="3"><textarea name="formDESCRICAO" rows="5" cols="50" class="form_textarea"><?php echo $vformDESCRICAO ?></textarea></td>
									</tr>
									<tr>
										<td colspan="3" align="center">
											<div class="clear">&nbsp;</div>
											<div class="clear">&nbsp;</div>
											
											<input type="submit" value="      Enviar Dados      " class="submit_" />
										</td>
									</tr>
								</table>
							</form>
							
							<div class="clear">&nbsp;</div>
							<div class="clear">&nbsp;</div>

							<script type="text/javascript">
							function fOcultaCategorias() {
								var vOcultar = document.getElementById("areaSelect").style.visibility;
								
								if (vOcultar == "visible") {
									document.getElementById("areaSelect").style.visibility = "hidden";

								} else {
									document.getElementById("areaSelect").style.visibility = "visible";

								}

							}
							
							function fSelectCategoria(vid, vnome) {
								document.getElementById("InputIdCategoria").value = vid;
								document.getElementById("InputNomeCategoria").value = vnome;
								document.getElementById("areaSelect").style.visibility = "hidden";

							}
							
							function fValidarForm() {
								if (document.formClassificados.formID_CATEGORIA.value.length == 0) {
									fBoxDialogo("Não foi selecionada nenhuma CATEGORIA.");
									document.formClassificados.formID_CATEGORIA.value = '';
									document.formClassificados.formCATEGORIA.value = '';
									document.formClassificados.formCATEGORIA.focus();
									return false;
								}
								
								if (document.formClassificados.formTITULO.value.length == 0) {
									fBoxDialogo("O campo TÍTULO não pode ser vazio!");
									document.formClassificados.formTITULO.value = '';
									document.formClassificados.formTITULO.focus();
									return false;
								}
								
								if (document.formClassificados.formPRECO.value.length == 0) {
									fBoxDialogo("O campo PREÇO não pode ser vazio!");
									document.formClassificados.formPRECO.value = '';
									document.formClassificados.formPRECO.focus();
									return false;
								}
								
								if (document.formClassificados.formDESCRICAO.value.length == 0) {
									fBoxDialogo("O campo DESCRIÇÃO não pode ser vazio!");
									document.formClassificados.formDESCRICAO.value = '';
									document.formClassificados.formDESCRICAO.focus();
									return false;
								}
							}
			
							</script>
						
						</td>
					</tr>
				</table>
			</div>	
		</div>
		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
	</div>

	<?php
	if ($vAcao == "alterar") {
		echo '<script type="text/javascript">';
		echo 'fSelectCategoria(' . $vformID_CATEGORIA. ',"' . $vformCATEGORIA . '");';
		echo '</script>';
		
	}
	?>
	
	<div id="boxDIALOGO"></div>

	<script type="text/javascript">
		document.getElementById("boxDIALOGO").style.top = (fElementoPos("boxEIXO").top-70) + "px";

		document.getElementById("campo2").style.display = "none";
		document.getElementById("campo3").style.display = "none";
		document.getElementById("campo4").style.display = "none";
	</script>
</body>
</html>