<?php
    $servidor = "44.203.209.69";
    $usuario = "usuario";
    $password = "password123";
    $database = "mi_base_datos";
    $port = 3306;

    $conexion = new mysqli($servidor, $usuario, $password, "$database", $port);
