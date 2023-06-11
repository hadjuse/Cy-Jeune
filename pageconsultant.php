<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/pageconsultant.css">
<?php 
if(session_start()){
    session_destroy();
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
            <b id="ref">CONSULTANT</b>
            <b id="hautpage">Je donne de la valeur à ton engagement</b>
        </div>
        <!-- onglet de navigation entre les differentes pages -->
            <div id="navigation">
                <a href="php/Jeune.php" id="jeunes">JEUNES</a>
                <a href="recap.php" id="referent">RÉFÉRENT</a>
                <a href="pageconsultant.php" id="consultant">CONSULTANT</a>
                <a href="pagepartenaire.html" id="partenaires">PARTENAIRES</a>
            </div>
            <!-- corps de la page avec les informations -->
            <?php
                session_start();

                // Je récupère les données de l'URL
                $jeune = $_GET['jeune'];
                $referent = $_GET['referent'];

                // J'affiche mes demandes de références validés, séléctionez par le jeune 
                echo" <div id=referents> Nom du référent :<br>";
                $json = file_get_contents('php/utilisateurs.json');
                $data = json_decode($json, true);
                $utilisateurs = $data['utilisateurs'];
                for($k=0; $k<count($referent);$k++){
                            echo "<table id='referenttabAccepté'><tr><td><button onclick='referent(" . $jeune . "," . $referent[$k] . ")'>" . $utilisateurs[$jeune]['referent'][$referent[$k]]['nom'] . ' ' .$utilisateurs[$jeune]['referent'][$referent[$k]]['prenom'] ."</td></tr></table>";
                }
                echo"</div>";      
?>
            <div id="contenu">
                <p class="tete"> Les référents : </p>
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
                                
                                    <tr id="jesuis"><td>Il est</td></tr>
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
                    <?php
                        //On prérempli le tableau avec les informations du premiers référents  
                        echo "<script> referent(".$jeune.",".$referent[0].") </script>";
                    ?>

                    <p class="tete"> Le jeune : </p>
                    <form action="php/referent.php" method="post" >
                        <div id="description2">
                            <div id="profil"><table >
                                <tr><td><label for="nom" class="head">NOM :</label>
                                <input disabled value="" type="text" name="nomJeune" id="nomJeune" required class="body"></input></td></tr>
                                <tr><td><label for="prenomJeune" class="head">PRENOM :</label>
                                <input disabled value="" type="text" name="prenomJeune" id="prenomJeune" required class="body"></input></td></tr>
                                <tr><td><label for="dateNaissance" class="head">DATE DE NAISSANCE :</label>
                                <input disabled value="" type="date" name="dateNaissanceJeune" id="dateNaissanceJeune" required class="body"></input></td></tr>
                                <tr><td><label for="mail" class="head">MAIL :</label>
                                <input disabled value="" type="mail" name="mailJeune" id="mailJeune" required class="body"></input></td></tr>
                                <tr><td><label for="reseau" class="head">Réseau social :</label>
                                <input disabled value="" type="text" name="reseauJeune" id="reseauJeune" required class="body"></input></td></tr>
    
                            </table>
                            </div>
                            <!--</div> -->     
                        </div>                  
                    </form>
                    <?php 
                        // J'affiche ici les informations dans le tableau du jeune 
                    echo "
                    <script>
                            fetch('php/utilisateurs.json')
                            .then(response => response.json())
                            .then(data => {
                                // Extraire les données souhaitées du fichier JSON
                                var prenom = data['utilisateurs'][".$jeune."]['prenom'];
                                var nom = data['utilisateurs'][".$jeune."]['nom'];
                                var dateNaissance = data['utilisateurs'][".$jeune."]['date_naissance'];
                                var mail = data['utilisateurs'][".$jeune."]['mail'];
                                var reseau = data['utilisateurs'][".$jeune."]['reseau'];

                                // Affecter les valeurs aux champs de formulaire
                                document.getElementById('nomJeune').value = nom;
                                document.getElementById('prenomJeune').value = prenom;
                                document.getElementById('dateNaissanceJeune').value = dateNaissance;
                                document.getElementById('mailJeune').value = mail;
                                document.getElementById('reseauJeune').value = reseau;
                            })
                            .catch(error => console.error(error));
                    </script>"
                ?>
            </div>

            </div>
                    
</body>

</html><form>