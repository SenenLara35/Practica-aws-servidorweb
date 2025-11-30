<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // Verificar Admin
    if (strtolower($_SESSION['rol']) != 'admin') {
        header("Location: listadopartidas.php");
        exit();
    }

    if(isset($_GET['id_partida'])) {
        $id = $_GET['id_partida'];
        $sql = "DELETE FROM partida WHERE id_partida = '$id'";
        mysqli_query($conexion, $sql);
    }

    header("Location: listadopartidas.php");
?>