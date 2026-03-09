<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';

$alumnos = $conexion->query("SELECT id, nombre, apellidos FROM alumnos WHERE deleted = 0");
$profesores = $conexion->query("SELECT id, nombre, apellidos FROM profesores WHERE deleted = 0");
$asignaturas = $conexion->query("SELECT id, nombre FROM asignaturas WHERE deleted = 0");
$aulas = $conexion->query("SELECT id, numero, capacidad FROM aulas WHERE deleted = 0");

$dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];
$horas = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $alumno_id = $conexion->real_escape_string($_POST['alumno_id']);
    $profesor_id = $conexion->real_escape_string($_POST['profesor_id']);
    $asignatura_id = $conexion->real_escape_string($_POST['asignatura_id']);
    $aula_id = $conexion->real_escape_string($_POST['aula_id']);
    $dia = $conexion->real_escape_string($_POST['dia']);
    $hora = $conexion->real_escape_string($_POST['hora']);
    
    $check_alumno = $conexion->query("SELECT id FROM horarios WHERE alumno_id = $alumno_id AND dia = '$dia' AND hora = '$hora'");
    $check_profesor = $conexion->query("SELECT id FROM horarios WHERE profesor_id = $profesor_id AND dia = '$dia' AND hora = '$hora'");
    $check_aula = $conexion->query("SELECT id FROM horarios WHERE aula_id = $aula_id AND dia = '$dia' AND hora = '$hora'");
    $horas_profesor = $conexion->query("SELECT COUNT(*) as total FROM horarios WHERE profesor_id = $profesor_id AND dia = '$dia'");
    $total_horas = $horas_profesor->fetch_assoc();
    
    if ($check_alumno->num_rows > 0) {
        $error = "El alumno ya tiene una clase a esa hora";
    } elseif ($check_profesor->num_rows > 0) {
        $error = "El profesor ya tiene una clase a esa hora";
    } elseif ($check_aula->num_rows > 0) {
        $error = "El aula ya está ocupada a esa hora";
    } elseif ($total_horas['total'] >= 5) {
        $error = "El profesor ya tiene 5 horas asignadas este día";
    } else {
        $sql = "INSERT INTO horarios (alumno_id, profesor_id, asignatura_id, aula_id, dia, hora) 
                VALUES ($alumno_id, $profesor_id, $asignatura_id, $aula_id, '$dia', '$hora')";
        if ($conexion->query($sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Error: " . $conexion->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Asignar Clase</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        select, input { width: 300px; padding: 8px; margin: 5px 0; }
        .btn { background: #6f42c1; color: white; padding: 10px; border: none; cursor: pointer; }
        .error { color: red; padding: 10px; border: 1px solid red; }
    </style>
</head>
<body>
    <h1>➕ Asignar Nueva Clase</h1>
    
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <label>Alumno:</label><br>
        <select name="alumno_id" required>
            <option value="">Seleccionar alumno</option>
            <?php while($alumno = $alumnos->fetch_assoc()): ?>
                <option value="<?php echo $alumno['id']; ?>">
                    <?php echo $alumno['nombre'] . ' ' . $alumno['apellidos']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <label>Profesor:</label><br>
        <select name="profesor_id" required>
            <option value="">Seleccionar profesor</option>
            <?php while($profesor = $profesores->fetch_assoc()): ?>
                <option value="<?php echo $profesor['id']; ?>">
                    <?php echo $profesor['nombre'] . ' ' . $profesor['apellidos']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <label>Asignatura:</label><br>
        <select name="asignatura_id" required>
            <option value="">Seleccionar asignatura</option>
            <?php while($asignatura = $asignaturas->fetch_assoc()): ?>
                <option value="<?php echo $asignatura['id']; ?>">
                    <?php echo $asignatura['nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <label>Aula:</label><br>
        <select name="aula_id" required>
            <option value="">Seleccionar aula</option>
            <?php while($aula = $aulas->fetch_assoc()): ?>
                <option value="<?php echo $aula['id']; ?>">
                    Aula <?php echo $aula['numero']; ?> (Cap: <?php echo $aula['capacidad']; ?>)
                </option>
            <?php endwhile; ?>
        </select><br>
        
        <label>Día:</label><br>
        <select name="dia" required>
            <option value="">Seleccionar día</option>
            <?php foreach($dias as $dia): ?>
                <option value="<?php echo $dia; ?>"><?php echo $dia; ?></option>
            <?php endforeach; ?>
        </select><br>
        
        <label>Hora:</label><br>
        <select name="hora" required>
            <option value="">Seleccionar hora</option>
            <?php foreach($horas as $hora): ?>
                <option value="<?php echo $hora; ?>"><?php echo substr($hora, 0, 5); ?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <input type="submit" value="Asignar Clase" class="btn">
    </form>
    <br>
    <a href="index.php">← Volver</a>
</body>
</html>
<?php $conexion->close(); ?>