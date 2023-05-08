function verif_mail() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "exist") {
          document.getElementById("error").innerHTML = "L'email existe déjà";
          return false; // empêcher le formulaire de se soumettre
        }
      }
    };
    var form = document.getElementById("form-inscription");
    var formData = new FormData(form);
    xhr.open("POST", "../php/inscription.php", true);
    xhr.send(formData);
    return true; // permettre le formulaire de se soumettre si l'e-mail n'existe pas
  }
  