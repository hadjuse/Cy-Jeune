<?php
if(session_start()){
    session_destroy();
}
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<link rel="stylesheet" href="css/page0.css">
<body>
    <div id="corps">
        <p id="text1"> Pour faire de l'engagement une valeur ! </p>
        <img src="image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png" >
        <p id="text2">...l'expression d'un potentiel, la promesse d'une richesse ! </p>
        <p><a href="pageengagement.php" value="ENTRER" id="ENTRER"> ENTRER</p>
    </div>
<div id="footer"> JEUNES 6.4 est un dispositif de valorisation de l'engagement des jeunes en Pyrénés-Atlantiques soutenu par l'État,le Conseil général, le conseil régional, les CAF Béarn-Soule et Pays basque, la MSA, l'université de Pau et des pays de l'Adour, la CPAM.</div>
</body>
</html>