<?php
    include "seguridad.php"; // Importante: Verifica que estás logueado
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");
?>

<div class="main-content">
    
    <form action="guardar_mazo.php" method="POST" class="form-gamer">
        <h2 class="form-title">Crear Nuevo Mazo</h2>
        
        <label for="nombre">Nombre del Mazo:</label>
        <input type="text" name="nombre" class="input-gamer" required placeholder="Ej: Charizard Ex Turbo">

        <label for="id_arquetipo">Arquetipo Base:</label>
        <select name="id_arquetipo" class="input-gamer" required>
            <option value="" disabled selected>-- Selecciona Arquetipo --</option>
            <?php
                $sql_arq = "SELECT id_arquetipo, nombre_arquetipo FROM arquetipo ORDER BY nombre_arquetipo ASC";
                $res_arq = mysqli_query($conexion, $sql_arq);
                while($arq = mysqli_fetch_array($res_arq)){
                    echo "<option value='".$arq['id_arquetipo']."'>".$arq['nombre_arquetipo']."</option>";
                }
            ?>
        </select>

        <label for="lista">Lista de Cartas:</label>
        <textarea name="lista" class="input-gamer" rows="6" placeholder="Pega aquí tu lista de cartas..."></textarea>

        <button type="submit" class="btn-gamer">Guardar Mazo</button>
        
        <div style="margin-top: 15px; text-align: center;">
            <a href="listamazos.php" style="color: #f44336;">Cancelar</a>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>
</body>
</html>