
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription Jeune</title>
    <link rel="stylesheet" href="css/inscription.css">
    <script src="javascript/inscription.js">
    </script>
</head>
<?php
  session_start();
  if (isset($_POST['submit'])){

    //On récupère les infos d'utilisateurs
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $mail = $_POST['mail'];
    //$mdp = $_POST['mdp'];
    $reseau = $_POST['reseau'];
    
    //cryptage du mot de passe 
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    // Charger le contenu actuel du fichier JSON
    $json = file_get_contents('utilisateurs.json');
    $data = json_decode($json, true);
    
    // Récupérer le tableau des utilisateurs
    $utilisateurs = $data['utilisateurs'];

  foreach($utilisateurs){
    if($utilisateurs["mail"] == mail ){
        echo "verif_mail()";
    }
  }
   //Voir si l'existe deja un utilisateur 

   if ( isset ($utilisateurs)){
      $indice = count($utilisateurs);
   }
   else {
      $indice = 0;
   }
    // Crée un tableau associatif avec les données de l'utilisateur
    $utilisateur = array(
      'indice' => $indice,
      'prenom' => $prenom,
      'nom' => $nom,
      'date_naissance' => $date_naissance,
      'mail' => $mail,
      'mdp' => $mdp,
      'reseau' => $reseau,
      'referent' => array()
    );

    // Ajouter le nouvel utilisateur au tableau des utilisateurs
    $utilisateurs[] = $utilisateur;

    // Mettre à jour le tableau des utilisateurs dans le tableau complet
    $data['utilisateurs'] = $utilisateurs;

    // Convertir le tableau associatif en JSON
    $json = json_encode($data, JSON_PRETTY_PRINT);

    // Écrire le JSON dans un fichier
    file_put_contents('utilisateurs.json', $json);

    // Rediriger l'utilisateur vers une autre page
    header("Location: ../connexion.html");
    exit;
}
?>
<script>
function verif_mail() {
  document.getElementById('form-inscription').addEventListener('submit', function(event) {
    event.preventDefault();});
  fetch('php/utilisateurs.json')
  .then(response => response.json())
  .then(data => {
    var utilisateurs = data['utilisateurs'];
    var mail = document.getElementById("mail").value;
    forEach(utilisateurs => {
      if (utilisateurs["mail"] == mail){
        document.getElementById("mailfaux")="email existe deja";
        return true;
      }
    });
    return false;
  })
  .catch(error => console.error(error));
}</script>
<body>
    <! banderole avec le nom de la page que la quelle on se situe>
        <div id="banderole">
            <a href="pageengagement.php"><img src="image/pagedepres/LOGOS_JEUNES_6,4,pdpres.png"></a>
            <b>Inscription</b>
        </div>
            <div class="corps">
                <form action="inscription.php" method="post" id="form-inscription">
                    <label for="prenom" class="left">Prénom: </label>
                    <input type="text" name="prenom" id="prenom" placeholder="" size="40" maxlength="30" required /><br>
                    <label for="nom" class="left">Nom:</label>
                    <input type="text" name="nom" id="nom" placeholder="" size="40" maxlength="30" required /><br>

                    <label for="naissance">Date de naissance:</label> <input type="date" id="naissance"
                        name="date_naissance" value="2007-07-22" min="1997-01-01" max="2007-12-31" required /> <br>

                    <label for="mail" class="left">Mail:</label><input type="email" name="mail" id="mail" placeholder=""
                        size="40" maxlength="30" required> 
                    <br><!--Cette balise p est en lien avec le programme ajax qui vérifie si l'email qu'on souhaite soumettre est déjà dans la base de donnée-->
                    <label for="mdp" class="left">Mot de passe:</label><input type="password" name="mdp" id="mdp"
                        placeholder="" size="40" maxlength="30" required><br>
                    réseau:<select name="reseau" id="reseau">
                        <optgroup label="réseau">
                            <option value="Facebook">Facebook</option>
                            <option value="Twitter">Twitter</option>
                            <option value="LinkedIn">LinkedIn</option>
                        </optgroup>
                    </select><br>
                    <button type="submit" name="submit" id="submit" onsubmit="verif_mail()"
                        class="btn-grad">Inscription</button>
                    <button type="button" name="connexion" id="connexion" onclick="document.location.href='connexion.html'" class="btn-grad">Connexion</button>
                </form>
                </div>
        <div id="mailfaux"></div>
</body>
</body>

</html>