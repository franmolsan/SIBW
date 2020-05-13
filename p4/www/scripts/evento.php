<?php
    $resto = substr($uri,8);
    $idEv = intval($resto);
    
    conectar();
    $evento = getEvento($idEv);
    $imagenes = getTodasImagenes($idEv);
    $comentarios = getComentarios($idEv);

    session_start();

    // si el usuario está logeado
    if (isset($_SESSION['nickUsuario'])) {
        $sesionUsuario = getUser($_SESSION['nickUsuario']);
        cerrar();
        echo $twig->render('evento.html', ['evento' => $evento , 'imagenes' => $imagenes, 'comentarios' => $comentarios, 'usuario' => $sesionUsuario]);
    } 
    // si no está logeado
    else {
        cerrar();
        echo $twig->render('evento.html', ['evento' => $evento , 'imagenes' => $imagenes, 'comentarios' => $comentarios]);
    }
?>