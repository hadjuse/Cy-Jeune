
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription Jeune</title>
    <link rel="stylesheet" href="css/inscription.css">
    <script src="javascript/inscription.js">
    </script>
</head>
<?php
  session_start();
  if (isset($_POST['submit'])){

    //On récupère les infos d'utilisateurs
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $mail = $_POST['mail'];
    //$mdp = $_POST['mdp'];
    $reseau = $_POST['reseau'];
    
    //cryptage du mot de passe 
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    // Charger le contenu actuel du fichier JSON
    $json = file_get_contents('utilisateurs.json');
    $data = json_decode($json, true);
    
    // Récupérer le tableau des utilisateurs
    $utilisateurs = $data['utilisateurs'];
   //Voir si l'existe deja un utilisateur 
    foreach ( $utilisateurs as $utilisateur) {
      if ($utilisateur['mail'] == $mail){
        header("Location: ../inscription.html");
        exit;
      }
    }
   if ( isset ($utilisateurs)){
      $indice = count($utilisateurs);
   }
   else {
      $indice = 0;
   }
    // Crée un tableau associatif avec les données de l'utilisateur
    $utilisateur = array(
      'indice' => $indice,
      'prenom' => $prenom,
      'nom' => $nom,
      'date_naissance' => $date_naissance,
      'mail' => $mail,
      'mdp' => $mdp,
      'reseau' => $reseau,
      'referent' => array()
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
