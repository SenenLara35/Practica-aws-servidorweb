<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // Verificar Admin
    if (strtolower($_SESSION['rol']) != 'admin') {
        header("Location: index.php");
        exit();
    }

    // Recibir datos
    $id_usuario = $_POST['id_usuario'];
    $nuevo_rol = $_POST['nuevo_rol'];

    // Actualizar
    $sql = "UPDATE usuario SET rol = '$nuevo_rol' WHERE id_usuario = '$id_usuario'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: listausuarios.php?msg=rol_ok");
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
?>