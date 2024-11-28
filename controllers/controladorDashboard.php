<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';  

if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));  
    exit;
}

$opcionActual = isset($_GET['opcion']) ? $_GET['opcion'] : 'inicio';

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/vistaDashboard.php';  
?>
