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
                        <a href="<?=URL?>/Office/Agenda&idu=<?=codigoHash($id_usuario)?>" class="links"><span>AGENDA</span></a>
                    </div>
                    <h2><?=($acao==="consultar" ? "Consultar Dados do Agendamento" : ($acao==="alterar" ? "Atualizar Dados do Agendamento" : 'Cadastrar Novo Agendamento'))?></h2><br>
                </div>
            </div>  
            <div class="row">
                <div class="col">
                    
                    <form method="post" action="<?=URL?>/Office/Agendamento/Salvar">
                        <input type="hidden" name="acao" value="<?=$acao?>">
                        <input type="hidden" name="id_agenda" value="<?=$codigo_agenda?>">

                        <?php 
                        if ($acao==="consultar" || $acao==="alterar") {

                            if ($dados['data_agendamento'] < date("Y-m-d")) {
                                echo '<input type="hidden" name="agendamento_vencido" value="sim">';

                            }

                            ?>
                            <h6 style="margin-bottom: 20px">Código: <span class="text-info"><?=str_pad($dados['id'], 5, "0", STR_PAD_LEFT)?></span></h6>
                            <?php
                        }
                        ?>

                        <div class="row mb-3">
                            <div class="col-md-6">

                                <fieldset<?=($acao==="consultar" ? " disabled" : ($acao==="alterar" && $dados['data_agendamento'] < date("Y-m-d") ? ' disabled' : ''))?>>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="paciente" class="form-label">Nome do Paciente:</label>
                                            <?php 
                                            if ($acao==="consultar" || $acao==="alterar" ) {
                                                ?>
                                                <div class="form-control bg-light" style="text-transform: uppercase"><?=$dados['nome']?></div>
                                                <?php

                                            } else {
                                                ?>
                                                <select name="paciente" id="paciente" class="form-select" required>
                                                    <option value="">...</option>
                                                    <?php 
                                                    foreach ($pacientes AS $paciente) {
                                                        echo '<option value="' . $paciente['id']. '">' . $paciente['nome'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <?php 
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="data_agendamento" class="form-label">Data do Agendamento:</label>
                                            <input 
                                                type="date" 
                                                id="data_agendamento" 
                                                name="data_agendamento" 
                                                min="<?=date("Y-m-d")?>" 
                                                class="form-control" 
                                                value="<?=(isset($dados['data_agendamento']) ? $dados['data_agendamento'] : '')?>" 
                                                required 
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="hora_agendamento" class="form-label">Horário do Agendamento:</label>
                                            <input 
                                                type="time" 
                                                id="hora_agendamento" 
                                                name="hora_agendamento" 
                                                min="07:30" 
                                                class="form-control" 
                                                value="<?=(isset($dados['hora_agendamento']) ? $dados['hora_agendamento'] : '')?>" 
                                                required 
                                            />
                                        </div>
                                    </div>                    
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="profissional" class="form-label">Profissional Médico:</label>
                                            <select name="profissional" id="profissional" class="<?=($acao==="consultar" ? 'form-control' : 'form-select')?>" required>
                                                <option value="">...</option>
                                                <?php 
                                                foreach ($profissionais AS $profissional) {
                                                    echo '<option value="' . $profissional['id'] . '"' . ($profissional['id']===$dados['id_profissional'] ? ' selected' : '') .'>' . $profissional['nome'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="agendamento_tipo" class="form-label">Agendamento do Tipo:</label>
                                            <select name="agendamento_tipo" id="agendamento_tipo" class="<?=($acao==="consultar" ? 'form-control' : 'form-select')?>" required>
                                                <option value="">Selecione uma opção...</option>
                                                <option value="consulta"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="consulta" ? ' selected': '') : '')?>>Consulta Médica</option>
                                                <option value="retorno"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="retorno" ? ' selected': '') : '')?>>Retorno de Consulta</option>
                                                <option value="exame"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="exame" ? ' selected': '') : '')?>>Exame</option>
                                                <option value="coleta"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="coleta" ? ' selected': '') : '')?>>Coleta de Exames</option>
                                                <option value="triagem"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="triagem" ? ' selected': '') : '')?>>Triagem</option>
                                                <option value="vacina"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="vacina" ? ' selected': '') : '')?>>Vacinação</option>
                                                <option value="procedimento"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="procedimento" ? ' selected': '') : '')?>>Procedimento Ambulatorial</option>
                                                <option value="telemedicina"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="telemedicina" ? ' selected': '') : '')?>>Consulta por Telemedicina</option>
                                                <option value="orientacao"<?=(isset($dados['tipo_agendamento']) ? ($dados['tipo_agendamento']==="orientacao" ? ' selected': '') : '')?>>Orientação/Enfermagem</option>
                                            </select>

                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset<?=($acao==="consultar" ? " disabled" : "")?>>
                                    <label for="obs" class="form-label">Observa&ccedil;&atilde;o:</label>
                                    <textarea name="obs" id="obs" rows="8" class="form-control"><?=(($dados['obs']) ?? '')?></textarea>
                                    
                                    <?php 
                                    if ($acao==="consultar" || $acao==="alterar") {
                                        ?>
                                        <br><label for="status" class="form-label">STATUS:</label>
                                        <select name="status" id="status" class="<?=($acao==="consultar" ? 'form-control' : 'form-select')?>" required>
                                            <option value="aberto"<?=(isset($dados['status']) ? ($dados['status']==="aberto" ? ' selected': '') : '')?>>EM ABERTO</option>
                                            <option value="cancelado"<?=(isset($dados['status']) ? ($dados['status']==="cancelado" ? ' selected': '') : '')?>>AGENDAMENTO CANCELADO</option>
                                            <option value="atendido"<?=(isset($dados['status']) ? ($dados['status']==="atendido" ? ' selected': '') : '')?>>PACIENTE ATENDIDO</option>
                                        </select>
                                        <?php

                                    }
                                    ?>
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
                                    
                                    if ($dados['status']==="aberto") {
                                        ?>
                                        <a href="<?=URL?>/Office/Agendamento&idu=<?=codigoHash($id_usuario)?>&ida=<?=codigoHash($codigo_agenda)?>&acao=alterar" class="btn btn-primary">Atualizar Dados</a>
                                        <?php
                                    }
                                    ?>

                                    <a href="<?=URL?>/Office/Agenda&idu=<?=codigoHash($id_usuario)?>" class="btn btn-secondary">Voltar Para Agenda</a>
                                    <?php

                                } else if($acao==="novo" || $acao==="alterar") {
                                    ?>
                                    <input type="submit" class="btn btn-success btn-lg" value="Salvar Dados"/>
                                    <a href="<?=URL?>/Office/Agenda&idu=<?=codigoHash($id_usuario)?>" class="btn btn-secondary btn-lg">Voltar Para Agenda</a>
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