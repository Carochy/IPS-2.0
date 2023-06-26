<?php
    session_start();
    session_unset();
    session_destroy();
    
    header("Location:/moob/IPS/index.php"); 
    /* require_once RAIZ.'/app/vistas/login.php'; */
    exit;
?>
