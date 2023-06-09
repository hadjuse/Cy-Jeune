
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modif.css">
    <title>modif_profil</title>
</head>
<body>
<script>
    function profil(u){
fetch('../php/utilisateurs.json')
            .then(response => response.json())
            .then(data => {

                // Extraire la valeur souhaitée du fichier JSON
                var prenom = data['utilisateurs'][u]['prenom'];
                var nom = data['utilisateurs'][u]['nom'];
                var dateNaissance = data['utilisateurs'][u]['date_naissance'];
                var mail = data['utilisateurs'][u]['mail'];
                var reseau = data['utilisateurs'][u]['reseau'];

                // Mettre à jour la valeur de l'input
                document.getElementById("prenom").value = prenom;
                document.getElementById("nom").value = nom;
                document.getElementById("date_naissance").value = dateNaissance;
                document.getElementById("mail").value = mail;
                document.getElementById("reseau").value = reseau;

            }).catch(error => console.error(error));
        }
</script>

<?php 
session_start();
echo "<script>profil(". $_SESSION['indice'] .")</script>";


?>

<div id="banderole">
            <a href="../page0.php"><img src="../image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b id="ref">profil</b>
            <b id="hautpage">Modification de mon profil</b>
        </div>
        <!-- onglet de navigation entre les differentes pages -->
            <div id="navigation">
                <a href="../php/Jeune.php" id="jeunes">JEUNES</a>
                <a href="../recap.php" id="referent">RÉFÉRENT</a>
                <a href="../pageconsultant.html" id="consultant">CONSULTANT</a>
                <a href="../pagepartenaire.html" id="partenaires">PARTENAIRES</a>
            </div>
<div id="profil">
    
<form action="../php/modifier.php" method="post" id="form-inscription" >
<table >
                                <tr><td><label for="nom" class="head">NOM :</label>
                                <input  value="" type="text" name="nom" id="nom" required class="body"></input></td></tr>
                                <tr><td><label for="prenom" class="head">PRENOM :</label>
                                <input  value="" type="text" name="prenom" id="prenom" required class="body"></input></td></tr>
                                <tr><td><label for="date_naissance" class="head">DATE DE NAISSANCE :</label>
                                <input  value="" type="text" name="date_naissance" id="date_naissance" required class="body"></input></td></tr>
                                <tr><td><label for="mail" class="head">MAIL :</label>
                                <input  value="" type="mail" name="mail" id="mail" required class="body"></input></td></tr>
                                <tr><td><label for="reseau" class="head">Réseau social :</label>
                                <input  value="" type="text" name="reseau" id="reseau" required class="body"></input></td></tr>
                            </table>
                            <button type="submit" name="submit" id="submit" class="btn-grad">modifier</button>
                </form>
                            </div>
</body>
</html>
