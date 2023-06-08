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
}