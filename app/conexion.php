<?php
    $servidor = "34.200.249.60";
    $usuario = "usuario";
    $password = "password123";
    $database = "mi_base_datos";
    $port = 3306;

    $conexion = new mysqli($servidor, $usuario, $password, "$database", $port);
