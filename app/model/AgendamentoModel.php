<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$pacientes = [];
$profissionais = [];
$dados = [];

if ($acao==="consultar" || $acao==="alterar") {
    
  $agenda = $conn->query("SELECT agenda.*, pacientes.nome FROM agenda INNER JOIN pacientes ON agenda.id_paciente=pacientes.id WHERE agenda.id=$codigo_agenda");
      
    $dados = mysqli_fetch_array($agenda);

  mysqli_free_result($agenda);

  $query = $conn->query("SELECT * FROM profissionais ORDER BY nome");
      
    while ($re = mysqli_fetch_assoc($query)) {
      $profissionais[] = $re;
    }

  mysqli_free_result($query);


} else if ($vParameters==="salvar") {
    
  $dadosForm = $_POST;
  
  $vAlerta = "";

  if ($dadosForm['acao']==="novo") {
    if (empty($dadosForm['paciente'])) { $vAlerta .= "<div>O campo <strong>Nome do Paciente</strong> n&atilde;o pode ser vazio.</div>"; }

  }

  if (empty($dadosForm['data_agendamento'])) { $vAlerta .= "<div>O campo <strong>Data do Agendamento</strong> n&atilde;o pode ser vazio.</div>"; }
  if (empty($dadosForm['hora_agendamento'])) { $vAlerta .= "<div>O campo <strong>Hor&aacute;rio do Agendamento</strong> n&atilde;o pode ser vazio.</div>"; }
  if (empty($dadosForm['profissional'])) { $vAlerta .= "<div>o Campo <strong>Profissional Médico</strong> n&atilde;o pode ser vazio.</div>"; }
  if (empty($dadosForm['agendamento_tipo'])) { $vAlerta .= "<div>o Campo <strong>Agendamento do Tipo</strong> n&atilde;o pode ser vazio.</div>"; }

  $vData = date("Y-m-d H:i:s");

  if (empty($vAlerta)) {

    if ($dadosForm['acao']==="novo") {

      $valores = "0" . $dadosForm['paciente'] . ",";
      $valores .= "0" . $dadosForm['profissional'] . ",";
      $valores .= "'" . date("Y-m-d", strtotime($dadosForm['data_agendamento'])) . "',";
      $valores .= "'" . date("H:i:s", strtotime($dadosForm['hora_agendamento'])) . "',";
      $valores .= "'" . $dadosForm['agendamento_tipo'] . "',";
      $valores .= "'" . $dadosForm['obs'] . "',";
      $valores .= "'aberto',";
      $valores .= "'" . $vData . "'";

      $campos = "id_paciente, id_profissional, data_agendamento, hora_agendamento, tipo_agendamento, obs, status, data_cad";

      try{
        
        $conn->query("INSERT INTO agenda ($campos) VALUES ($valores)");

        $agenda = $conn->query("SELECT id FROM agenda 
                  WHERE id_paciente=" . (int)$dadosForm['paciente'] . " 
                  AND id_profissional=" . (int)$dadosForm['profissional'] . " 
                  AND tipo_agendamento='" . $dadosForm['agendamento_tipo'] . "' 
                  AND data_cad='" .  $vData . "'"
              );
            
          $re = mysqli_fetch_array($agenda);
          $codigo_agenda = $re['id'];
          
        mysqli_free_result($agenda);
    
        
      } catch (Exception $e) {
        $vAlerta = $e->getMessage();

      }


    } else {

      try{
        
        $where = " WHERE id=" . $dadosForm['id_agenda'];

        $sql = "UPDATE agenda SET 
            id_profissional=0" . $dadosForm['profissional'] . ", 
            data_agendamento='" . date("Y-m-d", strtotime($dadosForm['data_agendamento'])) . "', 
            hora_agendamento='" . date("H:i:s", strtotime($dadosForm['hora_agendamento'])) . "', 
            tipo_agendamento='" . $dadosForm['agendamento_tipo'] . "', 
            obs='" . $dadosForm['obs'] . "', 
            status='" . $dadosForm['status'] . "' 
            $where";

        $conn->query($sql);
        
        $codigo_agenda =  $dadosForm['id_agenda'];


      } catch (Exception $e) {
        $vAlerta = $e->getMessage();

      }

    }

    
    $agenda = $conn->query("SELECT agenda.*, pacientes.nome FROM agenda INNER JOIN pacientes ON agenda.id_paciente=pacientes.id WHERE agenda.id=$codigo_agenda");
        
      $dados = mysqli_fetch_array($agenda);

    mysqli_free_result($agenda);

    $query = $conn->query("SELECT * FROM profissionais ORDER BY nome");
        
      while ($re = mysqli_fetch_assoc($query)) {
        $profissionais[] = $re;
      }

    mysqli_free_result($query);


  }


} else {

  $query = $conn->query("SELECT * FROM pacientes ORDER BY nome");
      
    while ($re = mysqli_fetch_assoc($query)) {
      $pacientes[] = $re;
    }

  mysqli_free_result($query);

  $query = $conn->query("SELECT * FROM profissionais ORDER BY nome");
      
    while ($re = mysqli_fetch_assoc($query)) {
      $profissionais[] = $re;
    }

  mysqli_free_result($query);

}
