<?php

$include_once = "register.php";

$formDados = [];
$mensagemErro = [];
$salvar = false;
$verificaEmail = [];

if ($vAction==="salvar") {
    
    $formDados = $_POST;

    if (isset($formDados['email']) && strlen($formDados['email']) < 6) {
        $mensagemErro['email'] = "O <strong>Seu Email</strong> deve ter pelo menos 6 caracteres.";
    }

    if (isset($formDados['password'])) {
        if (strlen($formDados['password']) < 6) {
            $mensagemErro['password'] = "O <strong>Senha</strong> deve ter pelo menos 6 caracteres.";

        } else if (strlen($formDados['confirm_password']) < 6) {
            $mensagemErro['password'] = "O <strong>Confirmação de Senha</strong> deve ter pelo menos 6 caracteres.";

        } else {
            if ($formDados['password'] != $formDados['confirm_password']) {
                $mensagemErro['password'] = "As <strong>Senhas</strong> digitadas não conferem.";
            }
        }
    }

    if (empty($mensagemErro)) {

        $salvar = true;
        
        include_once(LOCAL . "/app/model/RegisterModel.php");

        if (!empty($verificaEmail)) {
            $mensagemErro['email'] = "O <strong>Seu Email</strong> informado já está em uso.";
            $salvar = false;
            
        }
    }
}

include_once "app/views/{$include_once}";