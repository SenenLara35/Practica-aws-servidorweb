<?php
    include "seguridad.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // 1. RECIBIR DATOS
    $datos_combinados = $_POST['datos_partida']; // "ID_TORNEO|ID_RIVAL"
    $resultado = $_POST['resultado'];
    $ronda = $_POST['ronda']; // Por defecto 1
    
    // Usuario 1 soy YO, Usuario 2 es el RIVAL
    $id_usuario_1 = $_SESSION['id_usuario'];
    
    // Separamos el ID del torneo y del rival
    $partes = explode("|", $datos_combinados);
    $id_torneo = $partes[0];
    $id_usuario_2 = $partes[1];

    // 2. BUSCAR LOS MAZOS DE CADA JUGADOR
    // Necesitamos saber qué mazo registró cada uno para este torneo
    
    // Buscar Mazo Jugador 1
    $sql_mazo1 = "SELECT id_mazo_registrado FROM inscripcion WHERE id_torneo='$id_torneo' AND id_usuario='$id_usuario_1'";
    $res1 = mysqli_query($conexion, $sql_mazo1);
    $fila1 = mysqli_fetch_array($res1);
    $id_mazo_1 = $fila1['id_mazo_registrado'];

    // Buscar Mazo Jugador 2
    $sql_mazo2 = "SELECT id_mazo_registrado FROM inscripcion WHERE id_torneo='$id_torneo' AND id_usuario='$id_usuario_2'";
    $res2 = mysqli_query($conexion, $sql_mazo2);
    $fila2 = mysqli_fetch_array($res2);
    $id_mazo_2 = $fila2['id_mazo_registrado'];

    // 3. INSERTAR EN LA TABLA PARTIDA
    // Rellenamos todas las columnas que tiene tu imagen
    $sql = "INSERT INTO partida (id_torneo, ronda, id_usuario_1, id_mazo_1, id_usuario_2, id_mazo_2, resultado) 
            VALUES ('$id_torneo', '$ronda', '$id_usuario_1', '$id_mazo_1', '$id_usuario_2', '$id_mazo_2', '$resultado')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: listadopartidas.php?exito=1");
    } else {
        echo "Error al guardar partida: " . mysqli_error($conexion);
    }
?>