//***************************
// Função fBoxDialogo()
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
		vHTML += "<a href='javascript: fBoxDialogo(&quot;fechar&quot;)' class='fechar'><div style='background: #b20000; width: 60px; padding: 3px'>Fechar</div></a></div>";

		document.getElementById("boxDIALOGO").innerHTML = vHTML;

		setTimeout("fBoxDialogo('fechar')", 5000);

	} else {
		document.getElementById("boxDIALOGO").style.display = "none";

	}

}


//***************************
// Função fElementoPos()
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
// Função fApenasNumero()
//********************************

function fSoNumeros(e){
	var tecla=(window.event)?event.keyCode:e.which;
	
	if((tecla>47 && tecla<58)) return true;
	else{
	if (tecla==8 || tecla==0) return true;
	else  return false;
	}
}