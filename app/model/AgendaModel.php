<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$agendamentos = [];
$agendamentosPorDia = [];

// Buscar agendamentos do mês
$query = $conn->query("SELECT agenda.*, pacientes.nome AS nome_paciente
                      FROM agenda 
                      LEFT JOIN pacientes 
                      ON agenda.id_paciente=pacientes.id
                      WHERE MONTH(agenda.data_agendamento) = $mes AND YEAR(agenda.data_agendamento) = $ano"
                    );

  while ($re = mysqli_fetch_assoc($query)) {
    
    $agendamentos[] = $re;

  }

mysqli_free_result($query);


foreach ($agendamentos as $item) {
    
    $dia = date('j', strtotime($item['data_agendamento']));

    $agendamentosPorDia[$dia][] = $item;

}

