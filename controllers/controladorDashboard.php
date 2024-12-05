<?php
if (session_status()==PHP_SESSION_NONE){
    session_start();
    }

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';  

if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));  
    exit;
}

$opcionActual = isset($_GET['opcion']) ? $_GET['opcion'] : 'inicio';
$contenido = '';

switch ($opcionActual) {
    case 'inicio':
        ob_start();
        include get_views_disk("vistaInicio.php");
        $contenido = ob_get_clean();
        break;
    case 'usuarios':
        ob_start();
        include get_controllers_disk("controladorModificarUsuario.php");
        $contenido = ob_get_clean();
        break;
    case 'ingresar':
        ob_start();
        include get_controllers_disk("controladorIngresarUsuario.php");
        $contenido = ob_get_clean();
        break;
    default:
        http_response_code(400);
        $contenido = "<h1>ERROR </h1>";
        break;
}
include get_views_disk ("vistaDashboard.php");
?>
