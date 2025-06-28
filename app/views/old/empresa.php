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

		<script src="<?php echo $vUrlPadrao ?>/assets/js/geral002.js"></script>
		<script src="<?php echo $vUrlPadrao ?>/assets/js/query_redirect.js"></script>
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<link href="<?php echo $vUrlPadrao ?>/assets/photoswipe/dist/photoswipe.css?v=4.1.1-1.0.4" rel="stylesheet" />
		<link href="<?php echo $vUrlPadrao ?>/assets/photoswipe/dist/default-skin/default-skin.css?v=4.1.1-1.0.4" rel="stylesheet" />

		<script src="<?php echo $vUrlPadrao ?>/assets/photoswipe/dist/photoswipe.min.js?v=4.1.1-1.0.4"></script>
		<script src="<?php echo $vUrlPadrao ?>/assets/photoswipe/dist/photoswipe-ui-default.min.js?v=4.1.1-1.0.4"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo $vUrlPadrao ?>/assets/css/estilo008.css"/>
		
		<style>
			<!--
			#topoInterno {
				background: url(<?php echo $vUrlPadrao ?>/images/bg-galerias.jpg) no-repeat top center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
			
			.galeria-bloco {
				width: 25%;
				float: left;
				margin: 0px;
				padding: 0px;
			}
			
			.galeria-descricao {
				display: none;
				opacity: 0;
			}
			
			.galeriasSubTitulo {
				color: #999999;
				display: table;
				font-family: Times;
				font-weight: normal;
				font-style: italic;
				font-size: 52px;
				margin-top: 60px;
				position: relative;
				text-align: center;
				width: 100%;

			}
			
			.galeriasSeparador {
				margin: auto;
				width: 50%;
			}

			.galeriasSeparador img {
				width: 100%;
			}
			
			.galeriasOutras {
				background: #f0f0f0;
				border-radius: 150px;
				float: left;
				margin: 20px;
				margin-bottom: 40px;
				min-width: 380px;
			}
			
			.galeriasOutrasImg {
				border-radius: 150px;
				float: left;
				height: 150px;
				overflow: hidden;
				width: 150px;
			}
			
			.galeriasOutrasNome {
				float: left;
				font-family: 'Raleway', 'Lucida Sans', Tahoma, Arial;
				font-size: 36px;
				margin-top: 50px;
				margin-left: 15px;
				margin-right: 20px;
			}
			
			.galeriaImg {
				border: none; 
				background: none; 
				margin: 0px; 
				padding: 0px; 
				padding-left: 1px; 
				padding-bottom: 1px;
			}
			
			iframe { margin: auto; width: 100%; height: 500px; }
			-->
		</style>	
				
		<link rel="stylesheet" type="text/css" href="<?php echo $vUrlPadrao ?>/assets/css/media006.css"/>

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
					<div class="col-md-12"><br/><br/><div id="areaTitulos"><h1 class="tit-categorias">Nossa Empresa</h1></div><br/><br/><br/><br/></div>
				</div>
				
				<div id="area-empresa-texto" class="row">
					<div class="col-md-12">
						<?php
						$queryConteudo = $vConexao->query("SELECT * FROM sysc_conteudo WHERE secao='institucional'") or die ("Falha ao tentar conexão com Conteudo");
							$reConteudo = mysqli_fetch_array($queryConteudo);
							
							if ($reConteudo != "") {
							
								echo $reConteudo['conteudo'];
								
							}
						mysqli_free_result($queryConteudo);
						?>

					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12"><br/><br/><div style="display: table; margin: auto; border-bottom: #001a4c 2px solid; padding-bottom: 2px"><h1 class="tit-categorias">Fotos</h1></div><br/><br/><br/><br/></div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div id="demo-test-gallery" class="demo-gallery">
							<?php
							$queryFotos = $vConexao->query("SELECT * FROM sysc_galeriasshow") or die ("Falha ao tentar conexão com Conteudo");
									
									while ($reFotos = mysqli_fetch_assoc($queryFotos)) {
									
										echo '<a href="' . $vUrlPadrao . '/docs/fotos/empresa/' . $reFotos['arquivo'] . '" data-size="960x590" data-med="' . $vUrlPadrao . '/docs/fotos/empresa/' . $reFotos['arquivo'] . '" data-med-size="960x590" data-author="' . $reFotos['titulo'] . '">';
										echo '<figure class="galeria-bloco"><img src="' . $vUrlPadrao . '/docs/fotos/empresa/' . $reFotos['arquivo'] . '" class="galeriaImg" border="0" alt=""/></figure>';
										echo '<figure class="galeria-descricao">' . $reFotos['descricao'] . '</figure>';
										echo '</a>';
										
									}
									
							mysqli_free_result($queryFotos);
							?>
						</div>
					</div>
				</div>
				
				<br/><br/><br/><br/>
				
			</div><!--container-->

		</section>
		
		<div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="pswp__bg"></div>

			<div class="pswp__scroll-wrap">

			  <div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			  </div>

			  <div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<div class="pswp__counter"></div>

					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

					<button class="pswp__button pswp__button--share" title="Share"></button>

					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
						  <div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						  </div>
						</div>
					</div>
				</div>


				<!-- <div class="pswp__loading-indicator"><div class="pswp__loading-indicator__line"></div></div> -->

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip">
						<!-- <a href="#" class="pswp__share--facebook"></a>
						<a href="#" class="pswp__share--twitter"></a>
						<a href="#" class="pswp__share--pinterest"></a>
						<a href="#" download class="pswp__share--download"></a> -->
					</div>
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
				<div class="pswp__caption">
				  <div class="pswp__caption__center">
				  </div>
				</div>
			  </div>

			</div>


		</div>
		
		<?php
		include "rodape.php";
		?>
		
		<div id="botao_up">
			<a id="subir" href="#" title="Voltar ao topo"><img src="docs/images/up.png" alt="Voltar ao topo" border="0" /></a>
		</div>
			
		<script>window.jQuery || document.write('<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/jquery-slim.min.js"><\/script>')</script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/popper.min.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?=$vUrlPadrao?>/assets/bootstrap/js/holder.min.js"></script>

		<script type="text/javascript">
		(function() {

			var initPhotoSwipeFromDOM = function(gallerySelector) {

				var parseThumbnailElements = function(el) {
					var thumbElements = el.childNodes,
						numNodes = thumbElements.length,
						items = [],
						el,
						childElements,
						thumbnailEl,
						size,
						item;

					for(var i = 0; i < numNodes; i++) {
						el = thumbElements[i];

						// include only element nodes 
						if(el.nodeType !== 1) {
						  continue;
						}

						childElements = el.children;

						size = el.getAttribute('data-size').split('x');

						// create slide object
						item = {
							src: el.getAttribute('href'),
							w: parseInt(size[0], 10),
							h: parseInt(size[1], 10),
							author: el.getAttribute('data-author')
						};

						item.el = el; // save link to element for getThumbBoundsFn

						if(childElements.length > 0) {
						  item.msrc = childElements[0].getAttribute('src'); // thumbnail url
						  if(childElements.length > 1) {
							  item.title = childElements[1].innerHTML; // caption (contents of figure)
						  }
						}


						var mediumSrc = el.getAttribute('data-med');
						if(mediumSrc) {
							size = el.getAttribute('data-med-size').split('x');
							// "medium-sized" image
							item.m = {
								src: mediumSrc,
								w: parseInt(size[0], 10),
								h: parseInt(size[1], 10)
							};
						}
						// original image
						item.o = {
							src: item.src,
							w: item.w,
							h: item.h
						};

						items.push(item);
					}

					return items;
				};

				// find nearest parent element
				var closest = function closest(el, fn) {
					return el && ( fn(el) ? el : closest(el.parentNode, fn) );
				};

				var onThumbnailsClick = function(e) {
					e = e || window.event;
					e.preventDefault ? e.preventDefault() : e.returnValue = false;

					var eTarget = e.target || e.srcElement;

					var clickedListItem = closest(eTarget, function(el) {
						return el.tagName === 'A';
					});

					if(!clickedListItem) {
						return;
					}

					var clickedGallery = clickedListItem.parentNode;

					var childNodes = clickedListItem.parentNode.childNodes,
						numChildNodes = childNodes.length,
						nodeIndex = 0,
						index;

					for (var i = 0; i < numChildNodes; i++) {
						if(childNodes[i].nodeType !== 1) { 
							continue; 
						}

						if(childNodes[i] === clickedListItem) {
							index = nodeIndex;
							break;
						}
						nodeIndex++;
					}

					if(index >= 0) {
						openPhotoSwipe( index, clickedGallery );
					}
					return false;
				};

				var photoswipeParseHash = function() {
					var hash = window.location.hash.substring(1),
					params = {};

					if(hash.length < 5) { // pid=1
						return params;
					}

					var vars = hash.split('&');
					for (var i = 0; i < vars.length; i++) {
						if(!vars[i]) {
							continue;
						}
						var pair = vars[i].split('=');  
						if(pair.length < 2) {
							continue;
						}           
						params[pair[0]] = pair[1];
					}

					if(params.gid) {
						params.gid = parseInt(params.gid, 10);
					}

					return params;
				};

				var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
					var pswpElement = document.querySelectorAll('.pswp')[0],
						gallery,
						options,
						items;

					items = parseThumbnailElements(galleryElement);

					// define options (if needed)
					options = {

						galleryUID: galleryElement.getAttribute('data-pswp-uid'),

						getThumbBoundsFn: function(index) {
							// See Options->getThumbBoundsFn section of docs for more info
							var thumbnail = items[index].el.children[0],
								pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
								rect = thumbnail.getBoundingClientRect(); 

							return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
						},

						addCaptionHTMLFn: function(item, captionEl, isFake) {
							if(!item.title) {
								captionEl.children[0].innerText = '';
								return false;
							}
							captionEl.children[0].innerHTML = item.title +  '<br/><small>Photo: ' + item.author + '</small>';
							return true;
						}
						
					};


					if(fromURL) {
						if(options.galleryPIDs) {
							// parse real index when custom PIDs are used 
							// http://photoswipe.com/documentation/faq.html#custom-pid-in-url
							for(var j = 0; j < items.length; j++) {
								if(items[j].pid == index) {
									options.index = j;
									break;
								}
							}
						} else {
							options.index = parseInt(index, 10) - 1;
						}
					} else {
						options.index = parseInt(index, 10);
					}

					// exit if index not found
					if( isNaN(options.index) ) {
						return;
					}



					var radios = document.getElementsByName('gallery-style');
					for (var i = 0, length = radios.length; i < length; i++) {
						if (radios[i].checked) {
							if(radios[i].id == 'radio-all-controls') {

							} else if(radios[i].id == 'radio-minimal-black') {
								options.mainClass = 'pswp--minimal--dark';
								options.barsSize = {top:0,bottom:0};
								options.captionEl = false;
								options.fullscreenEl = false;
								options.shareEl = false;
								options.bgOpacity = 0.85;
								options.tapToClose = true;
								options.tapToToggleControls = false;
							}
							break;
						}
					}

					if(disableAnimation) {
						options.showAnimationDuration = 0;
					}

					// Pass data to PhotoSwipe and initialize it
					gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);

					// see: http://photoswipe.com/documentation/responsive-images.html
					var realViewportWidth,
						useLargeImages = false,
						firstResize = true,
						imageSrcWillChange;

					gallery.listen('beforeResize', function() {

						var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
						dpiRatio = Math.min(dpiRatio, 2.5);
						realViewportWidth = gallery.viewportSize.x * dpiRatio;


						if(realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200 ) {
							if(!useLargeImages) {
								useLargeImages = true;
								imageSrcWillChange = true;
							}
							
						} else {
							if(useLargeImages) {
								useLargeImages = false;
								imageSrcWillChange = true;
							}
						}

						if(imageSrcWillChange && !firstResize) {
							gallery.invalidateCurrItems();
						}

						if(firstResize) {
							firstResize = false;
						}

						imageSrcWillChange = false;

					});

					gallery.listen('gettingData', function(index, item) {
						if( useLargeImages ) {
							item.src = item.o.src;
							item.w = item.o.w;
							item.h = item.o.h;
						} else {
							item.src = item.m.src;
							item.w = item.m.w;
							item.h = item.m.h;
						}
					});

					gallery.init();
				};

				// select all gallery elements
				var galleryElements = document.querySelectorAll( gallerySelector );
				for(var i = 0, l = galleryElements.length; i < l; i++) {
					galleryElements[i].setAttribute('data-pswp-uid', i+1);
					galleryElements[i].onclick = onThumbnailsClick;
				}

				// Parse URL and open gallery if it contains #&pid=3&gid=1
				var hashData = photoswipeParseHash();
				if(hashData.pid && hashData.gid) {
					openPhotoSwipe( hashData.pid,  galleryElements[ hashData.gid - 1 ], true, true );
				}
			};

			initPhotoSwipeFromDOM('.demo-gallery');

		})();

		</script>
			
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