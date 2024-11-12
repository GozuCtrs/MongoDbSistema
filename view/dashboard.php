<?php
    session_start();
    if(!isset($_SESSION["txtusername"])){
        header('Location: http://127.0.0.1/mc/index.php');
    }

$opcionActual = isset($_GET['opcion']) ? $_GET['opcion'] : 'Dashboard';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/estilodashboard.css">
    <link rel="icon" href="imagenes/icono_pagina.png">
</head>
<body>
    <div class="caja_principal" name="caja_principal" id="caja_principal">
        <div class="panel_izquierdo" name="panel_izquierdo" id="panel_izquierdo">
            <p class="hola_usuario" name="hola_usuario" id="hola_usuario"> Hola <?php echo $_SESSION["txtusername"]?></p>
            <div class="decoracion_linea_izquierda" name="decoracion_linea_izquierda" id="decoracion_linea_izquierda"></div>
            <nav class="menu_navegacion" name="menu_navegacion" id="menu_navegacion">    
                <ul class="lista_paginas" name="lista_paginas" id="lista_paginas">
                    <li class="btn_pagina" name="btn_dashboard" id="btn_dashboard"><a href="?opcion=Dashboard" class="<?= $opcionActual=='Dashboard' ?'active':''?>">Dashboard</a></li>
                    <li class="btn_pagina" name="btn_pagina1" id="btn_pagina1"><a href="?opcion=pagina1" class="<?= $opcionActual=='pagina1' ?'active':''?>">Pagina 1</a></li>
                    <li class="btn_pagina" name="btn_pagina2" id="btn_pagina2"><a href="?opcion=pagina2" class="<?= $opcionActual=='pagina2' ?'active':''?>">Pagina 2</a></li>
                    <li class="btn_pagina" name="btn_pagina3" id="btn_pagina3"><a href="?opcion=pagina3" class="<?= $opcionActual=='pagina3' ?'active':''?>">Pagina 3</a></li>
                    <li class="btn_cerrar_sesion" name="btn_cerrar_sesion" id="btn_cerrar_sesion"><a href="http://127.0.0.1/mc/controllers/logout.php">Cerrar sesion</a></li>
                </ul>
            </nav>
        </div>      
        <div class="panel_derecho" name="panel_derecho" id="panel_derecho">
            <p class="titulo_navegacion_contenido" name="titulo_navegacion_contenido" id="titulo_navegacion_contenido"> <?php echo $opcionActual; ?></p>
            <div class="decoracion_linea_derecha" name="decoracion_linea_derecha" id="decoracion_linea_derecha"></div>
            <div class="contenido_pagina" name="contenido_pagina" id="contenido_pagina">
                <?php
                switch ($opcionActual) {
                    case 'Dashboard':
                        echo '<div class="contenido_dashboard" name="contenido_dashboard" id="contenido_dashboard">
                            <h2> Titulo contenido del dashboard </h2>
                            <p> bueno, aqui deberia ir el contenido del dashboard, pero como no hay, te pongo un par de lorem ipsum</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <p><br>Un poco mas de lorem Ipsum no?</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?<br></p>
                            <h3>Mi bella unas</h3>
                            <img class="img_paisaje_unas" name="img_paisaje_unas" id="img_paisaje_unas" src="imagenes/paisaje_unas.png">
                        </div>';
                        break;
                    case 'pagina1':
                        echo '<div class="contenido_pagina1" name="contenido_pagina1" id="contenido_pagina1">
                            <h2> Titulo contenido de la pagina 1 </h2>
                            <p> bueno, aqui deberia ir el contenido de la pagina 1, pero como no hay, te pongo un par de lorem ipsum</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <h3>Logo FIIS</h3>
                            <img src="imagenes/logo_fiis.jpg" class="img_logo_fiis" name="img_logo_fiis" id="img_logo_fiis">
                            <h3><br> Informacion:</h3>
                            <img src="imagenes/banner_fiis.jpg" class="img_banner_fiss" name="img_banner_fiss" id="img_banner_fiss">
                        </div>';
                        break;
                    case 'pagina2':
                        echo '<div class="contenido_pagina2" name="contenido_pagina2" id="contenido_pagina2">
                            <h2> Titulo contenido de la pagina 2 </h2>
                            <p> bueno, aqui deberia ir el contenido de la pagina 2, pero como no hay, te pongo un par de lorem ipsum</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <img src="imagenes/paisaje2.jpg" class="img_paisaje_pagina2" name="img_paisaje_pagina2" id="img_paisaje_pagina2" >
                        </div>';
                        break;
                    case 'pagina3':
                        echo '<div class="contenido_pagina3" name="contenido_pagina3" id="contenido_pagina3">
                            <h2> Titulo contenido de la pagina 2 </h2>
                            <p> bueno, aqui deberia ir el contenido de pagina 3, pero como no hay, te pongo un par de lorem ipsum</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, sint. Inventore enim delectus expedita accusantium totam deleniti libero saepe quae labore optio repudiandae velit aspernatur mollitia veritatis maxime, consequuntur magnam?</p>
                            <img src="imagenes/paisaje3.jpg" class="img_paisaje_pagina3" name="img_paisaje_pagina3" id="img_paisaje_pagina3" >
                            </div>';
                        break;
                }?>
            </div>
        </div>
    </div>
</body>
</html>