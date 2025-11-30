<?php
    include "seguridad.php";
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "mi_base_datos");
    
    $mi_id = $_SESSION['id_usuario'];
?>

<div class="main-content">
    <form action="guardar_partida.php" method="POST" class="form-gamer">
        <h2 class="form-title">Reportar Resultado</h2>

        <label>Selecciona Rival y Torneo:</label>
        <select name="datos_partida" class="input-gamer" required>
            <option value="" disabled selected>-- Elige contra quién jugaste --</option>
            
            <?php
            // 1. Buscamos los torneos donde YO estoy inscrito
            $sql_mis_torneos = "SELECT t.id_torneo, t.nombre_torneo 
                                FROM inscripcion i 
                                JOIN torneo t ON i.id_torneo = t.id_torneo 
                                WHERE i.id_usuario = '$mi_id'";
            $res_torneos = mysqli_query($conexion, $sql_mis_torneos);

            while($torneo = mysqli_fetch_array($res_torneos)){
                $id_t = $torneo['id_torneo'];
                $nom_t = $torneo['nombre_torneo'];

                echo "<optgroup label='$nom_t'>";

                // 2. Buscamos a los RIVALES inscritos en ese mismo torneo
                $sql_rivales = "SELECT u.id_usuario, u.NomUsuario 
                                FROM inscripcion i 
                                JOIN usuario u ON i.id_usuario = u.id_usuario 
                                WHERE i.id_torneo = '$id_t' AND i.id_usuario != '$mi_id'";
                $res_rivales = mysqli_query($conexion, $sql_rivales);

                if(mysqli_num_rows($res_rivales) > 0){
                    while($rival = mysqli_fetch_array($res_rivales)){
                        // Value = "ID_TORNEO|ID_RIVAL"
                        echo "<option value='" . $id_t . "|" . $rival['id_usuario'] . "'>" . $rival['NomUsuario'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Esperando rivales...</option>";
                }
                echo "</optgroup>";
            }
            ?>
        </select>

        <label>Resultado (Tu Puntuación - Rival):</label>
        <select name="resultado" class="input-gamer" required>
            <option value="" disabled selected>-- Selecciona --</option>
            <option value="2-0">2 - 0</option>
            <option value="2-1">2 - 1</option>
            <option value="1-0">1 - 0</option>
            <option value="1-1">1 - 1</option>
            <option value="0-1">0 - 1</option>
            <option value="1-2">1 - 2</option>
            <option value="0-2">0 - 2</option>
        </select>

        <input type="hidden" name="ronda" value="1">

        <button type="submit" class="btn-gamer">Registrar Partida</button>
    </form>
</div>

<?php include "footer.php"; ?>