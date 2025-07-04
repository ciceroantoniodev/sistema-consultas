<?php

use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$formDados = $_POST;

$usuario = isset($formDados['username']) ? str_replace('"', "||", str_replace("'", "||", $formDados['username'])) : '';
$senha = isset($formDados['password']) ? str_replace('"', "||", str_replace("'", "||", $formDados['password'])) : '';


if($usuario && $senha) {

    try {

        $query = $conn->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND senha='" . md5($senha) . "'");
        
            $re = mysqli_fetch_array($query);
        
        mysqli_free_result($query);


        if (!is_null($re) && !empty($re)) {

            $_SESSION['id'] = $re['id'];
            $_SESSION['nome'] = $re['nome'];
            $_SESSION['acesso'] = time();

            $codigo = (int)$re['id'] . "|" . 
                    str_replace("|", "", trim($re["nome"]));

            $codigo = base64_encode(base64_encode($codigo));

            header("Location: " . URL . "/office/Home&id=" . $codigo);
            exit;

        } else {
            $error = "login";

        }

    } catch (Exception $errLogin01) {
        $error = $errLogin01;

    }

}


include_once "app/views/login.php";
