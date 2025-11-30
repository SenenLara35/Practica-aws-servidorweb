<?php
    include "seguridad.php";
    include "header.php";
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // 1. SEGURIDAD EXTREMA: SOLO ADMIN
    // Si alguien intenta entrar escribiendo la URL y no es admin, fuera.
    if (strtolower($_SESSION['rol']) != 'admin') {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="main-content">
    
    <?php
        if(isset($_GET['msg'])){
            if($_GET['msg'] == 'rol_ok') echo "<p style='color: #00e5ff; font-weight: bold;'>¡Rol actualizado correctamente!</p>";
            if($_GET['msg'] == 'borrado') echo "<p style='color: #f44336; font-weight: bold;'>Usuario eliminado del sistema.</p>";
            if($_GET['msg'] == 'error_self') echo "<p style='color: #ff9800; font-weight: bold;'>No puedes eliminar tu propia cuenta.</p>";
            if($_GET['msg'] == 'error_fk') echo "<p style='color: #ff9800; font-weight: bold;'>No se puede borrar: Este usuario tiene mazos o torneos creados.</p>";
        }
    ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Gestión de Usuarios</h2>
        <span style="color: #a76ddc; font-weight: bold;"><i class="fa-solid fa-shield-halved"></i> Panel de Administrador</span>
    </div>

    <table class="tabla-gamer">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Rol (Permisos)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM usuario ORDER BY id_usuario ASC";
            $registros = mysqli_query($conexion, $sql);

            while ($fila = mysqli_fetch_array($registros)) {
                echo "<tr>";
                
                // ID
                echo "<td>" . $fila['id_usuario'] . "</td>";
                
                // NOMBRE
                echo "<td class='texto-mazo'>" . $fila['NomUsuario'] . "</td>";
                
                // EMAIL
                echo "<td>" . $fila['email'] . "</td>";
                
                // --- ROL CON DESPLEGABLE INTELIGENTE ---
                echo "<td>";
                // Creamos un formulario pequeño para cada fila
                echo "<form action='actualizar_rol.php' method='POST' style='margin:0;'>";
                echo "<input type='hidden' name='id_usuario' value='" . $fila['id_usuario'] . "'>";
                
                // El desplegable
                // onchange='this.form.submit()' hace que se envíe solo al cambiar la opción
                echo "<select name='nuevo_rol' class='input-gamer' style='padding: 5px; margin: 0; width: auto; font-size: 0.9em;' onchange='this.form.submit()'>";
                
                $roles = ['usuario', 'organizador', 'admin'];
                foreach($roles as $r){
                    // Si el rol de la base de datos coincide con esta opción, la marcamos selected
                    $seleccionado = ($fila['rol'] == $r) ? "selected" : "";
                    echo "<option value='$r' $seleccionado>" . ucfirst($r) . "</option>";
                }
                
                echo "</select>";
                echo "</form>";
                echo "</td>";

                // --- ACCIONES (ELIMINAR) ---
                echo "<td>";
                // Evitamos que el admin se borre a sí mismo (seguridad básica)
                if ($fila['id_usuario'] != $_SESSION['id_usuario']) {
                    echo "<a href='eliminar_usuario.php?id_usuario=" . $fila['id_usuario'] . "' class='btn-icon btn-delete' title='Expulsar Usuario' onclick='return confirm(\"¿Estás seguro de que quieres eliminar a " . $fila['NomUsuario'] . "?\")'>";
                    echo "<i class='fa-solid fa-user-xmark'></i>";
                    echo "</a>";
                } else {
                    echo "<span style='color: #666; font-size: 0.8em;'>(Tú)</span>";
                }
                echo "</td>";
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>

<?php include "footer.php"; ?>
</body>
</html>