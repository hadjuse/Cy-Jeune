<!DOCTYPE html>
<html lang="fr">
<head></head> 
<body>
<?php

if (isset($_POST['submit'])){

  //On récupère les infos du jeune
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $dateNaissance = $_POST['dateNaissance'];
  $mail = $_POST['mail'];
  $presentation = $_POST['presentation'];
  $reseau = $_POST['reseau'];
  $duree = $_POST['duree'];
  $commentaires = $_POST['commentaires'];
  $commentaire1 = $_POST['commentaire1'];

  // Charger le contenu actuel du fichier JSON
  $json = file_get_contents('test.json');
  $data = json_decode($json, true);

  // Récupérer le tableau des jeunes
  $jeunes = $data['jeunes'];
  // Crée un tableau associatif avec les données de l'jeune
  $jeune = array(
    'prenom' => $prenom,
    'nom' => $nom,
    'dateNaissance' => $dateNaissance,
    'presentation' => $presentation,
    'mail' => $mail,
    'reseau' => $reseau,
    'commentaires' => $commentaires,
    'duree' => $duree,
    'commentaire' => $commentaire1
  );

  // Ajouter le nouveau jeune au tableau des jeunes
  $jeunes[] = $jeune;

  // Mettre à jour le tableau des jeunes dans le tableau complet
  $data['jeunes'] = $jeunes;

  // Convertir le tableau associatif en JSON
  $json = json_encode($data, JSON_PRETTY_PRINT);

  // Écrire le JSON dans un fichier
  file_put_contents('test.json', $json);


  exit;
}
?>
</body>