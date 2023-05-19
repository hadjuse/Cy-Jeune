<?php
    session_start();
    require_once('php/statut.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/pageengagement.css">
<body>
<! banderole avec le nom de la page que la quelle on se situe>
    <div id="banderole">
        <a href="page0.html" ><img src="image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
        <div class="form"><a href="inscription.html" >inscription</a>
        <a href="connexion.html">connexion</a></div>
        <b>Pour faire de l'engagement une valeur</b>
    </div>
<! onglet de navigation entre les differentes pages>
    <div id="navigation">
        <a href="php/Jeune.php" id="jeunes">JEUNES</a>
        <a href="pagereferent.html" id="referent">RÉFÉRENT</a>
        <a href="pageconsultant.html" id="consultant">CONSULTANT</a>
        <a href="pagepartenaire.html" id="partenaires">PARTENAIRES</a>
    </div>
<! corps de la page avec les informations>
            <div id="textg"><h1>De quoi s’agit-il ?</h1><b>D’une opportunité : </b>celle qu’un engagement quelqu’il soit puisse être considérer
            à sa juste valeur ! <br>Tout eexpérience est source d’enrichissement et doit d’être reconnu largement.<br> Elle révèle un potentiel,
            l’expression d’un savoir-être à concrétiser.
            </div>
            <div id="textm"><h1>A qui s’adresse-t’il ?</h1>A vous, jeunes entre 16 et 30ans, qui vous êtes investis spontanément dans une
                association ou dans tout type d’action formelle ou informelle, et qui avez partagé de votre temps, de votre énergie, pour
                apporterun soutien, une aide, une compétence. <br><br>A vous, responsables de structures ou référents d’un jour, qui avez croisé 
                la route de ces jeunes et avez bénéficié même ponctuellement de cette implication citoyenne !<br> C’est l’occasion de 
                vous engager à votre tour pour ces jeunes en confirmant leur richesse pour en avoir été un temps les témoins mais aussi 
                les bénéficiaires !</div>
            <div id="textd">A vous, employeurs, recruteurs en ressources humaines, repré-sentants d’organismes de formation, qui recevez 
                ces jeunes, pour un emploi, un stage, un cursus de qualification, pour qui le savoir-être constitue le premier fondement 
                de toute capacité humaine.<br><br><h4> Cet engagement est une ressource à valoriser au fil d'un parcours en 3 étapes :</h4></div>
    
    <a href="pagejeune.html" class="tableau"><table id="tab1"  cellspacing="0" cellpadding="10"><tr id="rose" ><td>1ère étape la valorisation</td></tr>
            <tr id="rose2"><td>Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</td></tr></table></a>
    <a href="pagereferent.html" class="tableau"><table id="tab2" cellspacing="0" cellpadding="10"><tr id="vert" ><td>2ème étape la confirmation</td></tr>
        <tr id="vert2"><td>Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</td></tr></table></a>
            <a href="pageconsultant.html" class="tableau"><table id="tab3" cellspacing="0" cellpadding="10"><tr id="bleu" ><td>3ème étape la consultation</td>
            </tr><tr id="bleu2"><td>Validez cet engagement en prenant en compte sa valeur.</td></tr></table></a>
</body>
</html>