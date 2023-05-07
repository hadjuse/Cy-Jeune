<?php
    if (isset($_POST['submit'])){
        
        // On récupère les infos d'utilisateurs
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        // Charger le contenu actuel du fichier JSON
        $json = file_get_contents('utilisateurs.json');
        $data = json_decode($json, true);
        
        $utilisateurs = $data['utilisateurs'];
        
        // verifie si l'utilisateur existe
        $utilisateurs_trouve = false;
        foreach($utilisateurs as $utilisateur){
            if ($mail == $utilisateur['mail'] && $mdp == $utilisateur['mdp']){
                $utilisateurs_trouve = true;
                setcookie("connexion", $mail, time()+3600);
                break;
            }
        }
        $response = array('connexion' => $utilisateurs_trouve);
        echo json_encode($response);
    }
?>