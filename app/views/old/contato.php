<?php
if (!isset($_SESSION['sysContatoSalvo'])) {
	$_SESSION['sysContatoSalvo'] = "";

}

$vformAcao = isset($_POST["formAcao"]) ? strtolower($_POST["formAcao"]) : "";

$vformSetor = isset($_POST["formSetor"]) ? $_POST["formSetor"] : "";
$vformNome = isset($_POST["formNome"]) ? fAspas($_POST["formNome"]) : "";
$vformEmail = isset($_POST["formEmail"]) ? fAspas($_POST["formEmail"]) : "";
$vformFone = isset($_POST["formFone"]) ? fAspas($_POST["formFone"]) : "";
$vformComoSoube = isset($_POST["formComoSoube"]) ? fAspas($_POST["formComoSoube"]) : "";
$vformCidade = isset($_POST["formCidade"]) ? fAspas($_POST["formCidade"]) : "";
$vformAssunto = isset($_POST["formAssunto"]) ? fAspas($_POST["formAssunto"]) : "";
$vformMensagem = isset($_POST["formMensagem"]) ? fAspas($_POST["formMensagem"]) : "";
?>		
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title><?=$vHeadTitle?></title>
		
		<meta http-equiv="content-language" content="pt-br">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta name="description" content="Petrolina Piscinas é uma empresa especializada na construção de piscinas e áreas de lazer, trabalhando com qualidade superior e inovação." />
		<meta name="robots" content="index, follow"> 
		
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="http://www.petrolinapiscinas.com.br">
		<meta property="og:title" content="Petrolina Piscinas">
		<meta property="og:site_name" content="Petrolina Piscinas">
		<meta property="og:description" content="Petrolina Piscinas é uma empresa especializada na construção de piscinas e áreas de lazer, trabalhando com qualidade superior e inovação.">
		<meta property="og:image" content="http://www.petrolinapiscinas.com.br/docs/fotos/empresa/2019-11-21.jpg">
		<meta property="og:image:type" content="image/jpeg">
		<meta property="og:image:width" content="400">
		<meta property="og:image:height" content="238">
		<meta property="og:type" content="website">
		
		<meta name="author" content="SAMSITE Web Design Sistemas">
		<meta name="reply-to" content="suporte@samsite.com.br">
		
		<link rel="icon" type="image/x-icon" href="<?=$vUrlPadrao?>/images/petrolina-piscinas-favicon.png" />
		
		<link href="https://fonts.googleapis.com/css?family=Dosis|Hammersmith+One|Open+Sans|Raleway:200" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="<?=$vUrlPadrao?>/assets/bootstrap/css/fontawesome.min.css">

		<script src="assets/js/geral002.js"></script>
		<script src="assets/js/query_redirect.js"></script>
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<style>
			<!--
			.label_ { margin: 0px; padding: 0px; }
			
			.edit-login { margin: 0px; padding: 0px; }

			.submit_ { 
				background: #0a993a;
				border: #14ba4c 5px solid;
				border-radius: 25px;
				color: #ffffff;
				font-family: SegoMedium;
				font-size: 24px;
				font-weight: normal;
				padding: 6px;
				margin: auto;
				width: 170px;
			}
			
			#area-aviso {
				background: #f77460;
				border: #ff8370 10px solid;
				border-radius: 25px;
				color: #ffffff;
				display: none;
				font-family: SegoMedium;
				font-size: 16px;
				font-weight: normal;
				padding: 10px;
				margin: auto;
				margin-bottom: 15px;
				width: 500px;
			}
			
			div.planos_indisponivel {
				position: absolute;
				widht: 100%;
				z-index: 99;
			}
			-->
		</style>	
		
		<link rel="stylesheet" type="text/css" href="assets/css/estilo008.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/media006.css"/>

		<script type="text/javascript">
		var $w = $(window);

		$w.on("menu", function(){
		   if( $w.menuTop() > 300 ) {
			   document.getElementById("botao_up").style.display = "block";
			   
		   } else {
			   document.getElementById("botao_up").style.display = "none";
			   
		   }
		});
		</script>
		
	</head>
	<body>
		<?php
		include "header_interno.php";
		?>
		
		<section id="area-internas">
		
			<div class="container">
			
				<div class="row">
					<div class="col-md-12">
						<br/><br/>
						<div id="areaTitulos"><h1 class="tit-categorias">Contato</h1></div>
						<br/><br/>
						<div class="text-center"><h5>Selecione à Área de Interesse e preencha seus dados abaixo que entraremos em contato o mais breve possível.</h5></div><br/><br/>
					</div>
				</div>
				
				<?php
				if ($vformAcao == "novo") {
					$vErro = 0;
					
					$vEcho = '';
					
					if ($vformSetor == "") {
						$vEcho .= '<div>&mdash; O campo <strong>SELECIONE O SETOR</strong> não foi selecionado!</div>';
						$vErro++;
					}
					
					if ($vformNome == "") {
						$vEcho .= '<div>&mdash; O campo <strong>NOME PARA CONTATO</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformEmail == "") {
						$vEcho .= '<div>&mdash; O campo <strong>E-MAIL</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformFone == "") {
						$vEcho .= '<div>&mdash; O campo <strong>TELEFONE</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformCidade == "") {
						$vEcho .= '<div>&mdash; O campo <strong>CIDADE/UF</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformAssunto == "") {
						$vEcho .= '<div>&mdash; O campo <strong>ASSUNTO</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformMensagem == "") {
						$vEcho .= '<div>&mdash; O campo <strong>MENSAGEM</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					
					if ($vErro > 0) {
						echo '<div class="row">';
						echo '	<div class="col-md-12"><div id="areaAviso">';
						echo '		<h4>Ops!</h4>';
						
						echo $vEcho;
						
						echo '	</div><br/><br/></div>';
						echo '</div>';
						
					} else {
						$vDATA_CAD = date("Y-m-d H:i:s"); 
						
						$querySetores =$vConexao->query("SELECT * FROM sysc_cargos WHERE id=$vformSetor") or die ("Falha ao tentar conexão com Cargos");
							$reSetores = mysqli_fetch_array($querySetores);
							
							$vSetorNome = $reSetores['cargo'];
							$vSetorEmail = $reSetores['email'];
							
						mysqli_free_result($querySetores);
						
						$vContatoSalvo = strtolower(trim($vformNome)) . $vDATA_CAD;
						$vContatoSalvo = str_replace(" ", "", $vContatoSalvo);
						$vContatoSalvo = str_replace(":", "", $vContatoSalvo);
						$vContatoSalvo = str_replace("-", "", $vContatoSalvo);
						
						if (strpos($_SESSION['sysContatoSalvo'], $vContatoSalvo) <= 0) {
							$vCidade = str_replace("-", "|", $vformCidade);
							$vCidade = str_replace("/", "|", $vCidade);
							$vCidade = str_replace("_", "|", $vCidade);
							$vCidade = str_replace(".", "|", $vCidade);
							$vCidade = str_replace(",", "|", $vCidade);
							
							$arrayCidade = explode("|", $vCidade);
							
							$dbVALORES = "0" . $vformSetor;
							$dbVALORES .= ",'" . $vSetorNome . "'";
							$dbVALORES .= ",'" . $vformAssunto . "'";
							$dbVALORES .= ",'" . $vformNome . "'";
							$dbVALORES .= ",'" . $vformEmail . "'";
							$dbVALORES .= ",''";
							$dbVALORES .= ",'" . $vformFone . "'";
														
							if (count($arrayCidade) > 1) {
								$dbVALORES .= ",'" . $arrayCidade[0] . "'";
								$dbVALORES .= ",'" . strtoupper(substr($arrayCidade[1], 0, 2)) . "'";
								
							} else {
								$dbVALORES .= ",'" . $vformCidade . "'";
								$dbVALORES .= ",''";
								
							}
							
							$dbVALORES .= ",'" . $vformComoSoube . "'";
							$dbVALORES .= ",'" . str_replace("\n", "<br>", $vformMensagem) . "'";
							$dbVALORES .= ",'N'";
							$dbVALORES .= ",'N'";
							$dbVALORES .= ",'" . $vDATA_CAD . "'";
						  
							$dbCAMPOS = "id_setor, setor, assunto, nome, email, dddfone, fone, cidade, estado, comosoube, mensagem, lida, respondida, data";
							
							$dbSALVAR = $vConexao->query("INSERT INTO sysc_contatos (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());

							$vIdContato = 0;
							
							$queryContatos = $vConexao->query("SELECT * FROM sysc_contatos WHERE nome='$vformNome' AND data='$vDATA_CAD'") or die ("Falha em Contatos: 136");
								$reContatos = mysqli_fetch_array($queryContatos);
								
								if ($reContatos != "") {
									$vIdContato = $reContatos['id'];
									
								}
								
							mysqli_free_result($queryContatos);
							
							$_SESSION['sysContatoSalvo'] .= '[' . $vContatoSalvo . ']';
							$_SESSION['sysOrcamento'] = "";
							
							
							if ($vIdContato > 0) {

								$vformFileName = $_FILES['FormFileImagem']['name'];
								$vformFileTemp = $_FILES['FormFileImagem']['tmp_name'];
								$vformFileSize = $_FILES['FormFileImagem']['size'];
								
								if ($vformFileName != "") {
									// Pega extensão do arquivo
									preg_match("/\.(doc|docx|pdf|gif|bmp|png|jpg|jpeg){1}$/i", $vformFileName, $vFileExtensao);

									// Gera um nome único para a imagem
									$imagem_nome = md5(uniqid(time())) . "." . $vFileExtensao[1];

									// Caminho de onde a imagem ficará
									$imagem_dir = "./docs/documentos/" . $imagem_nome;
									$imagem_local = "./docs/documentos";
									
									// Faz o upload da imagem
									move_uploaded_file($vformFileTemp, $imagem_dir);
									
									
									// ***********************************************
									// *
									// * Inicia gravação no banco de dados
									// *
									// ***********************************************
										
									$vConexao->query("UPDATE sysc_contatos SET anexo='$imagem_nome' WHERE id=$vIdContato") or die (mysqli_error());
								}
							}
								
								
							// ***********************************************
							// *
							// * Enviar Mensagem
							// *
							// ***********************************************
							
							$mailAssinatura = '[ EQUIPE DE RELACIONAMENTO PETROLINA PISCINAS ]';
							
							$mailNome = $vformNome;
							$mailDestinatario = $vformEmail;
							$mailAssunto = 'PETROLINA PISCINAS: Contato Enviado Através do Site';
							
							$mailConteudo = '<b>Obrigado por manter contato.</b><br><br><br>';
							$mailConteudo .= 'Aguarde nosso retorno o mais breve poss&iacute;vel.<br><br><br>';
							$mailConteudo .= '<b>Agradecemos pela prefer&ecirc;ncia.</b><br><br><br>';
							
							include ("enviar_email.php");
							
							
							$mailNome = $vSetorNome;
							$mailDestinatario = $vSetorEmail;
							$mailAssunto = 'PETROLINA PISCINAS: Contato Recebido Através do Site';
							
							$mailConteudo = '<b>Contato Recebido Atrav&eacute;s do Site.</b><br><br><br>';							
							$mailConteudo .= '<b>NOME:</b> <font color="#ff0000">' . $vformNome . '</font><br>';
							$mailConteudo .= '<b>E-MAIL:</b> <font color="#ff0000">' . $vformEmail . '</font><br>';
							$mailConteudo .= '<b>FONE:</b> <font color="#ff0000">' . $vformFone . '</font><br>';
							$mailConteudo .= '<b>CIDADE:</b> <font color="#ff0000">' . $vformCidade . '</font><br>';
							$mailConteudo .= '<b>COMO SOUBE:</b> <font color="#ff0000">' . $vformComoSoube . '</font><br>';
							$mailConteudo .= '<b>ASSUNTO:</b> <font color="#ff0000">' . $vformAssunto . '</font><br>';
							$mailConteudo .= '<b>DATA:</b> <font color="#ff0000">' . $vDATA_CAD . '</font><br><br>';
							$mailConteudo .= '<b>MENSAGEM:</b><br><font color="#ff0000">' . str_replace("\n", "<br>", $vformMensagem) . '</font><br><br><br>';
							$mailConteudo .= 'Retorne o contato o mais breve poss&iacute;vel.<br><br><br>';
							
							include ("enviar_email.php");
							
							
							// ***********************************************

							
							$vformSetor = "";
							$vformNome = "";
							$vformEmail = "";
							$vformFone = "";
							$vformComoSoube = "";
							$vformCidade = "";
							$vformAssunto = "";
							$vformMensagem = "";

							
							echo '<div align="center" style="font-family: \'Raleway\', sans-serif;">';
							echo '<div style="font-size: 48px; color: #ba2525;">Obrigado!</div><br/>';
							echo '<div style="font-size: 20px; color: #2d7c1d;">Seu Contato foi salvo com sucesso!<br/><br/>Aguarde nosso retorno o mais breve poss&iacute;vel.<br/><br/><span style="font-weight: bold">Agradecemos pela prefer&ecirc;ncia.</span><br/><br/></div>';
							echo '</div>';
						}
					}
				}

				?>
				
				<form action="<?php echo $vUrlPadrao ?>/contato" method="post" enctype="multipart/form-data" name="frmContato">
					<input type="hidden" name="formAcao" value="novo"/>
					
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<select name="formSetor" id="cSetor" class="form-control input-lg" onChange="fVerificarSetor()">
								<option value="">Selecione o setor</option>
								
								<?php
								$querySetores =$vConexao->query("SELECT * FROM sysc_cargos WHERE tipo='setor' AND ativo='S'") or die ("Falha ao tentar conexão com Cargos");
									while ($reSetores = mysqli_fetch_assoc($querySetores)) {
										echo '<option value="' .$reSetores['id'] . '">';
										echo $reSetores['cargo'];
										echo '</option>';
									}
								mysqli_free_result($querySetores);
								?>
								
							</select><br/>
						</div>
						<div class="col-md-2"></div>
					</div>
					
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="text" name="formNome" value="<?php echo $vformNome ?>" class="form-control input-lg" data-myrules="required" placeholder="Nome"><br/></div>
						<div class="col-md-2"></div>
					</div>
					
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="text" name="formEmail" value="<?php echo $vformEmail ?>" class="form-control input-lg" data-myrules="required|email" placeholder="E-mail"><br/></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="text" name="formFone" value="<?php echo $vformFone ?>" class="form-control input-lg" placeholder="Telefone"><br/></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="text" name="formCidade" value="<?php echo $vformCidade ?>" class="form-control input-lg" placeholder="Cidade/UF"><br/></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="text" name="formComoSoube" value="<?php echo $vformComoSoube ?>" class="form-control input-lg" placeholder="Como Soube da Nossa Empresa?"><br/></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="text" name="formAssunto" value="<?php echo $vformAssunto ?>" class="form-control input-lg" data-myrules="required" placeholder="Assunto"><br/></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><textarea name="formMensagem" class="form-control input-lg" data-myrules="required" placeholder="Mensagem" rows="5"><?php echo $vformMensagem ?></textarea><br/><br/></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><div id="cCurriculo" style="display: none; width: 100%; border: #cccccc 1px solid; padding: 20px; border-radius: 10px; background: #f8f8f8; margin-bottom: 40px"><span style="font-style: italic">J&aacute; possui um Curr&iacute;culo pronto? Anexe o arquivo: </span><br/><br/><input type="file" name="FormFileImagem" /></div></div>
						<div class="col-md-2"></div>
					</div>
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8"><input type="submit" class="submit-enviar" value="Enviar" name="enviar"></div>
						<div class="col-md-2"></div>
					</div>
				</form>
				
				<script>
				function fVerificarSetor() {
					var vElemento = document.getElementById("cSetor");
					var vElementoStr = new String(vElemento.options[vElemento.selectedIndex].text);

					document.getElementById("cCurriculo").style.display = "none";
					
					if (vElementoStr.indexOf("Recursos Humanos") >= 0 || vElementoStr.indexOf("RH") >= 0) {
						document.getElementById("cCurriculo").style.display = "table";
						
					}
				}
				</script>
				
				<br/><br/><br/>
				
			</div><!--container-->

		</section>
		
		<?php
		include "rodape.php";
		?>
		
		<div id="botao_up">
			<a id="subir" href="#" title="Voltar ao topo"><img src="<?php echo $vUrlPadrao ?>/images/up.png" alt="Voltar ao topo" border="0" /></a>
		</div>
			
		<script>window.jQuery || document.write('<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/jquery-slim.min.js"><\/script>')</script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/popper.min.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/holder.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
			   $('#subir').click(function(){ 
					$('html, body').animate({menuTop:0}, 'slow');
					return false;
				 });
				
			 });
		</script>
	</body>
</html>