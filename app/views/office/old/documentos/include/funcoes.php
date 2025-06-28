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
// fNovoArquivo($prefixo, $arquivo)
//==============================================

function fNovoArquivo($prefixo, $arquivo) {
	$arquivoEXTENSAO = substr($arquivo, strrpos($arquivo, "."));
	
	$arquivoNOVO = strtoupper($arquivo);
	
	$arquivoNOVO = str_replace(" ", "", $arquivoNOVO);
	$arquivoNOVO = str_replace(".", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("_", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("-", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("[", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("]", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("*", "", $arquivoNOVO);
	$arquivoNOVO = str_replace(",", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("<", "", $arquivoNOVO);
	$arquivoNOVO = str_replace(">", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("%", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("$", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("#", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("@", "", $arquivoNOVO);
	$arquivoNOVO = str_replace("з", "C", $arquivoNOVO);
	$arquivoNOVO = str_replace("З", "C", $arquivoNOVO);
	$arquivoNOVO = str_replace("б", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("Б", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("а", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("А", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("г", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("Г", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("д", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("Д", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("в", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("В", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("й", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("Й", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("и", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("И", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("к", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("К", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("л", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("Л", "E", $arquivoNOVO);
	$arquivoNOVO = str_replace("н", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("Н", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("м", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("М", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("о", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("О", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("п", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("П", "I", $arquivoNOVO);
	$arquivoNOVO = str_replace("у", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("У", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("т", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("Т", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("ф", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("Ф", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("х", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("Х", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("ц", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("Ц", "O", $arquivoNOVO);
	$arquivoNOVO = str_replace("ъ", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("Ъ", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("щ", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("Щ", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("ы", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("Ы", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("ь", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("Ь", "U", $arquivoNOVO);
	$arquivoNOVO = str_replace("с", "N", $arquivoNOVO);
	$arquivoNOVO = str_replace("С", "N", $arquivoNOVO);
	$arquivoNOVO = str_replace("Є", "A", $arquivoNOVO);
	$arquivoNOVO = str_replace("є", "O", $arquivoNOVO);
	
	$arquivoNOVO = $prefixo . substr($arquivoNOVO . "ABCDEFGHIJKMLNOPQRSTUV", 0, 20) . date("H") . date("i") . date("s") . $arquivoEXTENSAO;
	
	return $arquivoNOVO;
}

//==============================================
// fTrocarAcentos($prefixo, $arquivo)
//==============================================

function fTrocarAcentos($texto) {
	$arquivoTEXTO = strtolower($texto);
	
	$arquivoTEXTO = str_replace("з", "c", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("З", "c", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("б", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Б", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("а", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("А", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("г", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Г", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("д", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Д", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("в", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("В", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("й", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Й", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("и", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("И", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("к", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("К", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("л", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Л", "e", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("н", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Н", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("м", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("М", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("о", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("О", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("п", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("П", "i", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("у", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("У", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("т", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Т", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("ф", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Ф", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("х", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Х", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("ц", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Ц", "o", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("ъ", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Ъ", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("щ", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Щ", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("ы", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Ы", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("ь", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Ь", "u", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("с", "n", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("С", "n", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("Є", "a", $arquivoTEXTO);
	$arquivoTEXTO = str_replace("є", "o", $arquivoTEXTO);
	
	return $arquivoTEXTO;
}

//==============================================
//   fDataIntervalo(data inicial, 
// 					data final
// 					tipo: (A)no, (M)es, (D)ias, (H)oras, (MI)segundos
// 					$separador: - ou / )
//==============================================

function fDataIntervalo($d1, $d2, $type='', $sep='-') {
	$d1 = explode($sep, $d1);
	$d2 = explode($sep, $d2);

	switch ($type) {
		case 'A':
			$X = 31536000;
			break;
		case 'M':
			$X = 2592000;
			break;
		case 'D':
			$X = 86400;
			break;
		case 'H':
			$X = 3600;
			break;
		case 'MI':
			$X = 60;
			break;
		default:
			$X = 1;
	}
	return floor( ( ( mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0] ) ) / $X ) );
}

//==============================================
// fTrocaCaracteres(cadeia)
//==============================================

function fTrocaCaracteres($cadeia) {
	$arrayACENTOS = array();
	$arrayCARACTERES = array();

	$arrayACENTOS[0] = "Б";
	$arrayACENTOS[1] = "б";
	$arrayACENTOS[2] = "В";
	$arrayACENTOS[3] = "в";
	$arrayACENTOS[4] = "А";
	$arrayACENTOS[5] = "а";
	$arrayACENTOS[6] = "Е";
	$arrayACENTOS[7] = "е";
	$arrayACENTOS[8] = "Г";
	$arrayACENTOS[9] = "г";
	$arrayACENTOS[10] = "Д";
	$arrayACENTOS[11] = "д";
	$arrayACENTOS[12] = "Ж";
	$arrayACENTOS[13] = "ж";
	$arrayACENTOS[14] = "Й";
	$arrayACENTOS[15] = "й";
	$arrayACENTOS[16] = "К";
	$arrayACENTOS[17] = "к";
	$arrayACENTOS[18] = "И";
	$arrayACENTOS[19] = "и";
	$arrayACENTOS[20] = "Л";
	$arrayACENTOS[21] = "л";
	$arrayACENTOS[22] = "п";
	$arrayACENTOS[23] = "Н";
	$arrayACENTOS[24] = "н";
	$arrayACENTOS[25] = "О";
	$arrayACENTOS[26] = "о";
	$arrayACENTOS[27] = "М";
	$arrayACENTOS[28] = "м";
	$arrayACENTOS[29] = "П";
	$arrayACENTOS[30] = "х";
	$arrayACENTOS[31] = "У";
	$arrayACENTOS[32] = "у";
	$arrayACENTOS[33] = "Ф";
	$arrayACENTOS[34] = "ф";
	$arrayACENTOS[35] = "Т";
	$arrayACENTOS[36] = "т";
	$arrayACENTOS[37] = "Х";
	$arrayACENTOS[38] = "Ц";
	$arrayACENTOS[39] = "ц";
	$arrayACENTOS[40] = "Щ";
	$arrayACENTOS[41] = "щ";
	$arrayACENTOS[42] = "Ъ";
	$arrayACENTOS[43] = "ъ";
	$arrayACENTOS[44] = "Ы";
	$arrayACENTOS[45] = "ы";
	$arrayACENTOS[46] = "Ь";
	$arrayACENTOS[47] = "ь";
	$arrayACENTOS[48] = "З";
	$arrayACENTOS[49] = "з";
	$arrayACENTOS[50] = "С";
	$arrayACENTOS[51] = "с";
	$arrayACENTOS[52] = "э";
	$arrayACENTOS[53] = "<";
	$arrayACENTOS[54] = ">";
	$arrayACENTOS[55] = "Ю";
	$arrayACENTOS[56] = "ю";
	$arrayACENTOS[57] = "Р";
	$arrayACENTOS[58] = "р";
	$arrayACENTOS[59] = "Э";
	$arrayACENTOS[60] = "ш";
	$arrayACENTOS[61] = "Ш";
	$arrayACENTOS[62] = "®";
	$arrayACENTOS[63] = "©";
	$arrayACENTOS[64] = "Я";

	$arrayCARACTERES[0] = "&Aacute;";
	$arrayCARACTERES[1] = "&aacute;";
	$arrayCARACTERES[2] = "&Acirc;";
	$arrayCARACTERES[3] = "&acirc;";
	$arrayCARACTERES[4] = "&Agrave;";
	$arrayCARACTERES[5] = "&agrave;";
	$arrayCARACTERES[6] = "&Aring;";
	$arrayCARACTERES[7] = "&aring;";
	$arrayCARACTERES[8] = "&Atilde;";
	$arrayCARACTERES[9] = "&atilde;";
	$arrayCARACTERES[10] = "&Auml;";
	$arrayCARACTERES[11] = "&auml;";
	$arrayCARACTERES[12] = "&AElig;";
	$arrayCARACTERES[13] = "&aelig;";
	$arrayCARACTERES[14] = "&Eacute;";
	$arrayCARACTERES[15] = "&eacute;";
	$arrayCARACTERES[16] = "&Ecirc;";
	$arrayCARACTERES[17] = "&ecirc;";
	$arrayCARACTERES[18] = "&Egrave;";
	$arrayCARACTERES[19] = "&egrave;";
	$arrayCARACTERES[20] = "&Euml;";
	$arrayCARACTERES[21] = "&euml;";
	$arrayCARACTERES[22] = "&iuml;";
	$arrayCARACTERES[23] = "&Iacute;";
	$arrayCARACTERES[24] = "&iacute;";
	$arrayCARACTERES[25] = "&Icirc;";
	$arrayCARACTERES[26] = "&icirc;";
	$arrayCARACTERES[27] = "&Igrave;";
	$arrayCARACTERES[28] = "&igrave;";
	$arrayCARACTERES[29] = "&Iuml;";
	$arrayCARACTERES[30] = "&otilde;";
	$arrayCARACTERES[31] = "&Oacute;";
	$arrayCARACTERES[32] = "&oacute;";
	$arrayCARACTERES[33] = "&Ocirc;";
	$arrayCARACTERES[34] = "&ocirc;";
	$arrayCARACTERES[35] = "&Ograve;";
	$arrayCARACTERES[36] = "&ograve;";  
	$arrayCARACTERES[37] = "&Otilde;";
	$arrayCARACTERES[38] = "&Ouml;";
	$arrayCARACTERES[39] = "&ouml;";
	$arrayCARACTERES[40] = "&Ugrave;";
	$arrayCARACTERES[41] = "&ugrave;";
	$arrayCARACTERES[42] = "&Uacute;";
	$arrayCARACTERES[43] = "&uacute;";
	$arrayCARACTERES[44] = "&Ucirc;";
	$arrayCARACTERES[45] = "&ucirc;";
	$arrayCARACTERES[46] = "&Uuml;";
	$arrayCARACTERES[47] = "&uuml;";
	$arrayCARACTERES[48] = "&Ccedil;";  
	$arrayCARACTERES[49] = "&ccedil;";  
	$arrayCARACTERES[50] = "&Ntilde;";  
	$arrayCARACTERES[51] = "&ntilde;";  
	$arrayCARACTERES[52] = "&yacute;";  
	$arrayCARACTERES[53] = "&lt;";  
	$arrayCARACTERES[54] = "&gt;";  
	$arrayCARACTERES[55] = "&THORN;";  
	$arrayCARACTERES[56] = "&thorn;";  
	$arrayCARACTERES[57] = "&ETH;";
	$arrayCARACTERES[58] = "&eth;";
	$arrayCARACTERES[59] = "&Yacute;";  
	$arrayCARACTERES[60] = "&oslash;";
	$arrayCARACTERES[61] = "&Oslash;";
	$arrayCARACTERES[62] = "&reg;";  
	$arrayCARACTERES[63] = "&copy;";  
	$arrayCARACTERES[64] = "&szlig;";
	
	$vCadeiaA = $cadeia;
	
	for ($i = 0; $i < 65; $i++) {
		$vPosicao = strpos("#".$vCadeiaA, $arrayACENTOS[$i]);
		
		if ($vPosicao > 0) {
			$vCadeiaB = substr($vCadeiaA, 0, $vPosicao-1);
			$vCadeiaC = substr($vCadeiaA, $vPosicao);
			$vCadeiaA = $vCadeiaB . $arrayCARACTERES[$i] . $vCadeiaC;
		}
		
	}
	
	return $vCadeiaA;
}


//==============================================
// 
// Funзгo fSeImagem()
// 
//==============================================

function fSeImagem($imagem) {
	$vPosicao = strpos(strtoupper($imagem), ".JPG") + strpos(strtoupper($imagem), ".PNG") + strpos(strtoupper($imagem), ".GIF") + strpos(strtoupper($imagem), ".BMP");
	
	return ($vPosicao > 0) ? TRUE : FALSE;
}


//==============================================
// 
// Funзгo fDiferencaHoras()
// 
//==============================================


function fDiferencaHoras($horaInicial, $horaFinal) {

	//Separa Hora e Minutos
	$horaInicial = explode( ':', $horaInicial );
	$horaFinal = explode( ':', $horaFinal );

	//Obtem o timestamp Unix. Seguindo, no seu caso, a ordem Hora/Minuto.
	$horaIni = mktime( $horaInicial[0], $horaInicial[1]);
	$horaFim = mktime( $horaFinal [0], $horaFinal [1]);

	//Verifica a direnca entre os horarios
	$horaDiferenca = $horaFim - $horaIni;
	
	$horaRetorno = (date('H',$horaDiferenca )-1) . ":" . date('i',$horaDiferenca );
	
	return ($horaRetorno);
}


//==============================================
// 
// Funзгo fSeEmail()
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
// Funзгo fImagemRedimensionar()
// 
//==============================================


function fImagemRedimensionar($imagem, $extensao, $largura, $peso, $pasta) {
	$foto = $imagem; // nome do arquivo original
	$larg =(int)$largura; // largura do arquivo ja redimensionado (em PX) 
	
	// Pega peso da imagem em bytes
	$bytes_foto = filesize($pasta . "/" . $foto);
	
	// carrega imagem
	if (strtolower($extensao) == "png") {
		$original=imagecreatefrompng($pasta . '/' . $foto);

	} else if (strtolower($extensao) == "gif") {
		$original=imagecreatefromgif($pasta . '/' . $foto);

	} else {
		$original=imagecreatefromjpeg($pasta . '/' . $foto);

	}
	
	// pega a largura da foto original
	$larg_foto=imagesx($original);
	
	// pega a altura da foto original
	$alt_foto=imagesy($original);
	
	// faz o calculo da proporcao altura/largura
	// afinal queremos que seja redimensionado proporcionalmente
	$fator=$alt_foto/$larg_foto;

	// faz o calcula da altura nova
	$altura_nova=$larg*$fator;

	if ($bytes_foto > ((int)$peso*1024)) {
		$vNovaImagem = "redimensiona" . $foto;
		
		// cria uma nova imagem com as dimensoes reduzidas
		$saida=imagecreatetruecolor($larg,$altura_nova);

		// cria uma copia redimensionada na imagem nova
		imagecopyresized($saida,$original, 0, 0, 0, 0,$larg,$altura_nova,$larg_foto,$alt_foto);
		
		// grava a imagem nova em arquivo com qualidade 90
		if (strtolower($extensao) == "png") {
			imagepng($saida,$pasta . "/" . $vNovaImagem,6);

		} else if (strtolower($extensao) == "gif") {
			imagepng($saida,$pasta . "/" . $vNovaImagem);

		} else {
			imagejpeg($saida,$pasta . "/" . $vNovaImagem,90);

		}

		// libera os recursos no servidor
		imagedestroy($saida);
		imagedestroy($original);
		
		$vUnLink = unlink($pasta . '/' . $foto) or die (mysqli_error());
		
		$foto = $vNovaImagem;
	}
	
	return ($foto);
}


//==============================================
// 
// Funзгo fNotificacoes()
// 
//==============================================


function fNotificacoes($vnotificacoes, $vtipo, $vuser, $vid1, $vid2) {
	$arrayNotificacoes = explode("][", $vnotificacoes);
	$vNotificacao = "";

	for ($i = 0; $i < count($arrayNotificacoes); $i++) {
		$arrayNotificacoes[$i] = explode(";", $arrayNotificacoes[$i]);
		$arrayNotificacoes[$i] = str_replace("]", "", str_replace("[", "", $arrayNotificacoes[$i]));

	}
	
	if ($vtipo == "deposito") {
		$varOrigem = trim($vtipo) . ":" . (int)$vid1;

		for ($i = 0; $i < count($arrayNotificacoes); $i++) {
			if (($arrayNotificacoes[$i][0] == $varOrigem) && ((int)$arrayNotificacoes[$i][1] == (int)$vid2) && (trim(strtolower($arrayNotificacoes[$i][2])) == trim(strtolower($vuser)))) {
				echo '';

			} else {
				for ($y = 0; $y < count($arrayNotificacoes[$i]); $y++) {
					if ($y == 0) {$vNotificacao .= '['; }
					if ($y > 0) { $vNotificacao .= ';'; }
					
					$vNotificacao .= $arrayNotificacoes[$i][$y];

				}
				
				$vNotificacao .= ']';
			}
		}

	} else if (($vtipo == "novo") || ($vtipo == "confirmado") || ($vtipo == "aguardando")) {
		$varOrigem = trim($vtipo) . ":" . $vuser;

		for ($i = 0; $i < count($arrayNotificacoes); $i++) {
			if ($arrayNotificacoes[$i][0] == $varOrigem) {
				echo '';

			} else {
				for ($y = 0; $y < count($arrayNotificacoes[$i]); $y++) {
					if ($y == 0) {$vNotificacao .= '['; }
					if ($y > 0) { $vNotificacao .= ';'; }
					
					$vNotificacao .= $arrayNotificacoes[$i][$y];

				}
				
				$vNotificacao .= ']';
			}
		}
	}

	return ( $vNotificacao );
}

//==============================================
// 
// Funcao fValidaCPF
// 
//==============================================

function fValidaCPF($cpf) {
 
    // Extrai somente os numeros
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequencia de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}


//==============================================
//' Criptografia de dados
//==============================================

function fCripto($vcadeia, $vtipo, $valfa) {
	$numerosA = Array("|",  "1",  "2",  "3",  "4",  "5",  "6",  "7",  "8",  "9",  "0",  "-",  ".",  ",");
	$numerosB = Array("|", "91", "12", "72", "37", "82", "20", "28", "52", "26", "11", "44", "77", "88");

	$maiusculasA = Array("|",  "A",  "B",  "C",  "D",  "E",  "F",  "G",  "H",  "I",  "J",  "K",  "L",  "M",  "N",  "O",  "P",  "Q",  "R",  "S",  "T",  "U",  "V",  "W",  "X",  "Y",  "Z"); 
	$maiusculasB = Array("|", "qM", "wN", "eB", "rV", "tC", "yX", "uZ", "iA", "oS", "pD", "aF", "sG", "dH", "fJ", "gK", "hL", "jP", "kO", "lI", "zU", "xY", "cT", "vR", "bE", "nW", "mQ");

	$minusculasA = Array("|",  "a",  "b",  "c",  "d",  "e",  "f",  "g",  "h",  "i",  "j",  "k",  "l",  "m",  "n",  "o",  "p",  "q",  "r",  "s",  "t",  "u",  "v",  "w",  "x",  "y",  "z"); 
	$minusculasB = Array("|", "5p", "8O", "7I", "4u", "6y", "3T", "6r", "2E", "5w", "3q", "6l", "7k", "8J", "9h", "0G", "4f", "3D", "6s", "5A", "4z", "3x", "7C", "6v", "1b", "8N", "5m");

	$a = "";
	
	if ($vtipo == "C") {
		if ($valfa == "A") {
			$vCadeia = str_replace("_", "", trim($vcadeia));
			$vCadeia = str_replace("%", "", $vCadeia);
			$vCadeia = str_replace(" ", "_", $vCadeia);

			for ($i = 0; $i < strlen($vCadeia); $i++) {
				if (array_search(substr($vCadeia, $i, 1), $maiusculasA) > 0) {
					$a .= $maiusculasB[array_search(substr($vCadeia, $i, 1), $maiusculasA)];
					
				} else if (array_search(substr($vCadeia, $i, 1), $minusculasA) > 0) {
					$a .= $minusculasB[array_search(substr($vCadeia, $i, 1), $minusculasA)];
					
				} else {
					$a .= "%".substr($vCadeia, $i, 1);
				}
			}

		} else {
			for ($i = 0; $i < strlen($vcadeia); $i++) {
				if (array_search(substr($vcadeia, $i, 1), $numerosA) > 0) {
					$a .= $numerosB[array_search(substr($vcadeia, $i, 1), $numerosA)];
					
				} else if (array_search(substr($vcadeia, $i, 1), $numerosA) > 0) {
					$a .= $numerosB[array_search(substr($vCadeia, $i, 1), $numerosA)];
					
				} else {
					$a .= substr($vcadeia, $i, 1);
				}
			}

		}
		
		$vRetorno = base64_encode($a);
		
	} else if ($vtipo == "D") {
		$vcadeia = base64_decode($vcadeia);

		if ($valfa == "A") {
			for ($i = 0; $i < strlen($vcadeia); $i++) {
				if (array_search(substr($vcadeia, $i, 2), $maiusculasB) > 0) {
					$a .= $maiusculasA[array_search(substr($vcadeia, $i, 2), $maiusculasB)];
					
				} else if (array_search(substr($vcadeia, $i, 2), $minusculasB) > 0) {
					$a .= $minusculasA[array_search(substr($vcadeia, $i, 2), $minusculasB)];
					
				} else {
					$a .= substr($vcadeia, $i, 2);
					
				}
				
				$i++;
				
			}
			
		} else {
			for ($i = 0; $i < strlen($vcadeia); $i++) {
				if (array_search(substr($vcadeia, $i, 2), $numerosB) > 0) {
					$a .= $numerosA[array_search(substr($vcadeia, $i, 2), $numerosB)];
					
				} else if (array_search(substr($vcadeia, $i, 2), $numerosB) > 0) {
					$a .= $numerosA[array_search(substr($vcadeia, $i, 2), $numerosB)];
					
				} else {
					$a .= substr($vcadeia, $i, 2);
					
				}
				
				$i++;
				
			}
		}
		
		$vRetorno = str_replace("%", "", str_replace("%_", " ", $a));

	}
	
	return( $vRetorno );
	
}


//==============================================
// 
// Funзгo fIdu()
// 
//==============================================


function fId($vacao, $vidu) {
	if (strtolower($vacao) == "d") {
		$vRetorno = (((int)$vidu-832765)/2);
		
	} else {
		$vRetorno = ((int)$vidu+(int)$vidu+832765);
	
	}
	
	return ($vRetorno);
}


//==============================================
// 
// Funзгo fSaqueCalendario(
// 
//==============================================


function fSaqueCalendario($vdia_semana) {
	$vMesAtual = date('m');
	$vAnoAtual = date('Y');

	if ($vMesAtual == 12) {
		$vProximoMes = 1;
		$vProximoAno = ($vAnoAtual+1);
		
	} else {
		$vProximoMes = ($vMesAtual+1);
		$vProximoAno = $vAnoAtual;

	}
	
	$vDiaProgramado = ((int)$vdia_semana-1);
	
	$vUltimoDiaMes = cal_days_in_month(CAL_GREGORIAN, $vMesAtual, $vAnoAtual);
	$vUltimoDiaProximo = cal_days_in_month(CAL_GREGORIAN, $vProximoMes, $vProximoAno);

	$arrayDiasAtual = Array();
	$arrayDiasProximo = Array();

	$x = 0;
	
	for ($i = 1; $i <= $vUltimoDiaMes; $i++) {
		$vDiaSaque = date("N", strtotime($i . "-" . $vMesAtual . "-" . $vAnoAtual)); 
		
		if ($vDiaSaque == 7) { $vDiaSaque = 0; }
		
		if (($vDiaSaque+10) == ($vDiaProgramado+10)) {
			$arrayDiasAtual[$x] = $i . "-" . $vMesAtual . "-" . $vAnoAtual;
			
			$x++;
		}
	}
	
	$x = 0;
	
	for ($i = 1; $i <= $vUltimoDiaProximo; $i++) {
		$vDiaSaque = date("N", strtotime($i . "-" . $vProximoMes . "-" . $vProximoAno)); 
		
		if ($vDiaSaque == 7) { $vDiaSaque = 0; }
		
		if (($vDiaSaque+10) == ($vDiaProgramado+10)) {
			$arrayDiasProximo[$x] = $i . "-" . $vProximoMes . "-" . $vProximoAno;
			
			$x++;
		}
	}
	
	return Array($arrayDiasAtual, $arrayDiasProximo);
}


//==============================================
// 
// Funзгo fBytes($vbytes)
// 
//==============================================


function fBytes($vbytes) {
	$vBytes = "000000000000".trim(" ".$vbytes);
	$vBytes = substr($vBytes, -12, 12);
	$vBytesA = substr($vBytes, 0, 3) . "." . substr($vBytes, 3, 3) . "." . substr($vBytes, 6, 3) . "." . substr($vBytes, 9, 3);
	
	$arrayBytes = explode(".", $vBytesA);

	$vBytes = "";
	
	for ($i = 0; $i < count($arrayBytes); $i++) {
		if ($i < 3) {
			$vBytes .= '['.(int)$arrayBytes[$i] . ".]";
			
		} else {
			$vBytes .= '['.$arrayBytes[$i] . ".]";
			
		}
	}
	
	$vBytes = str_replace("[0.]", "", $vBytes);
	$vBytes = str_replace("[", "", $vBytes);
	$vBytes = str_replace("]", "", $vBytes);
	
	return( substr($vBytes, 0, (strlen($vBytes)-1)) );
}


//==============================================
// fGerarLink($string)
//==============================================


function fGerarLink($string) {

	$vStr1 = strtolower(htmlentities($string, ENT_QUOTES, "UTF-8"));
	
	$vStr1 = str_replace("&aacute;", "a", $vStr1);
	$vStr1 = str_replace("&Aacute;", "a", $vStr1);
	$vStr1 = str_replace("&atilde;", "a", $vStr1);
	$vStr1 = str_replace("&Atilde;", "a", $vStr1);
	$vStr1 = str_replace("&acirc;", "a", $vStr1);
	$vStr1 = str_replace("&Acirc;", "a", $vStr1);
	$vStr1 = str_replace("&agrave;", "a", $vStr1);
	$vStr1 = str_replace("&Agrave;", "a", $vStr1);
	$vStr1 = str_replace("&eacute;", "e", $vStr1);
	$vStr1 = str_replace("&Eacute;", "e", $vStr1);
	$vStr1 = str_replace("&ecirc;", "e", $vStr1);
	$vStr1 = str_replace("&Ecirc;", "e", $vStr1);
	$vStr1 = str_replace("&iacute;", "i", $vStr1);
	$vStr1 = str_replace("&Iacute;", "i", $vStr1);
	$vStr1 = str_replace("&oacute;", "o", $vStr1);
	$vStr1 = str_replace("&Oacute;", "o", $vStr1);
	$vStr1 = str_replace("&otilde;", "o", $vStr1);
	$vStr1 = str_replace("&Otilde;", "o", $vStr1);
	$vStr1 = str_replace("&ocirc;", "o", $vStr1);
	$vStr1 = str_replace("&Ocirc;", "o", $vStr1);
	$vStr1 = str_replace("&uacute;", "u", $vStr1);
	$vStr1 = str_replace("&Uacute;", "u", $vStr1);
	$vStr1 = str_replace("&ccedil;", "c", $vStr1);
	$vStr1 = str_replace("&Ccedil;", "c", $vStr1);
	$vStr1 = str_replace("_", "-", $vStr1);
	$vStr1 = str_replace("*", "-", $vStr1);
	$vStr1 = str_replace("@", "-", $vStr1);
	$vStr1 = str_replace("$", "-", $vStr1);
	$vStr1 = str_replace("+", "-", $vStr1);
	$vStr1 = str_replace("=", "-", $vStr1);
	$vStr1 = str_replace("'", "-", $vStr1);
	$vStr1 = str_replace('"', "-", $vStr1);
	$vStr1 = str_replace(")", "-", $vStr1);
	$vStr1 = str_replace("(", "-", $vStr1);
	$vStr1 = str_replace("[", "-", $vStr1);
	$vStr1 = str_replace("]", "-", $vStr1);
	$vStr1 = str_replace("{", "-", $vStr1);
	$vStr1 = str_replace("}", "-", $vStr1);
	$vStr1 = str_replace("?", "-", $vStr1);
	$vStr1 = str_replace("?", "-", $vStr1);
	$vStr1 = str_replace("#", "-", $vStr1);
	$vStr1 = str_replace("&", "-", $vStr1);
	$vStr1 = str_replace(";", "-", $vStr1);
	$vStr1 = str_replace(".", "-", $vStr1);
	$vStr1 = str_replace(",", "-", $vStr1);
	$vStr1 = str_replace(":", "-", $vStr1);
	
	$aStr = explode(" ", $vStr1);
	
	$vStr3 = "";
	
	foreach ($aStr As $vStr2) {
		
		$vStr3 .= $vStr2 . "-";

	}
	
	$vString = substr($vStr3, 0, -1);
	
	return ( $vString );
}
?>
