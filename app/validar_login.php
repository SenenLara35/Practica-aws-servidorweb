<?php
    session_start();
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // Recibimos datos del formulario y limpiamos caracteres raros (Seguridad básica)
    $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $pass = mysqli_real_escape_string($conexion, $_POST['password']);

    // Consultamos si existe ese usuario y contraseña
    // IMPORTANTE: Ajusta 'usuario', 'NomUsuario' y 'contrasena' si tu tabla es diferente
    $sql = "SELECT * FROM usuario WHERE NomUsuario = '$user' AND contrasena = '$pass'";
    $resultado = mysqli_query($conexion, $sql);

    // Si encuentra 1 fila, es que el login es correcto
    if (mysqli_num_rows($resultado) == 1) {
        
        // Extraemos los datos para guardarlos en la sesión
        $fila = mysqli_fetch_array($resultado);
        
        // Guardamos variables de sesión (las "mochilas" que viajan por toda la web)
        $_SESSION['usuario'] = $fila['NomUsuario']; // Para mostrar el nombre
        $_SESSION['id_usuario'] = $fila['id_usuario']; // IMPORTANTE: Para filtrar mazos por ID
        $_SESSION['rol'] = $fila['rol']; // Por si luego quieres hacer cosas de admin

        // Redirigimos a la página principal o a donde quieras
        header("Location: index.php"); 
    } else {
        // Si falla, lo devolvemos al index con un error
        header("Location: index.php?error=1");
    }
?>