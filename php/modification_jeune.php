<?php
    // Inclusion de PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../php/vendor/autoload.php';
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
                    $kndice = count($utilisateur['referent']);
                 }
                 else {
                    $kndice = 0;
                 }
                if (isset($savoir_etre)) {
                    $savoir = $savoir_etre;   
                }
                else{
                    $savoir = [];
                }
                $utilisateur['referent'][] = array( 
                'indice' => $kndice,
                'nom' => $nom_referant,
                'prenom' => $prenom_referant,
                'mail' => $mail_referant,
                'reseau' => $reseau,
                'date_naissance' => $naissance_referant,
                'commentaire' => '    ',
                'engagement' => $engagement,
                'duree' => $duree,
                'savoir_etre' => $savoir);
                
                 // Les valeurs des variables
    $kdjeune = $_SESSION['indice'];
    $kdreferent = $kndice;

    // Construction de l'URL avec les paramètres
    $url = "http://localhost:8080/pagereferent.php?jeune=" . urlencode($kdjeune) . "&referent=" . urlencode($kdreferent);

        // Paramètres de l'e-mail
        $expediteur = 'cyjeune6.4@laposte.net';
        $mot_de_passe = 'Flaviomarioluigi6.4';
        $sujet = '[JEUNE6.4] Demande de referencement';
        $corps_message = 'Bonjour,<br>
                Le projet Jeunes6.4 est un dispositif de valorisation de l’engagement des jeunes en Pyrénées 
        ­Atlantiques soutenu par l’Etat, le Conseil Général, le Conseil Régional, les CAF Béarn-Soule et Pays Basque, la MSA, la CPAM. 
        Le projet, adressé aux jeunes entre 16 et 30 ans, vise à valoriser toute expérience comme source d’enrichissement qui puisse être 
        reconnue comme l’expression d’un savoir faire ou savoir être. Ce site web permet à des jeunes de valoriser leur savoir- faire et 
        savoir-être.<br> 
                Afin de compléter leur CV, les jeunes peuvent demander des références qui confirment leur expérience 
        (clubs de sport,bénévolat, services à domiciles, etc.). Ces références pourront être consultées par un recruteur potentiel.
        Vous avez été sollicité par un de ces jeunes afin de confirmer son engagement. Voici un lien permettant de 
        consulter et eventuellement confirmer ses experiences et savoir-faire/savoir-etre: <a href="'.$url.'">'.$url.'</a><br>
        Nous vous remercions par avance de votre participation.<br>
        Cordialement, l équipe Jeune6.4';



        // Configuration de PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        //$mail->SMTPDebug=2;
        $mail->Host = 'smtp.laposte.net';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = $expediteur;
        $mail->Password = $mot_de_passe;
        $mail->CharSet = 'utf-8';
        $mail->isHTML(true);
        
        // Destinataire et expéditeur
        $mail->setFrom($expediteur);
        $mail->addAddress($mail_referant);

        // Contenu de l'e-mail
        $mail->Subject = $sujet;
        $mail->Body = $corps_message;
    

        $mail->send();
        break;
        }}

        

        // Mettre à jour le tableau des utilisateurs dans le tableau complet
        $data['utilisateurs'] = $utilisateurs;  

        // Convertir le tableau associatif en JSON
        $json = json_encode($data, JSON_PRETTY_PRINT);

        // Écrire le JSON dans un fichier
        file_put_contents('utilisateurs.json', $json);
    }
   

    // Redirection vers la page de destination
    header("Location: ../recap.php");
    //header("Location: ../recap.php");

    exit; // Assure que le script se termine ici
?>

