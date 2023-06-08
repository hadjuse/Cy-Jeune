function verif_mail() {
  alert("la");
  fetch('../php/utilisateurs.json')
  .then(response => response.json())
  .then(data => {
    var utilisateurs = data['utilisateurs'];
    var mail = document.getElementById("mail").value;
    forEach(utilisateurs => {
      alert("la");
      if (utilisateurs["mail"] == mail){
        document.getElementById("mailfaux")="email existe deja";
        return false;
      }
    });
    return false;
  })
  .catch(error => console.error(error));
}