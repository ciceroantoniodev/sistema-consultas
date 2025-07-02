<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$dados = [];

if ($vParameters==="novo") {
    

} else if ($vParameters==="salvar") {
    
    $dadosForm = $_POST;
  
    $vAlerta = "";

    if (empty($dadosForm['especialidade'])) { $vAlerta .= "<div>O campo <strong>Nome da Especialidade</strong> n&atilde;o pode ser vazio.</div>"; }

    $vData = date("Y-m-d H:i:s");

    if (empty($vAlerta)) {
        $valores = "'" . $dadosForm['especialidade'] . "',";
        $valores .= "'',";
        $valores .= "'" . $vData . "'";

        $campos = "especialidade, status, data_cad";

        try{
        
            $conn->query("INSERT INTO especialidades ($campos) VALUES ($valores)");

        } catch (Exception $e) {
            $vAlerta = $e->getMessage();

        }
    }

    
    if (empty($vAlerta)) {

        $query = $conn->query("SELECT * FROM especialidades ORDER BY especialidade");
            
            while ($re = mysqli_fetch_assoc($query)) {
            
            $dados[] = $re;

            }

        mysqli_free_result($query); 

    }


} else {
  $query = $conn->query("SELECT * FROM especialidades ORDER BY especialidade");
      
    while ($re = mysqli_fetch_assoc($query)) {
      
      $dados[] = $re;

    }

  mysqli_free_result($query);

}
