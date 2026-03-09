<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $conexion->real_escape_string($_POST['numero']);
    $capacidad = $conexion->real_escape_string($_POST['capacidad']);
    $edificio = $conexion->real_escape_string($_POST['edificio']);
    $sql = "INSERT INTO aulas (numero, capacidad, edificio) VALUES ('$numero', '$capacidad', '$edificio')";
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
    <title>Crear Aula</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input { width: 300px; padding: 8px; margin: 5px 0; }
        .btn { background: #ffc107; color: black; padding: 10px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>➕ Crear Nueva Aula</h1>
    <form method="post">
        <label>Número:</label><br>
        <input type="text" name="numero" required><br>
        <label>Capacidad:</label><br>
        <input type="number" name="capacidad" required><br>
        <label>Edificio:</label><br>
        <input type="text" name="edificio"><br><br>
        <input type="submit" value="Guardar Aula" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver</a>
</body>
</html>
<?php $conexion->close(); ?>