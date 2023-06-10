<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/pageconsultant.css">

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
                $jeune = $_GET['jeune'];
                $referent = $_GET['referent'];

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
                                </table>
                            </div>     
                        </div>                  
                    </form>

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
                        $jeune = $_GET['jeune'];
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