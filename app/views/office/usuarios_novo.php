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

    <link rel="stylesheet" type="text/css" href="<?=URL?>/app/views/office/assets/css/style_index_01.css"/>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="links-voltar">
                    <a href="<?=URL?>/Office/Inicio" class="links"><span>INÍCIO</span></a> | 
                    <a href="<?=URL?>/Office/Usuarios&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="links"><span>USUÁRIOS</span></a>
                </div>
                <h2><?=($acao==="consultar" ? "Consultar Dados do Usuário" : ($acao==="alterar" ? "Alterar Dados do Usuário" : "Novo Usuário"))?></h2>
                <div>&nbsp;</div>
            </div>
        </div>

        <form method="post" action="<?=URL?>/app/controllers/UsuarioController.php">
            <input type="hidden" id="iu" name="iu" value="<?=(isset($dados['codigo']) ? $dados['codigo'] : '0')?>">

            <div class="row">
                <div class="col">
                    <span class='mensagemtipo'></span>
                </div>
            </div>
            
            <input type="hidden" id="acao" name="acao" value="<?=$acao?>">
            <input type="hidden" id="revenda" name="revenda" value="<?=($revenda>0 ? codigoHash($revenda) : '0')?>">
            <input type="hidden" id="id_user" name="id_user" value="<?=($id_user>0 ? codigoHash($id_user) : '0')?>">
            <input type="hidden" id="codigo_usuario" name="codigo_usuario" value="<?=($dados['codigo']>0 ? codigoHash($dados['codigo']) : '0')?>">

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
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" id="nome" name="nome" class="form-control" value="<?=(isset($dados['nome']) ? $dados['nome'] : '')?>"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="celular" class="form-label">Celular:</label>
                                <input type="text" id="celular" name="celular" class="form-control" value="<?=(isset($dados['celular']) ? $dados['celular'] : '')?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="email" class="form-label">E-mail:</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?=(isset($dados['email']) ? $dados['email'] : '')?>"/>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">&nbsp;</label>
                    <?php 
                    if($dados['mestre'] !== 'S'){

                        if($tarifasOptions !== ""){ 
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <fieldset<?=($acao==="consultar" ? " disabled" : "")?>>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="tarifa" class="form-label">Tarifas Salvas:</label>
                                                <select name="tarifa" id="tarifa" class="form-select">
                                                    <option value="<?=formataDinheiro($dados['valor_unitario_agenda'],2).";".formataDinheiro($dados['valor_unitario_filtro'],3).";".formataDinheiro($dados['valor_unitario_sender'],3).";".formataDinheiro($dados['valor_unitario_desbanimento'],3)?>">Tarifa atual</option>
                                                    <?php 
                                                    foreach($tarifasOptions as $l) {
                                                        echo $l;
                                                    } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="form-group col-sm-3">
                                                        <label for="nome" style="font-size:14px;">Valor Unitário Agenda:</label>
                                                        <input type="text" id="unitarioagenda" name="unitarioagenda" value= "<?=formataDinheiro(($dados['valor_unitario_agenda']),2)?>" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="nome" style="font-size:14px;">Valor Unitário Filtro:</label>
                                                        <input type="text" id="unitariofiltro" name="unitariofiltro" value= "<?=formataDinheiro(($dados['valor_unitario_filtro']),3)?>" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="nome" style="font-size:14px;">Valor Unitário Sender:</label>
                                                        <input type="text" id="unitariosender" name="unitariosender" value= "<?=formataDinheiro(($dados['valor_unitario_sender']),3)?>" class="form-control"/>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="nome" style="font-size:14px;">Valor Unitário Desbanimento:</label>
                                                        <input type="text" id="unitariodesbanimento" name="unitariodesbanimento" value= "<?=formataDinheiro(($dados['valor_unitario_desbanimento']),3)?>" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <?php 

                        } else { 
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="row">
                                                <div class="form-group col-sm-3">
                                                    <label for="nome" class="form-label">Valor Unitário Agenda:</label>
                                                    <input type="text" id="unitarioagenda" name="unitarioagenda" value= "<?=formataDinheiro(($valores['vlr_unitario_agenda']),2)?>" class="form-control"/>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label for="nome" class="form-label">Valor Unitário Filtro:</label>
                                                    <input type="text" id="unitariofiltro" name="unitariofiltro" value= "<?=formataDinheiro(($valores['vlr_unitario_filtro']),3)?>" class="form-control"/>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label for="nome" class="form-label">Valor Unitário Sender:</label>
                                                    <input type="text" id="unitariosender" name="unitariosender" value= "<?=formataDinheiro(($valores['vlr_unitario_sender']),3)?>" class="form-control"/>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label for="nome" class="form-label">Valor Unitário Desbanimento:</label>
                                                    <input type="text" id="unitariodesbanimento" name="unitariodesbanimento" value= "<?=formataDinheiro(($valores['vlr_unitario_desbanimento']),3)?>" class="form-control"/>
                                                </div>
                                            </div>      
                                        </div>      
                                    </div>      
                                </div>      
                            </div>      
                            <?php 
                        } 
                    } 
                    ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
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

            <script>
                $('#celular').mask('(99)99999-9999');
                
                <?php 
                if($dados['mestre'] !== 'S'){ 
                    ?>
                    var settsmoney = {
                        thousands: '.',
                        decimal: ',',
                        allowZero: false,
                        allowNegative: true,
                        precision: 2
                    };
                    var settsmoney2 = {
                        thousands: '.',
                        decimal: ',',
                        allowZero: false,
                        allowNegative: true,
                        precision: 3
                    };
                    $('#unitarioagenda').maskMoney(settsmoney);
                    $('#unitariofiltro').maskMoney(settsmoney2);
                    $('#unitariosender').maskMoney(settsmoney2);
                    $('#unitariodesbanimento').maskMoney(settsmoney2);
                    $("#tarifa").on('change', function(){
                        if(this.value){
                            let tfs = this.value.split(";");
                            $('#unitarioagenda').val(tfs[0]);
                            $('#unitariofiltro').val(tfs[1]);
                            $('#unitariosender').val(tfs[2]);
                            $('#unitariodesbanimento').val(tfs[3]);
                        }
                    });
                    <?php 
                } 
                ?>
            </script>
        </form>
    </div>

</body>

</html>