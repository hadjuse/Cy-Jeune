function verif_mail() {
  var email = document.getElementById("mail").value;
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "php/inscription.php", true);
  xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
          if (this.responseText === "exist") {
              document.getElementById("error").innerHTML = this.responseText;
          } else {
              document.getElementById("error").innerHTML = "";
              document.querySelector("form").submit();
          }
      }
  };
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("email=" + email);
}
