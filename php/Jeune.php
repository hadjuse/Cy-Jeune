<?php
    session_start();
    if (isset($_POST['submit'])){
        
        // On récupère les infos d'utilisateurs
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        // Charger le contenu actuel du fichier JSON
        $json = file_get_contents('utilisateurs.json');
        $data = json_decode($json, true);
        
        $utilisateurs = $data['utilisateurs'];
        
        // verifie si l'utilisateur existe et initialie une session et un cookie pour l'utilisateurs
        $utilisateurs_trouve = false;
        foreach($utilisateurs as $utilisateur){
            if ($mail == $utilisateur['mail'] && $mdp == $utilisateur['mdp']){
                $_SESSION['login'] = $utilisateur['nom'];      
                setcookie("login", $utilisateur["prenom"], time()+60*60*24);
                break;
            }
        }
        //$response = array('connexion' => $utilisateurs_trouve);
        //echo json_encode($response);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageJeune</title>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
<!--banderole avec le nom de la page que la quelle on se situe-->
        <div id="banderole">
            <a href="../page0.html"><img src="../image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b id="Jeune">JEUNE</b>
            <b id="engagement">Je donne de la valeur à mon engagement</b>
        </div>
        <!--onglet de navigation entre les differentes pages-->
            <div id="navigation">
                <a href="pagejeune.html" id="jeunes">JEUNES</a>
                <a href="pagereferent.html" id="referent">RÉFÉRENT</a>
                <a href="pageconsultant.html" id="consultant">CONSULTANT</a>
                <a href="pagepartenaire.html" id="partenaires">PARTENAIRES</a>
            </div>
            <h1 align="center">Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</h1>
    <?php
    $session_utilisateur = $_SESSION['login'];      
    echo $_COOKIE['login'];
    ?>
</body>
</html>