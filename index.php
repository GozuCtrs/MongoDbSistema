<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN CATALOGO</title>
    <link rel="stylesheet" href="view/css/estilos.css">
    <link rel="icon" href="view/imagenes/icono_pagina.png">
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
            header('Location: http://127.0.0.1/mc/view/dashboard.php');
        } else {
            header('Location: http://127.0.0.1/mc/view/claveequivocada.php');
        }
    }
    if(isset($_SESSION["txtusername"])){
        header('Location: http://127.0.0.1/mc/view/dashboard.php');
    }
?>
user:Marco   pass:1234

    <div class="caja_principal" name="caja_principal" id="caja_principal">
        <img class="decoracion_2circulos decoracion_circulos" name="decoracion_2circulos" id="decoracion_2circulos" src="view/imagenes/2circulos.png">
        <img class="decoracion_3circulos decoracion_circulos" name="decoracion_3circulos" id="decoracion_3circulos" src="view/imagenes/3circulos.png">
        <img class="decoracion_circulos_pequenos" name="decoracion_circulos_pequenos" id="decoracion_circulos_pequenos" src="view/imagenes/circulos_pequenos.png">

        <div class="panel_izquierdo" name="panel_izquierdo" id="panel_izquierdo">
            <img class="imagen_icono_perfil" name="imagen_icono_perfil" id="imagen_icono_perfil" src="view/imagenes/icono_perfil.png">
            <div class="caja_texto_perfil" name="caja_texto_perfil" id="caja_texto_perfil">
                <p class="texto_perfil" name="texto_perfil" id="texto_perfil">perfil</p>
            </div>
        </div>

        <form method="POST" class="panel_derecho" name="panel_derecho" id="panel_derecho" autocomplete="off">
            <h1 class="titulo_login" name="titulo_login" id="titulo_login">login</h1>
            <input type="text" class="caja_input_login texto_input_login" name="txtusername" id="txtusername" placeholder="nombre del usuario" maxlength="11" required>
            <input type="password" class="caja_input_login texto_input_login" name="txtpassword" id="txtpassword" placeholder="contraseña" required>
            <div class="caja_input_login" name="caja_input_recordar" id="caja_input_recordar">
                <label for="casilla_recordar" class="texto_input_login" name="texto_recordar" id="texto_recordar" for="casilla_recordar">recordar</label>
                <input type="checkbox" class="casilla_recordar" name="casilla_recordar" id="casilla_recordar">
            </div>
            <input type="submit" class="boton_enviar caja_input_login texto_input_login" name="btn_enviar" id="btn_enviar" value="enviar">
        </form>
        <img  src="view/imagenes/relleno.png" class="decoracion_relleno_inferior" name="decoracion_relleno_inferior" id="decoracion_relleno_inferior">
    </div>
</body>

</html>