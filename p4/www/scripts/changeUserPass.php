<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $nick = $_SESSION['nickUsuario'];
        $pass = $_POST['pass'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        
        conectar();
        modificarPassUsuario($nick, $pass);
        $sesionUsuario = getUser($_SESSION['nickUsuario']);
        cerrar();
        $mensaje = "Tu contraseña se ha modificado correctamente.";
        echo $twig->render('panel.html', ['mensaje' => $mensaje,'usuario' => $sesionUsuario]);
        exit();
        
  }
  
?>