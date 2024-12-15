<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloAdministradores.php';

error_log('Método recibido: ' . $_SERVER['REQUEST_METHOD']);

// Manejo del tipo de contenido dinámicamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $v_username = $_POST['txtusername'] ?? '';
    $v_password = $_POST['txtpassword'] ?? '';

    try {
        $modeloUsuario = new modeloUsuario();
        $credenciales = $modeloUsuario->ValidadUsuario($v_username, $v_password);

        if ($credenciales) {
            session_start();
    $_SESSION['txtusername'] = $v_username;
    // Redirección desde PHP
    header('Location: ' . get_controllers('controladorDashboard.php'));
    exit;
            
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
        }
    } catch (Exception $e) {
        // Manejar errores del servidor
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error en el servidor: ' . $e->getMessage()]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: text/html'); // HTML para respuestas GET

    try {
        // Renderizar la vista de login
        header('Content-Type: text/html'); // Asegurar formato HTML para GET
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/vistaLogin.php';
    } catch (Exception $e) {
        // Manejar errores al cargar la vista
        http_response_code(500);
        echo '<h1>Error en el servidor</h1>';
        echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    exit;
}

// Si el método no es GET ni POST, devolver 405
http_response_code(405);
header('Content-Type: application/json');
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
exit;
