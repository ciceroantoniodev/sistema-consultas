<?php
if ($_SESSION['sysOrcamento'] != "") { 
	if (!isset($_SESSION['sysOrcamentoSalvo'])) {
		$_SESSION['sysOrcamentoSalvo'] = "";

	}

	$vformAcao = isset($_POST["formAcao"]) ? strtolower($_POST["formAcao"]) : "";

	$vformProdutos = isset($_POST["formProdutos"]) ? $_POST["formProdutos"] : "";

	$vformNome = isset($_POST["formNome"]) ? fAspas($_POST["formNome"]) : "";
	$vformEmail = isset($_POST["formEmail"]) ? fAspas($_POST["formEmail"]) : "";
	$vformFone = isset($_POST["formFone"]) ? fAspas($_POST["formFone"]) : "";
	$vformCidade = isset($_POST["formCidade"]) ? fAspas($_POST["formCidade"]) : "";
	$vformBairro = isset($_POST["formBairro"]) ? fAspas($_POST["formBairro"]) : "";
	$vformWhatsApp = isset($_POST["formWhatsApp"]) ? fAspas($_POST["formWhatsApp"]) : "";
	$vformMensagem = isset($_POST["formMensagem"]) ? fAspas($_POST["formMensagem"]) : "";
	
} else {
	$vformAcao = "";
	
}
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
		
		<section id="area-categorias">
		
			<div class="container">
			
				<div class="row">
					<div class="col-md-12"><br/><br/><div id="areaTitulos"><h1 class="tit-categorias">Or&ccedil;amento</h1></div><br/><br/></div>
				</div>
				
				<?php
				if ($vformAcao == "novo") {
					$vErro = 0;
					
					$vEcho = '';
					
					
					if ($vformNome == "") {
						$vEcho .= '<div>&mdash; O campo <strong>NOME PARA CONTATO</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformCidade == "") {
						$vEcho .= '<div>&mdash; O campo <strong>CIDADE/UF</strong> não pode ser vazio!</div>';
						$vErro++;
					}
					
					if ($vformBairro == "") {
						$vEcho .= '<div>&mdash; O campo <strong>BAIRRO</strong> não pode ser vazio!</div>';
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
					
					if ($vErro > 0) {
						echo '<div class="row">';
						echo '	<div class="col-md-12"><div id="areaAviso">';
						echo '		<h4>Ops!</h4>';
						
						echo $vEcho;
						
						echo '	</div></div>';
						echo '</div>';
						
					} else {
						$vDATA_CAD = date("Y-m-d H:i:s"); 
						
						$vOrcamentoSalvo = strtolower(trim($vformNome)) . $vDATA_CAD;
						$vOrcamentoSalvo = str_replace(" ", "", $vOrcamentoSalvo);
						$vOrcamentoSalvo = str_replace(":", "", $vOrcamentoSalvo);
						$vOrcamentoSalvo = str_replace("-", "", $vOrcamentoSalvo);
						
						
						// Se o orçamento ainda não foi salvo
						// Então, inicia processo de salvação
						//
						if (strpos($_SESSION['sysOrcamentoSalvo'], $vOrcamentoSalvo) <= 0) {

							$vCidade = str_replace("-", "|", $vformCidade);
							$vCidade = str_replace("/", "|", $vCidade);
							$vCidade = str_replace("_", "|", $vCidade);
							$vCidade = str_replace(".", "|", $vCidade);
							$vCidade = str_replace(",", "|", $vCidade);
							
							$arrayCidade = explode("|", $vCidade);
							
							$dbVALORES = "'" . $vformNome . "'";
							
							if (count($arrayCidade) > 1) {
								$dbVALORES .= ",'" . $arrayCidade[0] . "'";
								$dbVALORES .= ",'" . strtoupper(substr($arrayCidade[1], 0, 2)) . "'";
								
							} else {
								$dbVALORES .= ",'" . $vformCidade . "'";
								$dbVALORES .= ",''";
								
							}
							
							$dbVALORES .= ",'" . $vformBairro . "'";
							$dbVALORES .= ",'" . $vformEmail . "'";
							$dbVALORES .= ",'" . $vformFone . "'";
							$dbVALORES .= ",'" . $vformWhatsApp . "'";
							$dbVALORES .= ",'" . $vformMensagem . "'";
							$dbVALORES .= ",0" . (int)$vformProdutos;
							$dbVALORES .= ",'S'";
							$dbVALORES .= ",'" . $vDATA_CAD . "'";
						  
							$dbCAMPOS = "nome, cidade, uf, bairro, email, fone, whatsapp, mensagem, itens, pendente, data_cad";
							
							$dbSALVAR = $vConexao->query("INSERT INTO sysc_orcamentos (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die(mysql_error());

							
							// Pegar ID do orçamento salvo
							//
							$queryOrcamentos = $vConexao->query("SELECT * FROM sysc_orcamentos WHERE nome='$vformNome' AND data_cad='$vDATA_CAD'") or die ("Falha ao tentar conexao com Orcamentos");
							
								$reOrcamentos = mysqli_fetch_array($queryOrcamentos);
								
								$vIdOrcamento = $reOrcamentos['id'];
								
							mysqli_free_result($queryOrcamentos);	

							
							// Iniciar salvação dos produtos relacionandos no orçamento
							//
							$dbCAMPOS = "id_orcamento, id_produto, produto, referencia, quantidade, data_cad";

							$vTotalItens = 0;
							
							$vTabela = '<table cellspacing=0 cellpadding=8 border=1>';
							$vTabela .= '<tr style="background: #666666; color: #ffffff"><td>Nome do Produto</td><td style="border-left: #ffffff 1px solid; border-right: #ffffff 1px solid">Referência</td><td>Quantidade</td></tr>';
							
							for ($i = 1; $i <= (int)$vformProdutos; $i++) {
								
								$vformId = isset($_POST["formId".$i]) ? $_POST["formId".$i] : "";
								$vformProduto = isset($_POST["formProduto".$i]) ? $_POST["formProduto".$i] : "";
								$vformReferencia = isset($_POST["formReferencia".$i]) ? $_POST["formReferencia".$i] : "";
								$vformQuantidade = isset($_POST["formReferencia".$i]) ? $_POST["formQuantidade".$i] : "";
								
								if (trim($vformProduto) != "") {
									$dbVALORES = "0" . $vIdOrcamento;
									$dbVALORES .= ",0" . $vformId;
									$dbVALORES .= ",'" . $vformProduto . "'";
									$dbVALORES .= ",'" . $vformReferencia . "'";
									$dbVALORES .= ",0" . (int)$vformQuantidade;
									$dbVALORES .= ",'" . $vDATA_CAD . "'";
								  
									$dbSALVAR = $vConexao->query("INSERT INTO sysc_orcamentosprodutos (" . $dbCAMPOS . ") VALUES (" . $dbVALORES . ")") or die("Falha ao tentar conexao com Orcamentos Detalhes");
									
									$vTotalItens++;
									
									$vTabela .= '<tr>';
									$vTabela .= '<td>' . $vformProduto . '</td>';
									$vTabela .= '<td>' . $vformReferencia . '</td>';
									$vTabela .= '<td>' . (int)$vformQuantidade . '</td>';
									$vTabela .= '</tr>';
								}
							}
							
							$vTabela .= '</table>';
							
							$vConexao->query("UPDATE sysc_orcamentos SET itens=$vTotalItens WHERE id=$vIdOrcamento") or die("Falha ao tentar conexao com Orcamentos");
							
							
							// ***********************************************
							// *
							// * Enviar Mensagem
							// *
							// ***********************************************
							
							
							$mailAssinatura = '[ EQUIPE DE RELACIONAMENTO PETROLINA PISCINAS ]';
							
							$mailNome = $vformNome;
							$mailDestinatario = $vformEmail;
							$mailAssunto = 'PETROLINA PISCINAS: Or&ccedil;amento Enviado Atrav&eacute;s do Site';
							
							$mailConteudo = '<b>Obrigado pelo interesse em nossos produtos.</b><br><br>';
							$mailConteudo .= $vTabela;
							$mailConteudo .= '<br><br>Aguarde o retorno o mais breve poss&iacute;vel de um dos nossos Representantes.<br><br><br>';
							$mailConteudo .= '<b>Agradecemos pela prefer&ecirc;ncia.</b><br><br><br>';
							
							include ("enviar_email.php");
							
							// Pegar ID do orçamento salvo
							//
							$queryDados = $vConexao->query("SELECT * FROM sysc_dadoscadastrais") or die ("Falha ao tentar conexao com Orcamentos");
							
								$reDados = mysqli_fetch_array($queryDados);
								
								$mailDestinatario = $reDados['email'];
								
							mysqli_free_result($queryDados);	
							
							$mailNome = 'PETROLINA PISCINAS';
							$mailAssunto = 'PETROLINA PISCINAS: Orçamento Recebido Através do Site';

							$mailConteudo = '<b>Or&ccedil;amento Recebido Atrav&eacute;s do Site</b><br><br><br>';							
							$mailConteudo .= '<b>NOME:</b> <font color="#ff0000">' . $vformNome . '</font><br>';
							$mailConteudo .= '<b>E-MAIL:</b> <font color="#ff0000">' . $vformEmail . '</font><br>';
							$mailConteudo .= '<b>FONE:</b> <font color="#ff0000">' . $vformFone . '</font><br>';
							$mailConteudo .= '<b>WHATSAPP:</b> <font color="#ff0000">' . $vformWhatsApp . '</font><br>';
							$mailConteudo .= '<b>CIDADE:</b> <font color="#ff0000">' . $vformCidade . '</font><br>';
							$mailConteudo .= '<b>BAIRRO:</b> <font color="#ff0000">' . $vformBairro . '</font><br>';
							$mailConteudo .= '<b>DATA:</b> <font color="#ff0000">' . $vDATA_CAD . '</font><br><br>';
							$mailConteudo .= '<b>MENSAGEM:</b><br><font color="#ff0000">' . str_replace("\n", "<br>", $vformMensagem) . '</font><br><br><br>';
							$mailConteudo .= '<b>RELA&Ccedil;&Atilde;O DE PRODUTOS:</b><br><br><br>';
							$mailConteudo .= $vTabela;
							$mailConteudo .= '<br><br><br>Retorne o contato o mais breve poss&iacute;vel.<br><br><br>';
							
							include ("enviar_email.php");
							
							
							// ***********************************************

							
							$_SESSION['sysOrcamentoSalvo'] .= '[' . $vOrcamentoSalvo . ']';
							$_SESSION['sysOrcamento'] = "";
							
							echo '<div align="center" style="font-family: \'Raleway\', sans-serif;">';
							echo '<div style="font-size: 48px; color: #ba2525;">Obrigado!</div><br/>';
							echo '<div style="font-size: 20px; color: #2d7c1d;">Seu or&ccedil;amento foi salvo com sucesso!<br/><br/>Aguarde o contato de um dos nossos Representantes o mais breve poss&iacute;vel.<br/><br/><br/><span style="font-weight: bold">Agradecemos a prefer&ecirc;ncia.</span></div>';
							echo '</div>';
							
							echo '<script type="text/javascript">';
							echo 'document.getElementById("btn-orcamento").style.display = "none";';
							echo '</script>';
						}
					}
				}

				?>
				
				<br/><br/>
				
				<form action="<?php echo $vUrlPadrao ?>/orcamento" method="post" name="frmOrcamentos">
					<input type="hidden" name="formAcao" value="novo"/>
					
					<?php
					if (!empty($_SESSION['sysOrcamento'])) {
						
						$vRelacao = $_SESSION['sysOrcamento'];
						$vRelacao = str_replace("][", "|", $vRelacao);
						$vRelacao = str_replace("[", "", $vRelacao);
						$vRelacao = str_replace("]", "", $vRelacao);
						
						$arrayRelacao = explode("|", $vRelacao);
						
						$vSql = "";
						
						$i =1;
						
						foreach ($arrayRelacao AS $vDados) {
							
							if (strpos($vSql, '='.(int)$vDados) < 1) {
								if ($i >1) { $vSql .= " OR "; }
							
								$vSql .= 'id='.(int)$vDados;
								
								$i++;
							}
							
						}
						
						$arrayProdutos = Array();
						
						$i = 0;
						
						$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtos WHERE " . $vSql) or die ("Falha ao tentar conexao com Produtos");
							while ($reProdutos = mysqli_fetch_assoc($queryProdutos)) {
								$arrayProdutos[$i] = [
														"Id"=>$reProdutos['id'], 
														"Nome"=>$reProdutos['nome'], 
														"Referencia"=>$reProdutos['referencia'], 
														"Foto"=>$reProdutos['foto_capa']
													 ];
								
								$i++;
								
							}
						mysqli_free_result($queryProdutos);	

						for ($i = 0; $i < count($arrayProdutos); $i++) {
							
							echo '<div id="rowList'. $i . '" class="row rowLista">';
								echo '<div class="col-md-2 imgLista">';
									if (fSeImagem($arrayProdutos[$i]['Foto']) && file_exists($vPastaLocal . "/docs/fotos/produtos/" . $arrayProdutos[$i]['Foto'])) {
										echo '<img src="' . $vUrlPadrao . '/docs/fotos/produtos/' . $arrayProdutos[$i]['Foto'] . '" width="80" border="0"/>';
										
									} else {
										echo '<img src="' . $vUrlPadrao . '/images/imagem_indisponivel.png" width="80" border="0"/>';
										
									}
								echo '</div>';
								
								echo '<div class="col-md-5">';
									echo '<div class="titLista">Nome do Produto:</div>';
									echo '<div class="nomLista">' . $arrayProdutos[$i]['Nome'] . '</div>';
									echo '<input type="hidden" name="formId' . ($i+1) . '" value="' . $arrayProdutos[$i]['Id'] . '"/>';
									echo '<input type="hidden" name="formProduto' . ($i+1) . '" value="' . $arrayProdutos[$i]['Nome'] . '"/>';
								echo '</div>';
								
								echo '<div class="col-md-2">';
									echo '<div class="titLista">Referência:</div>';
									echo '<div class="refLista">' . $arrayProdutos[$i]['Referencia'] . '</div>';
									echo '<input type="hidden" name="formReferencia' . ($i+1) . '" value="' . $arrayProdutos[$i]['Referencia'] . '"/>';
								echo '</div>';
								
								echo '<div class="col-md-2">';
									echo '<div class="titLista">Quantidade:</div>';
									echo '<input type="number" name="formQuantidade' . ($i+1) . '" value="1" class="form-lista-qtd" />';
								echo '</div>';
								
								echo '<div class="col-md-1">';
									echo '<div align="center"><a href="javascript: fDelOrcamento(' . $arrayProdutos[$i]['Id'] . ','. $i . ',\'' . $vUrlPadrao . '/orcamento\')"><div class="delLista">Excluir</div></a></div>';
								echo '</div>';
							echo '</div>';
						}
						
						echo '<input type="hidden" name="formProdutos" value="'. $i . '"/>';
						?>
			
						<br/><br/><br/>
						
						<div class="row">
							<div class="col-md-12">
								<div style="font-family: 'Raleway', sans-serif; font-size: 32px; font-weight: bold; color: #2d7c1d;">Informe seus dados:</div>
								<div style="font-family: 'Raleway', sans-serif; font-size: 16px; font-weight: bold; font-style: italic; color: #ff7575;">Todos os campos s&atilde;o obrigat&oacute;rios.</div>
							</div>
						</div>
								
						<br/><br/>
								
						<div class="row">
							<div class="col-md-6">
								<div><input type="text" name="formNome" value="<?php echo $vformNome ?>" class="form-control input-lg" data-myrules="required" placeholder="Nome Para Contato"><br/></div>
							</div>
							<div class="col-md-6">
								<div><input type="text" name="formCidade" value="<?php echo $vformCidade ?>" class="form-control input-lg" placeholder="Cidade/UF"><br/></div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div><input type="text" name="formBairro" value="<?php echo $vformBairro ?>" class="form-control input-lg" placeholder="Bairro"><br/></div>
							</div>
							<div class="col-md-6">
								<div><input type="text" name="formEmail" value="<?php echo $vformEmail ?>" class="form-control input-lg" data-myrules="required|email" placeholder="E-mail"><br/></div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div><input type="text" name="formFone" value="<?php echo $vformFone ?>" class="form-control input-lg" placeholder="Telefone"><br/></div>
							</div>
							<div class="col-md-6">
								<div><input type="text" name="formWhatsApp" value="<?php echo $vformWhatsApp ?>" class="form-control input-lg" placeholder="WhatsApp"><br/></div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div><textarea name="formMensagem" class="form-control input-lg" data-myrules="required" placeholder="Mensagem" rows="5"><?php echo $vformMensagem ?></textarea><br/><br/></div>

								<div><input type="submit" class="submit-enviar" value="Enviar Orçamento" /></div>
								
							</div>
						</div>
						
					<?php
					} else {
						if ($vformAcao != "novo") {
							echo '<div align="center" style="font-family: \'Raleway\', sans-serif;">';
							echo '<div style="font-size: 20px; color: #ba2525; font-weight: bold">Nenhum produto adicionado ao orçamento.</div>';
							echo '</div>';
						
						}
					}
					?>

				</form>
				
				<br/><br/><br/><br/>
				
			</div><!--container-->

		</section>

		<?php
		$vLojaDescricao = "";
		$vLojaImagem = "";
		
		$queryBanners = $vConexao->query("SELECT * FROM sysc_banners WHERE ativo='S' AND (secao='home' AND subsecao='inferior') ORDER BY ordem") or die ("Falha ao tentar conexão com BANNERS");
			$reBanners = mysqli_fetch_array($queryBanners);
			
			if ($reBanners != "") {
			
				if ($reBanners['mostrar_descricao'] == 'S') {
					$vLojaDescricao = $reBanners['descricao'];

				}
				
				$vLojaImagem = $reBanners['arquivo'];
			}
		mysqli_free_result($queryBanners);
		?>
		
		<script>
			document.getElementById("area-lojavirtual").style.background = "url(<?php echo $vUrlPadrao ?>/docs/banners/<?php echo $vLojaImagem ?>) no-repeat right";
			document.getElementById("area-lojavirtual").style.backgroundColor = "#51839e";
		</script>	


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