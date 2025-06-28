<?php 

require_once( LOCAL . '/app/config/includes/database.php');

$dados = [];


$status  = (isset($_POST['s'])  && $_POST['s'] != '') ? soNumero($_POST['s'],10) : '';
$num  = (isset($_POST['n'])  && $_POST['n'] != '') ? soNumero($_POST['n'],10) : '';
$extra = '';

$where = "WHERE f.id_usuario = ? AND f.id_revenda = ? ";
$dadosWhere = [$id_user,$revenda];
if($status!==''){
  if($status==='1'){
    $where .= "AND f.tipo = 'C' ";
  }
  else if($status==='2') {
    $where .= "AND f.tipo = 'D' ";
  }
}
if($num !==''){
}

$offset = (isset($_POST['offset']) && $_POST['offset']!="") ? soNumero($_POST['offset']) : 0;
$fetch = (isset($_POST['limit']) && $_POST['limit']!="") ? soNumero($_POST['limit']) : 20;
$pag_atl = (isset($_POST['pagatual']) && $_POST['pagatual']!="") ? soNumero($_POST['pagatual']) : 1;

$pag_final = 0;
$linhas = $fetch;

$linhas_parte = $database->queryNovo("SELECT count(1) FROM financeiro(nolock) f $where", $dadosWhere, 'column');
$linhas_total = $database->queryNovo("SELECT count(1) FROM financeiro(nolock) f WHERE f.id_usuario = ? AND f.id_revenda = ? ;", [$cfg_codigo,$revenda], 'column');;

$quantidade_pag = $linhas * $pag_atl;
$quantidade_pag_real =  $linhas * $pag_atl;

if($quantidade_pag_real > $linhas_parte){
  $quantidade_pag_real = $linhas_parte;
}

$u = "SELECT * FROM (
  select f.*,
	ROW_NUMBER() OVER (ORDER BY f.codigo DESC) AS ind
  from financeiro(nolock) f
  $where
)t
WHERE ind > ? AND ind <= ? ORDER BY ind";

$dadosWhere[] = $offset;
$dadosWhere[] = $offset + $fetch;

$dados = $database->queryNovo($u, $dadosWhere, 'assocs');
