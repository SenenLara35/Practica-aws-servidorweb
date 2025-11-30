<?php
    include "seguridad.php"; // 1. Verifica que estés logueado
    include "header.php";

    // 2. VERIFICACIÓN DE ROL (Seguridad Extra)
    // Si NO es organizador Y NO es admin, lo echamos fuera.
    $rol = strtolower($_SESSION['rol']);
    if ($rol != 'organizador' && $rol != 'admin') {
        // Redirigimos al listado normal
        header("Location: listadotorneos.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Torneo</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="main-content">
    
    <form action="guardar_torneo.php" method="POST" class="form-gamer">
        <h2 class="form-title">Organizar Nuevo Torneo</h2>

        <label for="nombre">Nombre del Torneo:</label>
        <input type="text" name="nombre" class="input-gamer" placeholder="Ej: Copa Regional Granada" required>

        <label for="fecha">Fecha del Evento:</label>
        <input type="date" name="fecha" class="input-gamer" required>

        <button type="submit" class="btn-gamer">Publicar Torneo</button>

        <div style="margin-top: 20px; text-align: center;">
            <a href="listadotorneos.php" style="color: #f44336; text-decoration: underline;">Cancelar</a>
        </div>
    </form>

</div>

<?php
    include "footer.php";
?>
</body>
</html>