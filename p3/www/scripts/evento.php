<?php
    $resto = substr($uri,8);
    $idEv = intval($resto);
    
    conectar();
    $evento = getEvento($idEv);
    $imagenes = getTodasImagenes($idEv);
    echo ($imagenes->num_rows);
    cerrar();
    echo $twig->render('evento.html', ['evento' => $evento , 'imagenes' => $imagenes]);
?>