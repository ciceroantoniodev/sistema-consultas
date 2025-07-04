<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$dados = [];

if ($vParameters==="novo") {
    

} else if ($vParameters==="editar") {
  
  $dadosForm = [];

  $query = $conn->query("SELECT * FROM pacientes WHERE id=$id_paciente");
      
    $re = mysqli_fetch_array($query);
      
    $dadosForm = $re;

  mysqli_free_result($query);    


} else if ($vParameters==="salvar") {
    
  $dadosForm = $_POST;
  
  $vAlerta = "";

  if (empty($dadosForm['nome'])) { $vAlerta .= "<div>O campo <strong>Nome do Paciente</strong> n&atilde;o pode ser vazio.</div>"; }
  if (empty($dadosForm['sexo'])) { $vAlerta .= "<div>O campo <strong>Sexo</strong> n&atilde;o pode ser vazio.</div>"; }
  if (empty($dadosForm['mae'])) { $vAlerta .= "<div>O campo <strong>Nome da M&atilde;e</strong> n&atilde;o pode ser vazio.</div>"; }
  if (empty($dadosForm['data_nasc'])) { $vAlerta .= "<div>o Campo <strong>Data de Nascimento</strong> n&atilde;o pode ser vazio.</div>"; }

  $vData = date("Y-m-d H:i:s");

  if (empty($vAlerta)) {

      if ($dadosForm['acao']==="novo") {

          $valores = "'" . $dadosForm['nome'] . "',";
          $valores .= "'" . date("Y-m-d", strtotime($dadosForm['data_nasc'])) . "',";
          $valores .= "'" . $dadosForm['sexo'] . "',";
          $valores .= "'" . $dadosForm['cpf'] . "',";
          $valores .= "'" . $dadosForm['rg'] . "',";
          $valores .= "'" . $dadosForm['mae'] . "',";
          $valores .= "'" . $dadosForm['pai'] . "',";
          $valores .= "'" . $dadosForm['endereco'] . "',";
          $valores .= "'" . $dadosForm['bairro'] . "',";
          $valores .= "'" . $dadosForm['cidade'] . "',";
          $valores .= "'" . $dadosForm['estado'] . "',";
          $valores .= "'" . $dadosForm['cep'] . "',";
          $valores .= "'" . $dadosForm['fone'] . "',";
          $valores .= "'" . $dadosForm['status'] . "',";
          $valores .= "'" . $vData . "'";

          $campos = "nome, data_nascimento, sexo, cpf, rg, nome_mae, nome_pai, endereco, bairro, cidade, estado, cep, telefone, status, data_cad";

          try{
            
            $conn->query("INSERT INTO pacientes ($campos) VALUES ($valores)");
            
            $pacientes = $conn->query("SELECT id FROM pacientes 
                            WHERE nome='" . $dadosForm['nome'] . "' 
                            AND nome_mae='" . $dadosForm['mae'] . "' 
                            AND data_cad='" .  $vData . "'");
                        
                $re = mysqli_fetch_array($pacientes);

                $id_paciente = $re['id'];
        
            mysqli_free_result($pacientes);


          } catch (Exception $e) {
            $vAlerta = $e->getMessage();

          }


      } else {

          try{
              
              $where = " WHERE id=" . $dadosForm['id_paciente'];

              $sql = "UPDATE pacientes SET 
                  nome='" . $dadosForm['nome'] . "', 
                  data_nascimento='" . date("Y-m-d", strtotime($dadosForm['data_nasc'])) . "', 
                  sexo='" . $dadosForm['sexo'] . "', 
                  cpf='" . $dadosForm['cpf'] . "', 
                  rg='" . $dadosForm['rg'] . "', 
                  nome_mae='" . $dadosForm['mae'] . "', 
                  nome_pai='" . $dadosForm['pai'] . "', 
                  endereco='" . $dadosForm['endereco'] . "', 
                  bairro='" . $dadosForm['bairro'] . "', 
                  cidade='" . $dadosForm['cidade'] . "', 
                  estado='" . $dadosForm['estado'] . "', 
                  cep='" . $dadosForm['cep'] . "', 
                  telefone='" . $dadosForm['fone'] . "' 
                  $where";

              $conn->query($sql);
                            
              $id_paciente =  $dadosForm['id_paciente'];


          } catch (Exception $e) {
              $vAlerta = $e->getMessage();

          }

      }

      
      if (empty($vAlerta)) {
          $query = $conn->query("SELECT * FROM pacientes ORDER BY nome");
                
              while ($re = mysqli_fetch_assoc($query)) {
                
                $dados[] = $re;

              }

          mysqli_free_result($query);

      } 

  }


} else {

    $query = $conn->query("SELECT * FROM pacientes ORDER BY nome");
        
      while ($re = mysqli_fetch_assoc($query)) {
        
        $dados[] = $re;

      }

    mysqli_free_result($query);

}
