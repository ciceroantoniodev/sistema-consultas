function fAddOrcamento(nid, vurl) {
	if (document.getElementById("btn-orcamento").style.display != "block") {
		document.getElementById("btn-orcamento").style.display = "block";
		
	}

	document.getElementById("areaAdicionar").innerHTML = '<a href="' + vurl + '/orcamento" class="orcamento"><div class="btn-add-orcamento"><span style="font-size: 18px">Produto Adicionado ao</span><br>Orçamento</div></a><br><br>';
	
	showDIRECT('', vurl + '/AddOrcamento/'+nid, 'areaAdicionar');

}

function fDelOrcamento(nid, nnn, vurl) {
	var vLinha = "rowList" + nnn;
	var vTotalProdutos = document.frmOrcamentos.formProdutos.value;
	
//	document.frmOrcamentos.formProdutos.value = (parseInt(vTotalProdutos)-1);
	
	eval("document.frmOrcamentos.formId" + (parseInt(nnn)+1) + ".value = ''");
	eval("document.frmOrcamentos.formProduto" + (parseInt(nnn)+1) + ".value = ''");
	eval("document.frmOrcamentos.formReferencia" + (parseInt(nnn)+1) + ".value = ''");
	eval("document.frmOrcamentos.formQuantidade" + (parseInt(nnn)+1) + ".value = ''");
	
	document.getElementById(vLinha).style.display = "none";

	eval("showDIRECT('', '"+vurl+"/include/delete_orcamento/"+nid+"', '"+vLinha+"')");

}

function fMenuSuspenso(nnn) {
	if (nnn == 2) {
		var vGetElement = "trans-menu-suspenso";
		
	} else {
		var vGetElement = "nav-menu-suspenso";
		
	}
	
	var vDivMenu = document.getElementById(vGetElement).style.display;
	
	if (vDivMenu != "block") {
		document.getElementById(vGetElement).style.display = "block";
		
	} else {
		document.getElementById(vGetElement).style.display = "none";
		
	}
}


function fMenuCategorias(nnn) {
	if (nnn == 2) {
		document.getElementById("categorias-down").style.display = "none";
		
	} else {
		document.getElementById("categorias-down").style.display = "block";
		
	}
	
}

function fAmpliarMiniatura(vfoto) {
	document.getElementById("imgPrincipal").src = vfoto;

}

function fSubMenu(vnn) {
	if (vnn > 0) {
		
		var vElemento = document.getElementById("opcProdutos");
		var vCoordenadas = vElemento.getBoundingClientRect();
		
		var x = vCoordenadas.left;
		var y = (vCoordenadas.top-10);
		
		if (document.getElementById("submenu").style.display == "block") {
			document.getElementById("submenu").style.display = "none";
			
		} else {
			document.getElementById("submenu").style.display = "block";
			
		}
		
		document.getElementById("submenu").style.marginLeft = x + "px";
		document.getElementById("submenu").style.marginTop = y + "px";

	} else {
		document.getElementById("submenu").style.display = "none";
		
	}
}