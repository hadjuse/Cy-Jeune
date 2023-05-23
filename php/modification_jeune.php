<?php
    session_start();
    if (isset($_POST['submit'])) {

        // Obtenir les informations du referant et de l'engagement du jeune à partir du formulaire
        $nom_referant = $_POST['nom'];
        $prenom_referant = $_POST['prenom'];
        $mail_referant = $_POST['mail'];
        $engagement = $_POST['engagement'];
        $naissance_referant = $_POST['naissance'];
        $reseau = $_POST['reseau'];
        $duree = $_POST['duree'];    
        $savoir_etre = $_POST['savoir'];

        // Charger le contenu actuel du fichier JSON
        $json = file_get_contents('utilisateurs.json');
        $data = json_decode($json, true);

        $utilisateurs = &$data['utilisateurs']; // On utilise une affectation par reference grâce au & qui modifie directement la table de hachage.
        foreach($utilisateurs as &$utilisateur){
            if ($_SESSION['mail'] == $utilisateur['mail']){
                if ( isset ($utilisateur['referent'])){
                    $indice = count($utilisateur['referent']);
                 }
                 else {
                    $indice = 0;
                 }
                if (isset($savoir_etre)) {
                    $savoir = $savoir_etre;   
                }
                else{
                    $savoir = [];
                }
                $utilisateur['referent'][] = array( 
                'indice' => $indice,
                'nom' => $nom_referant,
                'prenom' => $prenom_referant,
                'mail' => $mail_referant,
                'reseau' => $reseau,
                'date_naissance' => $naissance_referant,
                'engagement' => $engagement,
                'duree' => $duree,
                'savoir etre' => $savoir,
                'commentaire' => ''
                );
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
    header("Location: ../pagereferent.php");
    exit;
?>

