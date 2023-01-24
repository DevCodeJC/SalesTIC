<?php

function conexionDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'root', 'salestic');
    if(!$db){
        echo "Conexion a Base de Datos fallida!";
        exit;
    }
    return $db;
}
?>