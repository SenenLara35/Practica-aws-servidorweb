<?php
    include "seguridad.php"; // Protegemos la página (opcional)
    include "header.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Arquetipo - Granaless TCG</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <div class="main-content">
        
        <form action="altaarquetipos.php" method="post" enctype="multipart/form-data" class="form-gamer">
            <h2 class="form-title">Crear Arquetipo</h2>
            
            <label for="nom">Nombre del Arquetipo:</label>
            <input type="text" name="nom" id="nom" class="input-gamer" required maxlength="20" placeholder="Ej: Charizard ex">
            
            <label for="img">Imagen (Miniatura):</label>
            <input type="file" name="imagen" id="img" class="input-gamer" accept="image/*" required>
            
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <input type="submit" value="Guardar" class="btn-gamer">
                
                <input type="reset" value="Limpiar" class="btn-gamer" style="background: #f44336; box-shadow: none;">
            </div>

            <div style="margin-top: 15px; text-align: center;">
                <a href="listaarquetipos.php" style="color: #f44336; text-decoration: underline;">Cancelar</a>
            </div>
        </form>

    </div>

    <?php
        include "footer.php";
    ?>
</body>
</html>