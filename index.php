<?php 
        require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';
?>

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
        exit;
    }
?>
user:Marco   pass:1234

    <div class="caja_principal" name="caja_principal" id="caja_principal">
        <img class="decoracion_2circulos decoracion_circulos" src="img/2circulos.png">
        <img class="decoracion_3circulos decoracion_circulos" src="img/3circulos.png">
        <img class="decoracion_circulos_pequenos" src="img/circulos_pequenos.png">

        <div class="panel_izquierdo" name="panel_izquierdo" id="panel_izquierdo">
            <img class="imagen_icono_perfil" src="img/icono_perfil.png">
            <div class="caja_texto_perfil">
                <p class="texto_perfil">perfil</p>
            </div>
        </div>

        <form method="POST" class="panel_derecho" name="panel_derecho" id="panel_derecho" autocomplete="off">
            <h1 class="titulo_login">login</h1>
            <input type="text" class="caja_input_login texto_input_login" name="txtusername" id="txtusername" placeholder="nombre del usuario" maxlength="11" required>
            <input type="password" class="caja_input_login texto_input_login" name="txtpassword" id="txtpassword" placeholder="contraseña" required>
            <div class="caja_input_login">
                <label class="texto_input_login" for="casilla_recordar">recordar</label>
                <input type="checkbox" class="casilla_recordar" id="casilla_recordar">
            </div>
            <input type="submit" class="btn_enviar caja_input_login texto_input_login" value="enviar">
        </form>
        <img  src="img/relleno.png" class="decoracion_relleno_inferior">
    </div>
</body>

</html>