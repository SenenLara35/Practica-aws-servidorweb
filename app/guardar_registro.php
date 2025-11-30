<?php
    include "conexion.php";
    mysqli_select_db($conexion, "proyecto2");

    // Recibimos los datos
    $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $pass = mysqli_real_escape_string($conexion, $_POST['pass']);
    $pass2 = mysqli_real_escape_string($conexion, $_POST['pass2']);
    $rol = "usuario"; // Rol por defecto

    // 1. VALIDACIÓN DE CONTRASEÑAS
    if ($pass !== $pass2) {
        header("Location: registro.php?error=pass");
        exit();
    }

    // 2. VERIFICAR SI EL USUARIO YA EXISTE
    // Consultamos si ya hay alguien con ese nombre O ese email
    $sql_check = "SELECT * FROM usuario WHERE NomUsuario = '$user' OR email = '$email'";
    $resultado_check = mysqli_query($conexion, $sql_check);

    if (mysqli_num_rows($resultado_check) > 0) {
        // Si devuelve filas, es que ya existe
        header("Location: registro.php?error=existe");
        exit();
    }

    // 3. INSERTAR NUEVO USUARIO
    // Nota: Asumo que los campos de tu tabla son NomUsuario, email, contrasena, rol
    $sql_insert = "INSERT INTO usuario (NomUsuario, email, contrasena, rol) VALUES ('$user', '$email', '$pass', '$rol')";
    
    if (mysqli_query($conexion, $sql_insert)) {
        // Si sale bien, lo mandamos al LOGIN con un mensaje de éxito (opcional)
        // Puedes añadir en index.php un if(isset($_GET['registro'])) echo "Cuenta creada con éxito";
        header("Location: index.php?registro=exito");
    } else {
        echo "Error en la base de datos: " . mysqli_error($conexion);
    }
?>