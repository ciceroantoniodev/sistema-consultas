<?php
if (strpos("#".$vgetROTINAS, "[10]") > 0) {
	echo '<ul id="Gerenciamento" class="Popup" style="width:12em;">'; 

	echo '<li><a href="ger_franquias.php?local=' . $getLOCAL . '&id=' . $vgetIDUSUARIO . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Franquias</a></li>'; 
	
	echo '<li><a href="ger_vendedores.php?local=' . $getLOCAL . '&id=' . $vgetIDUSUARIO . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Vendedores</a></li>'; 

	echo '<li><a href="ger_codigos.php?local=' . $getLOCAL . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">C&oacute;digos</a></li>'; 
	
	echo '<li><a href="regioes.php?local=' . $getLOCAL . '&id=' . $vgetIDUSUARIO . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Regi&otilde;es</a></li>'; 
	
	echo '<li><a href="ger_usuarios.php?local=' . $getLOCAL . '&id=' . $vgetIDUSUARIO . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Usu&aacute;rios</a></li>'; 

	echo '</ul>';
}

if (strpos("#".$vgetROTINAS, "[13]") > 0) {
	echo '<ul id="Imoveis" class="Popup" style="width:12em;">'; 

	echo '<li><a href="imoveis_cadastrar.php?local=' . $getLOCAL . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&n=' . $vgetNIVEL . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Cadastrar Im&oacute;vel</a></li>'; 

	echo '<li><a href="imoveis_cadastrar.php?local=' . $getLOCAL . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&n=' . $vgetNIVEL . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Listagem</a></li>'; 

	echo '<li><a href="imoveis_cadastrar.php?local=' . $getLOCAL . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&n=' . $vgetNIVEL . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Destaques</a></li>'; 

	echo '<li><a href="imoveis_cadastrar.php?local=' . $getLOCAL . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&n=' . $vgetNIVEL . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Corretores</a></li>'; 

	echo '</ul>';
}

if (strpos("#".$vgetROTINAS, "[12]") > 0) {
	echo '<ul id="Financeiro" class="Popup" style="width:12em;">'; 

	echo '<li><a href="codigos_adquirir.php?local=' . $getLOCAL . '&idu=' . fIdu(1, $vgetIDUSUARIO) . '&idf=' . $vgetIDFRANQUIA . '&n=' . $vgetNIVEL . '&r=' . $vgetROTINAS . '&tp=' . $vgetTIPO . '" class="submenu" target="main">Adquirir C&oacute;digos</a></li>'; 

	echo '</ul>';
}
?>
