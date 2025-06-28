<?php 

require_once( LOCAL . '/app/config/includes/database.php');

$dados = [];


if ($vParameters==="novo" || $vParameters==="editar") {

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
}


if ($vParameters==="novo") {

    //$dados = $database->queryNovo("SELECT * FROM usuario (nolock) WHERE codigo = ? AND id_revenda = ? order by nome", [$iduser, $revenda], 'assoc');


} else if ($vParameters==="editar") {

    $dados = $database->queryNovo("SELECT * FROM usuario WHERE codigo = ?", [$codigo_usuario], 'assoc');

} else {
    $id_grupo_atual = $revenda;
    $tipo = isset($_POST['tipo']) ? soNumero($_POST['tipo']) : '';
    $pesquisa = isset($_POST['pesquisa']) ? limpaString($_POST['pesquisa']) : '';


    $where = "WHERE id_revenda = ? ";
    $var_junto = [$revenda];
    if($tipo !== ""){
        switch($tipo){
            case '':
                $where .= "";
            break;
            case '1':
                $where .= "AND u.cod_status = 'P' ";
            break;
            case '2':
                $where .= "AND u.cod_status = 'B' ";
            break;
            case '3':
                $where .= "AND u.cod_status = 'T' ";
            break;
            case '4':
                $where .= "AND u.mestre = 'S' ";
            break;
            default:
                $where .= "";
            break;
        }
    } 

    if($pesquisa !== ""){
        $var_junto[] = "%$pesquisa%";
        $var_junto[] = "%$pesquisa%";
        $var_junto[] = "%$pesquisa%";
        switch($tipo){
            case '':
                $where .= "AND (u.nome like ? OR u.celular like ? OR u.email like ?) ";
            break;
            default:
                $where .= "AND (u.nome like ? OR u.celular like ? OR u.email like ?) ";
            break;
        }
    }

    $offset = (isset($_POST['offset']) && $_POST['offset']!="") ? soNumero($_POST['offset']) : 0;
    $fetch = (isset($_POST['limit']) && $_POST['limit']!="") ? soNumero($_POST['limit']) : 20;
    $pag_atl = (isset($_POST['pagatual']) && $_POST['pagatual']!="") ? soNumero($_POST['pagatual']) : 1;
    $pag_final = 0;
    $linhas = $fetch;
    $linhas_parte = $database->queryNovo("SELECT count(1) from usuario(nolock) u $where;", $var_junto,'column');
    $linhas_total = $database->queryNovo("SELECT count(1) from usuario(nolock) u WHERE id_revenda = ? ", [$revenda],'column');
    $quantidade_pag = $linhas * $pag_atl;
    $quantidade_pag_real =  $linhas * $pag_atl;
    if($quantidade_pag_real > $linhas_parte){
    $quantidade_pag_real = $linhas_parte;
    }
    $dados = null;

    $u= "SELECT * FROM (
        select u.*,
        ROW_NUMBER() OVER (ORDER BY u.nome ASC) AS ind
        FROM usuario u (nolock) 
        $where
    )t
    WHERE ind > ? AND ind <= ? ORDER BY ind";
    $var_junto[] = $offset;
    $var_junto[] = $offset + $fetch;
    $dados = $database->queryNovo($u, $var_junto, 'assocs');

}