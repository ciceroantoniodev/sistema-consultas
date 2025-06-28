<?php

namespace app\classes;

use PDO;
use PDOException;
use Exception;

class SQLServer 
{
    
    private $pdo;
    public $ultima_query;
    

    public function __construct($pdo = true) {
        $this->abre();
    }
    

    public function abre() {
        try {
            $stat = "sqlsrv:server=".DB_SERVER_66.";database=".DB_NAME_66.";TrustServerCertificate=true;Encrypt=false";
            $this->pdo = new PDO($stat, DB_USER_66, DB_PASS_66);

        } catch (PDOException $e) {
            die("Erro: Sem Conexao\n");

        }

    }


    public function fecha() {
        if (isset($this->pdo)) {
            unset($this->pdo);
            $this->pdo = null;
        }
    }
    

    public function query($sql, $fetch) {
        $this->ultima_query = $sql;
        $temp = $this->pdo->prepare($sql);
        $temp->execute();

        switch ($fetch) {
            case "assoc":
                return $temp->fetch(PDO::FETCH_ASSOC);
                break;

            case "assocs":
                return $temp->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "object":
                return $temp->fetch(PDO::FETCH_OBJ);
                break;

            case "objects":
                return $temp->fetchAll(PDO::FETCH_OBJ);
                break;
            
            case "both":
                return $temp->fetch(PDO::FETCH_BOTH);
                break;

            case "boths":
                return $temp->fetchAll(PDO::FETCH_BOTH);
                break;

            case "column":
                return $temp->fetchColumn();
                break;

            case "count":
                return $temp->rowCount();
                break;

            case "exec":
                try {
                    return $temp->fetchAll(PDO::FETCH_ASSOC);//$temp->fetchColumn();
                
                } catch (Exception $e) {
                    return $e->getMessage();
                
                } catch (PDOException $e) {
                    return $e->getMessage();
                }

                break;

            case "execute":
                return null;
                break;

            default:
                die("Comando passado para a função não encontrado.");
                break;
        }
    }


    public function queryNovo($sql, $dados, $fetch) {
        $this->ultima_query = $sql;
        $temp = $this->pdo->prepare($sql);
        $temp->execute($dados);

        switch($fetch){
            case "assoc":
                return $temp->fetch(PDO::FETCH_ASSOC);
                break;

            case "assocs":
                return $temp->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "object":
                return $temp->fetch(PDO::FETCH_OBJ);
                break;

            case "objects":
                return $temp->fetchAll(PDO::FETCH_OBJ);
                break;
            
            case "both":
                return $temp->fetch(PDO::FETCH_BOTH);
                break;

            case "boths":
                return $temp->fetchAll(PDO::FETCH_BOTH);
                break;

            case "column":
                return $temp->fetchColumn();
                break;

            case "count":
                return $temp->rowCount();
                break;

            case "exec":
                try {
                    return $temp->fetchAll(PDO::FETCH_ASSOC);//$temp->fetchColumn();
                
                } catch (Exception $e) {
                    return $e->getMessage();
                
                } catch (PDOException $e) {
                    return $e->getMessage();
                
                }
                
                break;

            case "execute":
                return null;
                break;
            
            case "getAll":
                
                $dados = array();
                $dados[0] = 0;

                do {
                    try {
                        if ($t = $temp->fetchAll(PDO::FETCH_ASSOC)) {
                            array_push($dados, $t);
                        }

                    } catch (PDOException $e){
                        $dados[0]++;
                        continue;
                    }

                } while ($temp->nextRowset());
                
                return $dados;

                break;

            default:
                die("Comando passado para a função não encontrado.");
                break;

        }
    }


    public function queryPassa($sql, $fetch, $q = -1) {
        $this->ultima_query = $sql;
        $temp = $this->pdo->prepare($sql);
        $temp->execute();

        switch($fetch){
            case "getAll":
                
                $dados = array();
                $dados[0] = 0;

                do {
                    try {
                        if ($t = $temp->fetchAll(PDO::FETCH_ASSOC)) {
                            array_push($dados, $t);
                        }
                    } catch (PDOException $e){
                        $dados[0]++;
                        continue;
                    }

                } while ($temp->nextRowset());
                
                return $dados;
                break;

            case "debug":

                $dados = array();
                $dados[0] = 0;

                do {
                    try {
                        if ($t = $temp->fetchAll(PDO::FETCH_ASSOC)) {
                            array_push($dados, $t);
                            print_r($t);
                        }
                    } catch (PDOException $e){
                        $dados[0]++;
                        continue;
                    }

                } while ($temp->nextRowset());
                
                return $dados;
                break;

            default:
                die("Comando passado para a função não encontrado.");
                break;

        }
    }


    public function queryparam($sql, $fetch, $a) {
        
        $this->ultima_query = $sql;
        $temp = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL, PDO::SQLSRV_ATTR_CURSOR_SCROLL_TYPE => PDO::SQLSRV_CURSOR_BUFFERED) );

        $temp->execute();

        switch($fetch){
            case "assoc":
                return $temp->fetch(PDO::FETCH_ASSOC);
                break;

            case "assocs":
                return $temp->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "object":
                return $temp->fetch(PDO::FETCH_OBJ);
                break;

            case "objects":
                return $temp->fetchAll(PDO::FETCH_OBJ);
                break;
            
            case "both":
                return $temp->fetch(PDO::FETCH_BOTH);
                break;

            case "boths":
                return $temp->fetchAll(PDO::FETCH_BOTH);
                break;

            case "count":
                return $temp->rowCount();
                break;

            case "exec":
                try {
                    return $temp->fetchAll(PDO::FETCH_ASSOC);//$temp->fetchColumn();
                
                } catch (Exception $e) {
                    return $e->getMessage();
                
                } catch (PDOException $e) {
                    return $e->getMessage();
                
                }
                
                break;

            case "execute":
                return null;
                break;

            default:
                die("Comando passado para a função não encontrado");
                break;
        }
    }


    public function soNumero($str) {
        
        $str = preg_replace("/[^0-9]/", "", $str);

        if ($str == Null) {
            return json_encode(array(
                'c' => 0,
                'm' => 'Numero invalido.'
            ));
            exit;

        } else {
            return $str;

        }
    }

    
    public function p_arr($arr) {
        echo "<pre>",print_r($arr),"</pre>";

    }
}
