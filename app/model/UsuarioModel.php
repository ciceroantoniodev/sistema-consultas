<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$dados = [];


if ($vParameters==="novo") {

    //$dados = $database->queryNovo("SELECT * FROM usuario (nolock) WHERE codigo = ? AND id_revenda = ? order by nome", [$iduser, $revenda], 'assoc');


} else if ($vParameters==="editar") {

    $dadosForm = [];

    $query = $conn->query("SELECT * FROM usuarios WHERE id=$codigo_usuario");
      
      $re = mysqli_fetch_array($query);
      
      if (!empty($re)) {

        $dadosForm = $re;

      }

    mysqli_free_result($query);


} else if ($vParameters==="salvar") {

    $dadosForm = $_POST;
    
    $vAlerta = "";

    if (empty($dadosForm['nome'])) { $vAlerta .= "<div>O campo <strong>Nome do Usu&aacute;rio</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['login'])) { $vAlerta .= "<div>O campo <strong>Login do Usu&aacute;rio</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['senha'])) { $vAlerta .= "<div>O campo <strong>Senha do Usu&aacute;rio</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['confirmar_senha'])) { $vAlerta .= "<div>O campo <strong>Confirmar Senha</strong> n&atilde;o pode ser vazio.</div>"; }

    $vData = date("Y-m-d H:i:s");


    if (empty($vAlerta)) {

        if ($dadosForm['login'] != $dadosForm['login_atual']) {

            $usuarios = $conn->query("SELECT id FROM usuarios WHERE usuario='" . $dadosForm['login'] . "'");
                            
                $re = mysqli_fetch_array($usuarios);

                if ($re) {
                    $vAlerta = "<div>O <strong>Login do Usu&aacute;rio</strong> j&aacute; existe no sistema.</div>";

                }
                
            mysqli_free_result($usuarios);

        }
                
    }


    if (empty($vAlerta)) {

        $senha = isset($dadosForm['senha']) ? str_replace('"', "||", str_replace("'", "||", $dadosForm['senha'])) : '';
        $confirmar_senha = isset($dadosForm['confirmar_senha']) ? str_replace('"', "||", str_replace("'", "||", $dadosForm['confirmar_senha'])) : '';

        if ($dadosForm['acao']==="novo") {
            if (strlen($senha) < 6) {

                $vAlerta = "<div>A <strong>Senha</strong> deve ser maior que 5 caracteres.</div>";

            } else if ($senha != $confirmar_senha) {
                
                $vAlerta = "<div>As <strong>Senhas</strong> não conferem. Digite novamente.</div>";

            } else {

                $senha = md5($senha);

            }

        } else {

            if ($senha != $dadosForm['senha_atual']) {

                if (strlen($senha) < 6) {

                    $vAlerta = "<div>A <strong>Senha</strong> deve ser maior que 5 caracteres.</div>";

                } else if ($senha != $confirmar_senha) {
                    
                    $vAlerta = "<div>As <strong>Senhas</strong> não conferem. Digite novamente.</div>";

                } else {

                    $senha = md5($senha);

                }

            } else {
                $senha = $dadosForm['senha_atual'];

            }

        }
                
    }


    if (empty($vAlerta)) {
        
        if ($dadosForm['acao']==="novo") {

            $valores = "'" . $dadosForm['nome'] . "',";
            $valores .= "'" . $dadosForm['login'] . "',";
            $valores .= "'" . $senha . "',";
            $valores .= "'" . $dadosForm['adm'] . "',";
            $valores .= "'" . $dadosForm['ativo'] . "',";
            $valores .= "'" . $vData . "'";

            $campos = "nome, usuario, senha, adm, ativo, data_cad";

            try{

                $conn->query("INSERT INTO usuarios ($campos) VALUES ($valores)");

                $usuarios = $conn->query("SELECT id FROM usuarios 
                            WHERE usuario='" . $dadosForm['login'] . "' 
                            AND data_cad='" .  $vData . "'");
                        
                    $re = mysqli_fetch_array($usuarios);

                    $codigo_usuario = $re['id'];
                    
                mysqli_free_result($usuarios);
                

            } catch (Exception $e) {
                $vAlerta = $e->getMessage();

            }

        } else {

            try{
                
                $where = " WHERE id=" . $dadosForm['id_usuario'];

                $sql = "UPDATE usuarios SET 
                    nome='" . $dadosForm['nome'] . "', 
                    usuario='" . $dadosForm['login'] . "', 
                    senha='" . $senha . "', 
                    adm='" . $dadosForm['adm'] . "', 
                    ativo='" . $dadosForm['ativo'] . "' 
                    $where";

                $conn->query($sql);
                
                $codigo_usuario =  $dadosForm['id_usuario'];


            } catch (Exception $e) {
                $vAlerta = $e->getMessage();

            }

        }


        $query = $conn->query("SELECT * FROM usuarios ORDER BY nome");
      
            while ($re = mysqli_fetch_assoc($query)) {
            
                $dados[] = $re;

            }

        mysqli_free_result($query);

    }
    

} else {

    $query = $conn->query("SELECT * FROM usuarios ORDER BY nome");
      
        while ($re = mysqli_fetch_assoc($query)) {
        
        $dados[] = $re;

        }

    mysqli_free_result($query);

}