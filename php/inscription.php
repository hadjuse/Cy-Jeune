<?php
// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {

  // Récupère les données du formulaire
  $prenom = $_POST['prenom'];
  $nom = $_POST['nom'];
  $date_naissance = $_POST['date_naissance'];
  $mail = $_POST['mail'];
  $mdp = $_POST['mdp'];
  $reseau = $_POST['réseau'];

  // Crée un tableau associatif avec les données de l'utilisateur
  $utilisateur = array(
    'prenom' => $prenom,
    'nom' => $nom,
    'date_naissance' => $date_naissance,
    'mail' => $mail,
    'mdp' => $mdp,
    'reseau' => $reseau
  );

  // Charge le contenu du fichier JSON existant (s'il existe)
  $utilisateurs = array();
  if (file_exists('utilisateurs.json')) {
    $utilisateurs_json = file_get_contents('utilisateurs.json');
    $utilisateurs = json_decode($utilisateurs_json, true);
  }

  // Ajoute le nouvel utilisateur au tableau existant
  array_push($utilisateurs, $utilisateur);

  // Encode le tableau en JSON
  $utilisateurs_json = json_encode($utilisateurs, JSON_PRETTY_PRINT);

  // Écrit le contenu JSON dans le fichier
  file_put_contents('utilisateurs.json', $utilisateurs_json);

  // Affiche un message de confirmation
  echo "Utilisateur ajouté avec succès !";
}
?>
