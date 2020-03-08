function mostrarComentarios() 
{
  var x = document.getElementById("desplegable");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function getFecha()
{
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; // Enero es 0
    var yyyy = hoy.getFullYear();
    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
    hoy = dd+""+mm+""+yyyy;

    return hoy;
}

function getHora()
{
 var hoy = new Date();
 var horas = hoy.getHours();
 var minutos = hoy.getMinutes();

 return (horas+":"+minutos);
}

function validateForm() {

  // obtener el valor de los campos del comentario: nombre y email
  var nombre = document.forms["form_comentario"]["nombre"].value;
  var email = document.forms["form_comentario"]["email"].value;
  var com = document.getElementById("com").value;
  alert ("<p>" + nombre + ", " + getFecha() + " a las " + getHora() + "</p><p>" + com + "</p>")
  aniadeComentario(nombre,com);
}

function aniadeComentario(nombre,com) 
{
  document.getElementById("com1").innerHTML = "<p>" + nombre + ", " + getFecha() + " a las " + getHora() + "</p><p>" + com + "</p>";
}