<?php
//==============================================
// Preenche com Zeros a Esquerda Qualquer String
// Deve ser passado a Variavel e o Numero de Casas
// A Variavel pode ser Tipo Caracter ou Numerico
//==============================================
function StrZero($vNum, $vSize) { 
	return str_pad($vNum, $vSize, "0", STR_PAD_LEFT); 
	
}


//==============================================
// 
// Função fSeImagem()
// 
//==============================================

function fSeImagem($imagem) {
	$vPosicao = strpos(strtoupper($imagem), ".JPG") + strpos(strtoupper($imagem), ".PNG") + strpos(strtoupper($imagem), ".GIF") + strpos(strtoupper($imagem), ".BMP");
	
	return ($vPosicao > 0) ? TRUE : FALSE;
}


//==============================================
// 
// Função fSeEmail()
// 
//==============================================


function fSeEmail($email) {

	$vRes = true;
	
	if (strpos($email, "@") > 0) {
		$vStr = substr($email, strpos($email, "@")+1);

		if (strpos("#".$vStr, ".") > 0) {
			$vStr = substr($vStr, strpos($vStr, ".")+1);

			if (strlen($vStr) >= 2) {
				$vRes = true;

			} else {
				$vRes = false;

			}
		} else {
			$vRes = false;
		}
	} else {
		$vRes = false;
		
	}
	
	return ($vRes);
}


//==============================================
// 
// Função fCaptcha()
// 
//==============================================


function fCaptcha() {
	$vDia = date("d");
	$vMinuto = date("i");
	$vSegundo = date("s");
	$vSoma = ($vDia + $vMinuto + $vSegundo) + $vSegundo;
	$vSoma = ($vSoma + $vSegundo) * $vSegundo;
	$vSoma = $vSegundo . $vSoma;
	
	$vCodigoAtual = "".$vSoma."";
	
	if (strlen($vCodigoAtual) < 5) {
		$vCodigoAtual = $vCodigoAtual . "52839";
	}
	
	$vCodigoCaptcha = "";
	
	for ($i=0; $i <= 4; $i++) {
		$vImg = "cap" . substr($vCodigoAtual, $i, 1) . ".gif";
		
		echo '<img src="documentos/images/' . $vImg . '" width="33" border="0" />';
		
		$vCodigoCaptcha .= substr($vCodigoAtual, $i, 1);
	}
	
	return ($vCodigoCaptcha);
}


//==============================================
// 
// Funcao fAspas()
// 
//==============================================

function fAspas($str) {
	$vStr = str_replace("'", "&#039;", $str);
	$vStr = str_replace('"', '&quot;', $vStr);
	
	return ( $vStr );
}
?>
