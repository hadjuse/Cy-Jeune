<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/pagereferent.css">

<?php
    session_start();
    if ($_SESSION['connexion'] == 'visiteur'){
        header('Location: inscription.html');
        exit;
    
    }
?>

    <script>
        // Charger le fichier JSON
        fetch('php/utilisateurs.json')
          .then(response => response.json())
          .then(data => {

            // Extraire la valeur souhaitée du fichier JSON
            var prenom = data['utilisateurs'][1]['referent'][0]['prenom'];
            var nom = data['utilisateurs'][1]['referent'][0]['nom'];
            var dateNaissance = data['utilisateurs'][1]['referent'][0]['date_naissance'];
            var presentation = data['utilisateurs'][1]['engagement'][0];
            var mail = data['utilisateurs'][1]['referent'][0]['mail'];
            var reseau = data['utilisateurs'][1]['referent'][0]['reseau'];
            var duree = data['utilisateurs'][1]['duree'][0];
            var savoiretre = data['utilisateurs'][1]['savoir_etre'][0];
            var len = savoiretre.length;

            // Mettre à jour la valeur de l'input
            document.getElementById("prenom").value = prenom;
            document.getElementById("nom").value = nom;
            document.getElementById("dateNaissance").value = dateNaissance;
            document.getElementById("presentation").value = presentation;
            document.getElementById("mail").value = mail;
            document.getElementById("reseau").value = reseau;
            document.getElementById("duree").value = duree;
            
            if( len < 4 ){
                for (var j = 4; j > len; j--) {
                    var choixId = "Dchoix" + j;
                    var choixElement = document.getElementById(choixId).innerHTML ="";
                }
            }

            for (var i = 0; i < len; i++) {
                    var choixId = "choix" + (i + 1);
                    var inputId = "input" + (i + 1);
                    var choixElement = document.getElementById(choixId);
                    if (choixElement) {
                        choixElement.textContent = savoiretre[i];
                    }
                    var choixElement = document.getElementById(inputId);
                    if (choixElement) {
                        choixElement.value = savoiretre[i];
                    }
                }
          })
          .catch(error => console.error(error)); 
      </script>
    <!-- banderole avec le nom de la page que la quelle on se situe -->
        <div id="banderole">
            <a href="pageengagement.php"><img src="image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b id="ref">RÉFÉRENT</b>
            <b id="hautpage">Je confirme la valeur de ton engagement</b>
        </div>
        <!-- onglet de navigation entre les differentes pages -->
            <div id="navigation">
                <a href="php/Jeune.php" id="jeunes">JEUNES</a>
                <a href="pagereferent.html" id="referent">RÉFÉRENT</a>
                <a href="pageconsultant.html" id="consultant">CONSULTANT</a>
                <a href="pagepartenaire.html" id="partenaires">PARTENAIRES</a>
            </div>
            <!-- corps de la page avec les informations -->
            <script>
                function referent(a){
                    var requestURL = "../php/utilisateurs.json";
                    var request = new XMLHttpRequest();
                    request.open('GET', requestURL);
                    
                }
            </script>
            <div id="contenu">
                <p class="tete"> Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune </p>
                    <form action="php/referent.php" method="post" >
                        <div id="description">
                            <div id="commentaire"><table id="tableaucom">
                                
                                <tr class="head"><td><label for="commentaires" >COMMENTAIRES</label></td></tr>
                                <tr ><td><textarea value="t1" name="commentaires" id="commentaires" class="body" required ></textarea></td></tr>
                            </table>
                            </div>
                            <div id="profil"><table >
                                <tr><td><label for="nom" class="head">NOM :</label>
                                <input value="" type="text" name="nom" id="nom" required class="body"></input></td></tr>
                                <tr><td><label for="prenom" class="head">PRENOM :</label>
                                <input value="" type="text" name="prenom" id="prenom" required class="body"></input></td></tr>
                                <tr><td><label for="dateNaissance" class="head">DATE DE NAISSANCE :</label>
                                <input value="" type="date" name="dateNaissance" id="dateNaissance" required class="body"></input></td></tr>
                                <tr><td><label for="mail" class="head">MAIL :</label>
                                <input value="" type="mail" name="mail" id="mail" required class="body"></input></td></tr>
                                <tr><td><label for="reseau" class="head">Réseau social :</label>
                                <input value="" type="text" name="reseau" id="reseau" required class="body"></input></td></tr>
                                <tr><td><label for="presentation" class="head">Presentation :</label>
                                <input value="" type="text" name="presentation" id="presentation" required class="body"></input></td></tr>
                                <tr><td><label for="duree" class="head">Durée :</label>
                                <input value="" type="text" name="duree" id="duree" required class="body"></input></td></tr>
                            </table>
                            </div>
                            <div id="savoiretre"><table>
                                <tr class="savoir-etre"><td>SES SAVOIRS ETRE</td></tr>
                                
                                    <tr id="jesuis"><td>je confirme qu'il est*</td></tr>
                                    <tr id="choix"><td>
                                        <div id="Dchoix1">
                                            <input id="input1" type="checkbox" value="" name="savoir[]">
                                        <label  id="choix1" for="choix1"> </label>
                                        </div><div id="Dchoix2">
                                            <input id="input2" type="checkbox" value="" name="savoir[]">
                                        <label id="choix2" for="choix2"> </label>
                                        </div><div id="Dchoix3">
                                            <input id="input3" type="checkbox" value="" name="savoir[]">
                                        <label id="choix3" for="choix3"> </label>
                                        </div><div id="Dchoix4">
                                            <input id="input4" type="checkbox" value="" name="savoir[]">
                                        <label id="choix4" for="choix4"> </label>
                                        </div>
                                </table>
                            </div>     
                        </div>                  
                        <button type="submit" name="submit" id="submit" class="btn-grad2">Confirmez la demande</button>
                    </form>
            </div>

            </div>
                    
</body>

</html><form>

  
  