// cette fonction contient la suppression d'un utilisateurs entier ou bien referent
function afficherUtilisateurs(data) {
  var utilisateursDiv = document.getElementById("utilisateurs");
  data.utilisateurs.forEach(function (utilisateur) {
    // Sur cette ligne on parcourt les utilisateurs dans la BDD
    // On créer des balises pour chaques utilisateurs
    var utilisateurElement = document.createElement("div");
    utilisateurElement.className = "utilisateur";

    var nomElement = document.createElement("p");
    nomElement.textContent = "Nom: " + utilisateur.nom;

    var prenomElement = document.createElement("p");
    prenomElement.textContent = "Prénom: " + utilisateur.prenom;

    var emailElement = document.createElement("p");
    emailElement.textContent = "Email: " + utilisateur.mail;

    //On fait de même pour réferent mais on le met dans des balises liste <ul> et <li>
    var referentsElement = document.createElement("p");
    referentsElement.textContent = "Référents:";

    var referentListElement = document.createElement("ul");
    var id_utilisateur = utilisateur.indice;
    utilisateur.referent.forEach(function (referent) {
      var referentElement = document.createElement("li");
      referentElement.textContent =
        "Nom: " +
        referent.nom +
        ", Prénom: " +
        referent.prenom +
        ", Email: " +
        referent.mail;
      // On ajoute les boutons de suppressions pour le referent
      var supprimerReferentButton = document.createElement("button");
      supprimerReferentButton.type = "button";
      supprimerReferentButton.innerHTML = "Supprimer";
      supprimerReferentButton.className = "supp_referent";

      supprimerReferentButton.addEventListener("click", function () {
        // Code pour supprimer le référent ici
        // On utilise les informations du référent (referent.indice, par exemple) pour effectuer l'action de suppression
        var id_ref = referent.indice;
        var xhr = new XMLHttpRequest();
        var url = "../php/suppression.php?f=" + id_ref + "&u=" + id_utilisateur;
        xhr.open("GET", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.onreadystatechange = function(){
            if (xhr.readyState === 4) {
                if (xhr.status === 200){
                    console.log(id_ref + " envoyé avec succès au script PHP !");
                    console.log("Réponse du serveur : " + xhr.responseText);
                } else {
                    console.log(
                        "Une erreur s'est produite lors de l'envoi du texte :",
                        xhr.status
                    );
                }
            }
            
        }
        //Une fois la suppression effectue effectuée, on pouvez supprime visuellement le référent de la liste
        referentListElement.removeChild(referentElement);
        xhr.send();
      });

      referentElement.appendChild(supprimerReferentButton);
      referentListElement.appendChild(referentElement);
    });

    utilisateurElement.appendChild(nomElement);
    utilisateurElement.appendChild(prenomElement);
    utilisateurElement.appendChild(emailElement);
    utilisateurElement.appendChild(referentsElement);
    utilisateurElement.appendChild(referentListElement);
    // On ajoute les boutons de suppression si on veut supprimer en entier les utilisateurs avec le referent
    var button = document.createElement("button");
    button.type = "button";
    button.innerHTML = "Supprimer";
    button.className = "supp_utilisateur";

    button.addEventListener("click", function () {
      var ind = utilisateur.indice;
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "../php/suppression.php?q=" + ind, true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            console.log(ind + " envoyé avec succès au script PHP !");
            console.log("Réponse du serveur : " + xhr.responseText);
          } else {
            console.log(
              "Une erreur s'est produite lors de l'envoi du texte :",
              xhr.status
            );
          }
        }
      };
      location.reload();
      xhr.send();
    });

    utilisateurElement.appendChild(button);
    utilisateursDiv.appendChild(utilisateurElement);
  });
}

// Récupérer les données JSON à partir du fichier local
fetch("../php/utilisateurs.json")
  .then(function (response) {
    return response.json();
  })
  .then(function (data) {
    afficherUtilisateurs(data);
  });
