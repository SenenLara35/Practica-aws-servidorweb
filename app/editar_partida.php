<?php
    include "seguridad.php";
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // Verificar Admin
    if (strtolower($_SESSION['rol']) != 'admin') {
        header("Location: listadopartidas.php");
        exit();
    }

    $id_partida = $_GET['id_partida'];

    // Consultamos los datos actuales para mostrarlos
    $sql = "SELECT p.*, u1.NomUsuario as user1, u2.NomUsuario as user2 
            FROM partida p
            JOIN usuario u1 ON p.id_usuario_1 = u1.id_usuario
            JOIN usuario u2 ON p.id_usuario_2 = u2.id_usuario
            WHERE p.id_partida = '$id_partida'";
            
    $res = mysqli_query($conexion, $sql);
    $datos = mysqli_fetch_array($res);
?>

<div class="main-content">
    <form action="actualizar_partida.php" method="POST" class="form-gamer">
        <h2 class="form-title">Corregir Resultado</h2>
        
        <input type="hidden" name="id_partida" value="<?php echo $datos['id_partida']; ?>">

        <div style="text-align: center; margin-bottom: 20px; font-size: 1.2em;">
            <span style="color: #a76ddc; font-weight: bold;"><?php echo $datos['user1']; ?></span>
            <span style="margin: 0 10px;">VS</span>
            <span style="color: #a76ddc; font-weight: bold;"><?php echo $datos['user2']; ?></span>
        </div>

        <label>Resultado Correcto:</label>
        <select name="resultado" class="input-gamer">
            <option value="2-0" <?php if($datos['resultado']=='2-0') echo 'selected'; ?>>2 - 0</option>
            <option value="2-1" <?php if($datos['resultado']=='2-1') echo 'selected'; ?>>2 - 1</option>
            <option value="1-0" <?php if($datos['resultado']=='1-0') echo 'selected'; ?>>1 - 0</option>
            <option value="1-1" <?php if($datos['resultado']=='1-1') echo 'selected'; ?>>1 - 1</option>
            <option value="0-0" <?php if($datos['resultado']=='0-0') echo 'selected'; ?>>0 - 0</option>
            <option value="0-1" <?php if($datos['resultado']=='0-1') echo 'selected'; ?>>0 - 1</option>
            <option value="1-2" <?php if($datos['resultado']=='1-2') echo 'selected'; ?>>1 - 2</option>
            <option value="0-2" <?php if($datos['resultado']=='0-2') echo 'selected'; ?>>0 - 2</option>
        </select>

        <button type="submit" class="btn-gamer">Guardar Corrección</button>
        
        <div style="margin-top: 15px; text-align: center;">
            <a href="listadopartidas.php" style="color: #f44336;">Cancelar</a>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>