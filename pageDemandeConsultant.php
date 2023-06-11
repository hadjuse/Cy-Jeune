<?php 
session_start();
if ($_SESSION['connexion'] == 'visiteur'){
    header('Location: inscription.html');
    exit;
}
if (empty($_SESSION['referent'])){
    header('Location: php/jeune.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engagement</title>
</head>
<link rel="stylesheet" href="css/pageDemandeConsultant.css">

    <script>
        function referent(u,r,p){
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
                document.getElementById("prenom"+p).value = prenom;
                document.getElementById("nom"+p).value = nom;
                document.getElementById("dateNaissance"+p).value = dateNaissance;
                document.getElementById("presentation"+p).value = presentation;
                document.getElementById("mail"+p).value = mail;
                document.getElementById("reseau"+p).value = reseau;
                document.getElementById("duree"+p).value = duree;
                document.getElementById("commentaires"+p).innerHTML = commentaires;
                document.getElementById("indicereferent"+p).value = data['utilisateurs'][u]['referent'][r]['indice'];
                
                // Je supprime les champs en trop si il n'y a pas 12 ( valeurs max ) savoir-être 
                if( len < 12 ){
                    for (var j = 12; j > len; j--) {
                        var choixId = "Dchoix" + j;
                        var choixElement = document.getElementById(choixId+p).innerHTML ="";
                    }
                }

                // Mettre à jour la valeur de l'input
                for (var i = 0; i < len; i++) {
                        var choixId = "choix" + (i + 1);
                        var inputId = "input" + (i + 1);
                        var choixElement = document.getElementById(choixId+p);
                        if (choixElement) {
                            choixElement.textContent = savoiretre[i];
                        }
                        var choixElement = document.getElementById(inputId+p);
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
            // Php qui me permettra d'afficher toute les demandes de références accépté 
                // Je récupère les données du fichiers json 
                $json = file_get_contents('php/utilisateurs.json');
                $data = json_decode($json, true);
                $utilisateurs = $data['utilisateurs'];
                foreach ($utilisateurs as $us){
                    // Parcours de tout les utilisateurs 
                    
                    if ($_SESSION["mail"] == $us["mail"]){
                        
                        $k=0;
                        echo '<form action="php/demandeConsultant.php" method="POST" ><div id="sendmail"> <label for "mailConsultant" class="head"> Entrez l'."'".'e-mail du consultant : </label> <input value="" type="text" name="mailConsultant" id="mailConsultant" required class="body"></input>  ';
                        echo '<label > Selectionnez les engagements validés ci-dessous que vous souhaitez envoyer au consultant : </label>' ;
                        echo '</div>';
                        foreach ($us["referent"] as $pr ){
                            
                          if(substr($pr["commentaire"], -3) == "té"){
                            // Pour chaque référents j'affiche toutes ses données avec un input checkbox pour séléctionné ou non la référence  
                                echo '<div id="description">
                                    <div id="commentaire"><table id="tableaucom">
                                        
                                        <tr class="head"><td><label for="commentaires" >COMMENTAIRES</label></td></tr>
                                        <tr ><td><textarea disabled value="t1" name="commentaires'.$k.'" id="commentaires'.$k.'" class="body" required ></textarea></td></tr>
                                    </table>
                                    </div>
                                    <div id="profil"><table >
                                        <tr><td><label for="nom" class="head">NOM : </label>
                                        <input disabled value="" type="text" name="nom" id="nom'.$k.'" required class="body"></input></td></tr>
                                        <tr><td><label for="prenom" class="head">PRENOM :</label>
                                        <input disabled value="" type="text" name="prenom" id="prenom'.$k.'" required class="body"></input></td></tr>
                                        <tr><td><label for="dateNaissance" class="head">DATE DE NAISSANCE :</label>
                                        <input disabled value="" type="date" name="dateNaissance" id="dateNaissance'.$k.'" required class="body"></input></td></tr>
                                        <tr><td><label for="mail" class="head">MAIL :</label>
                                        <input disabled value="" type="mail" name="mail" id="mail'.$k.'" required class="body"></input></td></tr>
                                        <tr><td><label for="reseau" class="head">Réseau social :</label>
                                        <input disabled value="" type="text" name="reseau" id="reseau'.$k.'" required class="body"></input></td></tr>
                                        <tr><td><label for="presentation" class="head">Presentation :</label>
                                        <input disabled value="" type="text" name="presentation" id="presentation'.$k.'" required class="body"></input></td></tr>
                                        <tr><td><label for="duree" class="head">Durée :</label>
                                        <input disabled value="" type="text" name="duree" id="duree'.$k.'" required class="body"></input></td></tr>
                                    </table>
                                    </div>
                                    <div id="savoiretre"><table>
                                        <tr class="savoir-etre"><td>SES SAVOIRS ETRE</td></tr>
                                        
                                            <tr id="jesuis"><td>je confirme qu il est*</td></tr>
                                            <tr id="choix"><td>
                                                <div id="Dchoix1'.$k.'">
                                                    <input id="input1'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label  id="choix1'.$k.'" for="choix1"> </label>
                                                </div><div id="Dchoix2'.$k.'">
                                                    <input id="input2'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix2'.$k.'" for="choix2"> </label>
                                                </div><div id="Dchoix3'.$k.'">
                                                    <input id="input3'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix3'.$k.'" for="choix3"> </label>
                                                </div><div id="Dchoix4'.$k.'">
                                                    <input id="input4'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix4'.$k.'" for="choix4"> </label>
                                                </div>
                                                <div id="Dchoix5'.$k.'">
                                                    <input id="input5'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label  id="choix5'.$k.'" for="choix5"> </label>
                                                </div><div id="Dchoix6'.$k.'">
                                                    <input id="input6'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix6'.$k.'" for="choix6"> </label>
                                                </div><div id="Dchoix7'.$k.'">
                                                    <input id="input7'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix7'.$k.'" for="choix7"> </label>
                                                </div><div id="Dchoix8'.$k.'">
                                                    <input id="input8'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix8'.$k.'" for="choix8"> </label>
                                                </div>
                                                <div id="Dchoix9'.$k.'">
                                                    <input id="input9'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label  id="choix9'.$k.'" for="choix9"> </label>
                                                </div><div id="Dchoix10'.$k.'">
                                                    <input id="input10'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix10'.$k.'" for="choix10"> </label>
                                                </div><div id="Dchoix11'.$k.'">
                                                    <input id="input11'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix11'.$k.'" for="choix11"> </label>
                                                </div><div id="Dchoix12'.$k.'">
                                                    <input id="input12'.$k.'" type="checkbox" value="" name="savoir[]" disabled>
                                                <label id="choix12'.$k.'" for="choix12"> </label>
                                                </div>
                                        </table>
                                    </div>     
                                    <input id="indicereferent'.$k.'" type="checkbox" value="" name="engagement[]">
                                        <label id="cliquez" for="cliquez"> Cochez pour envoyez </label>
                                </div>';
                                
                            // J'appelle pour chaque référence la fonction de remplissage javascript pour remplir le tableau 
                            echo '<script> referent('.$_SESSION["indice"].','.$pr["indice"].','.$k.') </script>';
                            $k++;
                            }
                       }  echo '<button type="submit" name="envoyer" id="send" > Envoyer </button> <br></form>';
                  }
                    }   
            ?>
            <div id="contenu">
                
            </div>

            </div>
                    
</body>

</html><form>