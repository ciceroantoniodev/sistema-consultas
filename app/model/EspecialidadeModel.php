<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$dados = [];

if ($vParameters==="novo") {
    

} else if ($vParameters==="editar") {

    $dadosForm = [];

    $query = $conn->query("SELECT * FROM especialidades WHERE id=$id_especialidade");
      
      $re = mysqli_fetch_array($query);
      
      if (!empty($re)) {

        $dadosForm = $re;

      }

    mysqli_free_result($query);
    
    
} else if ($vParameters==="salvar") {
    
    $dadosForm = $_POST;
  
    $vAlerta = "";

    if (empty($dadosForm['especialidade'])) { $vAlerta .= "<div>O campo <strong>Nome da Especialidade</strong> n&atilde;o pode ser vazio.</div>"; }

    $vData = date("Y-m-d H:i:s");

    if (empty($vAlerta)) {

        if ($dadosForm['acao']==="novo") {
            $valores = "'" . $dadosForm['especialidade'] . "',";
            $valores .= "'',";
            $valores .= "'" . $vData . "'";

            $campos = "especialidade, status, data_cad";

            try{
            
                $conn->query("INSERT INTO especialidades ($campos) VALUES ($valores)");

            } catch (Exception $e) {
                $vAlerta = $e->getMessage();

            }


        } else {

            $where = " WHERE id=" . $dadosForm['id_especialidade'];

            $sql = "UPDATE especialidades SET especialidade='" . $dadosForm['especialidade'] . "' $where";

            $conn->query($sql);
                
            $id_especialidade =  $dadosForm['id_especialidade'];

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
