<?php

session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

$conexion = new  conexion($host, $namedb, $userdb, $passwordb);
$pdo = $conexion->obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tmpdatusuario = $_POST["datusuario"];

    $conexion = new  conexion($host, $namedb, $userdb, $passwordb);
    $pdo = $conexion->obtenerConexion();

    if (isset($_POST["datid"])){
        try {
            $sentencia = $pdo->prepare("UPDATE usuarios set username=?,password=?,perfil=? where id=?;");
            $sentencia->execute([$_POST["datusuario"],$_POST["datpassword"],$_POST["datperfil"],$_POST["datid"]]);
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
        <p>' .($tmpdatusuario) . ' ha sido modificado con éxito</p>
        </div>';
        } catch (PDOException $e) {
            echo "hubo un error, no se pudo eliminar <br>";
            echo $e->getMessage();
        } 
    }else {
    $query = $pdo->query("SELECT id,username,password,perfil FROM usuarios where username='" . $tmpdatusuario."'");
    $fila = $query->fetch(PDO::FETCH_ASSOC);

?>
    <form action="" method="POST">
        <input type="hidden" name="datid" id="datid" value="<?php echo $fila['id'] ?>"

        <label for="datusuario"> Usuario</label>
        <input type="text" name="datusuario" id="datusuario" value="<?php echo $fila['username'] ?>" required>
        <label for="datpassword"> Password</label>
        <input type="password" name="datpassword" id="datpassword" value="<?php echo $fila['password'] ?>" required>
        <label for="datperfil"> Perfil</label>
        <input type="text" name="datperfil" id="datperfil" value="<?php echo $fila['perfil'] ?>">
        <button type="submit"> Modificar usuario </button>
    </form>

<?php
    }
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        async function cargarUsuarios() {
            const input = document.getElementById('datusuario');
            const datalist = document.getElementById('usuariosList');
            
            try {
                const response = await fetch('<?php echo get_controllers("get_usernames.php"); ?>');
                const usuarios = await response.json();

                datalist.innerHTML = '';
                usuarios.forEach(usuario => {
                    const option = document.createElement('option');
                    option.value = usuario; 
                    datalist.appendChild(option);
                });
            } catch (error) {
                console.error("Error cargando usuarios:", error);
            }
        }
    </script>
</head>
<body onload="cargarUsuarios()">
    <form action="" method="POST">
        <label for="">Que usuarios deseas modificar</label>
        <input type="text" name="datusuario" id="datusuario" list="usuariosList" autocomplete="off" required>
        <datalist id="usuariosList"></datalist>
        <button type="submit">Buscar usuario</button>


    </form>