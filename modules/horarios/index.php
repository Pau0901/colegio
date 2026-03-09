<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$sql = "SELECT h.id, 
               a.nombre as alumno_nombre, a.apellidos as alumno_apellidos,
               p.nombre as prof_nombre, p.apellidos as prof_apellidos,
               asig.nombre as asignatura,
               au.numero as aula,
               h.dia, h.hora
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
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #6f42c1; color: white; }
        .btn { background: #6f42c1; color: white; padding: 10px; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>📅 Horario de Clases</h1>
    <a href="crear.php" class="btn">[+] Asignar Nueva Clase</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Alumno</th>
            <th>Profesor</th>
            <th>Asignatura</th>
            <th>Aula</th>
            <th