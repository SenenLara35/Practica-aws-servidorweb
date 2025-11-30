<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // 1. VERIFICACIÓN DE ROL OTRA VEZ (Para evitar accesos directos por URL)
    $rol = strtolower($_SESSION['rol']);
    if ($rol != 'organizador' && $rol != 'admin') {
        header("Location: index.php");
        exit();
    }

    // 2. RECIBIR DATOS
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $id_creador = $_SESSION['id_usuario'];

    // 3. INSERTAR EN BASE DE DATOS
    
    $sql = "INSERT INTO torneo (id_creador, nombre_torneo, fecha) 
            VALUES ('$id_creador','$nombre' , '$fecha')";

    if (mysqli_query($conexion, $sql)) {
        // Éxito: volvemos al listado
        header("Location: listadotorneos.php");
    } else {
        echo "Error al crear torneo: " . mysqli_error($conexion);
    }
?>