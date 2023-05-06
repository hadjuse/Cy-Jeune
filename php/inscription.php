<?php
if (isset($_POST['submit'])){
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $date_naissance = $_POST['date_naissance'];
  $mail = $_POST['mail'];
  $mdp = $_POST['mdp'];
  $reseau = $_POST['reseau'];

  // Crée un tableau associatif avec les données de l'utilisateur
  $utilisateur = array(
    'prenom' => $prenom,
    'nom' => $nom,
    'date_naissance' => $date_naissance,
    'mail' => $mail,
    'mdp' => $mdp,
    'reseau' => $reseau
  );

  // Charger le contenu actuel du fichier JSON
  $json = file_get_contents('utilisateurs.json');
  $data = json_decode($json, true);

  // Récupérer le tableau des utilisateurs
  $utilisateurs = $data['utilisateurs'];

  // Ajouter le nouvel utilisateur au tableau des utilisateurs
  $utilisateurs[] = $utilisateur;

  // Mettre à jour le tableau des utilisateurs dans le tableau complet
  $data['utilisateurs'] = $utilisateurs;

  // Convertir le tableau associatif en JSON
  $json = json_encode($data, JSON_PRETTY_PRINT);

  // Écrire le JSON dans un fichier
  file_put_contents('utilisateurs.json', $json);
}
?>
