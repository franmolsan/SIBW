var PROHIBIDAS = ["PERA", "MANZANA", "NARANJA", "SANDIA", "MELON", "MANDARINA", "FRESA", "MANGO"];
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
    hoy = dd+"/"+mm+"/"+yyyy;

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

  else if ( /^\s*$/.test(com) || com == "Introduce aquí tu comentario...") {
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
  div.innerHTML = "<p class=\"autor_fecha_hora\">" + nombre + ", el " + getFecha() + " a las " + getHora() + "</p><p>" + com + "</p>";
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

function compruebaProhibidas () {
  
  var com = document.getElementById("com").value;
  // dividir las palabras por espacios, saltos de linea, etc.
  var palabras = com.split(/(\s+)/);

  // comprobar si hay alguna palabra prohibida
  let i = 0;
  var el_prohibida = -1; 
  while ( el_prohibida == -1 && i < palabras.length ){
    el_prohibida = PROHIBIDAS.indexOf(palabras[i].toUpperCase());
    console.log("analizo: "+ palabras[i].toUpperCase() + " la busco en " + PROHIBIDAS);
    i++;
  }
    

  // si la hay, formar una cadena de asteriscos del mismo tamaño 
  if (el_prohibida != -1){
    let a_borrar = PROHIBIDAS[el_prohibida];
    let reg = new RegExp(a_borrar, 'gi');
    let asteriscos = ""
    let i;

    // la forma de la expresion regular es "\RegEx\gi", y nos interesa la 
    // longitud de la cadena RegEx (de ahí que lleguemos hasta lenght - 4 )
    for (i = 0; i < (reg.toString()).length-4; i++) {
      asteriscos = asteriscos + "*"
    }
    alert (reg + ", " + asteriscos);
    document.getElementById("com").value =  com.replace(reg, asteriscos);
  }

}