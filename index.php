<?php
session_start();
error_reporting(0);
set_time_limit(600);

setlocale(LC_ALL, 'pt_BR');
date_default_timezone_set('America/Sao_Paulo');

header("Content-Type: text/html; charset=UTF-8",true);

require_once __DIR__ . '/vendor/autoload.php'; 

include_once("app/config/route.php");


include_once( $includeController );
