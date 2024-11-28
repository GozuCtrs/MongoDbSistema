<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['datusuario'])) {
    $username = trim($_GET['datusuario']);

    if (empty($username)) {
        $mensaje = 'Error: El nombre de usuario no puede estar vacío.';
    } else {
        try {
            $modeloUsuario = new modeloUsuario();
            $resultado = $modeloUsuario->eliminarUsuario($username);

            if ($resultado) {
                $mensaje = 'Usuario eliminado correctamente.';
            } else {
                $mensaje = 'No se encontró un usuario con el nombre especificado.';
            }
            header('Location: ' . get_urlBase('controllers/controladorModificarUsuario.php'));
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    }
}
