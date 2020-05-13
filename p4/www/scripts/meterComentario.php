<?php
    include("bd.php");

    // si hemos dado a enviar (submit)
    if (isset($_POST['submit'])){
        conectar();
        session_start();

        $url_anterior = $_SERVER['HTTP_REFERER'];
        $idEv = substr($url_anterior, strrpos($url_anterior, '/') + 1);

        if (isset($_SESSION['nickUsuario'])) {
            $sesionUsuario = getUser($_SESSION['nickUsuario']);
            $nombre = $sesionUsuario['nick'];
            $email = $sesionUsuario['email'];
            $com = $mysqli->real_escape_string($_REQUEST['texto_comentario']);
            introducirComentario($idEv, $nombre, $email, $com);
        } 

        cerrar();
        header("Location: /evento/$idEv");
        exit();
    }
        
?>