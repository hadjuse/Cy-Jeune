function afficherUtilisateurs(data){
    var utilisateursDiv = document.getElementById("utilisateurs");
    data.utilisateurs.forEach(function(utilisateur) {
        // créer un élément <p> pour chaque utilisateurs
        var utilisateurElement = document.createElement("p");
        utilisateurElement.textContent = "Nom: " + utilisateur.nom + ", Prénom: " + utilisateur.prenom + ", Email: " + utilisateur.mail;
        // ajout pour chaque nouvelles utilisateurs
        utilisateursDiv.appendChild(utilisateurElement);
    });
}
// Récupérer les données JSON à partir du fichier local
fetch("php/utilisateurs.json")
        .then(function(response){
            return response.json();
        })
        .then(function(data){
            afficherUtilisateurs(data);
        }
        )