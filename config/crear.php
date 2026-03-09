<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión del Colegio</title>
    <style>
        body { font-family: Arial; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        h1 { color: #333; text-align: center; }
        ul { list-style: none; padding: 0; }
        li { margin: 15px 0; }
        a { display: block; padding: 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-size: 18px; }
        a:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏫 Sistema de Gestión del Colegio</h1>
        
        <ul>
            <li><a href="modules/alumnos/index.php">👨‍🎓 Alumnos</a></li>
            <li><a href="modules/profesores/index.php">👨‍🏫 Profesores</a></li>
            <li><a href="modules/aulas/index.php">🏛️ Aulas</a></li>
            <li><a href="modules/asignaturas/index.php">📚 Asignaturas</a></li>
            <li><a href="modules/horarios/index.php" style="background-color: #28a745;">📅 Horarios</a></li>
        </ul>
    </div>
</body>
</html>
<?php
?>