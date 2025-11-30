<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Granaless TCG</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
        include "conexion.php";
        include "header.php";
    ?>

    <div class="main-content">
        
        <?php
        // Si existe la variable de sesión, es que YA está logueado
        if (isset($_SESSION['usuario'])) {
            echo "<h2 style='text-shadow: 0 0 10px #00e5ff;'>¡Bienvenido de nuevo, " . $_SESSION['usuario'] . "!</h2>";
            echo "<p>Ya estás dentro del sistema.</p>";
            echo "<br>";
            echo "<a href='listamazos.php' class='btn-gamer'>Ir a mis Mazos</a>";
            echo "<br><br>";
            echo "<a href='cerrar_sesion.php' style='color: #f44336;'>Cerrar Sesión</a>";
        } else {
            // Si NO está logueado, mostramos el formulario de Login
        ?>
        <?php 
            if(isset($_GET['registro']) && $_GET['registro'] == 'exito'){
            echo "<p style='color: #00e5ff; text-align: center; font-weight: bold; font-size: 1.2em;'>¡Cuenta creada! Ahora inicia sesión.</p>";
            }
        ?>
            
            <form action="validar_login.php" method="POST" class="form-gamer">
                <h2 class="form-title">Iniciar Sesión</h2>

                <?php 
                    if(isset($_GET['error'])){
                        echo "<p style='color: #f44336; text-align: center; font-weight: bold;'>Usuario o contraseña incorrectos</p>";
                    }
                ?>

                <label for="user">Usuario:</label>
                <input type="text" name="usuario" class="input-gamer" placeholder="Tu nombre de usuario" required>

                <label for="pass">Contraseña:</label>
                <input type="password" name="password" class="input-gamer" placeholder="••••••••" required>

                <button type="submit" class="btn-gamer">Entrar</button>

                <div style="margin-top: 20px; text-align: center;">
                    <p style="font-size: 0.9em;">¿No tienes cuenta?</p>
                    <a href="registro.php" style="color: #00e5ff; text-decoration: underline;">¡Regístrate aquí!</a>
                </div>
            </form>

        <?php
        } // Fin del else
        ?>

    </div>

    <?php
        include "footer.php";
    ?>
</body>
</html>