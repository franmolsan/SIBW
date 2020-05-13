<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    include("scripts/bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    function startsWith($string, $query){
        return substr($string, 0, strlen($query)) === $query;
    }

    $uri = $_SERVER['REQUEST_URI'];

    if (startsWith($uri, "/evento_imprimir")){
        include ("scripts/evento_imprimir.php");
    }
    else if (startsWith($uri, "/evento")){
        include ("scripts/evento.php");
    }
    else if (startsWith($uri, "/login")){
        echo $twig->render('login.html', []);
    }
    else if (startsWith($uri, "/register")){
        echo $twig->render('register.html', []);
    }
    else if (startsWith($uri, "/panel")){
        session_start();
        // si el usuario está logeado
       if (isset($_SESSION['nickUsuario'])) {
            conectar();
            
            $sesionUsuario = getUser($_SESSION['nickUsuario']);
            cerrar();
            echo $twig->render('panel.html', ['usuario' => $sesionUsuario]);
       } 
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
        
        session_start();

        // si el usuario está logeado
        if (isset($_SESSION['nickUsuario'])) {
            $sesionUsuario = getUser($_SESSION['nickUsuario']);
            cerrar();
            echo $twig->render('index.html', ['eventos' => $eventos, 'imagenes' => $imagenes, 'usuario' => $sesionUsuario]);
        } 
        // si no está logeado
        else {
            cerrar();
            echo $twig->render('index.html', ['eventos' => $eventos, 'imagenes' => $imagenes]);
        }

        
        
    }
?>