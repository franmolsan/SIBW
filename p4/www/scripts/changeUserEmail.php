<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $nick = $_SESSION['nickUsuario'];
        $email = $_POST['email'];

        conectar();

        if (getUserFromEmail($email)) {
            $error = "Ese email ya está en uso.";
            $sesionUsuario = getUser($_SESSION['nickUsuario']);
            cerrar();
            echo $twig->render('panel.html', ['error' => $error,'usuario' => $sesionUsuario]);
        }
        else {
            modificarEmailUsuario($nick, $email);
            $sesionUsuario = getUser($_SESSION['nickUsuario']);
            cerrar();
            $mensaje = "Tu email se ha actualizado correctamente.";
            echo $twig->render('panel.html', ['mensaje' => $mensaje,'usuario' => $sesionUsuario]);
            exit();
        }
        
  }
  
?>