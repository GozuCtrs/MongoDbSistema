<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaEliminarUsuario.php';

if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['datusuario'])) {
    $username = trim($_POST['datusuario']);

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
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    }
}

mostrarFormularioEliminar($mensaje);
?>
