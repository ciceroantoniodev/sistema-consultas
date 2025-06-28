<?php

function redirect($url = "") {
    if ($url != "") {
        header( "Location: $url" );
        exit;
    }
}

function pegaIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    } else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function soData($str) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > 20){
        $tempdata = substr($tempdata, 0, 20);
    }
    $tempdata = preg_replace( "/[^0-9 \-\/]/", "", $tempdata );
    return $tempdata;
}

function soNumero($str) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > 40){
        $tempdata = substr($tempdata, 0, 40);
    }
    $tempdata = preg_replace( "/[^0-9]/", "", $tempdata );
    return $tempdata;
}

function soNumeroDinheiro($str) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > 40){
        $tempdata = substr($tempdata, 0, 40);
    }
    $tempdata = preg_replace( "/[^0-9,.-]/", "", $tempdata );
    return $tempdata;
}

function soNumeroBulkLinha($str) {
    $str = preg_replace("/[^0-9,]/", "", $str);
    return $str;
}
function soNumeroBulkLinhaAlt($str, $qtd = 100) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtd){
        $tempdata = substr($tempdata, 0, $qtd);
    }
    $tempdata = preg_replace( "/[^0-9,]/", "", $tempdata );
    return $tempdata;
}

function soNumeroBulk($str) {
    $str = preg_replace( "/[^0-9\s]/", "", $str );
    return $str;
}

function soNumeroDevice($str, $qtd = 100) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtd){
        $tempdata = substr($tempdata, 0, $qtd);
    }
    $tempdata = preg_replace("/[^a-zA-Z0-9;\-]/","",$tempdata);
    return $tempdata;
}

function soLetras($str){
    return preg_replace( "/[^a-zA-Z]/", "", $str );
}
function soLetrasMax($str, $qtdtemp = 50){
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtdtemp){
        $tempdata = substr($tempdata, 0, $qtdtemp);
    }
    $tempdata = preg_replace("/[^a-zA-Z]/", "", $tempdata);
    return $tempdata;
}
function soLetrasNumeros($str, $qtdtemp = 50){
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtdtemp){
        $tempdata = substr($tempdata, 0, $qtdtemp);
    }
    $tempdata = preg_replace( "/[^a-zA-Z0-9]/", "", $tempdata );
    return $tempdata;
}
function soLetrasNumerosValidation($str, $qtdtemp = 50){
  $tempdata = $str;
  if(mb_strlen($tempdata) > $qtdtemp){
      $tempdata = substr($tempdata, 0, $qtdtemp);
  }
  $tempdata = preg_replace("/[^a-zA-Z0-9\-]/","",$tempdata );
  return $tempdata;
}
function soLetrasVariavel($str, $qtdtemp = 500){
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtdtemp){
        $tempdata = substr($tempdata, 0, $qtdtemp);
    }
    $tempdata = preg_replace( "/[^a-zA-Z]/", "", $tempdata );
    return $tempdata;
}

function soLetrasNumerosSimbolos($str, $qtdtemp = 500){
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtdtemp){
        $tempdata = substr($tempdata, 0, $qtdtemp);
    }
    $tempdata = preg_replace("/[^0-9a-zA-Z \-_@!,<>.:\/]/", "", $tempdata);
    return $tempdata;
}
function soLetrasNumerosSimbolosPlus($str, $qtdtemp = 500){
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtdtemp){
        $tempdata = substr($tempdata, 0, $qtdtemp);
    }
    $tempdata = preg_replace("/[^0-9a-zA-Z \-_@!,<>.:\/(){}[]]/", "", $tempdata);
    return $tempdata;
}

function soLetraENumero($str) {
    $str = preg_replace("/[^0-9a-zA-Z ]/", "", $str );
    return $str;
}

function soIdPegar($str) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > 40){
        $tempdata = substr($tempdata, 0, 40);
    }
    $tempdata = preg_replace( "/[^0-9a-zA-Z \-]/", "", $tempdata );
    return $tempdata;
}

function limpaStringCompleta($str) {
    $str = preg_replace(["/[^0-9a-zA-Z \-]/"] , "", $str );
    return $str;
}

function formataCelular($phone) {
    $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
    $matches = [];
    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
    if ($matches) {
        return '('.$matches[1].') '.$matches[2].'-'.$matches[3];
    }
    return $phone;
}

function formataData($data, $hora = true, $segundo = true){
    $date = new DateTime($data);
    if($segundo){
        return $date-> format( 'd/m/Y' . (($hora) ? ' H:i:s' : '') );
    } else {
        return $date-> format( 'd/m/Y' . (($hora) ? ' H:i' : '') );
    }
}

function formataFloat($n, $casas = 3){
    return number_format(str_replace(',','.',str_replace('.','',$n)),$casas,'.','');
}

function formataDinheiro($money, $casas = 2){
    return number_format($money,$casas,',','.');
}

function stringDinheiro($money){
    //formata sem round
    return str_replace('.',',',$money);
}

function stringDinheiroContra($money){
    //formata sem round
    return str_replace(',','.',$money);
}

function formataSaidaArquivoWindows($texto){
    $enc = mb_detect_encoding($texto,"auto");
    return mb_convert_encoding($texto,"UTF-16LE",$enc);
}

function limpaString($m){
    $s = array("'","`","\xE2\x80\x98","\xE2\x80\x99","\"","--");
    $m = str_replace($s,"",$m);
    return $m;
}

function limpaStringEspecial($str, $qtdtemp = 100){
    $tempdata = $str;
    if(mb_strlen($tempdata) > $qtdtemp){
        $tempdata = substr($tempdata, 0, $qtdtemp);
    }
    $s = array("'","`","\xE2\x80\x98","\xE2\x80\x99","\"","--");
    $tempdata = str_replace($s,"",$tempdata);
    return $tempdata;
}

function removeSimbolosTodo( $str ) {
    $s = array("'","`","\xE2\x80\x98","\xE2\x80\x99","\"","--"," ");
    $str = str_replace($s, "", $str);
    return $str;
}

//funções genericas
function echoNumeracao($i,$f,$t,$g = 0) {
    $i++;
    if($g==0){
        return "<p style='font-size:14px;'>Showing $i - $f, from $t</p>";
    }
    else if($g==$t){
        return "<p style='font-size:14px;'>Showing $i - $f, from $t</p>";
    }
    else {
        return "<p style='font-size:14px;'>Showing $i - $f, from $t (Total $g entries from user)</p>";
    }
}

function echoSucessoUtf8($err){
    echo json_encode(array(
        'c' => 1,
        'm' => utf8_encode($err)
    ));
}

function echoErroUtf8($err){
    echo json_encode(array(
        'c' => 0,
        'm' => utf8_encode($err)
    ));
}

function encodeSaida($saida){
    return mb_convert_encoding($saida, 'ISO-8859-1', 'UTF-8');
}

function criaHashRandom($letras = 40){
    $conjunto = array_merge(range('a','z'),range('A','Z'),range('0','9'));
    shuffle($conjunto);
    return substr(implode($conjunto),0,$letras);
}

function casoSim($s){
    switch($s){
        case 'S':
            return 'Yes';
        break;
        case 'N':
            return 'No';
        break;
    }
    return  '';
}

function casoStatus($s){
    switch($s){
        case 'T':
            return 'Finalizado';
        break;
        case 'P':
            return 'Processando';
        break;
    }
    return  '';
}

function casoFiltro($s){
    switch($s){
        case 'T':
            return 'Válido';
        break;
        case 'F':
            return 'Inválido';
        break;
        case 'C':
            return 'Cancelado';
        break;
    }
    return  '';
}

function statusMostrar($s){
    switch($s){
        case "P":
        return "Pendente";
        break;
        case "T":
        return "<font color='blue'>Válido</font>";
        break;
        case "F":
        return "<font color='green'>Inválido</font>";
        break;
        case "B":
        return "<font color='red'>Banido</font>";
        break;
        default:
        return "Indefinido";
        break;
    }

    return "Erro";
}

function statusCanalDevice($st){
    switch($st){
        case 'P':
            return 'Disponivel';
        break;
        case 'B':
            return 'Banido';
        break;
    }
    return 'Erro';
}

function fecha_pagina(){
    exit('
        <script>
            window.close();
        </script>
        ');
}

function caixa_destinatario($dest_input){
    $volta = "";
    $tudo = explode(PHP_EOL, $dest_input);

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) !== ''){
                if(mb_strlen($l) > 5){
                    $ty = str_replace("'","",$l);
                    $ty = soNumero($ty);
                    $volta .= $ty."\r\n";
                }
            }
        }
        if(mb_strlen($volta) > 2){
            $volta = substr($volta, 0, -2);
        }
    }

    return $volta;
}

function caixa_destinatario_novo($dest_input){
    $volta = "";
    $tudo = explode(",", $dest_input);

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) !== ''){
                if(mb_strlen($l) > 5){
                    $ty = str_replace("'","",$l);
                    $ty = soNumero($ty);
                    $volta .= $ty."\r\n";
                }
            }
        }
        if(mb_strlen($volta) > 2){
            $volta = substr($volta, 0, -2);
        }
    }

    return $volta;
}

function caixa_destinatario_string($dest_input){
    $volta = "";
    $tudo = explode(PHP_EOL, $dest_input);

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) !== ''){
                if(mb_strlen($l) > 5){
                    $ty = str_replace("'","",$l);
                    $ty = decUtf8UmaLinhaBulk($ty,400);
                    $volta .= $ty."\r\n";
                }
            }
        }
        if(mb_strlen($volta) > 2){
            $volta = substr($volta, 0, -2);
        }
    }

    return $volta;
}

function caixa_destinatario_filtro($dest_input){
    $volta = "";
    $tudo = explode(PHP_EOL, $dest_input);
    $total = 0;

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) !== ''){
                if(mb_strlen($l) > 5){
                    $ty = soNumero($l);
                    $volta .= $ty."\r\n";
                    $total++;
                }
            }
        }
    }

    return ['numeros' => $volta, 'total' => $total];
}


function caixa_destinatario_sender($dest_input){
    $volta = "";
    $tudo = explode(PHP_EOL, $dest_input);
    $total = 0;

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) !== ''){
                if(mb_strlen($l) > 5){
                    $ty = soNumero($l);
                    $volta .= $ty."\r\n";
                    $total++;
                }
            }
        }
    }

    return ['numeros' => $volta, 'total' => $total];
}
function caixa_destinatario_sender_variaveis($dest_input){
    $volta = "";
    $tudo = explode(PHP_EOL, $dest_input);
    $total = 0;

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) !== ''){
                if(mb_strlen($l) > 5){
                    $temparr1 = explode(";",$l);
                    $totaltemparr1 = (count($temparr1) > 5) ? 5 : count($temparr1);
                    $tempstr = "";
                    for($itemp = 0; $itemp <= $totaltemparr1; $itemp++){
                        $tempstrstr = $temparr1[$itemp];
                        if($itemp === 0){
                            $tempstrstr = str_replace("'","",$tempstrstr);
                            $tempstrstr = soNumero($tempstrstr);
                        } else {
                            $tempstrstr = str_replace("'","",$tempstrstr);
                            $tempstrstr = soStringUmaLinha($tempstrstr,50);
                        }
                        $tempstr .= $tempstrstr.";";
                    }
                    $tempstr = substr($tempstr,0,mb_strlen($tempstr)-1);
                    if(substr_count($tempstr, ";") < 5){
                        for($i = substr_count($tempstr, ";"); $i < 5; $i++){
                            $tempstr.=";";
                        }
                    }
                    $volta .= $tempstr."\r\n";
                    $total++;
                }
            }
        }
    }

    return ['numeros' => $volta, 'total' => $total];
}

function caixa_devices_canais($dest_input){
    $tudo = explode(";", $dest_input);
    $devices = [];
    $canais = [];

    if(!empty($tudo)){
        foreach($tudo as $l) {
            if(trim($l) === ''){
                continue;
            }
            if(mb_strlen($l) <= 5){
                continue;
            }
            
            $t1 = explode("-", $l);
            if(count($t1)===2){
                if($t1[1] === "TODOS"){
                    $devices[] = $t1[0];
                } else {
                    $d = strval($t1[0]);
                    if(in_array($d,array_keys($canais),true)){
                        $canais[$d][] = $t1[1];
                    } else {
                        $canais[$d] = [$t1[1]];
                    }
                }
            }
        }
    }

    return ['devices' => $devices, 'canais' => $canais];
}

function retornaStringQueryAll($temp){
	if(gettype($temp) === 'array'){
		$r = '';
		foreach ($temp as $k=>$v) {
			$t = '';
			if(gettype($v) === 'array'){
				$t = retornaStringQueryAll($v);
			} else {
				$t = $v;
			}
			if($r===''){
				$r.=$t;
			} else {
				$r.=" $t";
			}
		}
		return $r;
	} else {
		return $temp;
	}
}

function retornaStringQueryErro($temp,$busc){
    $busc=strtolower($busc);
    if($busc===""){
        return "";
    }
    //'('.gettype($temp).')';
	if(gettype($temp) === 'array'){
		foreach ($temp as $k=>$v) {
            //'['.gettype($v).']';
			if(gettype($v) === 'array'){
				return retornaStringQueryErro($v,$busc);
			}
            if(gettype($v) === 'string'){
                if(str_contains(strtolower($v),$busc)){
                    return $v;
                }
            }
		}
	}
    if(gettype($temp) === 'string'){
        if(str_contains(strtolower($temp),$busc)){
            return $temp;
        }
    }
    return "";
}

function escape_mssql($variavel){
    if(gettype($variavel) === "string"){
        $temp = trim(str_replace("'","",$variavel));
        return $temp;
    }
    return "";
}

function verificacaoArquivo($campoFile){
    if (strpos($_FILES[$campoFile]['name'], "../") > 0) {
        return false;
    }
    else if (strpos($_FILES[$campoFile]['name'], ".php") > 0) {
        return false;
    }
    //else if(preg_match('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ_.,!@#$%&()+\- ]/', $_FILES[$campoFile]['name'])) {
    else if(preg_match('/[^A-Za-z0-9 _.!@#$%&*()?+áàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ\[\]\-{}\^;,~]/', $_FILES[$campoFile]['name'])) {
        return false;
    }
    return true;
}
function verificacaoArquivoMulti($campoFile,$i){
    if (strpos($_FILES[$campoFile]['name'][$i], "../") > 0) {
        return false;
    }
    else if (strpos($_FILES[$campoFile]['name'][$i], ".php") > 0) {
        return false;
    }
    //else if(preg_match('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ_.,!@#$%&()+\- ]/', $_FILES[$campoFile]['name'])) {
    else if(preg_match('/[^A-Za-z0-9 _.!@#$%&*()?+áàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ\[\]\-{}\^;,~]/', $_FILES[$campoFile]['name'][$i])) {
        return false;
    }
    return true;
}

function soStringUmaLinha($str, $tamMax = 50) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:,!@#$%&*()+?\-\/ ]/', "", $tempdata);
    return $tempdata;
}
function soStringMultiLinha($str, $tamMax = 50) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:,!@#$%&*()+?\-\/\s]/', "", $tempdata);
    return $tempdata;
}

function decUtf8UmaLinha($str, $tamMax = 50, $comAcento = true) {
    $tempdata = utf8_decode($str);
    if($comAcento){
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        $tempdata = str_replace($comAcentos, $semAcentos, $tempdata);
    }

    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:,!@#$%&*()+?\-\/ ]/', "", $tempdata);
    return $tempdata;
}
function decUtf8MultiLinha($str, $tamMax = 50, $comAcento = true) {
    $tempdata = utf8_decode($str);
    if($comAcento){
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        $tempdata = str_replace($comAcentos, $semAcentos, $tempdata);
    }

    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:,!@#$%&*()+?\-\/\s]/', "", $tempdata);
    return $tempdata;
}

function decUtf8UmaLinhaBulk($str, $tamMax = 50, $comAcento = true) {
    $tempdata = utf8_decode($str);
    if($comAcento){
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        $tempdata = str_replace($comAcentos, $semAcentos, $tempdata);
    }

    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:;,!@#$%&*()+?\-\/ ]/', "", $tempdata);
    return $tempdata;
}
function decUtf8MultiLinhaBulk($str, $tamMax = 50, $comAcento = true) {
    $tempdata = utf8_decode($str);
    if($comAcento){
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        $tempdata = str_replace($comAcentos, $semAcentos, $tempdata);
    }

    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:;,!@#$%&*()+?\-\/\s]/', "", $tempdata);
    return $tempdata;
}

function soLetraNumeroUmaLinha($str, $tamMax = 50, $comAcento = true) {
    $tempdata = utf8_decode($str);
    if($comAcento){
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        $tempdata = str_replace($comAcentos, $semAcentos, $tempdata);
    }

    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ ]/', "", $tempdata);
    return $tempdata;
}

function matchStringUmaLinha($str, $tamMax = 50) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $tamMax){
        return true;
    }
    if(preg_match('/[^0-9A-Za-záàâãéíóôõúçñÁÀÂÃÉÍÓÔÕÚÇÑ="_.:,!@#$%&*()+?\-\/ ]/', $tempdata)){
        return true;
    }
    return false;
}

function matchEmail($str, $tamMax = 100) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $tamMax){
        return false;
    }
    if(preg_match("/^[^@]+@[^@]+\.[a-z]{2,6}$/i", $tempdata))
    {
        return true;
    }
    return false;
}

function matchUrl($str, $tamMax = 100) {
    $tempdata = $str;
    if(mb_strlen($tempdata) > $tamMax){
        return false;
    }
    if(preg_match("/^((https|http|ftp)\:\/\/)?([a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-zA-Z]{2,4}|[a-z0-9A-Z]+\.[a-z0-9A-Z]+\.[a-zA-Z]{2,4}|[a-z0-9A-Z]+\.[a-zA-Z]{2,4})$/i", $tempdata))
    {
        return true;
    }
    return false;
}

function limpaNomeArquivoCanal($str, $tamMax = 100) {
    $tempdata = utf8_decode($str);
    if(true){
        $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
        $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U');
        $tempdata = str_replace($comAcentos, $semAcentos, $tempdata);
    }

    if(mb_strlen($tempdata) > $tamMax){
        $tempdata = substr($tempdata, 0, $tamMax);
    }
    $tempdata = preg_replace('/[^0-9A-Za-z_.;,!@#$%&()+\- ]/', "", $tempdata);
    return $tempdata;
}

function codigoHash($codigo, $acao = null){
    $vCodigo = is_null($acao) ? ((int)$codigo * (int)$codigo + 399) : sqrt((int)$codigo - 399);

    return $vCodigo;
}