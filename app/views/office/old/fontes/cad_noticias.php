<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

include "conexao.php";
include "../documentos/include/funcoes.php";
include "../documentos/include/_dadoslocal.php";

$vgetID_NOTICIA = isset($_GET["ida"]) ? $_GET["ida"] : 0;
$vgetIDUSUARIO = isset($_GET["idu"]) ? $_GET["idu"] : NULL;
$vgetTIPO = isset($_GET["tp"]) ? $_GET["tp"] : NULL;

$syscTITULOSECAO = "CADASTRAR NOVA NOTÍCIA";

$vformACAO = isset($_POST["formACAO"]) ? $_POST["formACAO"] : NULL;

$vformID_NOTICIA = isset($_POST["formID_NOTICIA"]) ? $_POST["formID_NOTICIA"] : NULL;

$vformTITULO = isset($_POST["formTITULO"]) ? $_POST["formTITULO"] : NULL;
$vformDESCRICAO = isset($_POST["formDESCRICAO"]) ? $_POST["formDESCRICAO"] : NULL;
$vformCATEGORIA = isset($_POST["formCATEGORIA"]) ? $_POST["formCATEGORIA"] : NULL;
$vformFONTE = isset($_POST["formFONTE"]) ? $_POST["formFONTE"] : NULL;
$vformABRANGE = isset($_POST["formABRANGE"]) ? $_POST["formABRANGE"] : NULL;
$vformDESTAQUE = isset($_POST["formDESTAQUE"]) ? $_POST["formDESTAQUE"] : NULL;
$vformORDEM_EXTERNO = isset($_POST["formORDEM_EXTERNO"]) ? $_POST["formORDEM_EXTERNO"] : NULL;
$vformPLAYER = isset($_POST["formPLAYER"]) ? $_POST["formPLAYER"] : NULL;
$vformVIDEO = isset($_POST["formVIDEO"]) ? $_POST["formVIDEO"] : NULL;
$vformTAGS = isset($_POST["formTAGS"]) ? $_POST["formTAGS"] : NULL;
$vformCONTEUDO = isset($_POST["formCONTEUDO"]) ? $_POST["formCONTEUDO"] : NULL;

$vformARQUIVO = isset($_POST["formARQUIVO"]) ? $_POST["formARQUIVO"] : NULL;
$vformFOTOCAPA = isset($_POST["formFOTOCAPA"]) ? $_POST["formFOTOCAPA"] : NULL;
$vformFOTOTEXTO = isset($_POST["formFOTOTEXTO"]) ? $_POST["formFOTOTEXTO"] : NULL;

$vformEXCLUIRCAPA = isset($_POST["formEXCLUIRCAPA"]) ? $_POST["formEXCLUIRCAPA"] : NULL;

$vformABRANGELOCAL = "selected='selected'";
$vformABRANGEREGIONAL = "";
$vformABRANGEGERAL = "";
$vformABRANGEENTREVISTA = "";

$vformDESTAQUE_EXTERNO = "";
$vformDESTAQUE_INTERNO = "";
$vformDESTAQUE_ULTIMAS = "";
$vformDESTAQUE_PRINCIPAL = "";

$vDATA_CAD = date("Y-m-d H:i:s"); 

if ($vformACAO == "novo") {	
	//$vformFILENOME = $_FILES['formFILE']['name'];
	$vformARQUIVO = "noticia" . date("Ym") . StrZero((int)$vgetIDUSUARIO, 11) . date("dHis") . ".html";
	
	$syscCAMINHO = "../documentos/noticias/" . $vformARQUIVO;

	$syscARQUIVO = fopen($syscCAMINHO, "w");
	
	fwrite($syscARQUIVO, $vformCONTEUDO);
	fclose($syscARQUIVO);
	
	if ($vformDESTAQUE == "D") {
		$vformDESTAQUE_EXTERNO = "S";
		$vformDESTAQUE_ULTIMAS = "";
		$vformDESTAQUE_PRINCIPAL = "";
		
	} else if ($vformDESTAQUE == "U") {
		$vformDESTAQUE_EXTERNO = "";
		$vformDESTAQUE_ULTIMAS = "S";
		$vformDESTAQUE_PRINCIPAL = "";
		
	} else if ($vformDESTAQUE == "P") {
		$vformDESTAQUE_EXTERNO = "";
		$vformDESTAQUE_ULTIMAS = "";
		$vformDESTAQUE_PRINCIPAL = "S";
		
	}
	
	$dbVALORES = "0" . (int)$vgetIDUSUARIO;
	$dbVALORES .= ",0" . (int)$getIDBAIRRO;
	$dbVALORES .= ",'" . $vformTITULO . "'";
	$dbVALORES .= ",'" . $vformDESCRICAO . "'";
	$dbVALORES .= ",'" . $vformCATEGORIA . "'";
	$dbVALORES .= ",'" . $vformFONTE . "'";
	$dbVALORES .= ",'" . $vformARQUIVO . "'";
	$dbVALORES .= ",0";
	$dbVALORES .= ",0";
	$dbVALORES .= ",0";
	$dbVALORES .= ",'" . $vformFOTOCAPA . "'";
	$dbVALORES .= ",'" . $vformFOTOTEXTO . "'";
	$dbVALORES .= ",'" . $vformABRANGE . "'";
	$dbVALORES .= ",'" . $vformDESTAQUE_EXTERNO . "'";
	$dbVALORES .= ",'" . $vformDESTAQUE_INTERNO . "'";
	$dbVALORES .= ",'" . $vformDESTAQUE_ULTIMAS . "'";
	$dbVALORES .= ",'" . $vformDESTAQUE_PRINCIPAL . "'";
	$dbVALORES .= ",0" . $vformORDEM_EXTERNO;
	$dbVALORES .= ",'" . $vformPLAYER . "'";
	$dbVALORES .= ",'" . $vformVIDEO . "'";
	$dbVALORES .= ",'" . $vformTAGS . "'";
	$dbVALORES .= ",'" . $vDATA_CAD . "'";

	$dbCAMPOS = "id_usuario, id_bairro, titulo, descricao, categoria, fonte, arquivo, cliques, visualizacoes, comentarios, foto1, foto2, abrange, destaque_externo, destaque_interno, destaque_ultimas, destaque_principal, ordem_externo, player, video, tags, data";
	
	$dbSALVAR = $vConexao->query("INSERT INTO sysc_noticias (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());
	
	$vformACAO = "";
	$vgetID_NOTICIA = "";
	
	$vformTITULO = "";
	$vformDESCRICAO = "";
	$vformCATEGORIA = "";
	$vformFONTE = "";
	$vformABRANGE = "Local";
	$vformDESTAQUE = "Nenhuma";
	$vformORDEM_EXTERNO = 0;
	$vformPLAYER = "";
	$vformVIDEO = "";
	$vformTAGS = "";

}

if ($vformACAO == "atualizar") {
	$vformID_NOTICIA = isset($_POST["formID_NOTICIA"]) ? $_POST["formID_NOTICIA"] : NULL;
	$vgetID_NOTICIA = $vformID_NOTICIA;
	
	$dbALT = "UPDATE sysc_noticias SET ";
	$dbWHERE = " where id=" . $vformID_NOTICIA;
	
	$vConexao->query($dbALT . "titulo='" . $vformTITULO . "', 
						 descricao='" . $vformDESCRICAO . "', 
						 categoria='" . $vformCATEGORIA . "', 
						 fonte='" . $vformFONTE . "', 
						 abrange='" . $vformABRANGE . "', 
						 ordem_externo='" . $vformORDEM_EXTERNO . "', 
						 foto1='" . $vformFOTOCAPA . "', 
						 foto2='" . $vformFOTOTEXTO . "', 
						 player='" . $vformPLAYER . "', 
						 video='" . $vformVIDEO . "', 
						 tags='" . $vformTAGS . "'" . $dbWHERE) or die (mysql_error());

	if ($vformDESTAQUE == "D") {
		$vConexao->query($dbALT . "destaque_externo='S', 
								destaque_interno='N', 
								destaque_ultimas='N', 
								destaque_principal='N'" . $dbWHERE) or die (mysql_error());
		
	} elseif ($vformDESTAQUE == "U") {
		$vConexao->query($dbALT . "destaque_externo='N', 
								destaque_interno='N', 
								destaque_ultimas='S', 
								destaque_principal='N'" . $dbWHERE) or die (mysql_error());
	
	} elseif ($vformDESTAQUE == "P") {
		$vConexao->query($dbALT . "destaque_externo='N', 
								destaque_interno='N', 
								destaque_ultimas='N', 
								destaque_principal='S'" . $dbWHERE) or die (mysql_error());
	
	} else {
		$vConexao->query($dbALT . "destaque_externo='N', 
								destaque_interno='N', 
								destaque_ultimas='N', 
								destaque_principal='N'" . $dbWHERE) or die (mysql_error());
	
	}
	
	$syscCAMINHO = "../documentos/noticias/" . $vformARQUIVO;

	$syscARQUIVO = fopen($syscCAMINHO, "w");
	
	fwrite($syscARQUIVO, $vformCONTEUDO);
	fclose($syscARQUIVO);
	
}

$syscCONTEUDO = "";
	
if ($vgetID_NOTICIA != "") {
	$syscTITULOSECAO = "ALTERAR DADOS NA NOTÍCIA";
	
	$dbSQL = "SELECT * FROM sysc_noticias WHERE id=" . $vgetID_NOTICIA;

	$dbQUERY = $vConexao->query($dbSQL) or die (mysql_error());

	while ($dbRE = mysqli_fetch_assoc($dbQUERY)) {
		$vformTITULO = $dbRE['titulo'];
		$vformDESCRICAO = $dbRE['descricao'];
		$vformCATEGORIA = $dbRE['categoria'];
		$vformFONTE = $dbRE['fonte'];
		$vformABRANGE = $dbRE['abrange'];
		$vformDESTAQUE_EXTERNO = $dbRE['destaque_externo'];
		$vformDESTAQUE_INTERNO = $dbRE['destaque_interno'];
		$vformDESTAQUE_ULTIMAS = $dbRE['destaque_ultimas'];
		$vformDESTAQUE_PRINCIPAL = $dbRE['destaque_principal'];
		$vformORDEM_EXTERNO = $dbRE['ordem_externo'];
		$vformPLAYER = $dbRE['player'];
		$vformVIDEO = $dbRE['video'];
		$vformTAGS = $dbRE['tags'];
		$vformFOTOCAPA = $dbRE['foto1'];
		$vformFOTOTEXTO = $dbRE['foto2'];
		
		$vformARQUIVO = $dbRE['arquivo'];
		
		$vFopen = fopen("../documentos/noticias/" . $vformARQUIVO, "r");
		
		while (!feof($vFopen)) {
			$syscCONTEUDO .= fgets($vFopen, 9999);
			
		}

	}
	
}

if ($vformABRANGE == "local") {
	$vformABRANGELOCAL = "selected='selected'";
	$vformABRANGEREGIONAL = "";
	$vformABRANGEGERAL = "";
	$vformABRANGEENTREVISTA = "";

} elseif ($vformABRANGE == "regional") {
	$vformABRANGELOCAL = "";
	$vformABRANGEREGIONAL = "selected='selected'";
	$vformABRANGEGERAL = "";
	$vformABRANGEENTREVISTA = "";
	
} elseif ($vformABRANGE == "geral") {
	$vformABRANGELOCAL = "";
	$vformABRANGEREGIONAL = "";
	$vformABRANGEGERAL = "selected='selected'";
	$vformABRANGEENTREVISTA = "";
	
} elseif ($vformABRANGE == "entrevista") {
	$vformABRANGELOCAL = "";
	$vformABRANGEREGIONAL = "";
	$vformABRANGEGERAL = "";
	$vformABRANGEENTREVISTA = "selected='selected'";
	
}

if ($vformDESTAQUE_EXTERNO == "S") {
	$syscDESTAQUE = "Destaques";
	$syscOPCAODESTAQUE = "D";
	
} elseif ($vformDESTAQUE_INTERNO == "S") {
	$syscDESTAQUE = "Interno";
	$syscOPCAODESTAQUE = "I";

} elseif ($vformDESTAQUE_PRINCIPAL == "S") {
	$syscDESTAQUE = "Novidade";
	$syscOPCAODESTAQUE = "N";

} elseif ($vformDESTAQUE_ULTIMAS == "S") {
	$syscDESTAQUE = "&Uacute;ltimas";
	$syscOPCAODESTAQUE = "U";
	
} else {
	$syscDESTAQUE = "Nenhuma";
	$syscOPCAODESTAQUE = "M";
	
}

//if (strpos("aa" . $vusuarioACESSO, "1") > 0 || strpos("aa" . $vusuarioACESSO, "2") > 0) {
	$syscDISABLED = "";
	
//} else {
	$syscDISABLED = "disabled='disabled'";
	
//}
include("fckeditor/fckeditor.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>:::: SysControle - Você no Controle :::: </title>
	<script language="Javascript" src="./documentos/js/funcoes.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" media="all" />
	<style type="text/css">
	<!--
	html {height:100%;}

	.table {height:100%;}
	
	td { padding-left: 3px; padding-right: 3px; }
	-->
	</style>

	<script language="JavaScript" type="text/javascript">
	function fValidaCampos() {
		if (document.frmCadNoticias.formNOME.value.length == 0) {
			alert('O campo NOME não pode ser vazio');
			document.frmCadNoticias.formNOME.value = '';
			document.frmCadNoticias.formNOME.focus();
			return false;
		}
		
		if (document.frmCadNoticias.formSOBRENOME.value.length == 0) {
			alert('O campo NOME não pode ser vazio');
			document.frmCadNoticias.formSOBRENOME.value = '';
			document.frmCadNoticias.formSOBRENOME.focus();
			return false;
		}

	}
	</script>
	<script type="text/javascript" src="menu/c_config.js"></script>
	<script type="text/javascript" src="menu/c_smartmenus.js"></script>
	<script type="text/javascript" src="menu/c_addon_popup_menus.js"></script>
</head>

<body>
	<?php
	$vgetROTINAS = isset($_GET["r"]) ? $_GET["r"] : NULL;
	
	include "_submenus.php";
	?>
	
	<iframe src="vazio.html" name="vazio" scrolling="no" frameborder="0" width="1" height="1"></iframe>

	<?php
	echo '<script language="JavaScript" type="text/javascript">';
		if ($vformACAO == "atualizar") {
//			echo 'history.go(-2)';
			
		}
	echo '</script>';

	if ($vformACAO == "" && $vgetID_NOTICIA == "") {
		$vformACAO = 'novo';
			
	} else {
		$vformACAO = 'atualizar';
		
	}
	?>
	
	<div align="center">
		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
		<form action="cad_noticias.php?local=<?php echo $getLOCAL ?>&ida=<?php echo $vgetID_NOTICIA ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>" method="post" style="margin: 0px" name="frmCadNoticias" onSubmit="return fValidaCampos()">
			<input name="formACAO" type="hidden" value="<?php echo $vformACAO ?>" />
			<input name="formID_NOTICIA" type="hidden" value="<?php echo $vgetID_NOTICIA ?>" />
			<input name="formARQUIVO" type="hidden" value="<?php echo $vformARQUIVO ?>" />

			<div style="width: 800px; border: #999999 1px solid">
				<div class="td_box8">
					<table border="0" width="100%" cellspacing="0" cellpadding="0" class="letras_">
						<thead></thead>
						<tbody>
							<tr>
								<?php
								if ($vformACAO == "") {
									echo '<td align="center" width="40" height="40" valign="middle"><a href="conteudo.php?local=' . $getLOCAL . '&tp=' . $vgetTIPO . '" target="home" title="Voltar para Home Principal"><img src="images/btn_close.gif" border="0" width="30" height="30" alt="Voltar para Home" /></a></td>';

								} else {
									echo '<td align="center" width="40" height="40" valign="middle"><a href="ger_noticias.php?local=' . $getLOCAL . '&tp=' . $vgetTIPO . '" target="home" title="Voltar para Listagem de Produtos"><img src="images/btn_back.gif" border="0" width="30" height="30" alt="Voltar para Listagem de Produtos" /></a></td>';

								}
								?>
								<td align="left" height="40" valign="middle"><span style="font-size: 20px; font-weight: bold"><?php echo $syscTITULOSECAO ?></span></td>
							</tr>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				<div align="left" style="margin: 10px">
					<table class="letras_" border="0">
						<thead></thead>
						<tbody>
							<tr>
								<td height="28" align="right" valign="top" class="align_"><span style="font-size: 12px">T&iacute;tulo da Not&iacute;cia:</span></td>
								<td><textarea name="formTITULO" rows="2" cols="70" tabindex="1" class="form_textarea"><?php echo $vformTITULO ?></textarea></td>
							</tr>
							<tr>
								<td height="28" align="right" valign="top" class="align_"><span style="font-size: 12px">Descri&ccedil;&atilde;o da Not&iacute;cia:</span><br /><em>(ou sub-t&iacute;tulo)</em></td>
								<td valign="top" colspan="2"><textarea name="formDESCRICAO" rows="4" cols="70" tabindex="2" class="form_textarea"><?php echo $vformDESCRICAO ?></textarea></td>
							</tr>
							<tr>
								<td height="28" align="right" valign="middle" class="align_">Categoria:</td>
								<td height="28" valign="middle"><input type="text" tabindex="3" name="formCATEGORIA" size="20" maxlength="20" value="<?php echo $vformCATEGORIA ?>" class="form_" /></td>
							</tr>
							<tr>
								<td height="28" align="right" valign="middle" class="align_">Abrang&ecirc;ncia:</td>
								<td height="28" valign="middle">
									<select name="formABRANGE" tabindex="4" class="form_">
										<option value="local" <?php echo $vformABRANGELOCAL ?>>Local</option>
										<option value="regional" <?php echo $vformABRANGEREGIONAL ?>>Regional</option>
										<option value="geral" <?php echo $vformABRANGEGERAL ?>>Geral</option>
										<option value="entrevista" <?php echo $vformABRANGEENTREVISTA ?>>Entrevista</option>
									</select>
								</td>
							</tr>
							<tr>
								<td height="28" align="right" valign="middle" class="align_">Tags:</td>
								<td height="28" valign="middle"><input type="text" tabindex="5" name="formTAGS" size="60" maxlength="250" value="<?php echo $vformTAGS . " " ?>" class="form_" /></td>
							</tr>
							<tr>
								<td height="28" align="right" valign="middle" class="align_" nowrap="nowrap">Local do Destaque:</td>
								<td height="28" valign="middle">
									<select name="formDESTAQUE" tabindex="6" class="form_">
										<option value="<?php echo $syscOPCAODESTAQUE ?>"><?php echo $syscDESTAQUE ?></option>
										<option value="M">Nenhuma</option>
										<option value="D">Destaques</option>
										<option value="U">&Uacute;ltimas</option>
										<option value="P">Principal</option>
									</select>
								</td>
							</tr>
							<tr>
								<td height="28" align="right" valign="middle" class="align_" nowrap="nowrap">Ordem do Destaque:</td>
								<td height="28" valign="middle"><input type="text" tabindex="7" name="formORDEM_EXTERNO" size="3" maxlength="1" value="<?php echo $vformORDEM_EXTERNO ?>" class="form_" /></td>
							</tr>
							<tr>
								<td height="28" align="right" valign="middle" class="align_">Fonte:</td>
								<td height="28" valign="middle"><input type="text" tabindex="8" name="formFONTE" size="50" maxlength="250" value="<?php echo $vformFONTE ?>" class="form_fonte" /></td>
							</tr>
							<tr>
								<td align="center" height="28" valign="middle" colspan="2">
									<input name="formFOTOCAPA" id="FotoCapa" type="hidden" value="<?php echo $vformFOTOCAPA ?>" />
									<input name="formFOTOTEXTO" id="FotoTexto" type="hidden" value="<?php echo $vformFOTOTEXTO ?>" />

									<div align="center" style="width: 430px">
										<div class="clear">&nbsp;</div>
										
										<div style="border: #999999 1px solid; width: 200px; float: left; margin-right: 20px"><iframe src="noticia_fotodestaque.php?local=<?php echo $getLOCAL ?>&ida=<?php echo $vgetID_NOTICIA ?>&file=<?php echo $vformFOTOCAPA ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>" name="vazio" scrolling="no" frameborder="0" width="200" height="250"></iframe></div>
										<div style="border: #999999 1px solid; width: 200px; float: left"><iframe src="noticia_fototexto.php?local=<?php echo $getLOCAL ?>&ida=<?php echo $vgetID_NOTICIA ?>&file=<?php echo $vformFOTOTEXTO ?>&idu=<?php echo $vgetIDUSUARIO ?>&tp=<?php echo $vgetTIPO ?>" name="vazio" scrolling="no" frameborder="0" width="200" height="250"></iframe></div>
									</div>
									<div align="left" style="width: 430px">
										<div style="width: 200px; float: left; color: #666666; margin-right: 20px"><em>(Obrigatório)</em></div>
										<div style="width: 200px; float: left; color: #666666"><em>(Opcional)</em></div>
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				
				<div class="clear">&nbsp;</div>
				
				<?php
				// Automatically calculates the editor base path based on the _samples directory.
				// This is usefull only for these samples. A real application should use something like this:
				// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
				//$sBasePath = $_SERVER['PHP_SELF'] ;
				//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
				//echo $sBasePath;
				$sBasePath = "fckeditor/";

				$oFCKeditor = new FCKeditor('formCONTEUDO') ;
				$oFCKeditor->BasePath	= $sBasePath ;
				$oFCKeditor->Width	= 800;
				$oFCKeditor->Height	= 450;
				$oFCKeditor->Value = $syscCONTEUDO;
				$oFCKeditor->Create() ;
				?>
				
				<br /><br /><br /><input type="submit" value="    SALVAR NOTÍCIA   " class="submit_">
				
				<div class="clear">&nbsp;</div>
				<div class="clear">&nbsp;</div>
			</div>
		</form>
		
		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		<div class="clear">&nbsp;</div>
		
	</div>
</body>
</html>