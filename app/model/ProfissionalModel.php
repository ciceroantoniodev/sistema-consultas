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
    

} else if ($vParameters==="editar") {

    $dadosForm = [];

    $query = $conn->query("SELECT profissionais.*, especialidades.especialidade FROM profissionais INNER JOIN especialidades ON profissionais.id_especialidade=especialidades.id WHERE profissionais.id=$id_profissional");
      
        $re = mysqli_fetch_array($query);
      
        $dadosForm = $re;
    
    mysqli_free_result($query);
  
  
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

        if ($dadosForm['acao']==="novo") {

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
                
                $profissionais = $conn->query("SELECT id FROM profissionais 
                            WHERE nome='" . $dadosForm['nome'] . "' 
                            AND documento_numero='" . $dadosForm['documento_numero'] . "' 
                            AND data_cad='" .  $vData . "'");
                        
                    $re = mysqli_fetch_array($profissionais);

                    $id_profissional = $re['id'];
            
                mysqli_free_result($profissionais);


            } catch (Exception $e) {
                $vAlerta = $e->getMessage();

            }

        } else {

            try{
              
                $where = " WHERE id=" . $dadosForm['id_profissional'];

                $sql = "UPDATE profissionais SET 
                    id_especialidade=0" . (int)$dadosForm['especialidade']  . ", 
                    nome='" . $dadosForm['nome'] . "', 
                    sexo='" . $dadosForm['sexo'] . "', 
                    data_nascimento='" . date("Y-m-d", strtotime($dadosForm['data_nasc'])) . "', 
                    documento_tipo='" . $dadosForm['documento_tipo'] . "', 
                    documento_numero='" . $dadosForm['documento_numero'] . "' 
                    $where";

                $conn->query($sql);
                            
                $id_profissional =  $dadosForm['id_profissional'];


            } catch (Exception $e) {
                $vAlerta = $e->getMessage();

            }

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
