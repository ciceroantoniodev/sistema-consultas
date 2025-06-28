<?php
$aSubMenu = [];

$m = 0;

$queryProdutos = $vConexao->query("SELECT * FROM sysc_produtoscategorias WHERE ativo='S' ORDER BY ordem, nome") or die ("Falha ao tentar se conectar com Links");
	while ($reProdutos = mysqli_fetch_assoc($queryProdutos)) {
		
		if ($reProdutos['tipo']=="grupo") {
			$aSubMenu[$m] = [ "Nome"=>$reProdutos['nome'], "Link"=>$reProdutos['link'] ];
			
			$m++;
			
		}
	}
mysqli_free_result($queryProdutos);
?>
<header id="headerInterno">

	<nav id="menu" class="menuInterno">
		<div id="menutopo">
			<a href="<?=$vUrlPadrao?>" class="scroll"><div class="opcMenu1Home">HOME</div></a>
			<a href="<?=$vUrlPadrao?>/empresa" class="scroll"><div onMouseOver="fSubMenu(0)" class="opcMenuHome">EMPRESA</div></a>
			<a href="javascript: void()" class="scroll"><div id="opcProdutos" onClick="fSubMenu(1)" onMouseOver="fSubMenu(1)" class="opcMenuHome">PRODUTOS</div></a>
			<a href="<?=$vUrlPadrao?>/unidades" class="scroll"><div onMouseOver="fSubMenu(0)" class="opcMenuHome">LOJAS</div></a>
			<a href="<?=$vUrlPadrao?>/diferenciais" class="scroll"><div class="opcMenuHome">DIFERENCIAIS</div></a>
			<a href="<?=$vUrlPadrao?>/contato" class="scroll"><div class="opcMenuHome">CONTATO</div></a>
		</div>
		
		<div id="submenu" onMouseOut="fSubMenu(0)">
			<?php
			foreach ($aSubMenu AS $vDados) {
				echo '<a href="' . $vUrlPadrao . '/produtos/' . $vDados['Link'] . '" class="scroll"><div onMouseOver="fSubMenu(1)" class="opcSubMenu">' . $vDados['Nome'] . '</div></a>';
				
			}
			?>
		</div>
		
		<div class="navMenuHome">
			<a href="javascript: void()" class="iconeSuspenso" onClick="fMenu('mSuspenso')"><div class="botaoSuspenso"><i class="fas fa-bars"></i></div></a>
			
			<ul class="menuSuspenso" id="mSuspenso">
				<li><a href="<?=$vUrlPadrao?>/empresa" class="menuS">EMPRESA</a></li>
				<li><a href="<?=$vUrlPadrao?>/produtos" class="menuS">PRODUTOS</a></li>
				<li><a href="<?=$vUrlPadrao?>/unidades" class="menuS">LOJAS</a></li>
				<li><a href="<?=$vUrlPadrao?>/diferenciais" class="menuS">DIFERENCIAIS</a></li>
				<li><a href="<?=$vUrlPadrao?>/contato" class="menuS">CONTATO</a></li>
			</ul>
		</div>
	</nav>
	
	
	<section class="topoInterno">
		<figure id="logoInterno">
			<a href="<?=$vUrlPadrao?>/home"><img src="<?=$vUrlPadrao?>/images/petrolina-piscinas-logo.png" class="img-responsive" border="0" /></a>
		</figure>
	</section>
	
</header>


