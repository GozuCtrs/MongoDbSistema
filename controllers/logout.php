<?php
// Incluir el archivo de configuración donde se define la función get_urlBase
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';

// Iniciar la sesión al principio del archivo
session_start();

// Verificar si la sesión está activa antes de intentar destruirla
if (isset($_SESSION['txtusername'])) {
    // Eliminar todas las variables de sesión
    session_unset();

    // Destruir la sesión
    session_destroy();
    
    // Redirigir a la página de inicio usando la función get_urlBase
    header('Location: ' . get_urlBase('index.php'));
    exit;
} else {
    // Si no hay sesión activa, redirigir a la página de inicio directamente
    header('Location: ' . get_urlBase('index.php'));
    exit;
}
?>
