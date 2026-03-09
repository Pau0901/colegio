<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$sql = "SELECT id, nombre, apellidos, email, telefono FROM profesores WHERE deleted = 0";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Profesores</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #28a745; color: white; }
        a { text-decoration: none; }
        .btn { background: #28a745; color: white; padding: 10px 15px; display: inline-block; margin-bottom: 20px; border-radius: 5px; }
        .btn:hover { background: #218838; }
    </style>
</head>
<body>
    <h1>👨‍🏫 Lista de Profesores</h1>
    <a href="crear.php" class="btn">➕ Añadir Nuevo Profesor</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['apellidos'] . "</td>";
                echo "<td>" . $fila['email'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>";
                echo "<a href='editar.php?id=" . $fila['id'] . "' style='color: #28a745;'>✏️ Editar</a> | ";
                echo "<a href='borrar.php?id=" . $fila['id'] . "' style='color: #dc3545;' onclick='return confirm(\"¿Estás seguro de que quieres borrar este profesor?\")'>🗑️ Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay profesores registrados.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="http://localhost:8080/colegio/index.php">← Volver al Menú Principal</a>
</body>
</html>
<?php $conexion->close(); ?>