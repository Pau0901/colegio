<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $conexion->real_escape_string($_POST['numero']);
    $capacidad = $conexion->real_escape_string($_POST['capacidad']);
    $edificio = $conexion->real_escape_string($_POST['edificio']);
    $sql = "UPDATE aulas SET numero='$numero', capacidad='$capacidad', edificio='$edificio' WHERE id=$id";
    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conexion->error;
    }
}
$sql = "SELECT * FROM aulas WHERE id=$id";
$resultado = $conexion->query($sql);
$aula = $resultado->fetch_assoc();
if (!$aula) {
    echo "Aula no encontrada";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Aula</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { width: 300px; padding: 8px; margin: 5px 0; }
        .btn { background: #ffc107; color: black; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>✏️ Editar Aula</h1>
    <form method="post">
        <label>Número:</label><br>
        <input type="text" name="numero" value="<?php echo $aula['numero']; ?>" required><br>
        <label>Capacidad:</label><br>
        <input type="number" name="capacidad" value="<?php echo $aula['capacidad']; ?>" required><br>
        <label>Edificio:</label><br>
        <input type="text" name="edificio" value="<?php echo $aula['edificio']; ?>"><br><br>
        <input type="submit" value="Actualizar Aula" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver</a>
</body>
</html>
<?php $conexion->close(); ?>