<?php
 
        require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

session_start();

$estado = $_GET['estado'] ?? 'denegado';
$redirectURL = $estado == 'admitido' ? get_views('dashboard.php?opcion=inicio') : get_views('claveequivocada.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verificando...</title>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilopantallacarga.css') ?>">
    <link rel="icon" href="../img/icono_pagina.png">
</head>
<body>
    <div class="contenedor_loader">
        <div class="loader"></div>
        <p class="txt_verificando">Verificando credenciales</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "<?php echo $redirectURL; ?>";
        }, 2000);
    </script>
</body>
</html>