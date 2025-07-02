<?php 

Use Exception;

require_once( LOCAL . '/app/config/includes/connection.php');

$dados = [];
$especialidades = [];


if (!empty($vParameters)) {

    $query = $conn->query("SELECT * FROM especialidades ORDER BY especialidade");
        
        while ($re = mysqli_fetch_assoc($query)) {
        
            $especialidades[] = ["Id" => $re['id'], "Especialidade" => $re['especialidade']];

        }

    mysqli_free_result($query);
}


if ($vParameters==="novo") {
    

} else if ($vParameters==="salvar") {
    
    $dadosForm = $_POST;

    $vAlerta = "";

    if (empty($dadosForm['nome'])) { $vAlerta .= "<div>O campo <strong>Nome do Paciente</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['sexo'])) { $vAlerta .= "<div>O campo <strong>Sexo</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['data_nasc'])) { $vAlerta .= "<div>o Campo <strong>Data de Nascimento</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['documento_tipo'])) { $vAlerta .= "<div>o Campo <strong>Tipo de Documento</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['documento_numero'])) { $vAlerta .= "<div>o Campo <strong>N&uacute;mero do Documento</strong> n&atilde;o pode ser vazio.</div>"; }
    if (empty($dadosForm['especialidade'])) { $vAlerta .= "<div>o Campo <strong>Especialidade</strong> n&atilde;o pode ser vazio.</div>"; }

    $vData = date("Y-m-d H:i:s");

    if (empty($vAlerta)) {
    
        $valores = "0" . (int)$dadosForm['especialidade'] . ",";
        $valores .= "'" . $dadosForm['nome'] . "',";
        $valores .= "'" . $dadosForm['sexo'] . "',";
        $valores .= "'" . date("Y-m-d", strtotime($dadosForm['data_nasc'])) . "',";
        $valores .= "'" . $dadosForm['documento_tipo'] . "',";
        $valores .= "'" . $dadosForm['documento_numero'] . "',";
        $valores .= "'',";
        $valores .= "'" . $vData . "'";

        $campos = "id_especialidade, nome, sexo, data_nascimento, documento_tipo, documento_numero, status, data_cad";

        try{
        
            $conn->query("INSERT INTO profissionais ($campos) VALUES ($valores)");

        } catch (Exception $e) {
            $vAlerta = $e->getMessage();

        }
    }


    if (empty($vAlerta)) {
        $query = $conn->query("SELECT profissionais.*, especialidades.especialidade FROM profissionais INNER JOIN especialidades ON profissionais.id_especialidade=especialidades.id ORDER BY profissionais.nome");
      
            while ($re = mysqli_fetch_assoc($query)) {
            
                $dados[] = $re;

            }

        mysqli_free_result($query);    
       
    }


} else {

  $query = $conn->query("SELECT profissionais.*, especialidades.especialidade FROM profissionais INNER JOIN especialidades ON profissionais.id_especialidade=especialidades.id ORDER BY profissionais.nome");
      
    while ($re = mysqli_fetch_assoc($query)) {
      
      $dados[] = $re;

    }

  mysqli_free_result($query);

}
