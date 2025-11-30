<?php
    include "seguridad.php";
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");

    // Variable para comprobar si es admin rápidamente
    $es_admin = (isset($_SESSION['rol']) && strtolower($_SESSION['rol']) == 'admin');
?>

<div class="main-content">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Registro de Batallas</h2>
        <a href="altapartida.php" class="btn-gamer" style="background: linear-gradient(45deg, #ff9800, #f57c00);">
            <i class="fa-solid fa-swords"></i> Reportar Resultado
        </a>
    </div>

    <table class="tabla-gamer">
        <thead>
            <tr>
                <th>Torneo</th>
                <th style="text-align: right;">Jugador 1</th>
                <th style="width: 50px;">VS</th>
                <th style="text-align: left;">Jugador 2</th>
                <th>Resultado</th>
                <?php if($es_admin) echo "<th>Admin</th>"; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // --- CAMBIO IMPORTANTE: Añadimos p.id_partida al SELECT ---
            $sql = "SELECT 
                        p.id_partida, 
                        t.nombre_torneo,
                        u1.NomUsuario as user1, a1.url_imagen_mini as img1,
                        u2.NomUsuario as user2, a2.url_imagen_mini as img2,
                        p.resultado
                    FROM partida p
                    JOIN torneo t ON p.id_torneo = t.id_torneo
                    JOIN usuario u1 ON p.id_usuario_1 = u1.id_usuario
                    JOIN mazo m1 ON p.id_mazo_1 = m1.id_mazo
                    JOIN arquetipo a1 ON m1.id_arquetipo = a1.id_arquetipo
                    JOIN usuario u2 ON p.id_usuario_2 = u2.id_usuario
                    JOIN mazo m2 ON p.id_mazo_2 = m2.id_mazo
                    JOIN arquetipo a2 ON m2.id_arquetipo = a2.id_arquetipo
                    ORDER BY p.id_partida DESC";

            $registros = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($registros) > 0) {
                while ($fila = mysqli_fetch_array($registros)) {
                    echo "<tr>";
                    
                    // TORNEO
                    echo "<td style='font-size: 0.9em; color: #a76ddc; font-weight: bold;'>" . $fila['nombre_torneo'] . "</td>";

                    // JUGADOR 1
                    echo "<td style='text-align: right; vertical-align: middle;'>";
                    echo "<span style='font-weight:bold; margin-right: 10px; font-size: 1.1em;'>" . $fila['user1'] . "</span>";
                    echo "<img src='arquetipos/" . $fila['img1'] . "' class='mini-arquetipo' style='width: 60px; height: 30px; vertical-align: middle;'>";
                    echo "</td>";

                    // VS
                    echo "<td style='color: #f44336; font-weight: bold; font-style: italic; font-size: 1.2em;'>VS</td>";

                    // JUGADOR 2
                    echo "<td style='text-align: left; vertical-align: middle;'>";
                    echo "<img src='arquetipos/" . $fila['img2'] . "' class='mini-arquetipo' style='width: 60px; height: 30px; vertical-align: middle;'>";
                    echo "<span style='font-weight:bold; margin-left: 10px; font-size: 1.1em;'>" . $fila['user2'] . "</span>";
                    echo "</td>";

                    // RESULTADO
                    echo "<td><span class='btn-gamer' style='padding: 5px 15px; background: #222; cursor: default; border: 1px solid #555;'>" . $fila['resultado'] . "</span></td>";

                    // BOTONES DE ADMIN
                    if ($es_admin) {
                        echo "<td>";
                        // Editar
                        echo "<a href='editar_partida.php?id_partida=" . $fila['id_partida'] . "' class='btn-icon btn-edit' title='Corregir Resultado'><i class='fa-solid fa-pen'></i></a>";
                        // Eliminar
                        echo "<a href='eliminar_partida.php?id_partida=" . $fila['id_partida'] . "' class='btn-icon btn-delete' title='Eliminar Partida' onclick='return confirm(\"¿Borrar esta partida?\")'><i class='fa-solid fa-trash'></i></a>";
                        echo "</td>";
                    }

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='padding: 30px;'>No hay partidas registradas aún.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>