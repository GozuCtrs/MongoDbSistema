<?php
function mostrarFormularioEditar($user_data = null, $mensaje = '')


{
?>
    <h2>Modificar Usuario</h2>
    <?php if ($mensaje) {
        echo $mensaje;
    ?>
    <?php
    }
    ?>

    <?php
    if ($user_data) {
    ?>
        <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
        <div class="caja_contenido_crud">
        <form action="" method="POST" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">

            <label for="username">Usuario:</label>
            <input class="txt_input" type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>" required>
            <br>

            <label for="password">Contraseña:</label>
            <input class="txt_input" type="text" id="password" name="password" value="<?php echo str_repeat('*', strlen($user_data['password'])); ?>" required>
            <br>

            <label for="perfil">Perfil:</label>
            <input class="txt_input" type="text" id="perfil" name="perfil" value="<?php echo $user_data['perfil']; ?>" required>
            <br>

            <button type="submit" class="btn_enviar">Guardar Cambios</button>
        </form>
        </div>
    <?php
    } else {
        echo '<p>Selecciona un usuario para editar.</p>';
    }
    ?>

    <?php
    function mostrarListaUsuarios($usuarios)
    {
    ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
        <div class="caja_contenido_crud">
        <h2 class="txt_titulo_lista">Lista de Usuarios</h2>
        <div class="tabla_datos_usuarios">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Perfil</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            foreach ($usuarios as $usuario) {
            ?>
                <tr>
                    <td><?php echo $usuario['id'] ?></td>
                    <td><?php echo $usuario['username'] ?></td>
                    <td><?php echo str_repeat('*', strlen($usuario['password'])) ?></td>
                    <td><?php echo $usuario['perfil'] ?></td>
                    <td>
    <a href="javascript:void(0);"
       class="btn_eliminar"
       onclick="confirmarEliminacion('<?php echo $usuario['username']; ?>', '<?php echo get_urlBase('controllers/controladoreliminarusuario.php?datusuario=' . urlencode($usuario['username'])); ?>');">
       Eliminar
    </a>
</td>

                    <td><a href="?edit_id=<?php echo $usuario['id']; ?>">Editar</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
        </div>
    </div>
    <script>
    function confirmarEliminacion(username, url) {
        Swal.fire({
            title: `¿Estás seguro?`,
            text: `El usuario "${username}" será eliminado permanentemente.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

    <?php
    }
    ?>
<?php
}
?>