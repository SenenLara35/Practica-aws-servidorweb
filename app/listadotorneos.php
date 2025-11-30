<?php
    // 1. SEGURIDAD: Primero verificamos la sesión
    include "seguridad.php"; 
    
    // 2. INCLUDES DE INTERFAZ Y CONEXIÓN
    include "header.php";
    include "conexion.php";
    
    mysqli_select_db($conexion, "proyecto2");

    // 3. RECUPERAR DATOS DEL USUARIO LOGUEADO
    // Usamos el operador de fusión null (??) por seguridad si la sesión fallara
    $rol_usuario = $_SESSION['rol'] ?? ''; 
    $id_usuario_logueado = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos - Granaless TCG</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="main-content">
    
    <?php
        if(isset($_GET['estado'])){
            if($_GET['estado'] == 'exito') {
                echo "<div style='background: rgba(0, 229, 255, 0.1); padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #00e5ff; color: #00e5ff; font-weight: bold;'>";
                echo "<i class='fa-solid fa-check'></i> ¡Operación realizada con éxito!";
                echo "</div>";
            }
            if($_GET['estado'] == 'ya_inscrito') {
                echo "<div style='background: rgba(244, 67, 54, 0.1); padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f44336; color: #f44336; font-weight: bold;'>";
                echo "<i class='fa-solid fa-triangle-exclamation'></i> ¡Ya estás apuntado a este torneo!";
                echo "</div>";
            }
        }
    ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Torneos Activos</h2>
        
        <?php
        $rol = strtolower($rol_usuario); // Pasamos a minúsculas para comparar
        if ($rol == 'organizador' || $rol == 'admin') {
            echo '<a href="altatorneo.php" class="btn-gamer">';
            echo '<i class="fa-solid fa-trophy"></i> Crear Torneo';
            echo '</a>';
        }
        ?>
    </div>

    <table class="tabla-gamer">
        <thead>
            <tr>
                <th>Nombre del Torneo</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Consultamos todos los torneos
            $sql = "SELECT * FROM torneo";
            $registros = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($registros) > 0) {
                // Recorremos cada torneo
                while ($fila = mysqli_fetch_array($registros)) {
                    // Obtenemos los datos (usamos índices numéricos según tu BD antigua)
                    // Ajusta estos índices si tus columnas han cambiado de orden
                    $id_torneo = $fila[0]; 
                    $nombre_torneo = $fila[2]; 
                    $ubicacion = $fila[3];     

                    echo "<tr>";
                    
                    // 1. NOMBRE
                    echo "<td class='texto-mazo'>" . $nombre_torneo . "</td>"; 
                    
                    // 2. UBICACIÓN
                    echo "<td><i class='fa-solid fa-location-dot' style='color:#a76ddc;'></i> " . $ubicacion . "</td>";
                    
                    // 3. ACCIONES (Contenedor de botones)
                    echo "<td>";
                    echo "<div style='display: flex; gap: 10px; justify-content: center; align-items: center;'>";

                    // --- BOTÓN A: VER INSCRITOS (Para todos) ---
                    echo "<a href='ver_inscritos.php?id_torneo=" . $id_torneo . "' class='btn-gamer' style='padding: 8px 15px; font-size: 0.9rem; background: linear-gradient(45deg, #4a4a4a, #2b2b2b); box-shadow: none;'>";
                    echo "<i class='fa-solid fa-users'></i> Ver";
                    echo "</a>";

                    // --- BOTÓN B: INSCRIPCIÓN (Lógica inteligente) ---
                    // Verificamos si el usuario YA está inscrito
                    $sql_check = "SELECT * FROM inscripcion WHERE id_torneo = '$id_torneo' AND id_usuario = '$id_usuario_logueado'";
                    $check = mysqli_query($conexion, $sql_check);

                    if (mysqli_num_rows($check) > 0) {
                        // YA INSCRITO -> Mensaje Verde
                        echo "<span style='color: #00e5ff; font-weight: bold; font-size: 0.9rem;'>";
                        echo "<i class='fa-solid fa-check-circle'></i> Apuntado";
                        echo "</span>";
                    } else {
                        // NO INSCRITO -> Botón Apuntarse
                        echo "<a href='apuntartorneo.php?id_torneo=" . $id_torneo . "' class='btn-gamer' style='padding: 8px 15px; font-size: 0.9rem;'>";
                        echo "Apuntarse";
                        echo "</a>";
                    }

                    // --- BOTÓN C: ELIMINAR (SOLO ADMIN) ---
                    if ($rol == 'admin') {
                        // Botón rojo de basura con confirmación
                        echo "<a href='eliminar_torneo.php?id_torneo=" . $id_torneo . "' class='btn-icon btn-delete' title='Eliminar Torneo' onclick='return confirm(\"¡ATENCIÓN!\\n\\nSi borras este torneo, se eliminarán también todas las inscripciones asociadas.\\n\\n¿Estás seguro de continuar?\")'>";
                        echo "<i class='fa-solid fa-trash'></i>";
                        echo "</a>";
                    }
                    
                    echo "</div>"; // Fin del contenedor flex
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // Si no hay torneos creados
                echo "<tr><td colspan='3' style='padding: 30px;'>No hay torneos activos en este momento.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
</div>

<?php
    include "footer.php";
?>
</body>
</html>