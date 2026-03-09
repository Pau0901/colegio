<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $codigo = $conexion->real_escape_string($_POST['codigo']);
    $curso = $conexion->real_escape_string($_POST['curso']);
    $sql = "UPDATE asignaturas SET nombre='$nombre', codigo='$codigo', curso='$curso' WHERE id=$id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conexion->error;
    }
}
$sql = "SELECT * FROM asignaturas WHERE id=$id";
$resultado = $conexion->query($sql);
$asignatura = $resultado->fetch_assoc();
if (!$asignatura) {
    echo "Asignatura no encontrada";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Asignatura</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { width: 300px; padding: 8px; margin: 5px 0; }
        .btn { background: #dc3545; color: white; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>✏️ Editar Asignatura</h1>
    <form method="post">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo $asignatura['nombre']; ?>" required><br>
        <label>Código:</label><br>
        <input type="text" name="codigo" value="<?php echo $asignatura['codigo']; ?>" required><br>
        <label>Curso:</label><br>
        <input type="number" name="curso" value="<?php echo $asignatura['curso']; ?>"><br><br>
        <input type="submit" value="Actualizar Asignatura" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver</a>
</body>
</html>
<?php $conexion->close(); ?>