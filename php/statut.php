<?php
    session_start();
    if (!isset($_SESSION['connexion'])){
        $_SESSION['connexion'] = "visiteur";
    }
?>