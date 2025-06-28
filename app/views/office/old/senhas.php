<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

if (strpos($_SERVER['HTTP_USER_AGENT'], "Firefox") > 0) {
	$vMarginTop = "1860px";
	
} else {
	$vMarginTop = "1860px";
	
}

$vError = "";
$vErrorMensagem = "";

include "conexao.php";
include "documentos/include/funcoes.php";

$vgetIDUSUARIO = isset($_GET["idu"]) ? fId("d", $_GET["idu"]) : NULL;


// ***********************************************************
// *
// *
// * Percorre tabela LOGIN e pega o nome do Usuário
// *
// *
// ***********************************************************

$arrayUSUARIOS = Array();
$i = 0;

$vQUERY = $vConexao->query("SELECT * FROM sysc_usuarios WHERE id=" . $vgetIDUSUARIO) or die("Falha na execução da consulta.");
	$vRE = mysqli_fetch_array($vQUERY);

	$vformUSUARIO = $vRE['usuario'];
	$vformLEMBRETE = $vRE['senha_lembrete'];

mysqli_free_result($vQUERY);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>::: Central de Apostas :::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="SAMSITE Sistemas Web Design" />
	<meta name="description" content="A centraldeapostas.com é hoje o maior meio de rendimentos consistentes para investidores que não podem ou não tem conhecimento do mercado de TRADING ESPORTIVO." />
	<meta name="keywords" content="central, aposta, esporte, investimento, investidores, trading, esportivo" />
	<link rel="shortcut icon" href="favicon.ico"> 
</head>
<body>
	<div id="area-principal">
		<div id="area-apostar">
			<div align="center">
				<div class="area-quero-apostas">
					<div align="left" style="margin: 30px;">
						<div style="font-size: 14px"><a href="javascript: showDIRECT('', 'inicio.php?idu=<?php echo fId("c", $vgetIDUSUARIO) ?>', 'areaConteudo')" class="ltopo">INÍCIO</a> / MINHAS SENHAS</div><br /><br />
						
						<div class="Titulo-Interno">Minhas Senhas</div><br /><br />
						
						<div id="area-cadastro">   
							<form method="post" action="salvar_senhas.php" target="direcionar" id="frmCadastro" name="frmCadastro" onSubmit="return fValidaCadastro()">
								<input type="hidden" name="formIDUSUARIO" value="<?php echo $vgetIDUSUARIO ?>" />

								<div class="clear"><br /></div>
								
								<div id="boxEIXO"></div>

								<div id="area-cadastro-left">
									<div style="font-size: 28px;border-bottom: #5B8F08 2px solid;width: 400px;color: #77AA24; font-weight: bold">PESSOAL</div>
									
									<div class="clear"><br /></div>
									
									<div style="font-size: 16px">Nome de Usuário/Login: <span style="font-weight: bold; font-size: 22px"><?php echo $vformUSUARIO ?></span></div>
						  
									<label for="Nome">Nova Senha</label>
									<input type="password" name="formLSENHAA" class="form-edit-senhas" tabindex="3" maxlength="100"  value="" />
						  
									<label for="Endereco">Repita a Senha</label>
									<input type="password" name="formLSENHAB" class="form-edit-senhas" tabindex="9" maxlength="100" value="" />

									<label for="Endereco">Frase Lembrete</label>
									<input type="text" name="formLEMBRETE" class="form-edit" tabindex="9" maxlength="100" value="<?php echo $vformLEMBRETE ?>" />

								</div>
								
								<div class="clear"><br /></div>
								
								<div>
									<div style="float: left"><br /><br /><input type="submit" id="button" value="   ATUALIZAR  " tabindex="27" onClick="fImagemLoad()" class="formSUBMIT" /></div>
									<div id="area-aviso"></div>
								</div>
								
								<iframe src="vazio.php" scrolling="yes" frameborder="0" name="direcionar" style="border:none; overflow:hidden; width:1px; height:1px;" allowTransparency="true"></iframe>
			
								<div class="clear"><br /><br /><br /></div>

							</form>

						</div>

						<div id="boxDIALOGO"></div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</body>
</html>