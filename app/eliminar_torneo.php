<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // 1. SEGURIDAD: SOLO ADMIN PUEDE ENTRAR AQUÍ
    $rol = strtolower($_SESSION['rol']);
    if ($rol != 'admin') {
        // Si intenta entrar un usuario normal u organizador, lo echamos
        header("Location: listadotorneos.php");
        exit();
    }

    // 2. RECIBIR ID
    if (isset($_GET['id_torneo'])) {
        $id_torneo = $_GET['id_torneo'];

        // 3. LIMPIEZA PREVIA (Borrar inscripciones asociadas)
        // Esto evita el error de "Cannot delete or update a parent row..."
        $sql_limpieza = "DELETE FROM inscripcion WHERE id_torneo = '$id_torneo'";
        mysqli_query($conexion, $sql_limpieza);

        // 4. BORRAR EL TORNEO
        $sql_borrar = "DELETE FROM torneo WHERE id_torneo = '$id_torneo'";
        
        if (mysqli_query($conexion, $sql_borrar)) {
            // Éxito
            header("Location: listadotorneos.php");
        } else {
            echo "Error al eliminar: " . mysqli_error($conexion);
        }
    } else {
        header("Location: listadotorneos.php");
    }
?>