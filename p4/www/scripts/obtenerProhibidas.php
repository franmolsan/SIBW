<?php
    include("bd.php");
    // si hay una peticion
    if (isset($_REQUEST)){
        conectar();
        $prohibidas = getProhibidas();
        $json = json_encode($prohibidas);
        echo $json;
        cerrar();
        exit();
    }
?>