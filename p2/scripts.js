const PROHIBIDAS = ["PERA", "MANZANA", "NARANJA", "SANDIA", "MELON", "MANDARINA", "FRESA", "MANGO"];
const ASTERISCOS = ["****", "*******", "*******", "******", "*****", "*********", "*****", "*****"];
function mostrarComentarios() 
{
  var x = document.getElementById("desplegable");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}

function getFecha()
{
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; // Enero es 0
    var yyyy = hoy.getFullYear();
    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
    hoy = dd+"/"+mm+"/"+yyyy;

    return hoy;
}

function getHora()
{
 var hoy = new Date();
 var horas = hoy.getHours();
 var minutos = hoy.getMinutes();
 if(horas<10){horas='0'+horas} if(minutos<10){minutos='0'+minutos}

 return (horas+":"+minutos);
}

function validateForm() {

  // obtener el valor de los campos del comentario
  var nombre = document.forms["form_comentario"]["nombre"].value;
  var email = document.forms["form_comentario"]["email"].value;
  var com = document.getElementById("com").value;
  if (nombre == ""){
    alert ("El nombre no puede estar vacío");
    return false;
  } 

  else if (email == ""){
    alert ("El email no puede estar vacío");
    return false;
  }

  else if (!validaEmail(email)) {
    alert("Dirección de email no válida");
    return false;
  }

  else if ( /^\s*$/.test(com)) {
    alert("El comentario no puede estar vacío")
    return false;
  }
  
  aniadeComentario(nombre,email,com);

  document.forms["form_comentario"]["nombre"].value = "";
  document.forms["form_comentario"]["email"].value = "";
  document.getElementById("com").value = "";
  return false;
}

function aniadeComentario(nombre,email,com)
{
  let div = document.createElement('div');
  div.className = "comentario";
  div.innerHTML = "<p class=\"autor\">" + nombre + ", <span class=\"fecha_hora\">" + getFecha() + " a las " + getHora() + "</span></p><p>" + com + "</p>";
  comentarios.append(div);
}


function validaEmail (em)
{
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em)) {
    return true;
  }
  else {
    return false;
  }
}

function compruebaProhibidas() {
  
  var com = document.getElementById("com");

  var i;
  for (i=0; i<PROHIBIDAS.length; i++){
    // usamos la expresión regular porque con la opción "gi" 
    // nos permite ignorar las mayúsculas o minúsculas.
    var reg = new RegExp (PROHIBIDAS[i], 'gi');
    com.value = com.value.replace(reg, ASTERISCOS[i]);  
  }

}