<!DOCTYPE html>
<html lang="fr">
<head></head> 
<body>
<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../php/vendor/autoload.php';
//On récupère les infos du jeune
    $kndiceReferent = $_POST['engagement'];
    $mailConsultant = $_POST["mailConsultant"];
    $kndiceJeune = $_SESSION['indice'];

    // Construction du tableau de paramètres
    $parametres = array(
        'jeune' => $kndiceJeune,
        'referent' => $kndiceReferent
    );

    // Conversion du tableau en chaîne de requête
    $parametresRequete = http_build_query($parametres);

    // Construction de l'URL avec les paramètres
    $url = "http://localhost/Cy-Jeune/pageconsultant.php?" . $parametresRequete;

     // Construction de l'URL avec les paramètres
     //$url = "http://localhost/Cy-Jeune/pageconsultant.php?jeune=" . urlencode($kndiceJeune) . "&referent=" . urlencode(implode(" ", $kndiceReferent));

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
     Nous vous remercions par avance de votre participation
     Cordialement, l équipe Jeune6.4';



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
     $mail->CharSet = 'utf-8';
     $mail->isHTML(true);
     
     // Destinataire et expéditeur
     $mail->setFrom($expediteur);
     $mail->addAddress($mailConsultant);

     // Contenu de l'e-mail
     $mail->Subject = $sujet;
     $mail->Body = $corps_message;
 
     try {
     // Envoi de l'e-mail
     $mail->send();
     echo "L'e-mail a été envoyé avec succès.";
     } catch (Exception $e) {
         echo "Une erreur s'est produite lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
     }
    header("location : page0.php");
    exit;
?>

</body></html>