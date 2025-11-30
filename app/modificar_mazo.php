<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mazo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php
    include "conexion.php";
    include "header.php";
    mysqli_select_db($conexion, "mi_base_datos");

    $id_mazo = $_GET['id_mazo'];

    // --- CAMBIO IMPORTANTE: HACEMOS JOIN PARA SACAR EL NOMBRE DEL USUARIO ---
    // Unimos la tabla mazo (m) con usuario (u)
    $sql_mazo = "SELECT m.*, u.NomUsuario 
                 FROM mazo m 
                 INNER JOIN usuario u ON m.id_propietario = u.id_usuario 
                 WHERE m.id_mazo = '$id_mazo'";
                 
    $res_mazo = mysqli_query($conexion, $sql_mazo);
    $datos_mazo = mysqli_fetch_array($res_mazo);
?>

<div class="main-content">
    <h2>Editar Mazo: <?php echo $datos_mazo['nombre_mazo']; ?></h2>

    <form action="actualizar_mazo.php" method="POST" class="form-gamer">
        
        <input type="hidden" name="id_mazo" value="<?php echo $datos_mazo['id_mazo']; ?>">

        <label>Propietario (No editable):</label>
        <input type="text" 
               value="<?php echo $datos_mazo['NomUsuario']; ?>" 
               class="input-gamer input-bloqueado" 
               readonly>

        <label>Nombre del Mazo:</label>
        <input type="text" name="nombre" class="input-gamer" value="<?php echo $datos_mazo['nombre_mazo']; ?>" required>

        <label>Arquetipo:</label>
        <select name="id_arquetipo" class="input-gamer">
            <?php
                $sql_a = "SELECT id_arquetipo, nombre_arquetipo FROM arquetipo";
                $res_a = mysqli_query($conexion, $sql_a);
                while($a = mysqli_fetch_array($res_a)){
                    if($a['id_arquetipo'] == $datos_mazo['id_arquetipo']){
                        echo "<option value='".$a['id_arquetipo']."' selected>".$a['nombre_arquetipo']."</option>";
                    } else {
                        echo "<option value='".$a['id_arquetipo']."'>".$a['nombre_arquetipo']."</option>";
                    }
                }
            ?>
        </select>

        <label>Lista de Cartas:</label>
        <textarea name="lista" class="input-gamer" rows="6"><?php echo $datos_mazo['lista_completa']; ?></textarea>

        <button type="submit" class="btn-gamer">Actualizar Mazo</button>
    </form>
</div>

<?php include "footer.php"; ?>
</body>
</html>