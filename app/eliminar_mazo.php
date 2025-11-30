<?php
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // Obtenemos el ID de la URL (listamazos.php?id_mazo=5)
    if(isset($_GET['id_mazo'])){
        $id_mazo = $_GET['id_mazo'];

        $sql = "DELETE FROM mazo WHERE id_mazo = '$id_mazo'";
        mysqli_query($conexion, $sql);
    }

    // Volvemos a la lista automáticamente
    header("Location: listamazos.php");
?>