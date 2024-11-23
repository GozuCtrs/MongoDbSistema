<?php
function mostrarUsuarios($usuarios)
{

?>

    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
    <div class="caja_contenido_crud">
        <h2 class="txt_titulo_lista" >Lista de Usuarios</h2>
        <div class="tabla_datos_usuarios">
        <table>
            <tr>
                <th class="th_vistausuario"> ID </th>
                <th class="th_vistausuario"> Username </th>
                <th class="th_vistausuario"> Password </th>
                <th class="th_vistausuario"> Perfil </th>
            </tr>
            <?php
            foreach ($usuarios as $usuario) {
            ?>
                <tr>
                    <td><?php echo $usuario['id'] ?></td>
                    <td><?php echo $usuario['username'] ?></td>
                    <td><?php echo str_repeat('*', strlen($usuario['password'])) ?></td>
                    <td><?php echo $usuario['perfil'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        </div>
    </div>

<?php
}
?>