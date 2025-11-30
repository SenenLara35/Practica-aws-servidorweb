<?php
    include "seguridad.php"; // Necesario para acceder a $_SESSION
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // 1. RECIBIMOS LOS DATOS DEL FORMULARIO
    $nom = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $arq = $_POST["id_arquetipo"];
    $lista = mysqli_real_escape_string($conexion, $_POST["lista"]);
    
    // 2. CAMBIO CLAVE: El propietario es el usuario que tiene la sesión iniciada
    $prop = $_SESSION['id_usuario']; 

    // 3. INSERTAMOS EN LA BASE DE DATOS
    $sql = "INSERT INTO mazo (id_propietario, id_arquetipo, nombre_mazo, lista_completa) 
            VALUES ('$prop', '$arq', '$nom', '$lista')";

    if(mysqli_query($conexion, $sql)){
        // Si sale bien, volvemos a la lista de mis mazos
        header("Location: listamazos.php");
    } else {
        echo "Error al guardar el mazo: " . mysqli_error($conexion);
    }
?>