<!DOCTYPE html>
<html lang="fr">
<head></head> 
<body>
<?php

//On récupère les infos du jeune
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $date_naissance = $_POST['dateNaissance'];
  $mail = $_POST['mail'];
  $engagement = $_POST['presentation'];
  $reseau = $_POST['reseau'];
  $duree = $_POST['duree'];
  $idjeune = $_POST['idjeune'];
  $idreferent = $_POST['idreferent'];
  
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
  $utilisateur = $utilisateurs[$idjeune];

  $utilisateur['referent'][$idreferent] = array( 
    'indice' => $idreferent,
    'nom' => $nom,
    'prenom' => $prenom,
    'mail' => $mail,
    'reseau' => $reseau,
    'date_naissance' => $date_naissance,
    'commentaire' => $commentaires,
    'duree' =>  $duree,
    'engagement'=> $engagement,
    'savoir_etre' => $savoir,
    );
  // Convertir le tableau associatif en JSON
  $utilisateurs[$idjeune] = $utilisateur;
  $data['utilisateurs'] = $utilisateurs;
  $json = json_encode($data, JSON_PRETTY_PRINT);
  
  // Écrire le JSON dans un fichier
  file_put_contents('utilisateurs.json', $json);

  


echo isset($_POST["confirmer"]);
exit;
?>

</body></html>