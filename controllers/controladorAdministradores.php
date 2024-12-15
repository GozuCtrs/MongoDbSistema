<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloAdministradores.php';

$modeloAdministrador = new modeloUsuario();
$mensaje = '';
$admin_data = null;

// Verificar si se solicita editar un administrador
if (isset($_GET['edit_id'])) {
    $id_to_edit = $_GET['edit_id']; // No necesitamos validarlo aquí, ya que es un ObjectId
    try {
        $admin_data = $modeloAdministrador->obtenerAdministradorPorId($id_to_edit);
        if (!$admin_data) {
            $mensaje = 'El administrador con ese ID no existe.';
        }
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

// Procesar actualización de administrador
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    try {
        $resultado = $modeloAdministrador->modificarAdministrador($id, $nombre, $password, $rol);
        if ($resultado) {
            $mensaje = 'Administrador actualizado correctamente.';
            $admin_data = $modeloAdministrador->obtenerAdministradorPorId($id);
        } else {
            $mensaje = 'No se realizaron cambios.';
        }
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

// Procesar ingreso de nuevo administrador
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevo_admin'])) {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    try {
        // Llamamos al modelo para insertar el nuevo administrador
        $resultado = $modeloAdministrador->ingresarAdministrador($nombre, $password, $rol);
        if ($resultado) {
            $mensaje = 'Administrador ingresado correctamente.';
        } else {
            $mensaje = 'No se pudo ingresar el administrador.';
        }
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

// Obtener lista de administradores para mostrar
try {
    $administradores = $modeloAdministrador->listarAdministradores();
} catch (Exception $e) {
    $mensaje = $e->getMessage();
    $administradores = [];
}


// Eliminar un administrador
if (isset($_GET['del_id'])) {
    $id_to_delete = $_GET['del_id']; // Se asume que es un ObjectId válido
    try {
        $resultado = $modeloAdministrador->eliminarAdministrador($id_to_delete);
        if ($resultado) {
            $mensaje = 'Administrador eliminado correctamente.';
        } else {
            $mensaje = 'No se pudo eliminar el administrador.';
        }
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

// Obtener lista de administradores para mostrar
try {
    $administradores = $modeloAdministrador->listarAdministradores();
} catch (Exception $e) {
    $mensaje = $e->getMessage();
    $administradores = [];
}

// Renderizar las vistas
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/vistaAdministradores.php';
mostrarFormularioEditar($admin_data, $mensaje);
mostrarListaAdministradores($administradores);
?>
