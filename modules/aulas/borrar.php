<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../../config/database.php';
$id = $_GET['id'];
$sql = "UPDATE aulas SET deleted = 1 WHERE id = $id";
if ($conexion->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $conexion->error;
}
$conexion->close();
?>