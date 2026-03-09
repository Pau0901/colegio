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
    
    $sql = "INSERT INTO profesores (nombre, apellidos, email, telefono) VALUES ('$nombre', '$apellidos', '$email', '$telefono')";
    
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Error: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Profesor</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input[type=text], input[type=email] { width: 300px; padding: 8px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px; }
        .btn { background: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background: #218838; }
        .error { color: red; padding: 10px; border: 1px solid red; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>➕ Crear Nuevo Profesor</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br>
        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" required><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br>
        <label>Teléfono:</label><br>
        <input type="text" name="telefono"><br><br>
        <input type="submit" value="Guardar Profesor" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver a la lista</a>
</body>
</html>
<?php $conexion->close(); ?>