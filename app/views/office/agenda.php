<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sistema Agendamento de Consultas</title>

        <!-- Bootstrap -->
        <link href="<?=URL?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=URL?>/assets/bootstrap/css/fontawesome.min.css">

        <link rel="stylesheet" type="text/css" href="<?=URL?>/app/views/office/assets/css/style_index_01.css"/>

        <style>
            a:link.agenda { color: #333333; text-decoration: none}
            a:visited.agenda { color: #333333; text-decoration: none}
            a:hover.agenda { color: #ff0000; text-decoration: none}

            table.calendar { width: 100%; border-collapse: collapse; }
            table.calendar td { width: 14.28%; border: 1px solid #ccc; vertical-align: top; height: 120px; padding: 5px; font-size: 12px; }
            table.calendar td:hover { background-color: #fcfcfc; }
            table.calendar th { background: #eee; padding: 8px; }
            .hoje { background: #def; }
        </style>

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="links-voltar">
                        <a href="<?=URL?>/Office/Inicio" class="links"><span>INÍCIO</span></a>
                    </div>
                    <h2>Agenda</h2><br>
                </div>
            </div>  
            <div class="row">
                <div class="col">

                    <table class="calendar">
                        <tr>
                            <th>Dom</th><th>Seg</th><th>Ter</th><th>Qua</th><th>Qui</th><th>Sex</th><th>Sáb</th>
                        </tr>

                        <tr>
                        <?php
                        $diaAtual = 1;
                        $coluna = 0;

                        // Células em branco antes do 1º dia
                        for ($i = 0; $i < $primeiroDiaSemana; $i++) {
                            echo "<td></td>";
                            $coluna++;
                        }

                        // Células dos dias do mês
                        while ($diaAtual <= $diasNoMes) {
                            $classe = ($diaAtual == date('j') && $mes == date('m') && $ano == date('Y')) ? 'hoje' : '';

                            echo "<td class='$classe'><strong>$diaAtual</strong><br>";

                            if (!empty($agendamentosPorDia[$diaAtual])) {
                                foreach ($agendamentosPorDia[$diaAtual] as $ag) {
                                    echo "<a href='" . URL . "/Office/Agendamento&idu=" . codigoHash($id_usuario) . "&ida=" . codigoHash($ag['id']) . "&acao=consultar' class='agenda'><div style='cursor: pointer'><span style='font-size: 12.5px'>" . substr($ag['hora_agendamento'], 0, 5) . " - " . substr($ag['nome_paciente'], 0, 16) . (strlen($ag['nome_paciente']) > 16 ? ' ...' : '') . "</span></div></a>";
                                }
                            }

                            echo "</td>";

                            $diaAtual++;
                            $coluna++;

                            // Quebra de linha ao final da semana
                            if ($coluna % 7 == 0 && $diaAtual <= $diasNoMes) {
                                echo "</tr><tr>";
                            }
                        }

                        // Células em branco ao final
                        while ($coluna % 7 != 0) {
                            echo "<td></td>";
                            $coluna++;
                        }
                        ?>
                        </tr>
                    </table>
                    
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>

                </div>
            </div>
        </div>
    </body>
</html>