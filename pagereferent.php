<!DOCTYPE html>
<html lang="fr">
                         <!--Page ou arrive le référent-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/pagereferent.css">
    <script>
        // Fonction pour récupérer les paramètres de requête depuis l'URL
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // Récupération des paramètres de requête
        var idjeune = getParameterByName('jeune');
        var idreferent = getParameterByName('referent');
        
        // Récupérer les paramètres de l'URL
        const params = new URLSearchParams(window.location.search);
                 
        // Charger le fichier JSON
        fetch('php/utilisateurs.json')
          .then(response => response.json())
          .then(data => {

            // Extraire la valeur souhaitée du fichier JSON
                // les valeurs du jeune 
            var prenomj = data['utilisateurs'][idjeune]['prenom'];
            var nomj = data['utilisateurs'][idjeune]['nom'];
            var dateNaissancej = data['utilisateurs'][idjeune]['date_naissance'];
            var mailj = data['utilisateurs'][idjeune]['mail'];
            var reseauj = data['utilisateurs'][idjeune]['reseau'];
            if(data['utilisateurs'][idjeune]['referent'][idreferent]['commentaire'].slice(-2) === "té"){
                window.location.href="php/merci.php";
                exit;
            }

                // Les valeurs du référents 
            var prenom = data['utilisateurs'][idjeune]['referent'][idreferent]['prenom'];
            var nom = data['utilisateurs'][idjeune]['referent'][idreferent]['nom'];
            var dateNaissance = data['utilisateurs'][idjeune]['referent'][idreferent]['date_naissance'];
            var presentation = data['utilisateurs'][idjeune]['referent'][idreferent]['engagement'];
            var mail = data['utilisateurs'][idjeune]['referent'][idreferent]['mail'];
            var reseau = data['utilisateurs'][idjeune]['referent'][idreferent]['reseau'];
            var duree = data['utilisateurs'][idjeune]['referent'][idreferent]['duree'];
            var savoiretre = data['utilisateurs'][idjeune]['referent'][idreferent]['savoir_etre'];
            var len = savoiretre.length;

            // Mettre à jour la valeur de l'input
            document.getElementById("prenomj").value = prenomj;
            document.getElementById("nomj").value = nomj;
            document.getElementById("dateNaissancej").value = dateNaissancej;
            document.getElementById("mailj").value = mailj;
            document.getElementById("reseauj").value = reseauj;

            document.getElementById("prenom").value = prenom;
            document.getElementById("nom").value = nom;
            document.getElementById("dateNaissance").value = dateNaissance;
            document.getElementById("presentation").value = presentation;
            document.getElementById("mail").value = mail;
            document.getElementById("reseau").value = reseau;
            document.getElementById("duree").value = duree;
            document.getElementById("idjeune").value = idjeune;
            document.getElementById("idreferent").value = idreferent;
            
            // Je supprime les champs en trop si il n'y a pas 12 ( valeurs max ) savoir-être 
            if( len < 4 ){
                for (var j = 4; j > len; j--) {
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
                <a href="recap.php" id="referent">RÉFÉRENT</a>
                <a href="pageDemandeConsultant.php" id="consultant">CONSULTANT</a>
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
                    <form action="php/referent.php" method="POST" >
                        <div class="description">   
                            <div id="commentaire"><table id="tableaucom">   <!--Commentaire du referent-->
                                
                                <tr class="head"><td><label for="commentaires" >COMMENTAIRES</label></td></tr>
                                <tr ><td><textarea value="t1" name="commentaires" id="commentaires" class="body" required ></textarea></td></tr>
                            </table>
                            </div>
                            <div>
                                
                            <table id="profil">
                            <tr><td class="centre">JEUNE :</td></tr>
                                <tr><td><label for="nomj" class="head">NOM :</label>
                                <input disabled value="" type="text" name="nomj" id="nomj" required class="body"></input></td></tr>
                                <tr><td><label for="prenomj" class="head">PRENOM :</label>
                                <input disabled value="" type="text" name="prenomj" id="prenomj" required class="body"></input></td></tr>
                                <tr><td><label for="dateNaissancej" class="head">DATE DE NAISSANCE :</label>
                                <input disabled value="" type="date" name="dateNaissancej" id="dateNaissancej" required class="body"></input></td></tr>
                                <tr><td><label for="mailj" class="head">MAIL :</label>
                                <input disabled value="" type="mail" name="mailj" id="mailj" required class="body"></input></td></tr>
                                <tr><td><label for="reseauj" class="head">Réseau social :</label>
                                <input disabled value="" type="text" name="reseauj" id="reseauj" required class="body"></input></td></tr>
                            </table>
                            
                            <table id="profil">
                            <tr ><td class="centre">REFERENT :</td></tr>
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
                                <tr class="savoir-etre"><td>SES SAVOIRS ETRE</td></tr>      <!--Tableau des savoirs etre-->
                                
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
                            
                            <div id="savoiretre3"><table>
                                <tr class="savoir-etre"><td>SES SAVOIRS ETRE</td></tr>
                                
                                    <tr id="jesuis"><td>il est également*</td></tr>
                                    <tr id="choix"><td>
                                        <div id="Dchoix1+">
                                            <input id="input1+" type="checkbox" value="Compétent" name="savoir[]">
                                        <label  id="choix1+" for="choix1+"> Compétent</label>
                                        </div><div id="Dchoix2+">
                                            <input id="input2+" type="checkbox" value="Confiant" name="savoir[]">
                                        <label id="choix2+" for="choix2+"> Confiant</label>
                                        </div><div id="Dchoix3+">
                                            <input id="input3+" type="checkbox" value="Bienveillant" name="savoir[]">
                                        <label id="choix3+" for="choix3+"> Bienveillant</label>
                                        </div><div id="Dchoix4+">
                                            <input id="input4+" type="checkbox" value="Respectueux" name="savoir[]">
                                        <label id="choix4+" for="choix4+">Respectueux </label>
                                        </div>
                                        <div id="Dchoix5+">
                                            <input id="input5+" type="checkbox" value="Honnete" name="savoir[]">
                                        <label  id="choix5+" for="choix5+"> Honnete</label>
                                        </div><div id="Dchoix6+">
                                            <input id="input6+" type="checkbox" value="Tolérant" name="savoir[]">
                                        <label id="choix6+" for="choix6+"> Tolérant</label>
                                        </div><div id="Dchoix7+">
                                            <input id="input7+" type="checkbox" value="Juste" name="savoir[]">
                                        <label id="choix7+" for="choix7+"> Juste</label>
                                        </div><div id="Dchoix8+">
                                            <input id="input8+" type="checkbox" value="Impartial" name="savoir[]">
                                        <label id="choix8+" for="choix8+">Impartial </label>
                                        </div>
                                </table>
                            </div> 
                        </div>   
                        <input id="idjeune" type="hidden" name="idjeune" value="">       
                        <input id="idreferent" type="hidden" name="idreferent" value="">    
                        <button type="submit" name="confirmer" id="submit" class="btn-grad2">Confirmer la demande</button>
                        <button type="submit" name="refuser" id="submit" class="btn-grad">Refuser la demande</button>
                    </form>
                    
            </div>

            </div>                  
</body>

</html>

  
  