<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilodashboard.css') ?>">
    <link rel="icon" href="../img/icono_pagina.png">
</head>

<body>
    <div class="panel_izquierdo">
        <p class="hola_usuario"> Hola <?php echo $_SESSION["txtusername"] ?></p>
        <div class="decoracion_linea_izquierda"></div>
        <nav class="menu_navegacion">
            <ul class="lista_paginas">
                <li class="btn_pagina"><a href="?opcion=inicio" class="<?= $opcionActual == 'inicio' ? 'active' : '' ?>">Inicio</a></li>

                <div class="linea_separadora_listas_paginas"></div>
                <li class="btn_subtitulo">colecciones</li>
                <li class="btn_pagina"><a href="?opcion=administradores" class="<?= $opcionActual == 'administradores' ? 'active' : '' ?>">Administradores</a></li>
                
                <div class="linea_separadora_listas_paginas"></div>
                <li class="btn_subtitulo">Procesos</li>
                <li class="btn_pagina"><a href="?opcion=ver_facturas" class="<?= $opcionActual == 'ver_facturas' ? 'active' : '' ?>">Ver facturas</a></li>
                <li class="btn_pagina"><a href="?opcion=crear_facturas" class="<?= $opcionActual == 'crear_facturas' ? 'active' : '' ?>">Crear facturas</a></li>
                
                <li class="btn_cerrar_sesion"><a href="<?php echo get_controllers('logout.php') ?>">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>

    <div class="panel_derecho">
        <p class="titulo_navegacion_contenido"> <?php echo ucfirst($opcionActual); ?></p>
        <div class="decoracion_linea_derecha"></div>
        <div class="contenido_pagina">
            <?php
            if (isset($contenido)) {
                echo $contenido;
            } else {
                echo "<h1> bienvenido al sistema </h1>";
            }
            ?>
        </div>
    </div>
</body>

</html>