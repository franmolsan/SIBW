<?php
    include("bd.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idComentario = $_POST['idCom'];

        conectar();
        borrarComentario($idComentario);
        cerrar();

        $url_anterior = $_SERVER['HTTP_REFERER'];
        $idEv = substr($url_anterior, strrpos($url_anterior, '/') + 1);
        header("Location: /evento/$idEv");
        exit();
    }
?>