<?php
  session_start();
  if (isset($_POST['submit'])){

    //On récupère les infos d'utilisateurs
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $mail = $_POST['mail'];
    $reseau = $_POST['reseau'];
    
    // Charger le contenu actuel du fichier JSON
    $json = file_get_contents('utilisateurs.json');
    $data = json_decode($json, true);
    
    // Récupérer le tableau des utilisateurs
    $utilisateurs = $data['utilisateurs'];
   //Voir si l'existe deja un utilisateur 
    // Crée un tableau associatif avec les données de l'utilisateur
    $utilisateur = array(
      'indice' => $utilisateurs[$_SESSION['indice']]['indice'],
      'prenom' => $prenom,
      'nom' => $nom,
      'date_naissance' => $date_naissance,
      'mail' => $mail,
      'mdp' => $utilisateurs[$_SESSION['indice']]['mdp'],
      'reseau' => $reseau,
      'referent' => $utilisateurs[$_SESSION['indice']]['referent']
    );

    // Ajouter le nouvel utilisateur au tableau des utilisateurs
    $utilisateurs[$_SESSION["indice"]] = $utilisateur;

    // Mettre à jour le tableau des utilisateurs dans le tableau complet
    $data['utilisateurs'] = $utilisateurs;

    // Convertir le tableau associatif en JSON
    $json = json_encode($data, JSON_PRETTY_PRINT);

    // Écrire le JSON dans un fichier
    file_put_contents('utilisateurs.json', $json);

    // Rediriger l'utilisateur vers une autre page
    header("Location: ../php/Jeune.php");
    exit;
}
?>