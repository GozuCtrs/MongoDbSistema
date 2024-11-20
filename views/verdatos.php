<?php

session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

$conexion = new  conexion($host, $namedb, $userdb, $passwordb);
$pdo = $conexion->obtenerConexion();

$query = $pdo->query("SELECT id,username,password,perfil FROM usuarios");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estiloverdatos.css') ?>">
</head>

<body>
    <div class="caja_tabla">
        <table>
            <tr>
                <th> id </th>
                <th> username </th>
                <th> password </th>
                <th> perfil </th>
            </tr>
            <?php
            while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $fila['id'] ?></td>
                    <td><?php echo $fila['username'] ?></td>
                    <td><?php echo str_repeat('*', strlen($fila['password'])) ?></td>
                    <td><?php echo $fila['perfil'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>