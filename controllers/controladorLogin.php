<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloUsuario.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Si no es una solicitud AJAX, carga la vista de login.
    include get_views_disk('vistaLogin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Solo manejar solicitudes AJAX para la validación.
    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Acceso no permitido']);
        exit;
    }

    $v_username = $_POST["txtusername"] ?? '';
    $v_password = $_POST["txtpassword"] ?? '';

    $modeloUsuario = new modeloUsuario();
    $credenciales = $modeloUsuario->ValidadUsuario($v_username, $v_password);

    if ($credenciales) {
        session_start();
        $_SESSION["txtusername"] = $v_username;
        echo json_encode(['success' => true, 'redirect' => get_controllers('controladorDashboard.php')]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario o contraseña incorrectos.']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
exit;
?>
