<?php
  
  function conectar(){
    global $mysqli;
    $mysqli = new mysqli("mysql", "usuario", "usuario", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
  }

  function cerrar(){
    global $mysqli;
    $mysqli -> close();
  }

  function getEvento($idEv) {
    global $mysqli;
    $res = $mysqli->prepare("SELECT id, nombre, lugar, fecha, hora, texto, precio FROM eventos WHERE id = ?");
    $res->bind_param("i", $idEv);
    $res->execute();
    $res = $res->get_result();
    
    $evento = array('nombre' => 'XXX', 'lugar' => 'YYY', 'fecha' => 'XX-YY-ZZ', 'hora' => 'XX:YY', 'texto' => 'ABCD', 'precio' => 'Z');
    
    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $evento = array('id' => $row['id'], 'nombre' => $row['nombre'], 'lugar' => $row['lugar'], 'fecha' => $row['fecha'], 'hora' => $row['hora'], 'texto' => $row['texto'], 'precio' => $row['precio']);
    }
    
    return $evento;
  }

  function getImagenesPortada($idEv){
    global $mysqli;
    $res = $mysqli->prepare("SELECT ruta, creditos FROM imagenes WHERE idEvento = ?");
    $res->bind_param("i", $idEv);
    $res->execute();
    $res = $res->get_result();

    $imagenes = array('ruta' => 'img/por_defecto.jpg', 'idEvento' => '1');

    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $imagenes = array('ruta' => $row['ruta'], 'creditos' => $row['creditos']);
    }

    return $imagenes;
  }

  function getTodasImagenes($idEv){
    global $mysqli;
    $res = $mysqli->prepare("SELECT ruta, creditos FROM imagenes WHERE idEvento = ?");
    $res->bind_param("i", $idEv);
    $res->execute();
    $res = $res->get_result();

    $imagenes = array('ruta' => 'img/por_defecto.jpg', 'idEvento' => '1');

    if ($res->num_rows > 0){
      $imagenes = [];
    }
    while ($row = $res->fetch_assoc()) { 
      array_push($imagenes,array('ruta' => $row['ruta'], 'creditos' => $row['creditos']));
    }

    return $imagenes;
  }

  function getNumEventos(){
    global $mysqli;
    $res = $mysqli->query("SELECT nombre FROM eventos");
    return $res->num_rows;
  }

  function getComentarios ($idEv){
    global $mysqli;
    $res = $mysqli->prepare("SELECT nombre, fecha_hora, texto FROM comentarios WHERE idEvento = ?");
    $res->bind_param("i", $idEv);
    $res->execute();
    $res = $res->get_result();

    $comentarios = [];

    while ($row = $res->fetch_assoc()) { 
      array_push($comentarios,array('nombre' => $row['nombre'], 'fecha_hora' => $row['fecha_hora'], 'texto' => $row['texto']));
    }

    return $comentarios;
  }

  function introducirComentario($idEv, $nom, $mail, $com){
    global $mysqli;
    date_default_timezone_set('Europe/Madrid');
    $fecha_hora = date('Y-m-d H:i:s');
    $res = $mysqli->prepare("INSERT INTO comentarios (idEvento, nombre, email, texto) VALUES (?,?,?,?)");
    $res->bind_param("isss", $idEv, $nom, $mail, $com);
    $res->execute();
    $res = $res->get_result();
  }

  function getProhibidas (){
    global $mysqli;
    $res = $mysqli->query("SELECT palabra from prohibidas");
    $palabras = [];
    while ($row = $res->fetch_assoc()) { 
      array_push($palabras,$row['palabra']);
    }
    return $palabras;
  }


  // USUARIOS

  // Devuelve true si existe un usuario con esa contraseña
  function checkLogin($nick, $pass) {
    global $mysqli;
    $usuario = $mysqli->prepare("SELECT nick, email, pass, rol from Usuario WHERE nick = ?");
    $usuario->bind_param("s", $nick);
    $usuario->execute();
    $usuario = $usuario->get_result();

    if ($usuario->num_rows == 1){
      $row = $usuario->fetch_assoc();
      if (password_verify($pass, $row['pass'] )) {
        return true;
      }
    }
    
    return false;
  }

  // Devuelve la información de un usuario a partir de su nick 
  function getUser($nick) {
    global $mysqli;
    $usuario = $mysqli->prepare("SELECT nick, email, pass, rol from Usuario WHERE nick = ?");
    $usuario->bind_param("s", $nick);
    $usuario->execute();
    $usuario = $usuario->get_result();
    
    if ($usuario->num_rows == 1){
      $row = $usuario->fetch_assoc();
      return $row;
    }
    
    return 0;
  }

    // Devuelve la información de un usuario a partir de su email 
    function getUserFromEmail($email) {
      global $mysqli;
      $usuario = $mysqli->prepare("SELECT nick, email, pass, rol from Usuario WHERE email = ?");
      $usuario->bind_param("s", $email);
      $usuario->execute();
      $usuario = $usuario->get_result();
      
      if ($usuario->num_rows == 1){
        $row = $usuario->fetch_assoc();
        return $row;
      }
      
      return 0;
    }

  function registrarUsuario($nick, $pass, $email){
    global $mysqli;
    $res = $mysqli->prepare("INSERT INTO Usuario (nick, pass, email) VALUES (?,?,?)");
    $res->bind_param("sss", $nick, $pass, $email);
    $res->execute();
    $res = $res->get_result();
  }

  function modificarNickUsuario($nick_antiguo, $nick_nuevo){
    global $mysqli;
    $res = $mysqli->prepare("UPDATE Usuario SET nick=? WHERE nick=?");
    $res->bind_param("ss", $nick_nuevo, $nick_antiguo);
    $res->execute();
    $res = $res->get_result();

    return $res;
  }

  function modificarEmailUsuario($nick, $nuevo_email){
    global $mysqli;
    $res = $mysqli->prepare("UPDATE Usuario SET email=? WHERE nick=?");
    $res->bind_param("ss", $nuevo_email, $nick);
    $res->execute();
    $res = $res->get_result();

    return $res;
  }

  function modificarPassUsuario($nick, $nueva_pass){
    global $mysqli;
    $res = $mysqli->prepare("UPDATE Usuario SET pass=? WHERE nick=?");
    $res->bind_param("ss", $nueva_pass, $nick);
    $res->execute();
    $res = $res->get_result();

    return $res;
  }
?>