<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // Recibimos los datos del formulario (apuntartorneo.php)
    $id_torneo = $_POST['id_torneo'];
    $id_mazo = $_POST['id_mazo']; // Este valor irá a la columna 'id_mazo_registrado'
    $id_usuario = $_SESSION['id_usuario'];

    // 1. VALIDACIÓN: Comprobamos si ya existe la inscripción
    // Usamos las columnas de tu imagen: id_torneo y id_usuario
    $sql_check = "SELECT * FROM inscripcion WHERE id_torneo = '$id_torneo' AND id_usuario = '$id_usuario'";
    $check = mysqli_query($conexion, $sql_check);

    if (mysqli_num_rows($check) > 0) {
        // Si ya está inscrito, lo devolvemos con aviso
        header("Location: listadotorneos.php?estado=ya_inscrito");
        exit();
    }

    // 2. INSERTAR INSCRIPCIÓN (ADAPTADO A TU TABLA)
    // OJO AQUÍ: Usamos 'id_mazo_registrado' que es como se llama en tu base de datos
    $sql = "INSERT INTO inscripcion (id_torneo, id_usuario, id_mazo_registrado) 
            VALUES ('$id_torneo', '$id_usuario', '$id_mazo')";

    if (mysqli_query($conexion, $sql)) {
        // Éxito
        header("Location: listadotorneos.php?estado=exito");
    } else {
        echo "Error en la base de datos: " . mysqli_error($conexion);
    }
?>