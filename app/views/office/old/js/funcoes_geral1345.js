var vCorPadrao = "#fcfcfc";
var vCorClick = "#CEECF5";
var vOpcaoAtiva = 1;

$vAnteriorImagem = "";
$vAnteriorLargura = 0;
$vAnteriorAltura = 0;

	
//************************
// Fun��o fAtivaAlfa(nn)
//************************

function fAtivaAlfa(nn) { 
	var vLetras = "";

	for (i=1; i <= 26; i++) {
		vLetras = "letra" + i;
		document.getElementById(vLetras).style.background = "url(documentos/images/box_botao.gif) no-repeat";
		
	}
	vLetras = "letra" + nn;

	document.getElementById(vLetras).style.background = "url(documentos/images/box_botao_on.gif) no-repeat";
}

//************************
// Fun��o fJanelaCalc()
//************************

function fJanelaCalc(URL, vLag, vAlt) {
  var width = vLag;
  var height = vAlt;
  var left = 50;
  var top = 200;
  window.open(URL, 'calculadora', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=no, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
}

//************************
// Fun��o fAjaxDirecionar()
//************************

function fAjaxDirecionar(vurl) {
	showDIRECT(document.frmGridBuscar.formBUSCAR.value, vurl, "areaDIRECT");
}

//***************************
// Fun��o fExcluirRegistros()
//***************************

function fExcluirRegistros(vidu) {
	var vInputs = document.getElementsByTagName('input');
	
	var vTabela = document.frmGridExcluir.formDELTABELA.value;
	var vCampo = document.frmGridExcluir.formDELCAMPO.value;
	
	document.frmGridExcluir.formDEL.value = "";
	
	for (var i=0; i<vInputs.length; i++){
	  if (vInputs[i].type == "checkbox") {
		if (vInputs[i].checked) {			
			document.frmGridExcluir.formDEL.value = document.frmGridExcluir.formDEL.value + vInputs[i].value + "-";
		}
	  }
	}
	
	if (document.frmGridExcluir.formDEL.value == "") {
		fBoxDialogo('Nenhum registro foi marcado para exclus&atilde;o!');
		return false;
		
	} else {
		var vRegistros = document.frmGridExcluir.formDEL.value;
		
		showDIRECT('', 'excluir_registros.php?idu=' + vidu + '&t=' + vTabela + '&c=' + vCampo + '&del=' + vRegistros , 'areaConteudo');
		
	}
}

//***************************
// Fun��o fExcluirConfirmar(2)
//***************************

function fExcluirConfirmar(vnn) {
	
	if (vnn == 2) {
		document.getElementById("ExcluirSim").style.display = "block";
		document.getElementById("ExcluirNao").style.display = "none";
		
	} else {
		document.getElementById("ExcluirSim").style.display = "none";
		document.getElementById("ExcluirNao").style.display = "block";
		
	}
}

//***************************
// Fun��o fMarcarTodos()
//***************************

function fMarcarTodos() {
	var vInputs = document.getElementsByTagName('input');
	
	if (document.frmGrid.formMARCARTODOS.checked) {
		for (var i=0; i<vInputs.length; i++){
		  if (vInputs[i].type == "checkbox") {
			vInputs[i].checked = 1;
		  }
		}	
		
	} else {
		for (var i=0; i<vInputs.length; i++){
		  if (vInputs[i].type == "checkbox") {
			vInputs[i].checked = 0;
		  }
		}	
		
	}
}

//***************
// Fun��o mOvr()
//***************

function mOvr(src,clrOver) {
	document.getElementById(src).style.background = clrOver;

}

//***************
// Fun��o mOut()
//***************

function mOut(src,clrIn) {
	document.getElementById(src).style.background = clrIn;
	
}

//*********************
// Fun��o fAVISOS()
//********************

function fAVISOS() {
	document.getElementById('areaAVISOS').style.display = "none";
	
}


//***************************
// Fun��o fBoxDialogo()
//***************************

function fBoxDialogo(vmsg) {
	document.getElementById("boxDIALOGO").innerHTML = "";
	
	if (vmsg != "fechar") {
		var vWidth = screen.width;
		var vHeight = screen.height;

		var vTop = (vHeight/2)-200;
		var vLeft = (vWidth/2)-250;
		
		document.getElementById("boxDIALOGO").style.display = "block";
		document.getElementById("boxDIALOGO").style.marginTop =  "" + vTop + "px";
		document.getElementById("boxDIALOGO").style.marginLeft =  "" + vLeft + "px";
		
		vHTML = "<div align='center' style='font-size: 18px; color: #CD0000'>ATEN��O</div><br />";
		vHTML += "<div align='center'>" + vmsg + "<br /><br />";
		vHTML += "<a href='javascript: fBoxDialogo(&quot;fechar&quot;)' class='fechar'><div style='background: #b20000; width: 60px; padding: 3px'>Fechar</div></a></div>";
		
		document.getElementById("boxDIALOGO").innerHTML = vHTML;
		
		setTimeout("fBoxDialogo('fechar')", 5000);
		
	} else {
		document.getElementById("boxDIALOGO").style.display = "none";

	}
	
}


//***************************
// Fun��o fObjetoExiste(obj)
//***************************


function fObjetoExiste(obj) {
   return (document.getElementById(obj)!=null)
}


//***************************
// Fun��o fImagemCarregando()
//***************************


function fImagemCarregando() {
	document.getElementById("area-aviso").innerHTML = "<img src='docs/images/carregando.gif' border='0' style='border: #cccccc 2px solid' />";
	
}

//********************************
// Fun��o fApenasNumero()
//********************************

function fApenasNumero(e) {
	var tecla=(window.event)?event.keyCode:e.which;
	if((tecla>47 && tecla<58)) return true;
	else{
	if (tecla==8 || tecla==0) return true;
	else return false;
	}
}

//********************************
// Fun��o fApenasNumero()
//********************************

function fJanelaAltura() {
	if (window.innerHeight) { 
		 //navegadores baseados em mozilla 
		 vIframeHeight = window.innerHeight;
		 
	} else {
		 if (document.body.clientHeight){ 
				 //Navegadores baseados em IExplorer, pois nao tenho innerheight 
				 vIframeHeight = document.body.clientHeight;
			
		 } else {
				 //outros navegadores 
				 vIframeHeight = window.innerHeight;
		 } 
	}
	
	return vIframeHeight;
}

//***************************
// Fun��o fImagemLoad()
//***************************

function fImagemLoad() {
	var vWidth = screen.width;
	var vHeight = screen.height;
	
	var vTop = (vHeight/2)-200;
	var vLeft = (vWidth/2)-102;

	document.getElementById("imagemLOAD").innerHTML = "<div align='center' style='background: #ffffff; padding: 5px; border: #cccccc 2px solid; color: #b20000'><img src='docs/images/carregando.gif' border='0'  /><br />Aguarde!!!</div>";
	document.getElementById("imagemLOAD").style.border = "#dddddd 20px solid";
	document.getElementById("imagemLOAD").style.marginTop =  "" + vTop + "px";
	document.getElementById("imagemLOAD").style.marginLeft =  "" + vLeft + "px";
	
}

//***************************
// Fun��o fBoxDialogo()
//***************************

function fBoxDialogo(vmsg) {
	document.getElementById("boxDIALOGO").innerHTML = "";
	
	if (vmsg != "fechar") {
		var vWidth = screen.width;
		var vHeight = screen.height;

		var vTop = (vHeight/2)-200;
		var vLeft = (vWidth/2)-250;
		
		document.getElementById("boxDIALOGO").style.display = "block";
		document.getElementById("boxDIALOGO").style.marginTop =  "" + vTop + "px";
		document.getElementById("boxDIALOGO").style.marginLeft =  "" + vLeft + "px";
		
		vHTML = "<div align='center' style='font-size: 18px; color: #CD0000'>ATEN��O</div><br />";
		vHTML += "<div align='center'>" + vmsg + "<br /><br />";
		vHTML += "<a href='javascript: fBoxDialogo(&quot;fechar&quot;)' class='fechar'><div style='background: #b20000; color: #ffffff; width: 60px; padding: 3px'>Fechar</div></a></div>";
		
		document.getElementById("boxDIALOGO").innerHTML = vHTML;
		
		setTimeout("fBoxDialogo('fechar')", 5000);
		
	} else {
		document.getElementById("boxDIALOGO").style.display = "none";

	}
	
}

//***************************
// Fun��o fElementoPos()
//***************************

function fElementoPos(elemID){
    var offsetTrail = document.getElementById(elemID);
    var offsetLeft = 0;
    var offsetTop = 0;
	
    while (offsetTrail) {
        offsetLeft += offsetTrail.offsetLeft;
        offsetTop += offsetTrail.offsetTop;
        offsetTrail = offsetTrail.offsetParent;
    }
	
    if (navigator.userAgent.indexOf("Mac") != -1 && 
        typeof document.body.leftMargin != "undefined") {
        offsetLeft += document.body.leftMargin;
        offsetTop += document.body.topMargin;
    }
	
    return {left:offsetLeft, top:offsetTop};
}


//***************************
// Fun��o fLoading()
//***************************

function fLoading() {
	var vWidth = screen.width;
	var vHeight = screen.height;
	
	document.getElementById("ImagemLoading").style.top = ((vHeight/2)-224) + "px";
	document.getElementById("ImagemLoading").style.left = ((vWidth/2)-120) + "px";
	document.getElementById("ImagemLoading").style.display = "block";
}


//***************************
// Fun��o fFormatarMoeda()
//***************************


/* Autor: Mario Costa */
function fFormatarMoeda(campo, separador_milhar, separador_decimal, tecla) {
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? tecla.which : tecla.keyCode;

	if (whichCode == 13) return true; // Tecla Enter
	if (whichCode == 8) return true; // Tecla Delete
	key = String.fromCharCode(whichCode); // Pegando o valor digitado
	if (strCheck.indexOf(key) == -1) return false; // Valor inv�lido (n�o inteiro)
	len = campo.value.length;
	for(i = 0; i < len; i++)
	if ((campo.value.charAt(i) != '0') && (campo.value.charAt(i) != separador_decimal)) break;
	aux = '';
	for(; i < len; i++)
	if (strCheck.indexOf(campo.value.charAt(i))!=-1) aux += campo.value.charAt(i);
	aux += key;
	len = aux.length;
	if (len == 0) campo.value = '';
	if (len == 1) campo.value = '0'+ separador_decimal + '0' + aux;
	if (len == 2) campo.value = '0'+ separador_decimal + aux;

	if (len > 2) {
		aux2 = '';

		for (j = 0, i = len - 3; i >= 0; i--) {
			if (j == 3) {
				aux2 += separador_milhar;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}

		campo.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
		campo.value += aux2.charAt(i);
		campo.value += separador_decimal + aux.substr(len - 2, len);
	}

	return false;
}


//***************************
// Fun��o fTabelaSalvar(nn)
//***************************


function fTabelaSalvar(nn) {
	if (nn == 2) {
		document.getElementById("area-tabela-salvar").style.display = "table";
		
	} else {
		document.getElementById("area-tabela-salvar").style.display = "none";

	}
	
	setTimeout("fTabelaSalvar(1)", 5000);
	
}


//*******************************************
// Fun��o fCancelarTabela(vmesano, vid)
//*******************************************


function fCancelarTabela(vmesano, vid) {
	showDIRECT(vmesano, 'query_percentuais.php?idu=' + vid + '', 'areaTabela');
}


//***************************
// Fun��o fBannerDados(vid)
//***************************


function fBannerDados(vid) {
	var vArea = "areaDADOS" + vid;
	var vTxt = "txtVER" + vid;

	if (document.getElementById(vArea).style.display == "none") {
		document.getElementById(vArea).style.display = "table";
		document.getElementById(vTxt).innerHTML = "&nbsp;Ocultar Dados&nbsp;";

	} else {
		document.getElementById(vArea).style.display = "none";
		document.getElementById(vTxt).innerHTML = "&nbsp;Ver Dados&nbsp;";

	}
}

//***************************
// Fun��o fOvr(src,clrOver)
//***************************


function fOvr(src,clrOver) {
	document.getElementById(src).style.background = clrOver;

}


//***************************
// Fun��o fOut(src, vnn)
//***************************


function fOut(src, vnn) {
	if (vnn == vOpcaoAtiva) {
		document.getElementById(src).style.background = vCorClick;
	
	} else {
		document.getElementById(src).style.background = vCorPadrao;
	
	}
}


//*********************************
// Fun��o fClk(src, vnn, vsecao)
//*********************************


function fClk(src, vnn, vsecao) {
	var vOpcaoAtual = "op" + vOpcaoAtiva;
	document.getElementById(vOpcaoAtual).style.background = vCorPadrao;
	document.getElementById(src).style.background = vCorClick;
	vOpcaoAtiva = vnn;
	
	top.direcionar.location.href = "openwysiwyg/editor.php?id=" + vsecao;
}


//******************************************************************
// Fun��o fEnviar(vcodigo,vurl,vtitulo,vpasta,vorigem,vheight)
//******************************************************************


function fEnviar(vcodigo,vurl,vtitulo,vpasta,vorigem,vheight) {
	top.frames['main'].location.href = "web_novoarquivo.php";
	
}


//*********************************
// Fun��o fValidaForm()
//*********************************


function fValidaForm() {
	var vIMPUTS = document.getElementsByTagName('input');
	var vSELECAO = 10;
	
	for (var i=0; i < vIMPUTS.length; i++){

		if (vIMPUTS[i].type == 'checkbox') {
			if (vIMPUTS[i].name != 'formDETALHES') {
				if (vIMPUTS[i].checked) {
					vSELECAO++;
					
				}
				
			}
			
		}
		
	}
	
	if (vSELECAO == 10) {
		alert("Nenhum arquivo foi selecionado para exclus�o.");
		return false;
		
	} else {
		document.frmGerenteArquivos.submit();
		
	}
}


//*********************************
// Fun��o fMostrarPropriedades()
//*********************************


function fMostrarPropriedades() {
	i = 1;
	
	if (document.frmGerenteArquivos.formDETALHES.checked == true) {
		while (true) {
			var vDIV = "div_" + i;
			
			if (document.getElementById(vDIV) == null) {
				break;
				
			} else {
				document.getElementById(vDIV).style.display = "block";
				
			}
			
			i++;
			
		}
		
	} else {
		while (true) {
			var vDIV = "div_" + i;
			
			if (document.getElementById(vDIV) == null) {
				break;
				
			} else {
				document.getElementById(vDIV).style.display = "none";
				
			}
			
			i++;
			
		}
		
	}
}


//***************************************************
// Fun��o fSelectOrigem(vid, vurl, vheight, vpasta)
//***************************************************


function fSelectOrigem(vid, vurl, vheight, vpasta) {
	var vHREF = "ger_arquivos.php?id=" + vid + "&url=" + vurl + "&o=geral&h=" + vheight + "&pasta=" + vpasta;
	
	location.href = vHREF;
	
}


//*****************************************************************************
// Fun��o ffAmpliarImagem(vimg, vlargura, valtura, vlarguraview, valturaview) 
//*****************************************************************************


function fAmpliarImagem(vimg, vlargura, valtura, vlarguraview, valturaview) {
	var vWidth = document.getElementById(vimg).width;
	var vHeight = document.getElementById(vimg).height;

	if (vWidth == 150 || vHeight == 150) {
		document.getElementById(vimg).style.width = vlargura + "px";
		document.getElementById(vimg).style.height = valtura + "px";

	} else {
		document.getElementById(vimg).style.width = vlarguraview + "px";
		document.getElementById(vimg).style.height = valturaview + "px";
		
	}
	
}


//*********************************
// Fun��o fSubmitImagens(vid)
//*********************************


function fSubmitImagens(vid) {
	var vPastas = document.getElementById("frmPastas").value;
	
	showDIRECT('', 'ger_imagens.php?idu=' + vid + '&o=geral&pasta=' + vPastas, 'areaConteudo');
}


//*********************************
// Fun��o fMostrarFiltro(vnn)
//*********************************


function fMostrarFiltro(vnn) {
	if (vnn == 2) {
		document.getElementById("fPeriodo").style.display = "inline";
		document.getElementById("fConteudo").style.display = "none";
	
	} else {
		document.getElementById("fPeriodo").style.display = "none";
		document.getElementById("fConteudo").style.display = "inline";
		
	}
}


//*********************************
// Fun��o fFiltroSubmit()
//*********************************


function fFiltroSubmit() {
	var vFiltroTipo = document.frmFiltro.formFiltro.value;
	var vid = document.frmFiltro.formIDUSUARIO.value;
	var vKey = document.frmFiltro.formTexto.value;
	var vData1Dia = document.frmFiltro.formData1Dia.value;
	var vData1Mes = document.frmFiltro.formData1Mes.value;
	var vData1Ano = document.frmFiltro.formData1Ano.value;
	var vData2Dia = document.frmFiltro.formData2Dia.value;
	var vData2Mes = document.frmFiltro.formData2Mes.value;
	var vData2Ano = document.frmFiltro.formData2Ano.value;

	if (vFiltroTipo == "periodo") {
		vKey = vData1Dia+"|"+vData1Mes+"|"+vData1Ano+"|"+vData2Dia+"|"+vData2Mes+"|"+vData2Ano;
		
	}

	showDIRECT('', 'query_extratoconsolidado.php?idu=' + vid + '&o=' + vFiltroTipo + '&k=' + vKey, 'areaDIRECT');
	
	return false;
}


//******************************
// Fun��o fBoxAlerta(nn, vdiv)
//******************************


function fBoxAlerta(nn, vdiv, vtempo) {
	if (nn == 2) {
		document.getElementById(vdiv).style.display = "table";
		
		var vTimeOut = setTimeout("fBoxAlerta(1,'" + vdiv + "')", vtempo);
		
	} else {
		document.getElementById(vdiv).style.display = "none";
		
		var vTimeOut = 0;

	}
	
	
}


//***************************
// Fun��o fBoxDialogo()
//***************************


function fBoxDialogo(vmsg) {
	document.getElementById("boxDIALOGO").innerHTML = "";
	
	if (vmsg != "fechar") {
		var vWidth = screen.width;
		var vHeight = screen.height;

		var vTop = (vHeight/2)-250;
		var vLeft = (vWidth/2)-250;

		document.getElementById("boxDIALOGO").style.display = "block";
		document.getElementById("boxDIALOGO").style.marginTop =  "" + vTop + "px";
		document.getElementById("boxDIALOGO").style.marginLeft =  "" + vLeft + "px";

		vHTML = "<div align='center' style='font-size: 18px; color: #CD0000'>ATEN&Ccedil;&Atilde;O</div><br />";
		vHTML += "<div align='center'>" + vmsg + "<br /><br />";
		vHTML += "<a href='javascript: fBoxDialogo(&quot;fechar&quot;)' style='color: #ffffff'><div style='background: #b20000; width: 60px; padding: 3px'>Fechar</div></a></div>";

		document.getElementById("boxDIALOGO").innerHTML = vHTML;

		setTimeout("fBoxDialogo('fechar')", 5000);

	} else {
		document.getElementById("boxDIALOGO").style.display = "none";

	}

}


//***************************
// Fun��o fElementoPos()
//***************************

function fElementoPos(elemID){
    var offsetTrail = document.getElementById(elemID);
    var offsetLeft = 0;
    var offsetTop = 0;
	
    while (offsetTrail) {
        offsetLeft += offsetTrail.offsetLeft;
        offsetTop += offsetTrail.offsetTop;
        offsetTrail = offsetTrail.offsetParent;
    }
	
    if (navigator.userAgent.indexOf("Mac") != -1 && 
        typeof document.body.leftMargin != "undefined") {
        offsetLeft += document.body.leftMargin;
        offsetTop += document.body.topMargin;
    }
	
    return {left:offsetLeft, top:offsetTop};
}


//********************************
// Fun��o fApenasNumero()
//********************************


function fSoNumeros(e){
	var tecla=(window.event)?event.keyCode:e.which;
	
	if((tecla>47 && tecla<58)) return true;
	else{
	if (tecla==8 || tecla==0) return true;
	else  return false;
	}
}


//********************************
// Fun��o fVoltar()
//********************************


function fVoltar() {
    history.go(-0);
}

//********************************
// Fun��o fVoltar()
//********************************


function fMostrarAviso(vtexto) {

	if (vtexto != "fechar") {
		top.document.getElementById("area-aviso").innerHTML = vtexto;
		top.document.getElementById("area-aviso").style.display = "table";
		
		setTimeout("fMostrarAviso('fechar')", 5000);
		
	} else {
		top.document.getElementById("area-aviso").innerHTML = "";
		top.document.getElementById("area-aviso").style.display = "none";
		
	}
}
