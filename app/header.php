<?php
    // 1. INICIAR SESIÓN (Si no está iniciada ya)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GranalessTCG</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Inicio</a></li>

                <?php
                // 2. LÓGICA VISUAL: ¿Hay alguien logueado?
                if (isset($_SESSION['usuario'])) {
                    
                    // Recuperamos el rol para saber qué botones extra mostrar
                    // Usamos ?? '' para evitar errores si por lo que sea no está definido
                    $rol = strtolower($_SESSION['rol'] ?? ''); 

                    // --- MENÚ PARA USUARIOS REGISTRADOS ---
                    echo '<li><a href="listamazos.php">Mis Mazos</a></li>';
                    echo '<li><a href="listadotorneos.php">Torneos</a></li>';
                    echo '<li><a href="listaarquetipos.php">Arquetipos</a></li>';
                    echo '<li><a href="listadopartidas.php">Partidas</a></li>';

                    // --- BOTÓN EXCLUSIVO DE ADMIN (AQUÍ ESTÁ EL CAMBIO) ---
                    if ($rol == 'admin') {
                        // Le ponemos un color dorado o diferente para que destaque
                        echo '<li><a href="listausuarios.php" style="color: #ffd700;"><i class="fa-solid fa-users-gear"></i> Usuarios</a></li>';
                    }
                    
                    // Botón de Salir en Rojo
                    echo '<li><a href="cerrar_sesion.php" style="color:#f44336;"><i class="fa-solid fa-power-off"></i> Salir</a></li>';
                
                } else {
                    // --- MENÚ PARA INVITADOS (NO LOGUEADOS) ---
                    echo '<li><a href="registro.php">Registro</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    
    <div class="banner-container">
        <img src="granalesstcg.png" alt="Banner Granaless TCG" class="banner-img">
    </div>