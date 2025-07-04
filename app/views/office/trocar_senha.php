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

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="links-voltar">
                    <a href="<?=URL?>/Office/Inicio" class="links"><span>INÍCIO</span></a>
                </div>
                <h2>Trocar Senha</h2>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <br>
                    <form method="post" action="<?=URL?>/Office/Trocar_Senha/Salvar">
                        <input type="hidden" id="acao" name="acao" value="<?=$acao?>">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?=$id_usuario?>">
                        <input type="hidden" id="senha_atual" name="db_senha_atual" value="<?=(isset($dados['senha']) ? $dados['senha'] : '')?>">

                        <div class="form-group mb-3">
                            <label for="tb_senha_atual" class="form-label">Senha Atual:</label>
                            <input name="senha_atual" type="password" maxlength="15" id="tb_senha_atual" class="form-control" required value="<?=(isset($dadosForm['senha_atual']) ? $dadosForm['senha_atual'] : '')?>">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tb_nova_senha" class="form-label">Nova Senha:</label>
                            <input name="nova_senha" type="password" maxlength="15" id="tb_nova_senha" class="form-control" required value="<?=(isset($dadosForm['nova_senha']) ? $dadosForm['nova_senha'] : '')?>" data-toggle="validator">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tb_conf_senha" class="form-label">Confirme a Senha:</label>
                            <input name="confirme_senha" type="password" maxlength="15" id="tb_conf_senha" class="form-control" required value="<?=(isset($dadosForm['confirme_senha']) ? $dadosForm['confirme_senha'] : '')?>" data-match="#tb_nova_senha" data-match-error="Senha não combinam">
                        </div>

                        <div class="mb-3">
                            <?php 
                            if (isset($vAlerta) && !empty($vAlerta)) {
                                echo '<div class="alert alert-danger" role="alert">' . $vAlerta . '</div>';
                            } else if ($salvo) {
                                echo '<div class="alert alert-success" role="alert">Senha Atualizada Com Sucesso!</div>';
                            }
                            ?>
                            
                            <button type="submit" class="btn btn-success btn-lg" style="width: 150px">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>