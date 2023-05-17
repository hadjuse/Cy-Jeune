<?php
    session_start();
    if (isset($_POST['submit'])) {
        // Obtenir les informations utilisateur à partir du formulaire
        $engagement = $_POST['engagement'];
        $duree = (int)$_POST['duree'];    
        $savoir_etre = $_POST['savoir'];
        //echo $savoir_etre;
        // Charger le contenu actuel du fichier JSON
        $json = file_get_contents('utilisateurs.json');
        $data = json_decode($json, true);

        $utilisateurs = &$data['utilisateurs']; // On utilise une affectation par reference grâce au &.
        foreach($utilisateurs as &$utilisateur){
            if ($_SESSION['mail'] == $utilisateur['mail']){
                $utilisateur['engagement'][] = $engagement;
                $utilisateur['duree'][] = $duree;
                
                if (isset($savoir_etre)) {
                    $utilisateur['savoir_etre'][] = $savoir_etre;   
                }
                break;
            }
        }

        // Mettre à jour le tableau des utilisateurs dans le tableau complet
        $data['utilisateurs'] = $utilisateurs;  

        // Convertir le tableau associatif en JSON
        $json = json_encode($data, JSON_PRETTY_PRINT);

        // Écrire le JSON dans un fichier
        file_put_contents('utilisateurs.json', $json);
    }
    header("Location: recap.php");
    exit;
?>

