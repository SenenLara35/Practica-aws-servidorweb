<?php
    $servidor = "10.2.1.13";
    $usuario = "usuario123";
    $password = "password123";
    $database = "mi_base_datos";
    $port = 3306;

    $conexion = new mysqli($servidor, $usuario, $password, "$database", $port);
?>