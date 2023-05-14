
<?php
    session_start();
    function logout(){
        setcookie("engagement", null, time()+60*60*24);
        setcookie("duree", $utilisateur['duree'], time()+60*60*24);
        setcookie("savoir_etre", "qzefg", time()+60*60*24);
    }
    if (isset($_POST['submit'])){
        
        // On récupère les infos d'utilisateurs
        $mail = $_POST['mail'];
        $mdp = $_POST['mdp'];    
        // Charger le contenu actuel du fichier JSON
        $json = file_get_contents('utilisateurs.json');
        $data = json_decode($json, true);
        
        $utilisateurs = $data['utilisateurs'];
        
        // verifie si l'utilisateur existe et initialie une session et des cookie pour l'utilisateur
        $utilisateurs_trouve = false;
        foreach($utilisateurs as $utilisateur){
            if ($mail === $utilisateur['mail'] && $mdp === $utilisateur['mdp']){
                // on initialise les sessions dont on veut simplement afficher le temps de la visite
                $_SESSION['mail'] = $utilisateur['mail'];
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['prenom'] = $utilisateur['prenom'];

                // On initialise des cookies de l'utilisateur pour une durée de 24h
                /*
                setcookie("engagement", "", time()+60*60*24);
                setcookie("duree", "", time()+60*60*24);
                setcookie("savoir_etre", "qzefg", time()+60*60*24);*/   
                $utilisateurs_trouve = true;
                break;
            }
        }
        if ($utilisateurs_trouve == false){
            echo "Utilisateur non trouvé";
            exit;
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
    <link rel="stylesheet" href="../css/pagejeune.css">
</head>
<body>

<!--banderole avec le nom de la page que la quelle on se situe-->
        <div id="banderole">
            <a href="../page0.html"><img src="../image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b id="Jeune">JEUNE</b>
            <b id="hautpage">Je donne de la valeur à mon engagement</b>
        </div>

        <!--onglet de navigation entre les differentes pages-->
            <div id="navigation">
                <a href="../php/Jeune.php" id="jeunes">JEUNES</a>
                <a href="../pagereferent.html" id="referent">RÉFÉRENT</a>
                <a href="../pageconsultant.html" id="consultant">CONSULTANT</a>
                <a href="../pagepartenaire.html" id="partenaires">PARTENAIRES</a>
            </div>
        <h1 align="center">Récapitulatif de votre compte</h1>

    <div class="corps">
        <p>Nom:
            <div id="carree">
                <?php
                    $session_nom = $_SESSION['nom'];
                    echo $session_nom;
                ?>
            </div>
        </p>
        <p>Prenom:
            <div id="carree">
                <?php
                    $session_prenom = $_SESSION['prenom'];
                    echo $session_prenom;
                ?>
            </div>
            
        </p>
        <p>mail:
            <div id="carree">
                <?php
                    $session_mail = $_SESSION['mail'];
                    echo $session_mail;
                ?>    
            </div>  
        </p>
    <div class="btn-grad"><a href="../pageJeune.html" id="nouv"><div class="white">Cliquez ici pour ajouter une nouvelle demande</div></a></div>
    </div>            
</body>
</html>