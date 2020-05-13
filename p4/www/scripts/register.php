<?php
    include("bd.php");
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('../templates');
    $twig = new \Twig\Environment($loader);
    
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nick = $_POST['nick'];
        $pass = $_POST['contraseña'];
        $email = $_POST['email'];
        
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        conectar();
        
        // real_escape_string para escapar los carácteres especiales
        $nick = $mysqli->real_escape_string($nick);
        //$pass = $mysqli->real_escape_string($pass);
        $email = $mysqli->real_escape_string($email);

        if (getUser($nick)) {
            $error = "Ese nombre de usuario ya existe.";
            //$twig->addGlobal('error', $error);
            cerrar();
            echo $twig->render('register.html', ['error' => $error]);
        }

        else if (getUserFromEmail($email)) {
            $error = "Ese email ya se está utilizando.";
            //$twig->addGlobal('error', $error);
            cerrar();
            echo $twig->render('register.html', ['error' => $error]);
        }

        else {
            registrarUsuario($nick,$pass,$email);
            session_start();
            $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
            cerrar();
            header("Location: /index");
            exit();
        }
        
    }
    
?>