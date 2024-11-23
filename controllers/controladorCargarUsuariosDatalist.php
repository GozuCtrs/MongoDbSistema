<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';

header('Content-Type: application/json');

try {
    $modeloUsuario = new modeloUsuario();
    $usuarios = $modeloUsuario->listarUsuarios();
    $usernames = array_map(function ($usuario) {
        return $usuario['username'];
    }, $usuarios);

    echo json_encode($usernames);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener los usuarios: ' . $e->getMessage()]);
}
?>
