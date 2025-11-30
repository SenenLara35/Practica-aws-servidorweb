<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // Verificar Admin
    if (strtolower($_SESSION['rol']) != 'admin') {
        header("Location: index.php");
        exit();
    }

    $id_borrar = $_GET['id_usuario'];

    // Evitar suicidio (borrarse a uno mismo)
    if ($id_borrar == $_SESSION['id_usuario']) {
        header("Location: listausuarios.php?msg=error_self");
        exit();
    }

    $sql = "DELETE FROM usuario WHERE id_usuario = '$id_borrar'";

    // Usamos try-catch o verificamos el resultado para capturar errores de Claves Foráneas
    try {
        if (mysqli_query($conexion, $sql)) {
            header("Location: listausuarios.php?msg=borrado");
        } else {
            // Si falla (probablemente porque tiene datos vinculados)
            header("Location: listausuarios.php?msg=error_fk");
        }
    } catch (Exception $e) {
        header("Location: listausuarios.php?msg=error_fk");
    }
?>