<?php

use app\classes\Csrf;

$vGet = $_GET;
$vLocation = false;

if (isset($vGet['confirm']) && $vGet['confirm'] === 'yes') {
    $csrf = new Csrf();
    $csrf->destroi_tokens();
    
    session_destroy();
    session_start();
    
    session_regenerate_id();

    unset($_SESSION['cfg_codigo']);
    unset($_SESSION['ultimo']);

    $vLocation = true;
}

include_once "app/views/office/logout.php";
