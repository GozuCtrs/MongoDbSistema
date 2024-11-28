<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN CATALOGO</title>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilos.css') ?>">
    <link rel="icon" href="img/icono_perfil.png">
</head>

<body>
<p>user:Marco    pass:1234</p>
    <div class="caja_principal">
        <img class="decoracion_2circulos decoracion_circulos" src="img/2circulos.png">
        <img class="decoracion_3circulos decoracion_circulos" src="img/3circulos.png">
        <img class="decoracion_circulos_pequenos" src="img/circulos_pequenos.png">

        <div class="panel_izquierdo">
            <img class="imagen_icono_perfil" src="img/icono_perfil.png">
            <div class="caja_texto_perfil">
                <p class="texto_perfil">perfil</p>
            </div>
        </div>

        <form method="POST" class="panel_derecho" autocomplete="off">
            <h1 class="titulo_login">login</h1>
            <?php if (!empty($mensaje)) { ?>
                <div class="mensaje_error">
                <p style="color: red;"><?php echo $mensaje; ?></p></div>
            <?php } ?>
            <input type="text" class="caja_input_login texto_input_login" name="txtusername" placeholder="nombre del usuario" maxlength="11" required>
            <input type="password" class="caja_input_login texto_input_login" name="txtpassword" placeholder="contraseña" required>
            <div class="caja_input_login">
                <label class="texto_input_login" for="casilla_recordar">recordar</label>
                <input type="checkbox" class="casilla_recordar" id="casilla_recordar">
            </div>
            <input type="submit" class="btn_enviar caja_input_login texto_input_login" value="enviar">
        </form>
        <img src="img/relleno.png" class="decoracion_relleno_inferior">
    </div>
</body>

</html>
