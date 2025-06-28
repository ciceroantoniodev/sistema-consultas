<footer id="areaRodape">
		
	<div class="container">
		<div class="row">
			<div class="col-md-8">
			
				<div class="row">
					<div class="col-md-6">
						<div id="areaRodapeDados">
							<figure><img src="<?php echo $vUrlPadrao ?>/images/petrolina-piscinas-logo.png" class="img-responsive" border="0"/></figure>
							
							<br>
							
							<h3 class="tit-rodape">MATRIZ:&nbsp;&nbsp;</h3>
							
							<?php
							echo $vDadosEndereco . '<br/>';
							echo $vDadosBairro . '&nbsp;&nbsp;|&nbsp;&nbsp;';
							echo $vDadosCidade . '/' . $vDadosEstado;
							
							echo '<br><br><h3 class="tit-rodape">LOJA 2:&nbsp;&nbsp;</h3>';
							
							echo $vDadosEndereco2 . '<br/>';
							echo $vDadosBairro2 . '&nbsp;&nbsp;|&nbsp;&nbsp;';
							echo $vDadosCidade2 . '/' . $vDadosEstado2;
							?>
							
							<br><br>
							
						</div>
						
					</div>
					
					<div class="col-md-6">
						<div id="redes-sociais">
							<h3 class="tit-rodape">COMPARTILHE:&nbsp;&nbsp;</h3>
							<?php
							$arrayLink = Array();
							$i = 0;
							
							$queryLinks = $vConexao->query("SELECT * FROM sysc_links") or die ("Falha ao tentar se conectar com Links");
								while ($reLinks = mysqli_fetch_assoc($queryLinks)) {
									$arrayLink[$i] = [
														"Titulo"=>$reLinks['titulo'], 
														"Descricao"=>$reLinks['descricao'], 
														"Servidor"=>$reLinks['servidor'], 
														"Link"=>$reLinks['link'], 
														"Imagem"=>$reLinks['logo'], 
														"Origem"=>trim($reLinks['origem'])
													 ];
									
									$i++;
								}
							mysqli_free_result($queryLinks);

							for ($i= 0; $i < count($arrayLink); $i++) {
								if (trim($arrayLink[$i]['Origem']) == 'redesocial_rodape') {
									echo '<a href="' . trim($arrayLink[$i]['Servidor']) . trim($arrayLink[$i]['Link']) . '" title="' . trim($arrayLink[$i]['Titulo']) . '" target="_blank">';
									echo '<img src="' . $vUrlPadrao . '/docs/logos/' . trim($arrayLink[$i]['Imagem']) . '" alt="' . $vUrlPadrao . '/docs/logos/' . trim($arrayLink[$i]['Imagem']) . '" title="' . trim($arrayLink[$i]['Titulo']) . '" border="0" />';
									echo '</a>';
									
								}
							}
							?>
						
							<br><br>

							<h3 class="tit-rodape">CONTATOS:&nbsp;&nbsp;</h3>
									
							<div class="row">
								<div class="col-md-6">
									<div style="color: #ffffff">
										<?php
										echo ((strlen(trim($vDadosFone1)) > 7) ? '<div>' . $vDadosFone1 . '</div>' : '');
										echo ((strlen(trim($vDadosFone2)) > 7) ? '<div>' . $vDadosFone2 . '</div>' : '');
										echo $vDadosEmail;
										?>
										
										<br><br><br>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
					
			<div class="col-md-4">
				<div id="areaMapa">
					<iframe src="<?=$vDadosMapa?>" id="frameMapa" frameborder="0" allowfullscreen></iframe><br/><br/>
					<a href="http://www.samsite.com.br" title="Samsite: Criação de Sites - Marketing Digital - Sistemas Web" target="_blank"><figure><img src="<?php echo $vUrlPadrao ?>/images/desenvolvido-por-samsite-web-design-sistemas.png" title="Samsite: Criação de Sites - Marketing Digital - Sistemas Web" alt="desenvolvido-por-samsite-web-design-sistemas.png" border="0" /></figure></a>
				</div><br/>
			</div>
		</div>
	</div>

	<div id="balao_whatsapp">
		<div class="zapTopo">Clique em um de nossos membros abaixo para conversar no Whatsapp</div>
		<?php
		$vItens = 0;
		
		for ($i= 0; $i < count($arrayLink); $i++) {

			if (strpos("_".$arrayLink[$i]['Origem'], "whatsapp") > 0) {

				$imagem = (!empty($arrayLink[$i]['Imagem']) ? strtoupper(trim($arrayLink[$i]['Imagem'])) : "");
				$vPosicao = strpos($imagem, ".JPG") + strpos($imagem, ".JPEG") + strpos($imagem, ".PNG") + strpos($imagem, ".GIF") + strpos($imagem, ".BMP");

				$imagem = $vUrlPadrao . '/images/icone-compartilhar-whatsapp.png';
				
				if ($vPosicao > 0) {
					if (file_exists('./docs/logos/' . $arrayLink[$i]['Imagem'])) {
						$imagem = base_url() . 'docs/logos/' . $arrayLink[$i]['Imagem'];
						
					}
				}

				$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
				$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
				$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
				$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
				$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

				
				if ($iphone || $android || $palmpre || $ipod || $berry == true) {
					$vZapLink = "https://api.whatsapp.com/send?phone=" . $arrayLink[$i]['Link'] . "&text=" . (!empty($arrayLink[$i]['Descricao']) ? $arrayLink[$i]['Descricao'] : "Ol&aacute;, te encontrei no site e gostaria de maiores informa&ccedil;&otilde;es.");
				  
				} else {
					$vZapLink = "https://web.whatsapp.com/send?phone=" . $arrayLink[$i]['Link'] . "&text=" . (!empty($arrayLink[$i]['Descricao']) ? $arrayLink[$i]['Descricao'] : "Ol&aacute;, te encontrei no site e gostaria de maiores informa&ccedil;&otilde;es.");

				}
				
				echo '<div class="zapRow">';				
					echo '<a href="' .  $vZapLink . '" target="_blank" title="Fale Conosco Pelo WhatsApp">';
					echo '<div class="zapImagem"><img src="' . $imagem . '" border="0" /></div>';
					echo '<div class="zapDados">' . $arrayLink[$i]['Titulo'] . '<div class="zapDescricao">' . $arrayLink[$i]['Descricao'] . '</div></div>';
					echo '</a>';
				echo '</div>';
				
				$vItens++;
			}
		}
		
		echo '<form><input type="hidden" id="zapItens" value="' . $vItens . '"/></form>';
		?>
	</div>

	<?php
	if ($_SESSION['sysOrcamento'] != "") {
		$vBtnOrcamento = "block";
		
	} else {
		$vBtnOrcamento = "none";
		
	}
	?>
	
	<div id="btn-orcamento" style="display: <?php echo $vBtnOrcamento ?>"><a href="<?=$vUrlPadrao?>/orcamento"><img src="<?php echo $vUrlPadrao ?>/images/btn-orcamento.png" width="45" border="0"/></a></div>

	<div id="botao_whatsapp">
		<img src="<?=$vUrlPadrao?>/images/icone-compartilhar-whatsapp.png"/>
	</div>
	
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo $vUrlPadrao ?>/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo $vUrlPadrao ?>/assets/bootstrap/js/bootstrap.min.js"></script>

<?php
if ($arrayUrl[0] == "empresa" || $arrayUrl[0] == "institucional") {
	echo '<script src="' . $vUrlPadrao . '/assets/js/photo-gallery.js"></script>';
	
}
?>

<script type="text/javascript">
	var $w = $(window);

	$w.on("scroll", function(){
	   if( $w.scrollTop() > 230 ) {
			$("#area-transition").fadeIn();
			
	   } else {
			$("#area-transition").fadeOut();
		   
	   }
	});


	$("div#botao_whatsapp").click(function(){
		
		var display = document.querySelector('#balao_whatsapp').style.display;
		var vItens = $("#zapItens").val();
		
		if(display == 'block') {
			$("#balao_whatsapp").fadeOut();
			
		} else {
			$("#balao_whatsapp").fadeIn(1000);
			
		}
			
	});

	
	function fMenu(vtipo) {
		var vAcao = document.getElementById(vtipo).style.display;
		
		if (vAcao == "table") {
			document.getElementById(vtipo).style.display = "none";
			
		} else {
			document.getElementById(vtipo).style.display = "table";
			
		}
	}
</script>