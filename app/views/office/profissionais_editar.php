<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Trocar Senha</title>

        <!-- Bootstrap -->
        <link href="<?=URL?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/fontawesome.min.css">

        <link rel="stylesheet" type="text/css" href="<?=URL?>/app/views/office/assets/css/style_index_01.css"/>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="links-voltar">
                        <a href="<?=URL?>/Office/Inicio" class="links"><span>INÍCIO</span></a> | 
                        <a href="<?=URL?>/Office/Profissionais" class="links"><span>PROFISSIONAIS</span></a> 
                    </div>
                    <h2>Cadastrar Novo Profissional</h2><br>
                </div>
            </div>  
            <div class="row">
                <div class="col">
                    
                    <form method="post" action="<?=URL?>/Office/Profissionais/Salvar">
                        <input type="hidden" id="acao" name="acao" value="<?=$acao?>">

                        <?php 
                        if ($acao==="consultar" || $acao==="alterar") {
                            ?>
                            <h6 style="margin-bottom: 20px">Código: <span class="text-info"><?=$dados['codigo']?></span></h6>
                            <?php
                        }
                        ?>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <fieldset<?=($acao==="consultar" ? " disabled" : "")?>>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="nome" class="form-label">Nome do Profissional:</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="<?=(isset($dadosForm['nome']) ? $dadosForm['nome'] : '')?>"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="data_nasc" class="form-label">Data de Nascimento:</label>
                                            <input type="date" id="data_nasc" name="data_nasc" class="form-control" value="<?=(isset($dadosForm['data_nasc']) ? $dadosForm['data_nasc'] : '')?>" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="sexo" class="form-label">Sexo:</label>
                                            <select name="sexo" id="sexo" class="form-select">
                                                <option value="">...</option>
                                                <option value="M"<?=(isset($dadosForm['sexo']) && $dadosForm['sexo']==="M" ? ' selected' : '')?>>MASCULINO</option>
                                                <option value="F"<?=(isset($dadosForm['sexo']) && $dadosForm['sexo']==="F" ? ' selected' : '')?>>FEMININO</option>
                                                <option value="O"<?=(isset($dadosForm['sexo']) && $dadosForm['sexo']==="O" ? ' selected' : '')?>>OUTRO</option>
                                            </select>
                                        </div>
                                    </div>                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="documento_tipo" class="form-label">Tipo de Documento:</label>
                                            <select name="documento_tipo" id="documento_tipo" class="form-select">
                                                <option value="">...</option>
                                                <option value="CRM"<?=(isset($dadosForm['documento_tipo']) && $dadosForm['documento_tipo']==="CRM" ? ' selected' : '')?>>CRM</option>
                                                <option value="RQE"<?=(isset($dadosForm['documento_tipo']) && $dadosForm['documento_tipo']==="RQE" ? ' selected' : '')?>>RQE</option>
                                                <option value="CNH"<?=(isset($dadosForm['documento_tipo']) && $dadosForm['documento_tipo']==="CNH" ? ' selected' : '')?>>CNH</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="documento_numero" class="form-label">N&uacute;mero do Documento:</label>
                                            <input type="text" id="documento_numero" name="documento_numero" class="form-control" value="<?=(isset($dadosForm['data_nasc']) ? $dadosForm['data_nasc'] : '')?>" />
                                        </div>
                                    </div>                    
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="especialidade" class="form-label">Especialidade:</label>
                                            <select name="especialidade" id="especialidade" class="form-select">
                                                <option value="">...</option>
                                                <?php 
                                                foreach ($especialidades AS $dado) {
                                                    echo '<option value="' . $dado['Id'] . '">' . $dado['Especialidade'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                
                                <?php 
                                if (isset($vAlerta) && !empty($vAlerta)) {
                                    echo '<div class="alert alert-danger" role="alert">' . $vAlerta . '</div>';
                                }
                                ?>

                                <?php
                                if ($acao==="consultar") {
                                    ?>
                                    <a href="<?=URL?>/Office/Usuarios/Editar&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>&cod=<?=codigoHash($codigo_usuario)?>&acao=alterar" class="btn btn-primary">Alterar Dados</a>
                                    <button type="button" class="btn btn-danger" >Bloquear</button>
                                    <button type="button" class="btn btn-warning" >Resetar Senha</button>
                                    <button type="button" class="btn btn-info" >Reenviar Validação</button>
                                    <a href="<?=URL?>/Office/Usuarios&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="btn btn-secondary">Voltar</a>
                                    <?php

                                } else if($acao==="novo" || $acao==="alterar") {
                                    ?>
                                    <input type="submit" class="btn btn-success btn-lg" value="Salvar Dados"/>
                                    <a href="<?=URL?>/Office/Usuarios&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="btn btn-secondary btn-lg">Voltar</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                    </form>                    

                </div>
            </div>
        </div>
    </body>
</html>