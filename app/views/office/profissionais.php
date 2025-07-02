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
                </div>
            </div>  
            <div class="row">
                <div class="col-md-6">
                    <h2>Profissionais</h2>
                </div>
                <div class="col-md-6" style="text-align: right">
                    <a href="<?=URL?>/Office/Profissionais/Novo" class="btn btn-primary"><i class="fas fa-plus"></i> Novo Profissional</a>
                </div>
            </div>  
            <br>
            <div class="row">
                <div class="col">
                    
                    <?php
                    if (!empty($dados)) {
                        ?>
                        <div class="table-responsive" style="margin-bottom:15px;">
                            
                            <table class="table table-striped table-bordered table-hover wrap">
                                <thead>
                                    <th>Nome</th>
                                    <th>Sexo</th>
                                    <th>Especialidade</th>
                                    <th>Documento</th>
                                    <th>Data de Nascimento</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($dados AS $dado) { 
                                        ?>
                                        <tr>
                                            <td><?=$dado['nome']?></td>
                                            <td><?=($dado['sexo']==="M" ? "Masculino" : "Feminino")?></td>
                                            <td><?=$dado['especialidade']?></td>
                                            <td><?=$dado['documento_tipo'] . '-' . $dado['documento_numero']?></td>
                                            <td><?=date("d/m/Y", strtotime($dado['data_nascimento']))?></td>
                                        </tr>
                                        <?php 
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 

                    } else {
                        echo '<br><br><br><h5>Nenhum Profissional Cadastrado!</h5>';

                    }
                    ?>

                </div>
            </div>
        </div>
    </body>
</html>