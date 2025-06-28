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
                    <form role="form" data-toggle="validator" method="post" id="form_editarSenha">
                        <input value="editaSenhaUser" name="action" hidden>
                        <div class="form-group mb-3">
                            <label for="tb_senha_atual" class="form-label">Senha Atual:</label>
                            <input name="tb_senha_atual" type="password" maxlength="15" id="tb_senha_atual" class="form-control" required value="">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tb_nova_senha" class="form-label">Nova Senha:</label>
                            <input name="tb_nova_senha" type="password" maxlength="15" id="tb_nova_senha" class="form-control" required value="" data-toggle="validator">
                        </div>
                        <div class="form-group mb-3">
                            <label for="tb_conf_senha" class="form-label">Confirme a Senha:</label>
                            <input name="tb_conf_senha" type="password" maxlength="15" id="tb_conf_senha" class="form-control" required value="" data-match="#tb_nova_senha" data-match-error="Senha não combinam">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success btn-lg" style="width: 150px">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>