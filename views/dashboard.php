<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';


session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
}

$opcionActual = isset($_GET['opcion']) ? $_GET['opcion'] : 'inicio';

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
                <li class="btn_pagina"><a href="?opcion=ver" class="<?= $opcionActual == 'ver' ? 'active' : '' ?>">Ver</a></li>
                <li class="btn_pagina"><a href="?opcion=ingresar" class="<?= $opcionActual == 'ingresar' ? 'active' : '' ?>">Ingresar</a></li>
                <li class="btn_pagina"><a href="?opcion=eliminar" class="<?= $opcionActual == 'eliminar' ? 'active' : '' ?>">Eliminar</a></li>
                <li class="btn_pagina"><a href="?opcion=modificar" class="<?= $opcionActual == 'modificar' ? 'active' : '' ?>">Modificar</a></li>
                <li class="btn_cerrar_sesion"><a href="<?php echo get_controllers('logout.php') ?>">Cerrar sesion</a></li>

            </ul>
        </nav>
    </div>
    <div class="panel_derecho">
        <p class="titulo_navegacion_contenido"> <?php echo $opcionActual; ?></p>
        <div class="decoracion_linea_derecha"></div>
        <div class="contenido_pagina">
            <?php
            if (isset($_GET["opcion"])) {
                $opcion = $_GET["opcion"];
                switch ($opcion) {
                    case 'inicio':
                        echo "<iframe src='" . get_views("inicio.php") . "' class='caja_iframe'> </iframe>";
                        break;
                    case 'ver':
                        echo "<iframe src='" . get_controllers("controladorUsuario.php") . "' class='caja_iframe'> </iframe>";
                        break;
                    case 'ingresar':
                        echo "<iframe src='" . get_controllers("controladorIngresarUsuario.php") . "' class='caja_iframe'> </iframe>";
                        break;
                    case 'eliminar':
                        echo "<iframe src='" . get_controllers("controladorEliminarUsuario.php") . "' class='caja_iframe'> </iframe>";
                        break;
                    case 'modificar':
                        echo "<iframe src='" . get_controllers("controladorModificarUsuario.php") . "' class='caja_iframe'> </iframe>";
                        break;
                }
            }
            ?>
        </div>
    </div>
</body>

</html>