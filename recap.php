<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/recap.css">
    <?php 
    session_start();
    if ($_SESSION['connexion'] == NULL){
        header('Location: inscription.html');
        exit;
    }
    if ($_SESSION['connexion'] == 'visiteur'){
        header('Location: inscription.html');
        exit;
    }
    
    ?>
    <script>
        function referent(u,r){
            // Charger le fichier JSON
            fetch('php/utilisateurs.json')
            .then(response => response.json())
            .then(data => {

                // Extraire la valeur souhaitée du fichier JSON
                var prenom = data['utilisateurs'][u]['referent'][r]['prenom'];
                var nom = data['utilisateurs'][u]['referent'][r]['nom'];
                var dateNaissance = data['utilisateurs'][u]['referent'][r]['date_naissance'];
                var presentation = data['utilisateurs'][u]['referent'][r]['engagement'];
                var mail = data['utilisateurs'][u]['referent'][r]['mail'];
                var reseau = data['utilisateurs'][u]['referent'][r]['reseau'];
                var duree = data['utilisateurs'][u]['referent'][r]['duree'];
                var commentaires = data['utilisateurs'][u]['referent'][r]['commentaire'];
                var savoiretre = data['utilisateurs'][u]['referent'][r]['savoir_etre'];
                var len = savoiretre.length;
                
                // Mettre à jour la valeur de l'input
                document.getElementById("prenom").value = prenom;
                document.getElementById("nom").value = nom;
                document.getElementById("dateNaissance").value = dateNaissance;
                document.getElementById("presentation").value = presentation;
                document.getElementById("mail").value = mail;
                document.getElementById("reseau").value = reseau;
                document.getElementById("duree").value = duree;
                document.getElementById("commentaires").innerHTML = commentaires;
                
                
                // Je supprime les champs en trop si il n'y a pas 12 ( valeurs max ) savoir-être 
                if( len < 12 ){
                    for (var j = 12; j > len; j--) {
                        var choixId = "Dchoix" + j;
                        var choixElement = document.getElementById(choixId).innerHTML ="";
                    }
                }

                // Mettre à jour la valeur de l'input
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
        }
      </script>
    <!-- banderole avec le nom de la page que la quelle on se situe -->
        <div id="banderole">
            <a href="page0.php"><img src="image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b id="ref">RÉFÉRENT</b>
            <b id="hautpage">Je confirme la valeur de ton engagement</b>
        </div>
        <!-- onglet de navigation entre les differentes pages -->
            <div id="navigation">
                <a href="php/Jeune.php" id="jeunes">JEUNES</a>
                <a href="recap.php" id="referent">RÉFÉRENT</a>
                <a href="pageDemandeConsultant.php" id="consultant">CONSULTANT</a>
                <a href="pagepartenaire.html" id="partenaires">PARTENAIRES</a>
            </div>
            <!-- corps de la page avec les informations -->
            <?php
                // Menu ou est affiché tout les référents du jeune connecté 
                echo" <div id=referents> Nom du référent :<br>";
                $json = file_get_contents('php/utilisateurs.json');
                $data = json_decode($json, true);
                $utilisateurs = $data['utilisateurs'];
                if (empty($utilisateurs[$_SESSION['indice']]['referent'])){
                    header('Location: php/jeune.php');
                    exit;
                }
                foreach ($utilisateurs as $us){
                    // parcours de tout les jeunes 
                if ($_SESSION["mail"] == $us["mail"]){
                    foreach ($us["referent"] as $pr ){
                        // Parcours de tout les référents du jeune connecté  
                       if (substr($pr["commentaire"], -3) == "sé"){
                            echo "<table id='referenttabRefusé'><tr><td><button onclick='referent(" . $_SESSION["indice"] . "," . $pr['indice'] . ")'>" . $pr['nom'] . ' ' . $pr['prenom'] ."</td></tr></table>";
                        }
                        elseif(substr($pr["commentaire"], -3) == "té"){
                            echo "<table id='referenttabAccepté'><tr><td><button onclick='referent(" . $_SESSION["indice"] . "," . $pr['indice'] . ")'>" . $pr['nom'] . ' ' . $pr['prenom'] ."</td></tr></table>";
                        }
                        else{
                            echo "<table id='referenttab'><tr><td><button onclick='referent(" . $_SESSION["indice"] . "," . $pr['indice'] . ")'>" . $pr['nom'] . ' ' . $pr['prenom'] ."</td></tr></table>";
                        } 
                        // Affichage de la demande avec différents couleurs suivant leur état
                        
                   }  
                   echo "<br><p style='color:#3f1ad1'>En attente</p> <p style='color:#2fd11a'>Accepté</p> <p style='color:#d11a1a'>Refusé</p>" ; 
                }
                }
                echo"</div>";   

                    // Vérification de qui peut accéder au site ou non
                echo '<script> referent('.$_SESSION["indice"].',0) </script>';
                
            ?>
            <div id="contenu">
                <p class="tete"> Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune </p>
                    <form action="php/referent.php" method="post" >
                        <div id="description">
                            <div id="commentaire"><table id="tableaucom">
                                
                                <tr class="head"><td><label for="commentaires" >COMMENTAIRES</label></td></tr>
                                <tr ><td><textarea disabled value="t1" name="commentaires" id="commentaires" class="body" required ></textarea></td></tr>
                            </table>
                            </div>
                            <div id="profil"><table >
                                <tr><td><label for="nom" class="head">NOM :</label>
                                <input disabled value="" type="text" name="nom" id="nom" required class="body"></input></td></tr>
                                <tr><td><label for="prenom" class="head">PRENOM :</label>
                                <input disabled value="" type="text" name="prenom" id="prenom" required class="body"></input></td></tr>
                                <tr><td><label for="dateNaissance" class="head">DATE DE NAISSANCE :</label>
                                <input disabled value="" type="date" name="dateNaissance" id="dateNaissance" required class="body"></input></td></tr>
                                <tr><td><label for="mail" class="head">MAIL :</label>
                                <input disabled value="" type="mail" name="mail" id="mail" required class="body"></input></td></tr>
                                <tr><td><label for="reseau" class="head">Réseau social :</label>
                                <input disabled value="" type="text" name="reseau" id="reseau" required class="body"></input></td></tr>
                                <tr><td><label for="presentation" class="head">Presentation :</label>
                                <input disabled value="" type="text" name="presentation" id="presentation" required class="body"></input></td></tr>
                                <tr><td><label for="duree" class="head">Durée :</label>
                                <input disabled value="" type="text" name="duree" id="duree" required class="body"></input></td></tr>
                            </table>
                            </div>
                            <div id="savoiretre"><table>
                                <tr class="savoir-etre"><td>SES SAVOIRS ETRE</td></tr>
                                
                                    <tr id="jesuis"><td>je confirme qu'il est*</td></tr>
                                    <tr id="choix"><td>
                                        <div id="Dchoix1">
                                            <input id="input1" type="checkbox" value="" name="savoir[]" disabled>
                                        <label  id="choix1" for="choix1"> </label>
                                        </div><div id="Dchoix2">
                                            <input id="input2" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix2" for="choix2"> </label>
                                        </div><div id="Dchoix3">
                                            <input id="input3" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix3" for="choix3"> </label>
                                        </div><div id="Dchoix4">
                                            <input id="input4" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix4" for="choix4"> </label>
                                        </div>
                                        <div id="Dchoix5">
                                            <input id="input5" type="checkbox" value="" name="savoir[]" disabled>
                                        <label  id="choix5" for="choix5"> </label>
                                        </div><div id="Dchoix6">
                                            <input id="input6" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix6" for="choix6"> </label>
                                        </div><div id="Dchoix7">
                                            <input id="input7" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix7" for="choix7"> </label>
                                        </div><div id="Dchoix8">
                                            <input id="input8" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix8" for="choix8"> </label>
                                        </div>
                                        <div id="Dchoix9">
                                            <input id="input9" type="checkbox" value="" name="savoir[]" disabled>
                                        <label  id="choix9" for="choix9"> </label>
                                        </div><div id="Dchoix10">
                                            <input id="input10" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix10" for="choix10"> </label>
                                        </div><div id="Dchoix11">
                                            <input id="input11" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix11" for="choix11"> </label>
                                        </div><div id="Dchoix12">
                                            <input id="input12" type="checkbox" value="" name="savoir[]" disabled>
                                        <label id="choix12" for="choix12"> </label>
                                        </div>
                                </table>
                            </div>     
                        </div>                  
                    </form>
            </div>

            </div>
                    
</body>

</html><form>