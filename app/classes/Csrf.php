<?php

namespace app\classes;

class Csrf 
{
    public function pega_token_id() {
        if(isset($_SESSION['token_id'])) { 
            return $_SESSION['token_id'];
        } else {
            $token_id = $this->random(10);
            $_SESSION['token_id'] = $token_id;
            return $token_id;
        }
    }

    public function pega_token($regenerar = false) {
        if($regenerar == true) {
            unset($_SESSION['token_value']);
        }
        if(isset($_SESSION['token_value'])) {
            return $_SESSION['token_value']; 
        } else {
            $token = hash('sha256', $this->random(500));
            $_SESSION['token_value'] = $token;
            return $token;
        }
    }

    public function pega_id_sessao() {
        if(isset($_SESSION['id_sessao'])) {
            return $_SESSION['id_sessao']; 
        } else {
            $token = hash('sha256', $this->random(500));
            $_SESSION['id_sessao'] = $token;
            return $token;
        }
    }


    public function destroi_tokens() {
        unset($_SESSION['token_value']);
        unset($_SESSION['token_id']);
    }

    
    public function validacao($method) {
        if($method == 'post' || $method == 'get') {
            $post = $_POST;
            $get = $_GET;
            if( isset(${$method}[$this->pega_token_id()]) && (${$method}[$this->pega_token_id()] == $this->pega_token()) ) {
                return true;
            } else {
                return false;	
            }
        } else {
            return false;	
        }
    }

    public function validacao_valorsomente($method) {
        if($method == 'post' || $method == 'get') {
            $post = $_POST;
            $get = $_GET;
            if( isset(${$method}['_']) && (${$method}['_'] == $this->pega_token()) ) {
                return true;
            } else {
                return false;	
            }
        } else {
            return false;	
        }
    }

    public function crianomes_form($campos, $regenerar) {
        $valores = array();
        foreach ($campos as $campo) {
            if($regenerar == true) {
                unset($_SESSION[$campo]);
            }
            $s = isset($_SESSION[$campo]) ? $_SESSION[$campo] : $this->random(10);
            $_SESSION[$campo] = $s;
            $valores[$campo] = $s;	
        }
        return $valores;
    }

    private function random($len) {
        $return = '';
        if (function_exists('openssl_random_pseudo_bytes')) {
            $byteLen = intval(($len / 2) + 1);
            $return = substr(bin2hex(openssl_random_pseudo_bytes($byteLen)), 0, $len);
        }

        if (empty($return)) {
            for ($i=0;$i<$len;++$i) {
                if (!isset($urandom)) {
                    if ($i%2==0) {
                        mt_srand(time()%2147 * 1000000 + (double)microtime() * 1000000);
                    }
                    $rand=48+mt_rand()%64;
                } else {
                    $rand=48+ord($urandom[$i])%64;
                }

                if ($rand>57)
                    $rand+=7;
                if ($rand>90)
                    $rand+=6;

                if ($rand==123) $rand=52;
                if ($rand==124) $rand=53;
                $return.=chr($rand);
            }
        }

	    return $return;
    }

    public function limpaStringSeg($str, $qtdtemp = 100){
        $tempdata = $str;
        if(mb_strlen($tempdata) > $qtdtemp){
            $tempdata = substr($tempdata, 0, $qtdtemp);
        }
        $s = array("'","`","\xE2\x80\x98","\xE2\x80\x99","\"","--");
        $tempdata = str_replace($s,"",$tempdata);
        return $tempdata;
    }
}
