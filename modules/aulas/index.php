<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$sql = "SELECT id, numero, capacidad, edificio FROM aulas WHERE deleted = 0";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Aulas</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #ffc107; color: black; }
        .btn { background: #ffc107; color: black; padding: 10px; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>🏛️ Lista de Aulas</h1>
    <a href="crear.php" class="btn">[+] Añadir Nueva Aula</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Capacidad</th>
            <th>Edificio</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['numero'] . "</td>";
                echo "<td>" . $fila['capacidad'] . "</td>";
                echo "<td>" . $fila['edificio'] . "</td>";
                echo "<td>";
                echo "<a href='editar.php?id=" . $fila['id'] . "'>✏️ Editar</a> | ";
                echo "<a href='borrar.php?id=" . $fila['id'] . "' onclick='return confirm(\"¿Estás seguro?\")'>🗑️ Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay aulas registradas.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="http://localhost:8080/colegio/index.php">← Volver al Menú</a>
</body>
</html>
<?php $conexion->close(); ?>