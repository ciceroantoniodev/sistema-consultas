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
                        <a href="<?=URL?>/Office/Usuarios&idu=<?=codigoHash($id_usuario)?>" class="links"><span>USU&Aacute;RIOS</span></a> 
                    </div>
                    <h2><?=($acao==="consultar" ? 'Consultar Dados do Usu&aacute;rio' : ($acao==="alterar" ? 'Atualizar Dados do Usu&aacute;rio' : 'Cadastrar Novo Usu&aacute;rio'))?></h2><br>
                </div>
            </div>  
            <div class="row">
                <div class="col">
                    
                    <form method="post" action="<?=URL?>/Office/Usuarios/Salvar">
                        <input type="hidden" id="acao" name="acao" value="<?=$acao?>">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?=$codigo_usuario?>">
                        <input type="hidden" id="login_atual" name="login_atual" value="<?=(isset($dadosForm['usuario']) ? $dadosForm['usuario'] : '')?>">
                        <input type="hidden" id="senha_atual" name="senha_atual" value="<?=(isset($dadosForm['senha']) ? $dadosForm['senha'] : '')?>">

                        <?php 
                        if ($acao==="consultar" || $acao==="alterar") {
                            ?>
                            <h6 style="margin-bottom: 20px">Código: <span class="text-info"><?=str_pad($codigo_usuario, 3, "0", STR_PAD_LEFT)?></span></h6>
                            <?php
                        }
                        ?>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <fieldset<?=($acao==="consultar" ? " disabled" : "")?>>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="nome" class="form-label">Nome do Usu&aacute;rio:</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="<?=(isset($dadosForm['nome']) ? $dadosForm['nome'] : '')?>"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="login" class="form-label">Login do Usu&aacute;rio:</label>
                                            <input type="text" id="login" name="login" class="form-control" value="<?=(isset($dadosForm['usuario']) ? $dadosForm['usuario'] : '')?>"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="senha" class="form-label">Senha do Usu&aacute;rio:</label>
                                            <input type="password" id="senha" name="senha" class="form-control" value="<?=(isset($dadosForm['senha']) ? $dadosForm['senha'] : '')?>"/>
                                        </div>
                                        <div class="col">
                                            <label for="confirmar_senha" class="form-label">Confirmar Senha:</label>
                                            <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-control" value="<?=(isset($dadosForm['senha']) ? $dadosForm['senha'] : '')?>"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="adm" class="form-label">Administrador:</label><br>
                                            <input type="radio" name="adm" id="adm" value="S" <?=(isset($dadosForm['adm']) ? ($dadosForm['adm']==="S" ? 'checked' : '') : '')?> /> SIM&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="adm" value="N" <?=(isset($dadosForm['adm']) ? ($dadosForm['adm']==="N" ? 'checked' : '') : '')?> /> N&Atilde;O
                                        </div>
                                        <div class="col">
                                            <label for="ativo" class="form-label">Ativo:</label><br>
                                            <input type="radio" name="ativo" id="ativo" value="S" <?=(isset($dadosForm['ativo']) ? ($dadosForm['ativo']==="S" ? 'checked' : '') : '')?> /> SIM&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="ativo" value="N" <?=(isset($dadosForm['ativo']) ? ($dadosForm['ativo']==="N" ? 'checked' : '') : '')?> /> N&Atilde;O
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
                                    <a href="<?=URL?>/Office/Usuarios/Editar&idu=<?=codigoHash($id_usuario)?>&ida=<?=codigoHash($codigo_usuario)?>&acao=alterar" class="btn btn-primary">Alterar Dados</a>
                                    <a href="<?=URL?>/Office/Usuarios&idu=<?=codigoHash($id_usuario)?>" class="btn btn-secondary">Voltar</a>
                                    <?php

                                } else if($acao==="novo" || $acao==="alterar") {
                                    ?>
                                    <input type="submit" class="btn btn-success btn-lg" value="Salvar Dados"/>
                                    <a href="<?=URL?>/Office/Usuarios&idu=<?=codigoHash($id_usuario)?>" class="btn btn-secondary btn-lg">Voltar</a>
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