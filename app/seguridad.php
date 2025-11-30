<?php
// seguridad.php

// 1. Aseguramos que la sesión esté iniciada para poder leer las variables
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Comprobamos si el usuario existe en la sesión
if (!isset($_SESSION['usuario'])) {
    // Si NO está logueado, lo mandamos al Login (index.php)
    header("Location: index.php");
    
    // ¡IMPORTANTE! exit() detiene la ejecución del script. 
    // Si no lo pones, el código de abajo se seguiría ejecutando aunque cambies de página.
    exit();
}
?>