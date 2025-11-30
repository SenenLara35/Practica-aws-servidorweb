<?php
    include "seguridad.php";
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    $id_torneo = $_GET['id_torneo'];

    // Obtener nombre del torneo para el título
    $sql_torneo = "SELECT * FROM torneo WHERE id_torneo = '$id_torneo'";
    $res_torneo = mysqli_query($conexion, $sql_torneo);
    $datos_torneo = mysqli_fetch_array($res_torneo);
    
    // Ajusta el índice si tu columna de nombre no es la [2]
    $nombre_torneo = $datos_torneo[2]; 
?>

<div class="main-content">
    
    <div style="margin-bottom: 20px;">
        <h2 style="margin-bottom: 5px;">Participantes del Torneo</h2>
        <h3 style="color: #00e5ff; margin-top: 0;"><?php echo $nombre_torneo; ?></h3>
    </div>

    <table class="tabla-gamer">
        <thead>
            <tr>
                <th>Jugador</th>
                <th>Imagen</th> <th>Arquetipo</th> </tr>
        </thead>
        <tbody>
            <?php
            // --- CONSULTA MODIFICADA ---
            // Hemos añadido 'a.nombre_arquetipo' al SELECT
            $sql = "SELECT u.NomUsuario, a.url_imagen_mini, a.nombre_arquetipo
                    FROM inscripcion i
                    INNER JOIN usuario u ON i.id_usuario = u.id_usuario
                    INNER JOIN mazo m ON i.id_mazo_registrado = m.id_mazo
                    INNER JOIN arquetipo a ON m.id_arquetipo = a.id_arquetipo
                    WHERE i.id_torneo = '$id_torneo'";

            $registros = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($registros) > 0) {
                while ($fila = mysqli_fetch_array($registros)) {
                    echo "<tr>";
                    
                    // 1. JUGADOR
                    echo "<td style='font-size: 1.2rem; font-weight: bold; color: #d1d1d1;'>";
                    echo "<i class='fa-solid fa-user'></i> " . $fila['NomUsuario'];
                    echo "</td>";

                    // 2. IMAGEN DEL ARQUETIPO
                    echo "<td>";
                    echo "<img src='arquetipos/" . $fila['url_imagen_mini'] . "' class='mini-arquetipo' alt='Arquetipo'>";
                    echo "</td>";

                    // 3. NOMBRE DEL ARQUETIPO (El cambio solicitado)
                    echo "<td class='texto-mazo' style='color: #a76ddc; font-weight: bold;'>";
                    echo $fila['nombre_arquetipo'];
                    echo "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' style='padding: 30px;'>Aún no hay nadie inscrito en este torneo. ¡Sé el primero!</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="listadotorneos.php" class="btn-gamer" style="background: #4a4a4a;">
        <i class="fa-solid fa-arrow-left"></i> Volver a Torneos
    </a>

</div>

<?php
    include "footer.php";
?>
</body>
</html>