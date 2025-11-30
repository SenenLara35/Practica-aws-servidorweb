<?php
    $servidor = "10.2.1.13";
    $usuario = "usuario123";
    $password = "password123";
    $database = "mi_base_datos";
    $port = 3306;

    $conexion = new mysqli($servidor, $usuario, $password, "$database", $port);
    if ($conn->connect_error) {
    die("❌ Error fatal de conexión: " . $conn->connect_error);
}
// Si quieres quitar esto luego, coméntalo, pero ahora sirve para saber que funciona
echo "✅ ¡Conexión exitosa a la Base de Datos a través del Peering!";
?>
?>