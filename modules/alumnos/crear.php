<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellidos = $conexion->real_escape_string($_POST['apellidos']);
    $email = $conexion->real_escape_string($_POST['email']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $sql = "INSERT INTO alumnos (nombre, apellidos, email, telefono) VALUES ('$nombre', '$apellidos', '$email', '$telefono')";
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Alumno</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { width: 300px; padding: 8px; margin: 5px 0; }
        .btn { background: #007bff; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>➕ Crear Nuevo Alumno</h1>
    <form method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" required><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br>
        <label>Teléfono:</label><br>
        <input type="text" name="telefono"><br><br>
        <input type="submit" value="Guardar Alumno" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver</a>
</body>
</html>
<?php $conexion->close(); ?>