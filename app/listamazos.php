<?php
// 1. SEGURIDAD: El "portero" va primero. Si no hay sesión, te echa.
include "seguridad.php";

// 2. Resto de includes
include "header.php";
include "conexion.php";

mysqli_select_db($conexion, "mi_base_datos");
$id_usuario_logueado = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Mazos</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="main-content">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Mis Mazos Registrados</h2>
            <a href="altamazo.php" class="btn-gamer"><i class="fa-solid fa-plus"></i> Nuevo Mazo</a>
        </div>

        <?php
        $sql = "SELECT m.id_mazo, m.nombre_mazo, a.url_imagen_mini 
                FROM mazo m 
                INNER JOIN arquetipo a ON m.id_arquetipo = a.id_arquetipo 
                WHERE m.id_propietario = '$id_usuario_logueado'"; // <--- AQUÍ ESTÁ LA CLAVE
        
        $resultado = mysqli_query($conexion, $sql);


        if (mysqli_num_rows($resultado) > 0) {
            ?>
            <table class="tabla-gamer">
                <thead>
                    <tr>
                        <th>Arquetipo</th>
                        <th>Nombre del Mazo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fila = mysqli_fetch_array($resultado)) {
                        echo "<tr>";

                        // 1. COLUMNA IMAGEN
                        // NOTA: Asegúrate de que la carpeta sea 'arquetipos' o 'imagenes' según donde subiste los archivos
                        echo "<td>";
                        echo "<img src='arquetipos/" . $fila['url_imagen_mini'] . "' alt='Arquetipo' class='mini-arquetipo'>";
                        echo "</td>";

                        // 2. COLUMNA NOMBRE
                        echo "<td class='texto-mazo'>" . $fila['nombre_mazo'] . "</td>";

                        // 3. COLUMNA ACCIONES
                        echo "<td>";

                        // Botón EDITAR
                        echo "<a href='modificar_mazo.php?id_mazo=" . $fila['id_mazo'] . "' class='btn-icon btn-edit' title='Editar'>";
                        echo "<i class='fa-solid fa-pen-to-square'></i>";
                        echo "</a>";

                        // Botón ELIMINAR
                        echo "<a href='eliminar_mazo.php?id_mazo=" . $fila['id_mazo'] . "' class='btn-icon btn-delete' title='Eliminar' onclick='return confirm(\"¿Seguro que quieres borrar este mazo?\")'>";
                        echo "<i class='fa-solid fa-trash'></i>";
                        echo "</a>";

                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            // Si NO tiene mazos, mostramos un mensaje amigable en lugar de una tabla vacía
            echo "<div style='text-align: center; padding: 40px; background: rgba(0,0,0,0.3); border-radius: 10px;'>";
            echo "<h3 style='color: #d1d1d1;'>Aún no tienes ningún mazo.</h3>";
            echo "<p>¡Crea tu primer mazo para empezar a competir!</p>";
            echo "</div>";
        }
        ?>

    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>