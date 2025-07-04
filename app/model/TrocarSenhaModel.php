<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');


if ($vParameters==="salvar") {
    
    $dadosForm = $_POST;
    
    $vAlerta = "";

    if (empty($dadosForm['senha_atual'])) { $vAlerta .= "<div>O campo <strong>Senha Atual</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['nova_senha'])) { $vAlerta .= "<div>O campo <strong>Nova Senha</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['confirme_senha'])) { $vAlerta .= "<div>O campo <strong>Confirme a Senha</strong> n&atilde;o pode ser vazio.</div>"; }


    $vData = date("Y-m-d H:i:s");
    
    $id_usuario = (int)$dadosForm['id_usuario'];
    

    if (empty($vAlerta)) {

        $senha_atual = isset($dadosForm['senha_atual']) ? str_replace('"', "||", str_replace("'", "||", $dadosForm['senha_atual'])) : '';
        $nova_senha = isset($dadosForm['nova_senha']) ? str_replace('"', "||", str_replace("'", "||", $dadosForm['nova_senha'])) : '';
        $confirme_senha = isset($dadosForm['confirme_senha']) ? str_replace('"', "||", str_replace("'", "||", $dadosForm['confirme_senha'])) : '';


        if (md5($senha_atual) != $dadosForm['db_senha_atual']) {
            
            $vAlerta = "<div>A <strong>Senha Atual</strong> est&aacute; incorreta.</div>";

        } else {

            if (strlen($nova_senha) < 6) {

                $vAlerta = "<div>A <strong>Senha</strong> deve ser maior que 5 caracteres.</div>";

            } else if ($nova_senha != $confirme_senha) {
                
                $vAlerta = "<div>As <strong>Senhas</strong> não conferem. Digite novamente.</div>";

            } else {

                $senha = md5($nova_senha);

            }

        }
                
    }


    if (empty($vAlerta)) {

        try{
            
            $where = " WHERE id=" . (int)$dadosForm['id_usuario'];

            $sql = "UPDATE usuarios SET senha='" . $senha . "' $where";

            $conn->query($sql);
            
            $dadosForm = [];

            $salvo = true;
            

        } catch (Exception $e) {
            $vAlerta = $e->getMessage();

        }

    }
        
}


$query = $conn->query("SELECT id,senha FROM usuarios WHERE id=$id_usuario");
  
    $re = mysqli_fetch_array($query);
    
    $dados = $re;

mysqli_free_result($query);
