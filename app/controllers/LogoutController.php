<?php

$vGet = $_GET;
$vLocation = false;

if (isset($vGet['confirm']) && $vGet['confirm'] === 'yes') {
    
    session_destroy();
    session_start();
    
    session_regenerate_id();

    unset($_SESSION['id']);
    unset($_SESSION['nome']);
    unset($_SESSION['acesso']);

    $vLocation = true;
}

include_once "app/views/office/logout.php";
