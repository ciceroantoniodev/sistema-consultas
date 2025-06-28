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
                        <a href="<?=URL?>/Office/Usuarios&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="links"><span>USUÁRIOS</span></a>
                    </div>
                    <h2>Tarifas</h2>
                </div>
            </div>  
            <div class="row mb-3">
                <div class="col">  
                    <button id="addtrfValores" class="btn btn-primary btn-sm" type="button"> <i class="fa fa-plus"></i> Adicionar Tarifa </button>
                    <?php 
                    if(!empty($dados)){ 
                        ?>
                        <button id="rmvtrfValores" class="btn btn-danger btn-sm" type="button"> <i class="fa fa-minus"></i> Remover Tarifa </button>
                        <?php 
                    } 
                    ?>
                </div>  
            </div>  
            <div class="row">
                <div class="col">

                    <div class="table-responsive" style="margin-bottom:15px;">

                        <?php
                        if(!empty($dados)){
                            ?>
                            <table id="dvcs" class="table table-striped table-bordered table-hover wrap">
                                <thead>
                                    <tr>
                                        <th width='1%'><input type="checkbox" class="select_all_trf"></th>
                                        <th width=''>Nome</th>
                                        <th width=''>T. Agenda</th>
                                        <th width=''>T. Filtro</th>
                                        <th width=''>T. Sender</th>
                                        <th width=''>T. Desbanimento</th>
                                        <th width=''>Entrada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($dados as $l) { 
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" class="cxs cx_one_trf" name="cx_trf" value="<?php echo $l['codigo'];?>" ></td>
                                            <td><span class="nometrf"><?php echo htmlentities(htmlspecialchars($l['nome'])); ?></span></td>
                                            <td><?php echo htmlentities(htmlspecialchars(formataDinheiro($l['vlr_unitario_agenda'],2))); ?></td>
                                            <td><?php echo htmlentities(htmlspecialchars(formataDinheiro($l['vlr_unitario_filtro'],3))); ?></td>
                                            <td><?php echo htmlentities(htmlspecialchars(formataDinheiro($l['vlr_unitario_sender'],3))); ?></td>
                                            <td><?php echo htmlentities(htmlspecialchars(formataDinheiro($l['vlr_unitario_desbanimento'],3))); ?></td>
                                            <td><?php echo htmlentities(htmlspecialchars(formataData($l['dh_entrada'],true,false)));?></td>
                                        </tr>
                                        <?php 
                                    } 
                                    ?>
                                </tbody>
                            </table>
                            <?php 
                            
                        } else {
                            ?> 
                            <p class="h3 text-center">Sem Tarifas.</p> 
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
