<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    if (strtolower($_SESSION['rol']) != 'admin') {
        header("Location: listadopartidas.php");
        exit();
    }

    $id = $_POST['id_partida'];
    $res = $_POST['resultado'];

    $sql = "UPDATE partida SET resultado = '$res' WHERE id_partida = '$id'";

    if(mysqli_query($conexion, $sql)) {
        header("Location: listadopartidas.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
?>