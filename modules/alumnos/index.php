<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$sql = "SELECT id, nombre, apellidos, email, telefono FROM alumnos WHERE deleted = 0";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Alumnos</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #007bff; color: white; }
        a { text-decoration: none; }
        .btn { background: #007bff; color: white; padding: 10px; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>👨‍🎓 Lista de Alumnos</h1>
    <a href="crear.php" class="btn">[+] Añadir Nuevo Alumno</a>
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
                echo "<a href='editar.php?id=" . $fila['id'] . "'>✏️ Editar</a> | ";
                echo "<a href='borrar.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Estás seguro?\")'>🗑️ Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No hay alumnos registrados.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="http://localhost:8080/colegio/index.php">← Volver al Menú</a>
</body>
</html>
<?php $conexion->close(); ?>