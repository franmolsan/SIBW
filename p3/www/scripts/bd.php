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

?>
