<?php

if(substr_count($_SERVER['REQUEST_URI'],'database.php') > 0 ){
    http_response_code(404);
    exit;
}

use app\classes\SQLServer;

require_once('connection.php');

$database = new SQLServer();
