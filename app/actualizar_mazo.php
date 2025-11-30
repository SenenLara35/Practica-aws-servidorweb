<?php
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // Recibimos datos
    $id_mazo = $_POST['id_mazo'];
    $nom = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    // $prop = $_POST["id_propietario"];  <-- YA NO LO RECIBIMOS NI ACTUALIZAMOS
    $arq = $_POST["id_arquetipo"];
    $lista = mysqli_real_escape_string($conexion, $_POST["lista"]);

    // Actualizamos SOLO nombre, arquetipo y lista. El dueño se queda igual.
    $sql = "UPDATE mazo SET 
            nombre_mazo = '$nom', 
            id_arquetipo = '$arq', 
            lista_completa = '$lista' 
            WHERE id_mazo = '$id_mazo'";

    if(mysqli_query($conexion, $sql)){
        header("Location: listamazos.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
?>