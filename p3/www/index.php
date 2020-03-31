<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("scripts/bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    function startsWith($string, $query){
        return substr($string, 0, strlen($query)) === $query;
    }

    $uri = $_SERVER['REQUEST_URI'];

    if (startsWith($uri, "/evento")){
        include ("scripts/evento.php");
    }
    else {
        conectar();
        $num_eventos = getNumEventos();
        $imagenes = [];
        $eventos = [];

        for ($i = 1; $i <= $num_eventos; $i++) {
            array_push($eventos, getEvento($i));
            array_push($imagenes,getImagenesPortada($i));
        }
        cerrar();

        echo $twig->render('index.html', ['eventos' => $eventos, 'imagenes' => $imagenes]);
    }
?>