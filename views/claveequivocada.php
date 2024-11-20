<?php 
        require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clave erronea</title>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estiloclaveequivocada.css') ?>">
    <link rel="icon" href="../img/icono_pagina.png">

</head>
<body>

    <?php

        session_start();
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $v_username ="";
            $v_password ="";

            if (isset($_POST["txtusername"])){
                $v_username = $_POST["txtusername"];
            }
            if (isset($_POST["txtpassword"])){
                $v_password = $_POST["txtpassword"];
            }
            
            if ( ($v_username == "Marco") && ($v_password == "1234") ) {
                $_SESSION["txtusername"]=$v_username; 
                $_SESSION["txtpassword"]=$v_password;
                header('Location: '.get_views('pantallacarga.php?estado=admitido'));
                exit;
            } else {
                header('Location: '.get_views('pantallacarga.php?estado=denegado'));
                exit;
            }
        }
        if(isset($_SESSION["txtusername"])){
            header('Location: '.get_views('dashboard.php'));
        }
    ?>

user:Marco   pass:1234

    <div class="caja_principal" name="caja_principal" id="caja_principal">
        <img class="decoracion_2circulos decoracion_circulos" src="../img/2circulos.png">
        <img class="decoracion_3circulos decoracion_circulos" src="../img/3circulos.png">
    
        <div class="caja_login" name="caja_login" id="caja_login">
            <form method="POST" class="panel_form" autocomplete="off">
                <h1 class="titulo_login" >login</h1>

                <div class="mensaje_error">
                <h5 class="txt_credenciales_incorrectas">Credenciales incorrectas</h5>
                <p class="txt_detalles_error">Nombre de usuario o contraseña no validos</p>
                </div>

                <input type="text" class="caja_input_login texto_input_login" name="txtusername" id="txtusername" placeholder="nombre del usuario" maxlength="11" required>
                <input type="password" class="caja_input_login texto_input_login" name="txtpassword" id="txtpassword" placeholder="contraseña" required>
                <div class="caja_input_login"name="caja_input_recordar" id="caja_input_recordar">
                    <label for="casilla_recordar" class="texto_input_login" name="texto_recordar" id="texto_recordar" for="casilla_recordar">recordar</label>
                    <input type="checkbox" class="casilla_recordar" name="casilla_recordar" id="casilla_recordar">
                </div>
                
                <input type="submit" class="boton_enviar caja_input_login texto_input_login" name="btn_enviar" id="btn_enviar" value="enviar">
            </form>
        </div>
    </div>
</body>
</html>