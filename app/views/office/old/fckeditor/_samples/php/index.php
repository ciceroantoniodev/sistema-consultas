<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$vgetID = isset($_GET["id"]) ? $_GET["id"] : NULL;
$vgetIDA = isset($_GET["ida"]) ? $_GET["ida"] : NULL;
$vgetCONN = isset($_GET["conn"]) ? $_GET["conn"] : NULL;
$vgetORIGEM = isset($_GET["o"]) ? $_GET["o"] : NULL;
$vgetIFRAMEHEIGHT = isset($_GET["h"]) ? $_GET["h"] : NULL;
$vgetARQUIVO = isset($_GET["file"]) ? $_GET["file"] : NULL;
$vgetURL = isset($_GET["url"]) ? $_GET["url"] : NULL;

$syscTITULOSECAO = "";

if ($vgetORIGEM == "noticias") {
	$syscTITULOSECAO = "EDITOR DE NOTÍCIAS";
	$syscACTION = "../../../documentos/syscontrole/";

	if ($vgetARQUIVO == "") {
		$vgetARQUIVO = "noticia" . $vgetIDA . date("YmdHis") . ".html"  ;
		
	}
	
	$syscCAMINHO = dirname(__FILE__);
	$syscCAMINHO = str_replace("fckeditor", "", $syscCAMINHO);
	$syscCAMINHO = str_replace("_samples", "", $syscCAMINHO);
	$syscCAMINHO = str_replace("php", "", $syscCAMINHO);
	$syscCAMINHO = str_replace("\\", "/", $syscCAMINHO);
	$syscCAMINHO = str_replace("///", "/", $syscCAMINHO);
	$syscCAMINHO = $syscCAMINHO . "documentos/noticias/" . $vgetARQUIVO;
//	$syscCAMINHO = str_replace("/", "\\", $syscCAMINHO);
	
	$syscCONTEUDO = "";
	
	if (file_exists($syscCAMINHO)) {	
		$syscARQUIVO = fopen($syscCAMINHO, "r");
		
		while (!feof($syscARQUIVO)) {
			$syscCONTEUDO .= fgets($syscARQUIVO, 9999);
			
		}

	}
	
} elseif ($vgetORIGEM == "paginas") {
	$syscTITULOSECAO = "EDIÇÃO DE CONTEÚDO DAS PÁGINAS / SEÇÕES";
	$syscACTION = "../../../";

	include "../../../documentos/include/usuarios/" . $vgetCONN;
	include "../../../documentos/include/conexao.php";

	$dbQUERY = mysql_query("SELECT conteudo FROM sysc_conteudo WHERE id=" . $vgetIDA) or die (mysql_error());

	while ($dbRE = mysql_fetch_assoc($dbQUERY)) {
		$syscCONTEUDO = $dbRE['conteudo'];
		
	}

}

include("../../fckeditor.php") ;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>:::: SysControle - Você no Controle :::: </title>
		<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
		<meta name="robots" content="noindex, nofollow">
		<link href="../sample.css" rel="stylesheet" type="text/css" />
		
		<style type="text/css">
		<!--
		.submit_  {
					font-family: tahoma, Verdana, Arial, Helvetica, sans-serif;
					font-size: 18px;
					color: #ffffff;
					background: #436EEE;
					height: 30px;
					border-right: #000080 1px solid;
					border-top: #0000FF 1px solid;
					border-left: #0000FF 1px solid;
					border-bottom: #000080 1px solid;
		}
		-->
		</style>
	</head>
	<body>
		<div align="center">
			<div style="width: 95%; border: #999999 1px solid">
				<div style="border-bottom: #999999 1px solid">
					<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<thead></thead>
						<tbody>
							<tr>
								<td align="center" width="40" height="40" valign="middle"><a href="framework.php?id=<?php echo $vgetID ?>&page=galerias" target="home" title="Voltar para Listagem de Galerias"><img src="http://www20.syscontrole.com.br/documentos/images/btn_back.gif" border="0" width="30" height="30" alt="Voltar" /></a></td>
								<td align="left" height="40" valign="middle"><span style="font-size: 20px; font-weight: bold; color: #333333"><?php echo $syscTITULOSECAO ?></span></td>
							</tr>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
				<div align="left" style="margin: 10px">
					<form action="<?php echo $syscACTION ?>salvar_edicao.php?id=<?php echo $vgetID ?>&ida=<?php echo $vgetIDA ?>&o=<?php echo $vgetORIGEM ?>&h=<?php echo $vgetIFRAMEHEIGHT ?>&file=<?php echo $vgetARQUIVO ?>" method="post" style="margin-top: 0px; margin-bottom: 0pt" name="frmEditor">
						<?php
						// Automatically calculates the editor base path based on the _samples directory.
						// This is usefull only for these samples. A real application should use something like this:
						// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
						$sBasePath = $_SERVER['PHP_SELF'] ;
						$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

						$oFCKeditor = new FCKeditor('formCONTEUDO') ;
						$oFCKeditor->BasePath	= $sBasePath ;
						$oFCKeditor->Height	= ((int)$vgetIFRAMEHEIGHT - 320);
						$oFCKeditor->Value = $syscCONTEUDO;
						$oFCKeditor->Create() ;
						?>
						<br>
						<input type="submit" value="    Salvar    " class="submit_">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
