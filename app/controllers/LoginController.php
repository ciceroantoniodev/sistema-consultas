<?php

use app\classes\Csrf;

require_once( LOCAL . '/app/config/includes/database.php');
require_once( LOCAL . '/app/config/includes/funct.php');

$formDados = $_POST;

$p_numero = (isset($formDados['username']) && $formDados['username'] != '') ? limpaStringEspecial($formDados['username']) : '';
$p_senha = (isset($formDados['password']) && $formDados['password'] != '') ? limpaStringEspecial($formDados['password']) : '';

$csrf = new Csrf();
$p_result = 0;

if($p_numero && $p_senha) {

    try {
        $ultimo = $database->queryNovo("SELECT codigo,nome,email,mestre,super_mestre,id_revenda,dh_ultimo_acesso,cod_status,dh_validacao FROM usuario(nolock) 
                                            WHERE email = ? AND senha = ?;", [$p_numero, $p_senha], "assoc");

        if (!is_null($ultimo) && !empty($ultimo)) {

            if (Trim($ultimo["cod_status"]) === 'P') {
                $p_result = 7;
                $token_value = $csrf->pega_token(true);

            } else if (Trim($ultimo["cod_status"]) === 'B') {
                $p_result = 2;
                $token_value = $csrf->pega_token(true);

            } else if (Trim($ultimo["cod_status"]) === 'T') {
                $csrf->destroi_tokens();
                
                session_destroy();
                session_start();

                session_regenerate_id();

                $codigo = $ultimo["codigo"];

                $_SESSION['cfg_codigo'] = $codigo;
                //$_SESSION['ultimo'] = $ultimo['dh_ultimo_acesso'];
                $_SESSION['ultimo'] = time();

                $database->queryNovo("EXEC usuarioIAE 'U', ?, ?, null, null, null, null, null, null, null, null ;", [$ultimo['id_revenda'], $codigo], "exec");

                $codigo = (int)$codigo . "|" . 
                    str_replace("|", "", trim($ultimo["nome"])) . "|" . 
                    str_replace("|", "", trim($ultimo["email"])) . "|" . 
                    str_replace("|", "", trim($ultimo["mestre"])) . "|" . 
                    str_replace("|", "", trim($ultimo["super_mestre"])) . "|" . 
                    str_replace("|", "", (int)$ultimo["id_revenda"]);

                $codigo = base64_encode(base64_encode($codigo));

                header("Location: " . URL . "/office/Home&id=" . $codigo);
                exit;

            } else {
                $p_result = 6;
                $token_value = $csrf->pega_token(true);
            }

        } else {
            $p_result = 1;
            $token_value = $csrf->pega_token(true);

        }

    } catch (Exception $errLogin01) {
        $p_result = 6;
        $token_value = $csrf->pega_token(true);

    }

}


include_once "app/views/login.php";
