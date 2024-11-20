<?php
session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tmpdatusuario = $_POST["datusuario"];
    $tmpdatpassword = $_POST["datpassword"];
    $tmpdatperfil = $_POST["datperfil"];

    $conexion = new  conexion($host, $namedb, $userdb, $passwordb);
    $pdo = $conexion->obtenerConexion();

    try {
        $sentencia = $pdo->prepare("INSERT INTO usuarios (username,password,perfil) values(?,?,?);");
        $sentencia->execute([$tmpdatusuario, $tmpdatpassword, $tmpdatperfil]);
        echo '<div style="
            display: grid;
            justify-content: center;     
            margin: 10px;
            background-color: white;
            padding: 20px;
            width: 500px;
            border-radius: 15px;
            box-shadow: 0 0 10px #0004;
        ">
        <img src="../img/check.png" class="img_check" style="margin:auto;">
        <p>USUARIO REGISTRADO</p>
        </div>';
    } catch (PDOException $e) {
        echo '<div style="
            display: grid;
            justify-content: center;     
            margin: 10px;
            background-color: white;
            padding: 20px;
            width: 500px;
            border-radius: 15px;
            box-shadow: 0 0 10px #0004;
        ">
        <img src="../img/x.png" class="img_check" style="margin:auto;">
        <p>HUBO UN ERROR</p>
        </div>';
        echo $e->getMessage();
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estiloingresardatos.css') ?>">
</head>

<body>
    <form method="POST" class="caja_formulario">
        <p>Ingresar datos del usuario</p>
        <label for="datusuario"> Usuario</label>
        <input type="text" class="txtinput" name="datusuario" id="datusuario" autocomplete="off" required>
        <label for="datpassword"> Password</label>
        <input type="password" class="txtinput" name="datpassword" id="datpassword" autocomplete="off" required>
        <label for="datperfil"> Perfil</label>
        <input type="text" name="datperfil" id="datperfil" class="txtinput" autocomplete="off">
        <button type="submit" class="btnregistrar"> Registrar usuario </button>
    </form>

</body>

</html>