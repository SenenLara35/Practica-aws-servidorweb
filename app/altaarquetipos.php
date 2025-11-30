<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Arquetipos</title>
</head>
<body>
<?php
    include"conexion.php";
?>
<?php
    include"header.php";
?>
<?php
    mysqli_select_db($conexion, "mi_base_datos");

    $nom=$_POST["nom"];
    // --- PARTE NUEVA: VERIFICACIÓN DE DUPLICADO ---
    // 1. Consultamos si el nombre ya existe
    $sql_verificacion = "SELECT nombre_arquetipo FROM arquetipo WHERE nombre_arquetipo = '$nom'";
    $resultado_verificacion = mysqli_query($conexion, $sql_verificacion);

    // 2. Verificamos si la consulta trajo algún resultado
    if (mysqli_num_rows($resultado_verificacion) > 0) {
        // Si entra aquí, el nombre ya existe
        echo "Error: El nombre del arquetipo '$nom' ya existe en la base de datos.</p>";
    } else {

        $directoriosubida="arquetipos/";
        $max_file_size="5120000";
        $extensionesValidas=array("jpg","png");
        if (isset($_FILES['imagen'])){
            $errores=0;
            $nombreArchivo=$_FILES['imagen']['name'];
            $filesize=$_FILES['imagen']['size'];
            $directorioTemp=$_FILES['imagen']['tmp_name'];
            $arrayArchivo=pathinfo($nombreArchivo);
            $extension=$arrayArchivo['extension'];

            if(!in_array($extension,$extensionesValidas)){
                echo'La extension no es valida';
                $errores=1;
            }
            if($filesize>$max_file_size){
                echo 'tamaño maximo superado';
                $errores= 1;
            }
            if($errores==0){
                $nombreCompleto=$directoriosubida.$nombreArchivo;
                move_uploaded_file($directorioTemp,$nombreCompleto);
                $sql = "INSERT INTO arquetipo (nombre_arquetipo, url_imagen_mini) VALUES('$nom','$nombreArchivo')";
                mysqli_query($conexion, $sql);
                
            }
                    $sql = "SELECT * from arquetipo";
        $registros = mysqli_query($conexion, $sql);
        echo"<div id='listado'>";
        echo "<table border= 2>";
        echo "<caption> LISTADO DE ARQUETIPOS </caption>";
        echo "<thead><tr><th>Identificador</th><th>Nombre</th><th>Descripcion</th></thead>"; 
        while ($registro=mysqli_fetch_row($registros)){
            echo "<tr>";
            echo "<td>$registro[0]</td>";
            echo "<td>$registro[1]</td>";
            echo '<td><img src="arquetipos/' . $registro[2] . '" alt="' . $registro[1] . '" width="50"></td>';        }
        echo "</table>";
        echo "</div>";
        }
    }
?>
<?
include"footer.php";
?>