//*****************************
// Função fValidaCadastro()
//*****************************

function fValidaForm(vthis) {
	if (vthis.name == "frmCadCategorias") {
		if (document.frmCadCategorias.formNOME.value.length == 0) {
			fBoxDialogo('O campo <strong>NOME DO GRUPO</strong> n&atilde;o pode ser vazio!');
			document.frmCadCategorias.formNOME.value = '';
			document.frmCadCategorias.formNOME.focus();
			return false;
		}
		
	} else if (vthis.name == "frmCadFornecedores") {
		if (document.frmCadFornecedores.formNOME.value.length == 0) {
			fBoxDialogo('O campo <strong>NOME DO FORNECEDOR</strong> n&atilde;o pode ser vazio!');
			document.frmCadFornecedores.formNOME.value = '';
			document.frmCadFornecedores.formNOME.focus();
			return false;
		}
		
	} else if (vthis.name == "frmExclusaoRegistros") {
		if (document.frmExclusaoRegistros.formCONFIRMAR[0].checked == false && document.frmExclusaoRegistros.formCONFIRMAR[1].checked == false) {
			fBoxDialogo('Nenhuma CONFIRMA&Ccedil;&Atilde;O foi selecionada!');
			document.frmExclusaoRegistros.formCONFIRMAR[0].checked = false;
			document.frmExclusaoRegistros.formCONFIRMAR[1].checked = false;
			return false;
		}
		
	} else if (vthis.name == "frmCadLinks") {
		if (document.frmCadLinks.formTITULO.value.length == 0) {
			fBoxDialogo('O campo <strong>T&Iacute;TULO DO LINK</strong> n&atilde;o pode ser vazio!');
			document.frmCadLinks.formTITULO.value = '';
			document.frmCadLinks.formTITULO.focus();
			return false;
		}
		
		if (document.frmCadLinks.formLINK.value.length == 0) {
			fBoxDialogo('O campo <strong>LINK / URL</strong> n&atilde;o pode ser vazio!');
			document.frmCadLinks.formLINK.value = '';
			document.frmCadLinks.formLINK.focus();
			return false;
		}
		
	} else if (vthis.name == "frmCadLinhas") {
		if (document.frmCadLinhas.formNOME.value.length == 0) {
			fBoxDialogo('O campo <strong>NOME DA LINHA</strong> n&atilde;o pode ser vazio!');
			document.frmCadLinhas.formNOME.value = '';
			document.frmCadLinhas.formNOME.focus();
			return false;
		}
		
		
	} else {
		if (document.frmCadastro.formPLANO.value.length == 0) {
			fBoxDialogo('N&atilde;o foi selecionado nenhum PLANO. ');
			document.frmCadastro.formPLANO.value = '';
			document.frmCadastro.formUSUARIO.focus();
			return false;
		}
		
		if (document.frmCadastro.formUSUARIO.value.length == 0) {
			fBoxDialogo('O campo USUÁRIO/LOGIN n&atilde;o pode ser vazio!');
			document.frmCadastro.formUSUARIO.value = '';
			document.frmCadastro.formUSUARIO.focus();
			return false;
		}
		
		if (document.frmCadastro.formSENHA.value.length == 0) {
			fBoxDialogo('O campo SENHA n&atilde;o pode ser vazio!');
			document.frmCadastro.formSENHA.value = '';
			document.frmCadastro.formSENHA.focus();
			return false;
		}
		
		if (document.frmCadastro.formNOME.value.length == 0) {
			fBoxDialogo('O campo NOME n&atilde;o pode ser vazio!');
			document.frmCadastro.formNOME.value = '';
			document.frmCadastro.formNOME.focus();
			return false;
		}

		if (document.frmCadastro.formDTNASCIMENTODIA.value.length == 0) {
			fBoxDialogo('O campo DIA da DATA DE NASCIMENTO n&atilde;o pode ser vazio!');
			document.frmCadastro.formDTNASCIMENTODIA.value = '';
			document.frmCadastro.formDTNASCIMENTODIA.focus();
			return false;
		}

		if (document.frmCadastro.formDTNASCIMENTOMES.value.length == 0) {
			fBoxDialogo('O campo MÊS da DATA DE NASCIMENTO n&atilde;o pode ser vazio!');
			document.frmCadastro.formDTNASCIMENTOMES.value = '';
			document.frmCadastro.formDTNASCIMENTOMES.focus();
			return false;
		}

		if (document.frmCadastro.formDTNASCIMENTOANO.value.length == 0) {
			fBoxDialogo('O campo ANO da DATA DE NASCIMENTO n&atilde;o pode ser vazio!');
			document.frmCadastro.formDTNASCIMENTOANO.value = '';
			document.frmCadastro.formDTNASCIMENTOANO.focus();
			return false;
		}

		if (document.frmCadastro.formCPF.value.length == 0) {
			fBoxDialogo('O campo CPF n&atilde;o pode ser vazio!');
			document.frmCadastro.formCPF.value = '';
			document.frmCadastro.formCPF.focus();
			return false;
		}

		if (document.frmCadastro.formFONE.value.length == 0 && document.frmCadastro.formCELULAR.value.length == 0) {
			fBoxDialogo('Os campos FONE e CELULAR n&atilde;o podem ser vazios!');
			document.frmCadastro.formFONE.value = '';
			document.frmCadastro.formFONE.focus();
			return false;
			
		} else {
			if (document.frmCadastro.formDDDFONE.value.length == 0 && document.frmCadastro.formDDDCELULAR.value.length == 0) {
				fBoxDialogo('Os campos DDD do FONE e DDD do CELULAR n&atilde;o podem ser vazios!');
				document.frmCadastro.formDDDFONE.value = '';
				document.frmCadastro.formDDDFONE.focus();
				return false;
				
			}
		}

		if (document.frmCadastro.formEMAIL.value.length == 0) {
			fBoxDialogo('O campo E-MAIL n&atilde;o pode ser vazio!');
			document.frmCadastro.formEMAIL.value = '';
			document.frmCadastro.formEMAIL.focus();
			return false;
		}

	}	
}	


//*****************************
// Função fCheckBox()
//*****************************


var vCheckBox = "";
var vCheckClick = "";
var vCheckPlano = "";
var vCheckButton = "";

function fCheckBox(vthis, vacao, vplano) {
	var vId = vthis.id;
	var vStr = new String(vthis.src);
	var vStrName = new String(vthis.name);
	var vPlanoPlano = "p" + vId;
	var vPlanoButton = "b" + vId;

	if (vacao == 3) {
		if (vStrName.indexOf("up") > 0) {
			var arrayUp = vStrName.split("|");
			
			var vValorPlano = parseFloat(arrayUp[1]);
			var vValorDisponivel = parseFloat(arrayUp[2]);
			var vValorUpgrade = parseFloat(arrayUp[3]);
			
			document.getElementById("upFORMA").style.display = "none";
			document.getElementById("ValorUp").style.display = "none";
			document.getElementById("posPAGAMENTO").style.display = "none";
			document.getElementById("upCOMPROVANTE").style.display = "none";
			document.getElementById("selectSUBMIT").style.display = "none";
			
			document.getElementById("upVlrPlano").value = vValorUpgrade;
			
			if (vValorDisponivel > 5) {
				document.getElementById("DescontarSim").checked = false;
				document.getElementById("DescontarNao").checked = false;
				
			} else {
				fUpValor(vValorPlano, vValorDisponivel, vValorUpgrade, 'N');
				
			}
			
			document.getElementById("upSALDO").style.display = "table";
		}
		
		if (vCheckClick != "") {
			document.getElementById(vCheckClick).src = "../documentos/images/chek_box_off.gif";

			document.getElementById(vCheckPlano).style.background = "#fafafa";
			document.getElementById(vCheckPlano).style.border = "none";
			
			document.getElementById(vCheckButton).style.background = "#fafafa";
			document.getElementById(vCheckButton).style.border = "none";
		}
		
		document.getElementById(vId).src = "../documentos/images/chek_box_click.gif";
		
		document.getElementById(vPlanoPlano).style.background = "#FBEFEF";
		document.getElementById(vPlanoPlano).style.borderTop = "#F78181 1px solid";
		document.getElementById(vPlanoPlano).style.borderLeft = "#F78181 1px solid";
		document.getElementById(vPlanoPlano).style.borderRight = "#F78181 1px solid";
		
		document.getElementById(vPlanoButton).style.background = "#FBEFEF";
		document.getElementById(vPlanoButton).style.borderLeft = "#F78181 1px solid";
		document.getElementById(vPlanoButton).style.borderRight = "#F78181 1px solid";
		document.getElementById(vPlanoButton).style.borderBottom = "#F78181 1px solid";
		
		vCheckClick = vId;
		vCheckBox = "";
		vCheckPlano = vPlanoPlano;
		vCheckButton = vPlanoButton;
		
		document.getElementById("frmPlano").value = vplano;

	} else if (vacao == 2) {
		if (vStr.indexOf("box_over") > 0) {
			document.getElementById(vCheckBox).src = "../documentos/images/chek_box_off.gif";

		}
		
	} else {
		if (vStr.indexOf("box_click") <= 0) {
			if (vCheckBox != "") {
				document.getElementById(vCheckBox).src = "../documentos/images/chek_box_off.gif";

			}
			
			document.getElementById(vId).src = "../documentos/images/chek_box_over.gif";
			
			vCheckBox = vId;
		}
	}	
}

function fUpValor(vValorPlano, vValorDisponivel, vValorUpgrade, vsaldo) {
	vValorUpgrade = document.getElementById("upVlrPlano").value;

	var vValorDiferenca = (parseFloat(vValorUpgrade)-parseFloat(vValorPlano));
	
	document.getElementById("ValorUp").style.display = "table";
	document.getElementById("ValorUp").style.border = "#cccccc 1px solid";
	document.getElementById("ValorUp").style.background = "#f1f1f1";
	document.getElementById("ValorUp").style.padding = "10px";
	document.getElementById("ValorUp").style.fontSize = "22px";
	document.getElementById("ValorUp").style.width = "350px";
	document.getElementById("ValorUp").style.color = "#0431B4";
	
	document.getElementById("upFORMA").style.display = "table";
	document.getElementById("selectSUBMIT").style.display = "none";
	
	if (vsaldo == "S") {
		if (vValorDisponivel > vValorDiferenca) {
			document.getElementById("ValorUp").style.width = "440px";
			document.getElementById("upFORMA").style.display = "none";
			document.getElementById("posPAGAMENTO").style.display = "none";
			document.getElementById("upCOMPROVANTE").style.display = "none";
			document.getElementById("selectSUBMIT").style.display = "block";
			
			document.getElementById("ValorUp").innerHTML = "Será descontado <span style='font-weight: bold'>$ " + vValorDiferenca + "</span>&nbsp;<span style='font-style: italic; font-size: 16px'>(+ tarifa)</span> do seu saldo.";
			
		} else {
			if (vValorDisponivel > 5) {
				document.getElementById("ValorUp").innerHTML = "Valor para o upgrade: <span style='font-weight: bold'>$ " + ((vValorUpgrade - vValorPlano) - vValorDisponivel) + "</span>";
				
			} else {
				document.getElementById("ValorUp").innerHTML = "Valor para o upgrade: <span style='font-weight: bold'>$ " + (vValorUpgrade - vValorPlano) + "</span>";
			
			}
		}
		
	} else {
		document.getElementById("ValorUp").innerHTML = "Valor para o upgrade: <span style='font-weight: bold'>$ " + (vValorUpgrade - vValorPlano) + "</span>";
	
	}
}

function fUpAtualizar(vtipo) {
	document.getElementById("selectSUBMIT").style.display = "none";
	
	if (vtipo == "submit") {
		document.getElementById("selectSUBMIT").style.display = "table";
		
	} else {
		document.getElementById("posPAGAMENTO").style.display = "table";
		
		document.getElementById("selectDEPOSITO").style.display = "none";
		document.getElementById("selectSISTEMA").style.display = "none";
		
		if (vtipo == "deposito") {
			document.getElementById("selectDEPOSITO").style.display = "table";
			
		} else {
			document.getElementById("selectSISTEMA").style.display = "table";

		}
	}
}

function fUpComprovante() {
	document.getElementById("upCOMPROVANTE").style.display = "block";
	
}


//*******************************
// Função fGrupoTipo(nn)
//*******************************

function fGrupoTipo(nn) {
	if (nn == 0) {
		document.getElementById("idSubGrupoA").style.display = "none";
		document.getElementById("idSubGrupoB").style.display = "none";
		
		document.frmCadCategorias.formSELECTSUBCATEGORIA.disabled = true;
		
	} else {
		document.getElementById("idSubGrupoA").style.display = "block";
		document.getElementById("idSubGrupoB").style.display = "block";
		
		document.frmCadCategorias.formSELECTSUBCATEGORIA.disabled = false;
		
	}
}

//*******************************
// Função fOpcoesDeCores(nn)
//*******************************

function fOpcoesDeCores(vnn) {
	if (vnn == 2) {
		document.getElementById("opcoes-cores").style.display = "none";
		
	} else {
		document.getElementById("opcoes-cores").style.display = "block";
		
	}
}

//************************************
// Função fSubGrupos(vidc, vcatgs)
//************************************

function fSubGrupos(vidu, vcatgs, vselect) {
	var vSelecao = "";

	for (i = 1; i <= parseInt(vcatgs); i++) {
		vDivCategoria = "fCategoria"+i;
		
		if (document.getElementById(vDivCategoria).checked) {
			if (i > 1) {
				vSelecao += "-";
			}
			
			vSelecao += document.getElementById(vDivCategoria).value;

		}
	}
	
	showDIRECT('', 'query_subgrupos.php?idu=' + vidu+ '&ids=' + vSelecao + '&sel=' + vselect, 'AreaSubGrupo');
	
}


//************************************
// Função fAmpliarFoto(vidc, vcatgs)
//************************************


function fAmpliarFoto(vordem) {
	var vFotoGaleria = "cFotoGaleria"+vordem;
	var vDiv = "cDiv"+vordem;

	if (document.getElementById(vFotoGaleria).style.width == "500px") {
		document.getElementById(vDiv).style.zIndex = "99";
		document.getElementById(vFotoGaleria).style.width = "150px";
		
	} else {
		document.getElementById(vDiv).style.zIndex = "999";
		document.getElementById(vFotoGaleria).style.width = "500px";
		
	}
	
}

//************************************
// Função fGuiasEditar()
//************************************


function fGuiasEditar(nnn) {
	
	var aGuias = new Array("divDescricao", "divAplicacao", "divEspecificacao", "divVideo", "divObservacao");

	for (i = 0; i < aGuias.length; i++) {
		vGuia = aGuias[i];
		vTdOn ="tdOn" + i;
		
		document.getElementById(vGuia).style.display = "none";
		document.getElementById(vTdOn).style.background = "#fcfcfc";
		document.getElementById(vTdOn).style.borderRadius = "0px";
	}
	
	vTdOn ="tdOn" + nnn;

	document.getElementById(aGuias[nnn]).style.display = "table";
	document.getElementById(vTdOn).style.background = "#dddddd";
	document.getElementById(vTdOn).style.borderRadius = "10px 10px 0px 0px";
	
}