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
// Função codigoHash()
// 
//==============================================

function codigoHash($codigo, $acao = null){
    $vCodigo = is_null($acao) ? ((int)$codigo * (int)$codigo + 399) : sqrt((int)$codigo - 399);

    return $vCodigo;
}

