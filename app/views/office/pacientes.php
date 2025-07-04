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
                    <h2>Pacientes</h2>
                </div>
                <div class="col-md-6" style="text-align: right">
                    <a href="<?=URL?>/Office/Pacientes/Novo" class="btn btn-primary"><i class="fas fa-plus"></i> Novo Paciente</a>
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
                                    <th>Data Nascimento</th>
                                    <th>Contato</th>
                                    <th>Cidade</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($dados AS $dado) { 
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?=URL?>/office/Pacientes/Editar&idu=<?=codigoHash($id_usuario)?>&idp=<?=codigoHash($dado['id'])?>&acao=consultar" class="links">
                                                    <?=$dado['nome']?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=URL?>/office/Pacientes/Editar&idu=<?=codigoHash($id_usuario)?>&idp=<?=codigoHash($dado['id'])?>&acao=consultar" class="links">
                                                    <?=date("d/m/Y", strtotime($dado['data_nascimento']))?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=URL?>/office/Pacientes/Editar&idu=<?=codigoHash($id_usuario)?>&idp=<?=codigoHash($dado['id'])?>&acao=consultar" class="links">
                                                    <?=$dado['telefone']?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=URL?>/office/Pacientes/Editar&idu=<?=codigoHash($id_usuario)?>&idp=<?=codigoHash($dado['id'])?>&acao=consultar" class="links">
                                                    <?=$dado['cidade'] . '/' . $dado['estado']?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 

                    } else {
                        echo '<br><br><br><h5>Nenhum Paciente Cadastrado!</h5>';

                    }
                    ?>

                </div>
            </div>
        </div>
    </body>
</html>