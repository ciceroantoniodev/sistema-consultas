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
                        <a href="<?=URL?>/Office/Inicio" class="links"><span>INÍCIO</span></a>
                    </div>
                    <h2>Agendamento</h2><br>
                </div>
            </div>  
            <div class="row">
                <div class="col">
                    
                    <form method="post" action="<?=URL?>/Office/Pacientes/Salvar">
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
                                            <label for="nome" class="form-label">Nome do Paciente:</label>
                                            <select name="paciente" class="form-select">
                                                <option value="">...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="data_nasc" class="form-label">Data do Agendamento:</label>
                                            <input type="date" id="data_nasc" name="data_nasc" class="form-control" value="<?=(isset($dadosForm['data_nasc']) ? $dadosForm['data_nasc'] : '')?>" />
                                        </div>
                                    </div>                    
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="data_nasc" class="form-label">Horário do Agendamento:</label>
                                            <input type="time" id="data_nasc" name="data_nasc" class="form-control" value="<?=(isset($dadosForm['data_nasc']) ? $dadosForm['data_nasc'] : '')?>" />
                                        </div>
                                    </div>                    
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="nome" class="form-label">Profissional do Atendimento:</label>
                                            <select name="paciente" class="form-select">
                                                <option value="">...</option>
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