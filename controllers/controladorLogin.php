<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';

if (isset($_SESSION["txtusername"])) {
    header('Location: ' . get_views('dashboard.php'));
    exit();
}

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_username = $_POST["txtusername"] ?? '';
    $v_password = $_POST["txtpassword"] ?? '';

    if ($v_username === "Marco" && $v_password === "1234") {
        $_SESSION["txtusername"] = $v_username;
        $_SESSION["txtpassword"] = $v_password;
        header('Location: ' . get_views('pantallacarga.php?estado=admitido'));
        exit();
    } else {
        $mensaje = 'Usuario o contraseña incorrectos.';
    }
}

require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaLogin.php';
