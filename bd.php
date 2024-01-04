<?php
    $cadena_conexion = 'mysql:dbname=pedidos;host=127.0.0.1';  
    $usuario = 'root';
    $clave='';

    $bd = new PDO($cadena_conexion, $usuario, $clave);
?>