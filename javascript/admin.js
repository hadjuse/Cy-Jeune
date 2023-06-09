  

function afficherUtilisateurs(data) {
  var utilisateursDiv = document.getElementById("utilisateurs");
  data.utilisateurs.forEach(function(utilisateur, indice) {
      // Créer un élément <p> pour chaque utilisateur et un bouton supprimer
      var utilisateurElement = document.createElement("p");
      var button = document.createElement('button');
      button.type = 'button';
      button.innerHTML = 'Supprimer';
      button.className = "supp_utilisateur";
      utilisateurElement.textContent = "Nom: " + utilisateur.nom + ", Prénom: " + utilisateur.prenom + ", Email: " + utilisateur.mail;
      button.addEventListener('click', function() {
            // mise à jour bdd
            var ind = utilisateur.indice;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../php/suppresion.php?q=" + ind, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                console.log(ind + " envoyé avec succès au script PHP !");
                console.log("Réponse du serveur : " + xhr.responseText);
                } else {
                console.log("Une erreur s'est produite lors de l'envoi du texte :", xhr.status);
                }
            }
            };
            location.reload();
            xhr.send();
      });
      // Ajout pour chaque nouvel utilisateur
      utilisateursDiv.appendChild(utilisateurElement);
      utilisateursDiv.appendChild(button);
  });
}


// Récupérer les données JSON à partir du fichier local
fetch("../php/utilisateurs.json")
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            afficherUtilisateurs(data);
        }
        )
