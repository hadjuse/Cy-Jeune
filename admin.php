<?php
    session_start();

    if (isset($_POST['submit'])) {
        $admin = $_POST['admin'];
        $mdp = $_POST['mdp'];
        // Étape de connexion
        $json_data = file_get_contents('php/admin.json');
        // L'argument true permet de décoder le fichier en tant que tableau associatif
        $data = json_decode($json_data, true);
        $administration = $data['admin'];
        $admin_trouver = false;
    
        if ($administration[0]['pseudo'] == $admin && $administration[0]['mdp'] == $mdp) {
            $admin_trouver = true;
            $_SESSION['admin'] = $admin;
        }
    
        if ($admin_trouver == false) {
            header('Location: connexion_admin.html');
            exit;
        }
    
        //include("php/suppresion.php");
        //$s=$_GET['q'];
        /*
        echo $s;
        print_r($_GET);
        if (isset($s)) {
            $ind = $s;
            echo $ind;
            // Faites d'autres opérations avec $ind si nécessaire
        } else {
            echo 'Indice non trouvé';
        }*/
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
    <div id = "utilisateurs"></div>
    <div id = "test"></div>
    <script src="javascript/admin.js"></script>
    <div class="btn-grad2"><a href="php/deconnexion.php" id="nouv"><div class="white">Déconnexion</div></a></div>
    
</body>
</html>
