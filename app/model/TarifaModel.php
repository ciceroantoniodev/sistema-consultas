<?php 

require_once( LOCAL . '/app/config/includes/database.php');

$dados = [];

if ($vParameters==="novo") {

    $iduser = isset($_POST['iu']) ? soNumero($_POST['iu']) : '';

    //$dados = $database->queryNovo("SELECT * FROM usuario (nolock) WHERE codigo = ? AND id_revenda = ? order by nome", [$iduser, $revenda], 'assoc');

    $valores = $database->queryNovo("SELECT codigo,vlr_unitario_agenda,vlr_unitario_filtro,vlr_unitario_sender,vlr_unitario_desbanimento from revenda(nolock) where codigo = ? ORDER by codigo desc ; ",[$revenda],"assoc");

    $tarifasSalvas = $database->queryNovo("SELECT nome,vlr_unitario_filtro,vlr_unitario_agenda,vlr_unitario_sender,vlr_unitario_desbanimento
                                            FROM tarifa_padrao(nolock)
                                            WHERE id_usuario = ? ;", [$id_user], 'assocs');
    $tarifasOptions = [];

    if(!empty($tarifasSalvas)){
        $tarifasOptions = array_map(function ($e){
            return "<option value='".formataDinheiro($e['vlr_unitario_agenda'],2).";".formataDinheiro($e['vlr_unitario_filtro'],3).";".formataDinheiro($e['vlr_unitario_sender'],3).";".formataDinheiro($e['vlr_unitario_desbanimento'],3)."'>".htmlentities(htmlspecialchars($e['nome']))."</option>";
        }, $tarifasSalvas);
    }

} else {

    $where = "WHERE t.id_usuario = ? ";
    $dadosWhere = [$id_user];

    $offset = (isset($_POST['offset']) && $_POST['offset']!="") ? soNumero($_POST['offset']) : 0;
    $fetch = (isset($_POST['limit']) && $_POST['limit']!="") ? soNumero($_POST['limit']) : 10;
    $pag_atl = (isset($_POST['pagatual']) && $_POST['pagatual']!="") ? soNumero($_POST['pagatual']) : 1;
    
    $pag_final = 0;
    $linhas = $fetch;

    $linhas_parte = $database->queryNovo("SELECT count(1) FROM tarifa_padrao(nolock) t $where", $dadosWhere, 'column');
    $linhas_total = $database->queryNovo("SELECT count(1) FROM tarifa_padrao(nolock) t WHERE t.id_usuario = ? ;", [$id_user], 'column');
    
    $quantidade_pag = $linhas * $pag_atl;
    $quantidade_pag_real =  $linhas * $pag_atl;

    if($quantidade_pag_real > $linhas_parte){
        $quantidade_pag_real = $linhas_parte;
    }

    $u = "SELECT * FROM (
    select t.*,
        ROW_NUMBER() OVER (ORDER BY t.dh_entrada DESC) AS ind
    from tarifa_padrao(nolock) t
    $where
    )t
    WHERE ind > ? AND ind <= ? ORDER BY ind";

    $dadosWhere[] = $offset;
    $dadosWhere[] = $offset + $fetch;
    
    $dados = $database->queryNovo($u, $dadosWhere, 'assocs');

}