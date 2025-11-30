<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Arquetipos</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php
        include("conexion.php");
        include("header.php"); // Se asume que aquí inicia la sesión si es necesario
        mysqli_select_db($conexion, "proyecto2");

        // --- LÓGICA DEL BUSCADOR ---
        $busqueda = "";
        $where = "";

        if (isset($_POST['buscar'])) {
            // Limpiamos lo que escribe el usuario por seguridad
            $busqueda = mysqli_real_escape_string($conexion, $_POST['busqueda']);
            // Creamos el filtro SQL
            $where = "WHERE nombre_arquetipo LIKE '%$busqueda%'";
        }
    ?>

    <div class="main-content">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Listado de Arquetipos</h2>
            <a href="altaarquetipo.php" class="btn-gamer">
                <i class="fa-solid fa-plus"></i> Crea tu arquetipo
            </a>
        </div>

        <form method="POST" action="listaarquetipos.php" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="busqueda" class="input-gamer" 
                   placeholder="Buscar por nombre..." 
                   value="<?php echo $busqueda; ?>" 
                   style="margin-bottom: 0;"> <button type="submit" name="buscar" class="btn-gamer" style="margin-top: 0; width: auto; padding: 0 20px;">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar
            </button>
            
            <?php if($busqueda != "") { ?>
                <a href="listaarquetipos.php" class="btn-gamer" style="background: #f44336; margin-top: 0; width: auto; display: flex; align-items: center;">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            <?php } ?>
        </form>

        <table class="tabla-gamer">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre del Arquetipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Modificamos la consulta para incluir el filtro $where
                $sql = "SELECT * FROM arquetipo $where ORDER BY nombre_arquetipo ASC";
                $registros = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($registros) > 0) {
                    while ($fila = mysqli_fetch_array($registros)) {
                        $ruta_imagen = "arquetipos/" . $fila['url_imagen_mini'];
                        
                        echo "<tr>";
                        
                        // 2. HEMOS QUITADO EL ID DE AQUÍ TAMBIÉN

                        // Columna Imagen
                        echo "<td>";
                        if (!empty($fila['url_imagen_mini'])) {
                            echo "<img src='$ruta_imagen' alt='" . $fila['nombre_arquetipo'] . "' class='mini-arquetipo'>";
                        } else {
                            echo "Sin imagen";
                        }
                        echo "</td>";

                        // Columna Nombre
                        echo "<td class='texto-mazo'>" . $fila['nombre_arquetipo'] . "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No se encontraron arquetipos con ese nombre.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <?php
        include("footer.php");
    ?>
</body>
</html>