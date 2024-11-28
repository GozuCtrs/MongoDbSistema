<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';

$ruta = $_GET['ruta'] ?? 'login';

switch ($ruta) {
    case 'login':
        require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/controladorLogin.php';
        break;

    case 'dashboard':
        require_once $_SERVER['DOCUMENT_ROOT'].'/controllers/controladorDashboard.php';
        break;

    default:
        echo "Error 404: Página no encontrada";
        break;
}
