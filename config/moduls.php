<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';

$sql = "SELECT h.id, a.nombre as alumno, p.nombre as profesor, p.apellidos as prof_apellidos, 
               asig.nombre as asignatura, au.numero as aula, h.dia, h.hora
        FROM horarios h
        JOIN alumnos a ON h.alumno_id = a.id
        JOIN profesores p ON h.profesor_id = p.id
        JOIN asignaturas asig ON h.asignatura_id = asig.id
        JOIN aulas au ON h.aula_id = au.id
        ORDER BY h.dia, h.hora";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Horario de Clases</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>📅 Horario de Clases</h1>
    <a href="crear.php">[+] Asignar Nueva Clase</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Alumno</th>
            <th>Profesor</th>
            <th>Asignatura</th>
            <th>Aula</th>
            <th>Día</th>
            <th>Hora</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['alumno'] . "</td>";
                echo "<td>" . $fila['profesor'] . " " . $fila['prof_apellidos'] . "</td>";
                echo "<td>" . $fila['asignatura'] . "</td>";
                echo "<td>" . $fila['aula'] . "</td>";
                echo "<td>" . $fila['dia'] . "</td>";
                echo "<td>" . $fila['hora'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay clases asignadas</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="../../index.php">← Volver al Menú</a>
</body>
</html>
<?php $conexion->close(); ?>