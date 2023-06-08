function verif_mail() {
  fetch('php/utilisateurs.json')
  .then(response => response.json())
  .then(data => {
    var utilisateurs = data['utilisateurs'];
    var mail = document.getElementById("mail").value;
    alert(mail);
    if(utilisateurs == null ){
      alert('null');
      return true;
    }
    else {
      utilisateurs.foreach(utilisateur => {
      alert(mail,"la");
      if (utilisateur["mail"] == mail){
        document.getElementById("mailfaux").value="email existe deja";
        return false;
      }
      })
    }
    alert("la");
    return true;
  })
}

function verif_mail() {
  fetch('php/utilisateurs.json')
  .then(response => response.json())
  .then(data => {
      alert('a');
    var utilisateurs = data['utilisateurs'];
    var mail = document.getElementById("mail").value;
    if(utilisateurs == null ){
      var a = 0;
      alert('b');
    }
    else {
      alert('c');
      utilisateurs.foreach(utilisateur => {
      alert('d');
      if (utilisateur["mail"] == mail){
        document.getElementById("mailfaux")="email existe deja";
        var a =1;
      }
      }) ;
    }
   var a =0;
  })
}