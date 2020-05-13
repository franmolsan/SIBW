<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $nuevo_nick = $_POST['nick'];
        $nick_antiguo = $_SESSION['nickUsuario'];

        conectar();
        if (getUser($nuevo_nick)) {
            $error = "Ese nombre de usuario ya existe.";
            $sesionUsuario = getUser($_SESSION['nickUsuario']);
            cerrar();
            echo $twig->render('panel.html', ['error' => $error,'usuario' => $sesionUsuario]);
        }
        else {
            modificarNickUsuario($nick_antiguo, $nuevo_nick);
            $mensaje = "Tu nombre de usuario se ha actualizado correctamente.";
            $_SESSION['nickUsuario'] = $nuevo_nick;
            $sesionUsuario = getUser($nuevo_nick);
            cerrar();
            echo $twig->render('panel.html', ['mensaje' => $mensaje,'usuario' => $sesionUsuario]);
            exit();
        }
        
  }
  
?>