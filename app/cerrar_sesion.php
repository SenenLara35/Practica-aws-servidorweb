<?php
    session_start();
    session_destroy(); // Destruye toda la información de la sesión
    header("Location: index.php"); // Te manda al login otra vez
?>