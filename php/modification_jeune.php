<?php
    // Inclusion de PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //require 'php/vendor/autoload.php';
    session_destroy();
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

        // Paramètres de l'e-mail
        $expediteur = 'cyjeune6.4@laposte.net';
        $mot_de_passe = 'Flaviomarioluigi6.4';
        $sujet = 'Demande de';
        $corps_message = 'Bonjour'.$url;

        // Configuration de PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug=2;
        $mail->Host = 'smtp.laposte.net';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = $expediteur;
        $mail->Password = $mot_de_passe;

        // Destinataire et expéditeur
        $mail->setFrom($expediteur);
        $mail->addAddress($mail_referant);

        // Contenu de l'e-mail
        $mail->Subject = $sujet;
        $mail->Body = $corps_message;
    
        try {
        // Envoi de l'e-mail
        //$mail->send();
        echo "L'e-mail a été envoyé avec succès.";
        } catch (Exception $e) {
            echo "Une erreur s'est produite lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
        }


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
                'commentaire' => '',
                'engagement' => $engagement,
                'duree' => $duree,
                'savoir_etre' => $savoir
                
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
    // Les valeurs des variables
    $idjeune = $_SESSION['indice'];
    $idreferent = $indice;

    // Construction de l'URL avec les paramètres
    $url = "../pagereferent.php?jeune=" . urlencode($idjeune) . "&referent=" . urlencode($idreferent);

    // Redirection vers la page de destination
    header("Location: " . $url);
    //header("Location: ../recap.php");

    exit; // Assure que le script se termine ici
?>

