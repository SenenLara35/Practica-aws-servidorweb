<?php
    include "seguridad.php"; // Protegemos la página
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // Recogemos el ID del torneo de la URL y el ID del usuario de la sesión
    $id_torneo = $_GET['id_torneo'];
    $id_usuario = $_SESSION['id_usuario']; 
?>

<div class="main-content">
    
    <form action="guardar_inscripcion.php" method="POST" class="form-gamer">
        <h2 class="form-title">Inscripción al Torneo</h2>
        
        <input type="hidden" name="id_torneo" value="<?php echo $id_torneo; ?>">

        <label for="id_mazo">Elige con qué mazo jugarás:</label>

        <?php
            // --- AQUÍ ESTABA EL ERROR ---
            // Antes buscabas "WHERE usuario = ...", pero tu tabla tiene "id_propietario"
            $sql = "SELECT id_mazo, nombre_mazo FROM mazo WHERE id_propietario = '$id_usuario'";
            
            // Para depurar (Si vuelve a fallar, descomenta la línea de abajo para ver el error real)
            // $resultado = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
            
            $resultado = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($resultado) > 0) {
        ?>
                <select name="id_mazo" class="input-gamer" required>
                    <option value="" disabled selected>-- Selecciona tu Mazo --</option>
                    <?php
                        while ($fila = mysqli_fetch_array($resultado)) {
                            echo "<option value='" . $fila['id_mazo'] . "'>" . $fila['nombre_mazo'] . "</option>";
                        }
                    ?>
                </select>

                <button type="submit" class="btn-gamer">Confirmar Inscripción</button>

        <?php
            } else {
                // Si el usuario no tiene mazos
                echo "<p style='color: #d1d1d1; margin-bottom: 20px;'>No tienes mazos registrados.</p>";
                echo "<a href='altamazo.php' class='btn-gamer' style='background: #f44336;'>Crear un Mazo primero</a>";
            }
        ?>
    </form>
    
    <br>
    <a href="listadotorneos.php" style="color: #00e5ff; text-decoration: underline;">Volver al listado</a>

</div>

<?php
    include "footer.php";
?>
</body>
</html>