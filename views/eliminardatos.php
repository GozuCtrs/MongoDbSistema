<?php 

session_start();
if(!isset($_SESSION["txtusername"])){
    header('Location: '.get_urlBase('index.php'));
}

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

$conexion = new  conexion($host,$namedb,$userdb,$passwordb);
$pdo = $conexion->obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tmpdatusuario = $_POST["datusuario"];

    $conexion = new  conexion($host, $namedb, $userdb, $passwordb);
    $pdo = $conexion->obtenerConexion();

    try {
        $sentencia = $pdo->prepare("DELETE FROM usuarios WHERE username=?;");
        $sentencia->execute([$tmpdatusuario]);
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
        <p>' .($tmpdatusuario) . ' ha sido eliminado con éxito</p>
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
        <p>HUBO UN ERROR, NO SE PUDO ELIMINAR</p>
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
        <label for="datusuario">A quién debo eliminar</label>
        <input type="text" name="datusuario" id="datusuario" list="usuariosList" autocomplete="off" required>
        <datalist id="usuariosList"></datalist>
        <button type="submit">Eliminar usuario</button>
    </form>
</body>
</html>
