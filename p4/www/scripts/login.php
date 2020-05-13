<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nick = $_POST['nick'];
        $pass = $_POST['contraseña'];

        conectar();
        if (checkLogin($nick, $pass)) {
            session_start();
            $usuario = getUser($nick);
            $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
            cerrar();
            header("Location: /index");
            exit();
        }

        else {
            cerrar();
            $error = "Login incorrecto";
            echo $twig->render('login.html', ['error' => $error]);
        }
        
        
  }
  
?>