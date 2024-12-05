<?php 

if(!isset($_SESSION["txtusername"])){
    header('Location: '.get_urlBase('index.php'));
}

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';
?>
<link rel="stylesheet" href="<?php echo get_urlBase('css/estiloinicio.css') ?>">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estiloinicio.css') ?>">
</head>
<body>
    <div class="contenedor_principal">
        <div class="panel_bienvenida">
            <h1>¡Bienvenido al Sistema!</h1>
            <p>Hola, <span class="username"><?php echo $_SESSION["txtusername"]?></span>. Nos alegra verte aquí.</p>
            <p class="description">
                Este sistema está diseñado para facilitar la <br> 
                gestión de bases de datos de usuarios. <br> 
                Podrás realizar operaciones como <br>
                agregar, editar, visualizar y eliminar <br> 
                registros de manera sencilla y eficiente. <br>
            </p>
        </div>
    </div>
</body>
</html>
