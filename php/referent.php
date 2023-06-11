<!DOCTYPE html>
<html lang="fr">
<head></head> 
<body>
<?php
// Inclusion de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//On récupère les infos du jeune
$prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $date_naissance = $_POST['dateNaissance'];
  $mailj = $_POST['mail'];
  $engagement = $_POST['presentation'];
  $reseau = $_POST['reseau'];
  $duree = $_POST['duree'];
  $kdjeune = $_POST['idjeune'];
  $kdreferent = $_POST['idreferent'];

  // Vérifie si la demande a été validé ou non et ajoute a la fin du commentaire 
  if (isset($_POST['confirmer'])){
    $commentaires = $_POST['commentaires']."      Accepté";
  }
  elseif (isset($_POST['refuser'])){
    $commentaires = $_POST['commentaires']."      Refusé";
  }


  $savoir_etre = $_POST['savoir'];
  if (isset($savoir_etre)) {
    $savoir = $savoir_etre;   
  }
  else{
    $savoir = [];
  }

 

  // Charger le contenu actuel du fichier JSON
  $json = file_get_contents('utilisateurs.json');
  $data = json_decode($json, true);

  // Récupérer le tableau des jeunes
  $utilisateurs = $data['utilisateurs'];
  $utilisateur = $utilisateurs[$kdjeune];

  $utilisateur['referent'][$kdreferent] = array( 
    'indice' => $kdreferent,
    'nom' => $nom,
    'prenom' => $prenom,
    'mail' => $mailj,
    'reseau' => $reseau,
    'date_naissance' => $date_naissance,
    'commentaire' => $commentaires,
    'duree' =>  $duree,
    'engagement'=> $engagement,
    'savoir_etre' => $savoir,
    );
  // Convertir le tableau associatif en JSON
  $utilisateurs[$kdjeune] = $utilisateur;
  $data['utilisateurs'] = $utilisateurs;
  $json = json_encode($data, JSON_PRETTY_PRINT);
  
  // Écrire le JSON dans un fichier
  file_put_contents('utilisateurs.json', $json);


  require '../php/vendor/autoload.php';

  // Paramètres de l'e-mail
 $expediteur = 'cyjeune6.4@laposte.net';
 $mot_de_passe = 'Flaviomarioluigi6.4';
 $sujet = '[JEUNE6.4] demande traitée';
 $corps_message = 'Bonjour '.$prenom.', <br> Vous avez une nouvelle réponse concernant votre référent '. $utilisateur['referent'][$kdreferent]['nom'].' '.   $utilisateur['referent'][$kdreferent]['prenom'].'<br>
 Veuillez vous connecter à l adresse suivante pour voir votre réponse: <a href ="http://localhost/Cy-Jeune/connexion.html">http://localhost/Cy-Jeune/connexion.html</a> <br> Cordialement, l équipe Jeune6.4';

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
         $mail->addAddress($mailj);
 
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

  header("Location: ../php/merci.php");
?>

</body></html>