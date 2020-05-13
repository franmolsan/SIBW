var PROHIBIDAS = [];
var ASTERISCOS = [];
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

  return true;
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

function validaNombre(nombre){
  if (nombre == ""){
    return false;
  } 
  return true;
}

function validaPass(pass){
  if (pass == ""){
    return false;
  } 
  return true;
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

function validaRegistro(){
  var nombre = document.forms["form_registro"]["nick"].value;
  var email = document.forms["form_registro"]["email"].value;
  var pass = document.forms["form_registro"]["contraseña"].value;

  if (!validaNombre (nombre)){
    alert ("El nombre no puede estar vacío");
    return false;
  } 

  else if (!validaPass (pass)){
    alert ("Debes introducir una contraseña para proteger tu cuenta");
    return false;
  } 

  else if (!validaEmail(email)) {
    alert("Dirección de email no válida");
    return false;
  }

  return true;
}



function validaLogin(){
  var nombre = document.forms["form_login"]["nick"].value;
  var pass = document.forms["form_login"]["contraseña"].value;
  if (!validaNombre (nombre)){
    alert ("Introduce tu nombre de usuario");
    return false;
  } 

  else if (!validaPass (pass)){
      alert ("Introduce tu contraseña");
    return false;
  } 

  return true;
}

function validaCambioNombre(){
  var nombre = document.forms["cambioNombre"]["nick"].value;
  var confirmacion = validaNombre(nombre);

  if (!confirmacion){
    alert ("Introduce el nuevo nombre de usuario");
  }

  return confirmacion;
}

function validaCambioEmail(){
  var email = document.forms["cambioEmail"]["email"].value;
   
  var confirmacion = validaEmail(email);
  if (!confirmacion){
    alert ("Introduce un email válido");
  }
  return confirmacion;
}

function validaCambioPass(){
  var pass = document.forms["cambioPass"]["pass"].value;

  var confirmacion = validaPass(pass);
  if (!confirmacion){
    alert ("Introduce una nueva contraseña");
  }
  return confirmacion;
}

// obtener las palabras prohibidas
// usando AJAX
function getProhibidas(){
  
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {

    // cuando hayamos obtenido respuesta
    if (this.readyState == 4 && this.status == 200) {

      // obtenemos la respuesta como un string, y luego lo 
      // separamos por espacios
      PROHIBIDAS = JSON.parse(this.responseText);

      for(var i =0; i < PROHIBIDAS.length; i++){
        var aste = "";
        for (var j=0; j < PROHIBIDAS[i].length; j++){
          aste = aste + "*";
        }
        ASTERISCOS.push(aste);
      }
    }
  };
 
  xmlhttp.open("GET","/scripts/obtenerProhibidas.php", true);
  xmlhttp.send();

}