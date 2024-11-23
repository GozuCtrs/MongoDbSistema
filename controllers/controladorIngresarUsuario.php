<?php
session_start();

    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaIngresarUsuario.php';

    if (!isset($_SESSION["txtusername"])) {
        header('Location: ' . get_urlBase('index.php'));
        exit();
    }

    $mensaje = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tmpdateuser = $_POST['datusuario']; 
        $tmpdatepassword = $_POST['datpassword'];
        $tmpdateperfil = $_POST['datperfil']; 

        $modeloUsuario = new modeloUsuario();

        try {
            $modeloUsuario->insertarUsuario($tmpdateuser, $tmpdatepassword, $tmpdateperfil);
            $mensaje =  'Usuario registrado correctamente. <br>';
        } catch (PDOException $e) {
            $mensaje =  'Error al registrar usuario: '.$e->getMessage();
        }
        exit();
    
    }
mostrarFormularioIngreso($mensaje);
?>
