<?php
    include "header.php"; // Aquí ya se inicia la sesión
    
    // Si el usuario ya está logueado, lo mandamos al inicio
    if (isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Granaless TCG</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    
    <div class="main-content">
        
        <form action="guardar_registro.php" method="POST" class="form-gamer">
            <h2 class="form-title">Nuevo Usuario</h2>

            <?php 
                if(isset($_GET['error'])){
                    if($_GET['error'] == 'existe'){
                        echo "<p style='color: #f44336; text-align: center; font-weight: bold;'>¡Ese nombre o email ya está en uso!</p>";
                    } else if ($_GET['error'] == 'pass'){
                        echo "<p style='color: #f44336; text-align: center; font-weight: bold;'>Las contraseñas no coinciden</p>";
                    } else {
                        echo "<p style='color: #f44336; text-align: center; font-weight: bold;'>Error al registrar</p>";
                    }
                }
            ?>

            <label for="usuario">Nombre de Usuario:</label>
            <input type="text" name="usuario" class="input-gamer" placeholder="Ej: ElJota" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" class="input-gamer" placeholder="correo@ejemplo.com" required>

            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" class="input-gamer" placeholder="••••••••" required>

            <label for="pass2">Confirmar Contraseña:</label>
            <input type="password" name="pass2" class="input-gamer" placeholder="••••••••" required>

            <button type="submit" class="btn-gamer">Crear Cuenta</button>

            <div style="margin-top: 20px; text-align: center;">
                <p style="font-size: 0.9em;">¿Ya tienes cuenta?</p>
                <a href="index.php" style="color: #00e5ff; text-decoration: underline;">Inicia Sesión</a>
            </div>
        </form>

    </div>

    <?php
        include "footer.php";
    ?>
</body>
</html>