<?php
    session_start();
    if (isset($_POST['submit'])) {

        // Obtenir les informations du referant et de l'engagement du jeune à partir du formulaire
        $nom_referant = $_POST['nom'];
        $prenom_referant = $_POST['prenom'];
        $mail_referant = $_POST['mail'];
        $engagement = $_POST['engagement'];
        $naissance_referant = $_POST['naissance'];
        echo $naissance_referant;
        $reseau = $_POST['reseau'];
        $duree = (int)$_POST['duree'];    
        $savoir_etre = $_POST['savoir'];

        // Charger le contenu actuel du fichier JSON
        $json = file_get_contents('utilisateurs.json');
        $data = json_decode($json, true);

        $utilisateurs = &$data['utilisateurs']; // On utilise une affectation par reference grâce au & qui modifie directement la table de hachage.
        foreach($utilisateurs as &$utilisateur){
            if ($_SESSION['mail'] == $utilisateur['mail']){
                $utilisateur['engagement'][] = $engagement;
                $utilisateur['duree'][] = $duree;
                $utilisateur['referent']['nom'] = $nom_referant;
                $utilisateur['referent']['prenom'] = $prenom_referant;
                $utilisateur['referent']['mail'] = $mail_referant;
                $utilisateur['referent']['reseau'] = $reseau;
                $utilisateur['referent']['date_naissance'] = $naissance_referant;
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

