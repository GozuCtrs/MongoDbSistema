<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloUsuario.php';

$modeloUsuario = new modeloUsuario();
$mensaje = '';
$user_data = null;

// Verificar si se solicita editar un usuario
if (isset($_GET['edit_id'])) {
    $id_to_edit = filter_var($_GET['edit_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($id_to_edit !== false) {
        try {
            $user_data = $modeloUsuario->obtenerUsuarioPorId($id_to_edit);
            if (!$user_data) {
                $mensaje = 'El usuario con ese ID no existe.';
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    } else {
        $mensaje = 'ID inválido.';
    }
}

// Procesar actualización de usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $perfil = $_POST['perfil'];

    try {
        $resultado = $modeloUsuario->modificarUsuario($id, $username, $password, $perfil);
        if ($resultado) {
            $mensaje = 'Usuario actualizado correctamente.';
            $user_data = $modeloUsuario->obtenerUsuarioPorId($id);
        } else {
            $mensaje = 'No se realizaron cambios.';
        }
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

// Obtener lista de usuarios para mostrar
try {
    $usuarios = $modeloUsuario->listarUsuarios();
} catch (Exception $e) {
    $mensaje = $e->getMessage();
    $usuarios = [];
}

// Renderizar las vistas
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/vistaModificarUsuario.php';
mostrarFormularioEditar($user_data, $mensaje);
mostrarListaUsuarios($usuarios);
?>
