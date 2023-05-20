<?php
    // Ce fichier modifie la variable session de connexion et initialise les sessions nécessaires.
    session_start();

    // on récupère les infos du formulaires.
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];

    // Charger le contenu actuel du fichier JSON
    $json = file_get_contents('utilisateurs.json');
    $data = json_decode($json, true);
    $utilisateurs = $data['utilisateurs'];
    
    // verifie si l'utilisateur existe et initialie une session et des cookie pour l'utilisateur
    $utilisateurs_trouve = false;
    foreach($utilisateurs as $utilisateur){
        if ($mail === $utilisateur['mail'] && $mdp === $utilisateur['mdp']){
            // on initialise les sessions dont on veut simplement afficher le temps de la visite
            $_SESSION['indice'] = $utilisateur['indice'];
            $_SESSION['mail'] = $utilisateur['mail'];
            $_SESSION['nom'] = $utilisateur['nom'];
            $_SESSION['prenom'] = $utilisateur['prenom'];
            $utilisateurs_trouve = true;
            break;
        }
    }

    if ($utilisateurs_trouve == false){
        header('Location: ../connexion.html');
        exit;
    }
    else{
        $_SESSION['connexion'] = 'jeune';
        header('Location: Jeune.php');
    }
?>