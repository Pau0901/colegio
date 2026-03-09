<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellidos = $conexion->real_escape_string($_POST['apellidos']);
    $email = $conexion->real_escape_string($_POST['email']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $sql = "UPDATE alumnos SET nombre='$nombre', apellidos='$apellidos', email='$email', telefono='$telefono' WHERE id=$id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conexion->error;
    }
}
$sql = "SELECT * FROM alumnos WHERE id=$id";
$resultado = $conexion->query($sql);
$alumno = $resultado->fetch_assoc();
if (!$alumno) {
    echo "Alumno no encontrado";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Alumno</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { width: 300px; padding: 8px; margin: 5px 0; }
        .btn { background: #007bff; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>✏️ Editar Alumno</h1>
    <form method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo $alumno['nombre']; ?>" required><br>
        <label>Apellidos:</label><br>
        <input type="text" name="apellidos" value="<?php echo $alumno['apellidos']; ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $alumno['email']; ?>"><br>
        <label>Teléfono:</label><br>
        <input type="text" name="telefono" value="<?php echo $alumno['telefono']; ?>"><br><br>
        <input type="submit" value="Actualizar Alumno" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver</a>
</body>
</html>
<?php $conexion->close(); ?>