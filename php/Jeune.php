
<?php
    session_start();
    if ($_SESSION['connexion'] == 'visiteur'){
        header('Location: ../inscription.html');
        exit;
    
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageJeune</title>
    <link rel="stylesheet" href="../css/jeune.css">
</head>
<body>

<!--banderole avec le nom de la page que la quelle on se situe-->
        <div id="banderole">
            <a href="../page0.php"><img src="../image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b id="Jeune">JEUNE</b>
            <b id="hautpage">Je donne de la valeur à mon engagement</b>
        </div>

        <!--onglet de navigation entre les differentes pages-->
            <div id="navigation">
                <a href="../php/Jeune.php" id="jeunes">JEUNES</a>
                <a href="../pagereferent.php" id="referent">RÉFÉRENT</a>
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