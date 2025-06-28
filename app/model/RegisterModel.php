<?php 

require_once( LOCAL . '/app/config/includes/database.php');


$verificaEmail = $database->queryNovo("SELECT email FROM usuario WHERE email = ? ; ",[$formDados['email']],"assoc");

if (empty($verificaEmail)) {
    
    $cfg_id_revenda = 1;
    $vagenda = null;
    $vfiltro = null;
    $vsender = null;
    $vdesban = null;

    $sql = "exec usuarioIAE 'I', ?, null, ?, ?, null, ?, ?, ?, ?, ? ; ";
    $sqlDados = [$cfg_id_revenda,$formDados['name'],$formDados['email'],$formDados['contact'],$vagenda,$vfiltro,$vsender,$vdesban];
$rows = $database->queryNovo($sql, $sqlDados, "getAll");

var_dump($rows);

/*
    try {
    $rows = $database->queryNovo($sql, $sqlDados, "getAll");
    $tempresul = retornaStringQueryAll($rows);
    if(str_contains(strtolower($tempresul),'erro')) {
        $errRetorno = retornaStringQueryErro($rows,'erro');
        if(str_contains(strtolower($errRetorno),'email')){
        echoErroUtf8($errRetorno.". Linha: ".strval($contFor+1));
        exit;
        }

        echoErroUtf8("Erro no banco. Verifique as informações da linha ".strval($contFor+1));
        exit;
    } else {
        $valores2 = $database->queryNovo("SELECT codigo,email,token_validacao,cod_status,senha from usuario(nolock) 
                                        WHERE cod_status = 'P' AND dh_validacao is null AND id_revenda = ?
                                        AND nome = ? AND email = ? AND celular = ? ORDER by codigo desc",[$cfg_id_revenda, $nome, $email, $celular],"assoc");
        if(!empty($valores2)){
        if($valores2['cod_status']==='P'){
            include_once(__DIR__."/../../includes/mods/mailgf.php");
            $enviar = new EmailGF();
            $enviar->envioNovaConta($valores2["email"], $valores2["token_validacao"], $valores2["senha"]);
        }
        }
    }

    $totalAfetados++;
    } catch (Exception $errD){
    $errorDel = true;
    break;
    }
    */
}
