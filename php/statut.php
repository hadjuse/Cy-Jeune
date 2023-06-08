<?php
    // Ce fichier consiste à initialisé un statut initial qui est celle de visiteur
    session_start();
    if (!isset($_SESSION['connexion'])){
        $_SESSION['connexion'] = "visiteur";
    }
?>