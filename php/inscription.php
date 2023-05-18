<?php
  session_start();
  if (isset($_POST['submit'])){

    //On récupère les infos d'utilisateurs
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    $reseau = $_POST['reseau'];

    // Charger le contenu actuel du fichier JSON
    $json = file_get_contents('utilisateurs.json');
    $data = json_decode($json, true);

    // Récupérer le tableau des utilisateurs
    $utilisateurs = $data['utilisateurs'];

    // On vérifie maintenant si le mail entré par l'utilisateur existe déjà dans la base de données ou pas.
    foreach ($utilisateurs as $utilisateur){
      if ($utilisateur["mail"] == $mail){
        echo "Le mail existe déjà";
        exit;
      }
    }
    $referent=array(
      'prenom' = "",
      'nom' => "",
      'date_naissance' => "",
      'mail' => "",
      'reseau' => "",
    );
    // Crée un tableau associatif avec les données de l'utilisateur
    $utilisateur = array(
      'prenom' => $prenom,
      'nom' => $nom,
      'date_naissance' => $date_naissance,
      'mail' => $mail,
      'mdp' => $mdp,
      'reseau' => $reseau,
      'engagement' => array(),
      'duree' => array(),
      'savoir_etre' => array(),
      'referent' = $referent
    );

    // Ajouter le nouvel utilisateur au tableau des utilisateurs
    $utilisateurs[] = $utilisateur;

    // Mettre à jour le tableau des utilisateurs dans le tableau complet
    $data['utilisateurs'] = $utilisateurs;

    // Convertir le tableau associatif en JSON
    $json = json_encode($data, JSON_PRETTY_PRINT);

    // Écrire le JSON dans un fichier
    file_put_contents('utilisateurs.json', $json);

    // Rediriger l'utilisateur vers une autre page
    header("Location: ../connexion.html");
    exit;
}
?>
