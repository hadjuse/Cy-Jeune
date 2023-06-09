<!DOCTYPE html>
<html lang="fr">
<head></head> 
<body>
<?php
// Inclusion de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../php/vendor/autoload.php';
if (isset($_POST['submit'])){

  //On récupère les infos du jeune
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $date_naissance = $_POST['dateNaissance'];
  $mail = $_POST['mail'];
  $engagement = $_POST['presentation'];
  $reseau = $_POST['reseau'];
  $duree = $_POST['duree'];
  $commentaires = $_POST['commentaires'];
  $savoir_etre = $_POST['savoir'];

 // Paramètres de l'e-mail
 $expediteur = 'cyjeune6.4@laposte.net';
 $mot_de_passe = 'Flaviomarioluigi6.4';
 $sujet = '[JEUNE6.4] Nouvelle réponse de referencement';
 $corps_message = 'Bonjour'.' '.$prenom.'\n'.'Vous avez une nouvelle réponse concernant le référent'.
 'Veuillez vous connecter à l adresse suivante pour voir votre réponse:'.'http://localhost/Cy-Jeune/connexion.html'.'\n Cordialement, l équipe Jeune6.4';

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
 $mail->addAddress($mail);

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

  // Charger le contenu actuel du fichier JSON
  $json = file_get_contents('utilisateurs.json');
  $data = json_decode($json, true);

  // Récupérer le tableau des jeunes
  $utilisateurs = $data['utilisateurs'];
  $utilisateur = $utilisateurs[0];
  $indice = $utilisateur['referent'][0]["indice"];

  $utilisateur['referent'][0] = array( 
    'indice' => $indice,
    'nom' => $nom,
    'prenom' => $prenom,
    'mail' => $mail,
    'reseau' => $reseau,
    'date_naissance' => $date_naissance,
    'commentaire' => $commentaires,
    'duree' =>  $duree,
    'engagement'=> $engagement,
    'savoir_etre' => $savoir_etre,
    );
  // Convertir le tableau associatif en JSON
  $utilisateurs[0] = $utilisateur;
  $data['utilisateurs'] = $utilisateurs;
  $json = json_encode($data, JSON_PRETTY_PRINT);
  
  // Écrire le JSON dans un fichier
  file_put_contents('utilisateurs.json', $json);


  exit;
}
?>

</body></html>