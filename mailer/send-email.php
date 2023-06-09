<?php
// Inclusion de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if (isset($_POST['adresse_email'])) {
    $adresse_email = $_POST['adresse_email'];
    
    // Paramètres de l'e-mail
    $expediteur = 'cyjeune6.4@laposte.net';
    $mot_de_passe = 'Flaviomarioluigi6.4';
    $sujet = 'Bonjour';
    $corps_message = 'AMOG US';
    
    // Configuration de PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug=2;
    $mail->Host = 'smtp.laposte.net';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = 'cyjeune6.4';
    $mail->Password = $mot_de_passe;
    
    // Destinataire et expéditeur
    $mail->setFrom($expediteur,'cyjeune6.4');
    $mail->addAddress($adresse_email);
    
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
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <meta charset="UTF-8">
</head>
<body>
<!-- Formulaire HTML -->
<form method="POST" action="">
    <input type="email" name="adresse_email" placeholder="Adresse e-mail" required>
    <button type="submit">Envoyer</button>
</form>
</body>
</html>