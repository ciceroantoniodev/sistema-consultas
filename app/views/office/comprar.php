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
                    <h2>Comprar</h2>
                </div>
            </div>  
            <div class="row">
                <div class="col">

                    <div class="table-responsive" style="margin-bottom:15px;">

                        <div class="container-fluid">
                            <div class="row">
                                <h2>
                                    Financeiro - Saldo: <?php echo "R$ ". ((floatval($cfg_saldo)<=0.0) ? '<font color="red">'.formataDinheiro($cfg_saldo,2).'</font>' : formataDinheiro($cfg_saldo,2));?> <br>
                                    Total Adiantamento: <?php echo "R$ ". formataDinheiro($qtdAdiant,2);?>
                                </h2>
                            </div>
                            <?php 
                            if (!empty($dados)){ 
                                ?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-striped table-bordered wrap" style="margin-bottom:10px;margin-top:10px;">
                                            <tbody>
                                                <td width='1%' style="font-size:20px;">Pix: </td>
                                                <td style="font-size:20px;"><?php echo nl2br(htmlentities($dados['pix'])); ?></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php 
                            } 
                            ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="frm" role="form" data-toggle="validator" method="post">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-sm-3 baixo">
                                            <div class="input-group">
                                                <label for="s" class="input-group-addon"> Status</label>
                                                <select name="s" id="s" class="form-select" >
                                                    <option value="" selected> Todos</option>
                                                    <option value="1"> Crédito</option>
                                                    <option value="2"> Débito</option>
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="row fbody">
<?php
if(!empty($dados)){
?>
<div class="col-sm-12" style='margin-top:10px;'>
  <div class="table-responsive" style="margin-bottom:15px;">
    <table id="nmrs" class="table table-striped table-bordered table-hover wrap" style="margin-bottom:0px;">
      <thead>
        <th width='20%'>Data entrada</th>
        <th width='1%'>Débito</th>
        <th width='1%'>Crédito</th>
        <th width=''>Descrição</th>
      </thead>
      <tbody>
          <?php 
          foreach ($dados as $l) { 
            ?>
            <tr>
              <td> <?php echo htmlentities(formataData($l['dh_entrada'],true,false));?> </td>
              <td> <?php echo htmlentities(($l['tipo'] === 'D') ? formataDinheiro($l['valor']) : '');?> </td>
              <td> <?php echo htmlentities(($l['tipo'] === 'C') ? formataDinheiro($l['valor']) : '');?> </td>
              <td> <?php echo htmlentities(($l['historico']));?> </td>
            </tr>
            <?php 
        } 
        ?>
      </tbody>
    </table>
  </div>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
  <div class="numeracao">
    <?=echoNumeracao($quantidade_pag-$linhas, $quantidade_pag_real, $linhas_parte, 0)?>
  </div>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
  <div class='pull-right' >
    <div class="paginacao"  >
    </div>
  </div>
</div>
<?php 
}
?>


                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>

    </body>
</html>