<?php
    session_start();
    
    if (isset($_POST['submit']))
    {
        $admin = $_POST['admin'];
        $mdp= $_POST['mdp'];

        // on déclare la function supprimer qu'on utilisera plus tards
        function supprimer($id)
        {
            $jsonData = file_get_contents('php/utilisateurs.json'); // Charger les données JSON depuis le fichier
            $data = json_decode($jsonData, true); // Décoder les données JSON en un tableau associatif

            $cle_utilisateur = $id; // Clé du compte à supprimer
            $index = -1; // Index du compte dans le tableau des données JSON

            foreach ($data['utilisateurs'] as $cle => $account) { // Parcourir chaque compte
                if ($account['indice'] === $cle_utilisateur) { // Vérifier si la clé correspond
                    $index = $cle; // Stocker l'index du compte à supprimer
                    break;
                }
            }

            if ($index !== -1) { // Si l'index du compte a été trouvé
                unset($data['utilisateurs'][$index]); // Supprimer le compte du tableau
                $data['utilisateurs'] = array_values($data['utilisateurs']); // Réorganiser les index du tableau
            }

            $jsonData = json_encode($data, JSON_PRETTY_PRINT); // Encoder les données au format JSON
            file_put_contents('php/utilisateurs.json', $jsonData); // Enregistrer les modifications dans le fichier

        }

        //Etape de connexion
        $json_data = file_get_contents('php/admin.json');

        // l'argument true permet de décoder le fichier en tant que tableau associative
        $data = json_decode($json_data, true); 

        $administration = $data['admin'];
        $admin_trouver = false;
        if ($administration[0]['pseudo'] == $admin && $administration[0]['mdp'] == $mdp){
            $admin_trouver = true;
            $_SESSION['admin'] = $admin; 
        }
        if ($admin_trouver == false){
            header('Location: connexion_admin.html');
            exit;
        }
        
        //test
        supprimer(0);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminstrateur</title>
</head>
<body>
<div class="btn-grad2"><a href="php/deconnexion.php" id="nouv"><div class="white">Déconnexion</div></a></div>
</body>
</html>