<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

$conexion = new conexion($host, $namedb, $userdb, $passwordb);
$pdo = $conexion->obtenerConexion();

try {
    $sentencia = $pdo->prepare("SELECT username FROM usuarios");
    $sentencia->execute();
    $usuarios = $sentencia->fetchAll(PDO::FETCH_COLUMN); // Obtener solo la columna 'username'
    echo json_encode($usuarios); // Devolver en formato JSON
} catch (PDOException $e) {
    echo json_encode(["error" => "No se pudieron obtener los usuarios"]);
    http_response_code(500);
}
?>
