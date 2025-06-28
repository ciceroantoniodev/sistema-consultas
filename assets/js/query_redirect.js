var xmlHttp
var vStateChanged

function showDIRECT(vconteudo, vurl, vareadirect) { 
	xmlHttp = GetXmlHttpObject();
	vStateChanged = vareadirect;

	var vShowOrigem = "_" + vconteudo + "_";
	
	if (xmlHttp == null) {
		alert ("Este navegador não suporta AJAX!");
		return;
	} 

	var url = vurl;
	
//	if (vShowOrigem.indexOf("object") > 0) {
//		url = url + "&qry=" + vconteudo.options[vconteudo.selectedIndex].value;
		
//	} else {
//		url = url + "&qry=" + vconteudo;
		
//	}

	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("POST",url,true);
	xmlHttp.send(null);
}

function stateChanged() { 
	if (xmlHttp.readyState == 4) { 
		document.getElementById(vStateChanged).innerHTML=xmlHttp.responseText;
	}
}

function GetXmlHttpObject() {
	var xmlHttp = null;
	
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	}
	
	catch (e) {
		// Internet Explorer
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
	
		catch (e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	
	return xmlHttp;
}	