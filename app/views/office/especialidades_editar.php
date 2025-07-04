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
                        <a href="<?=URL?>/Office/Especialidades" class="links"><span>ESPECIALIDADES</span></a> 
                    </div>
                    <h2></h2><br>
                    <h2><?=($acao==="consultar" ? 'Consultar Dados da Especialidade' : ($acao==="alterar" ? 'Atualizar Dados da Especialidade' : 'Cadastrar Nova Especialidade'))?></h2><br>

                </div>
            </div>  
            <div class="row">
                <div class="col">
                    
                    <form method="post" action="<?=URL?>/Office/Especialidades/Salvar">
                        <input type="hidden" id="acao" name="acao" value="<?=$acao?>">
                        <input type="hidden" id="acao" name="id_especialidade" value="<?=$id_especialidade?>">

                        <?php 
                        if ($acao==="consultar" || $acao==="alterar") {
                            ?>
                            <h6 style="margin-bottom: 20px">Código: <span class="text-info"><?=str_pad($id_especialidade, 4, "0", STR_PAD_LEFT)?></span></h6>
                            <?php
                        }
                        ?>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <fieldset<?=($acao==="consultar" ? " disabled" : "")?>>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="especialidade" class="form-label">Nome da Especialidade:</label>
                                            <input type="text" id="especialidade" name="especialidade" class="form-control" value="<?=(isset($dadosForm['especialidade']) ? $dadosForm['especialidade'] : '')?>"/>
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
                                    <a href="<?=URL?>/Office/Especialidades/Editar&idu=<?=codigoHash($id_usuario)?>&ide=<?=codigoHash($id_especialidade)?>&acao=alterar" class="btn btn-primary">Alterar Dados</a>
                                    <a href="<?=URL?>/Office/Especialidades&idu=<?=codigoHash($id_usuario)?>" class="btn btn-secondary">Voltar</a>
                                    <?php

                                } else if($acao==="novo" || $acao==="alterar") {
                                    ?>
                                    <input type="submit" class="btn btn-success btn-lg" value="Salvar Dados"/>
                                    <a href="<?=URL?>/Office/Especialidades&idu=<?=codigoHash($id_usuario)?>" class="btn btn-secondary btn-lg">Voltar</a>
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