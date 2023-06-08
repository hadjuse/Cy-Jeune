<?php
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$dateNaissance = $_POST['date_naissance'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

// Vérifier si l'adresse e-mail existe déjà dans le fichier JSON
$file = 'php/utilisateurs.json';
$json = file_get_contents($file);
$data1 = json_decode($json, true);

foreach ($data1 as $user) {
  if ($user['mail'] === $email) {
    // L'adresse e-mail existe déjà, arrêter l'exécution et retourner une réponse d'erreur
    $response = array('success' => false, 'message' => 'Adresse e-mail déjà utilisée');
    echo json_encode($response);
    exit; // Arrêter l'exécution du script
  }
}

// Créer un tableau associatif avec les données
$data = array(
  'nom' => $nom,
  'prenom' => $prenom,
  'date_naissance' => $dateNaissance,
  'email' => $email,
  'mdp' => $mdp
);

// Ajouter les nouvelles données au tableau existant
$data1[] = $data;

// Convertir le tableau en JSON
$jsonData = json_encode($data1);

// Enregistrer le JSON dans le fichier
file_put_contents($file, $jsonData);

// Répondre avec une réponse JSON indiquant que l'enregistrement a réussi
$response = array('success' => true);
echo json_encode($response);
?>