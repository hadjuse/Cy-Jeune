<!DOCTYPE html>
<html lang="fr">
<head></head> 
<body>
<?php

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

  // Charger le contenu actuel du fichier JSON
  $json = file_get_contents('utilisateurs.json');
  $data = json_decode($json, true);

  // Récupérer le tableau des jeunes
  $utilisateurs = $data['utilisateurs'];
  $utilisateur = $utilisateurs[0];

  $utilisateur['referent']['prenom'][0] = $prenom;
  $utilisateur['referent']['nom'][0] = $nom;
  $utilisateur['referent']['date_naissance'][0] = $date_naissance;
  $utilisateur['referent']['mail'][0] = $mail;
  $utilisateur['referent']['reseau'][0] = $reseau;
  $utilisateur['duree'][0] = $duree;
  $utilisateur['referent']['commentaires'][0] = $commentaires;
  $utilisateur['savoir_etre'][0] = $savoir_etre;
  $utilisateur['engagement'][0] = $engagement;
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