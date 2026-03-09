<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$sql = "SELECT id, nombre, codigo, curso FROM asignaturas WHERE deleted = 0";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Asignaturas</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #dc3545; color: white; }
        .btn { background: #dc3545; color: white; padding: 10px; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>📚 Lista de Asignaturas</h1>
    <a href="crear.php" class="btn">[+] Añadir Nueva Asignatura</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Código</th>
            <th>Curso</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['codigo'] . "</td>";
                echo "<td>" . $fila['curso'] . "</td>";
                echo "<td>";
                echo "<a href='editar.php?id=" . $fila['id'] . "'>✏️ Editar</a> | ";
                echo "<a href='borrar.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Estás seguro?\")'>🗑️ Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay asignaturas registradas.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="http://localhost:8080/colegio/index.php">← Volver al Menú</a>
</body>
</html>
<?php $conexion->close(); ?>