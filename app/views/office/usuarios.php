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
                    <h2>Usuários</h2>
                </div>
            </div>  
            <div class="row mb-3">
                <div class="col">  
                    <a href="<?=URL?>/office/usuarios/novo&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="btn btn-primary btn-sm"><i class="fas fa-user"></i> Novo Usuário</a>
                    <a href="<?=URL?>/office/usuarios/novo&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Adicionar Bulk Usuários</a>
                    <a href="<?=URL?>/office/tarifas&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>" class="btn btn-info btn-sm text-white"><i class="fas fa-file-invoice-dollar"></i> Tarifas</a>
                </div>  
            </div>  
            <div class="row">
                <div class="col">

                    <div class="table-responsive" style="margin-bottom:15px;">
                        <table id="users" class="table table-hover table-striped table-bordered wrap" style="margin-bottom:0px;">
                            <thead class="bg-secondary text-white">
                                <tr style="text-transform: uppercase;">
                                    <th>Cod</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Celular</th>
                                    <th>Entrada</th>
                                    <th>Validação</th>
                                    <th>Saldo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dados as $dado) {
                                    $qtdAdiant = 0;
                                    ?>
                                    <tr <?=($dado['mestre']==='S') ? 'class="table-info"' : ($dado['cod_status']==='P' ? 'class="bg-success text-white"' : '')?> <?=($dado["cod_status"]==='B' ? 'style="color:red;font-weight: bold;"' : '')?>>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>">
                                        <input type="hidden" name="i" id="i" value="<?=$dado["codigo"]?>">
                                        <a href="<?=URL?>/office/usuarios/editar&rv=<?=codigoHash($revenda)?>&idu=<?=codigoHash($id_user)?>&cod=<?=codigoHash($dado["codigo"])?>&acao=consultar" class="menu" title="Editar Usuário"<?=($dado['cod_status']==='P' ? ' style="color: #ffffff"' : '')?>>                                            
                                            <span class="cod"><?php echo $dado["codigo"];?></span>
                                        </a>
                                        <?php
                                        /*
                                        <div class="dropdown">
                                        <a data-toggle="dropdown" role="button" href="#" class="btn btn-primary dropdown-toggle"> <span class="cod"><?php echo $dado["codigo"];?></span> <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <?php if($dado["cod_status"] !== 'B'){ ?>
                                            <li role="presentation"><a class="editaUser" data-toggle="dropdown" href="#" onclick="">Editar</a></li>
                                            <?php if($dado["mestre"] !== 'S'){ ?>
                                            <li role="presentation"><a class="bloqueioUser" data-toggle="dropdown" href="#" onclick="">Bloquear</a></li>
                                            <li role="presentation"><a class="reseteSenhaUser" data-toggle="dropdown" href="#" onclick="">Resetar Senha para 123456</a></li>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <li role="presentation"><a class="desbloqueioUser" data-toggle="dropdown" href="#" onclick="">Desbloquear</a></li>
                                            <?php } ?>
                                            <?php if($dado["cod_status"] === 'P'){ ?>
                                            <li role="presentation"><a class="reenviarEmail" data-toggle="dropdown" href="#" onclick="">Reenviar Validação</a></li>
                                            <?php } ?>
                                            <?php if($dado["mestre"] !== 'S' && $dado["cod_status"] === 'T'){ ?>
                                            <li role="presentation"><a class="addCredito" data-toggle="dropdown" href="#" onclick="">Adicionar Crédito</a></li>
                                            <?php } ?>
                                        </ul>
                                        </div>
                                        */
                                        ?>
                                    </td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>"><?=$dado["nome"]?></td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>"><?=$dado["email"]?></td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>"><?=formataCelular($dado["celular"])?></td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>"><?=(!empty($dado["dh_entrada"]) ? date("d/m/Y", strtotime($dado["dh_entrada"])) : '' )?></td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>"><?=(!empty($dado["dh_validacao"]) ? date("d/m/Y", strtotime($dado["dh_validacao"])) : '' )?></td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>" style="text-align: right">R$ <?=formataDinheiro($dado["saldo"],2)?></td>
                                    <td class="<?=($dado['cod_status']==='P' ? 'text-white' : ($dado['cod_status']==='B' ? 'text-danger' : 'text-dark'))?>"><?=($dado['cod_status']==='P' ? "Valida&ccedil;&atilde;o" : ($dado['cod_status']==='T' ? "Validado" : "Bloqueado"))?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="numeracao">
                        <?php echo echoNumeracao($quantidade_pag-$dadoinhas, $quantidade_pag_real, $dadoinhas_parte, 0); ?>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class='pull-right' >
                        <div class="paginacaousers"  >
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('.paginacaousers').html(paginacaoGenerica("muda",<?php echo $dadoinhas_parte.','.$dadoinhas.','.$pag_atl.','.$pag_final ?>));

            $('.table-responsive').on('show.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "inherit" );
            });
            $('.table-responsive').on('hide.bs.dropdown', function () {
                $('.table-responsive').css( "overflow", "auto" );
            });

            $('.paginacaousers').on("click", "a.muda", function(e){
                e.preventDefault();
                let linhas = <?php echo $dadoinhas; ?>;
                let pag_atl = parseInt(e.target.id);
                let x = pag_atl * linhas;

                $('.listaUsers').html($dadooadpage).load('userList.php',{
                    tipo : $("#usuarios").val().trim(),
                    pesquisa : $("#pesquisaUsuario").val().trim(),
                    offset : (x-linhas),
                    limit : linhas,
                    pagatual : pag_atl
                });
                return false;      
            });
        </script>

    </body>
</html>