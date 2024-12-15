<?php
function mostrarFormularioEditar($admin_data = null, $mensaje = '')
{
?>
    

    <?php
    if ($admin_data) {
    ?>
        <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
        <div class="caja_contenido_crud">
            <h2 class="txt_titulo_lista margin">Modificar Administrador</h2>
            <form action="" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php echo $admin_data['_id']; ?>">
                <label for="nombre">Nombre:</label>
                <input class="txt_input" type="text" id="nombre" name="nombre" value="<?php echo $admin_data['nombre']; ?>" required>
                <br>
                <label for="password">Contraseña:</label>
                <input class="txt_input" type="text" id="password" name="password" value="<?php echo $admin_data['password']; ?>" required>
                <br>
                <label for="rol">Rol:</label>
                <input class="txt_input" type="text" id="rol" name="rol" value="<?php echo $admin_data['rol']; ?>" required>
                <br>
                <button type="submit" class="btn_enviar">Guardar Cambios</button>
            </form>
        </div>
    <?php
    }
}

function mostrarListaAdministradores($administradores)
{
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
    <div class="contenedor_cajas">
        <div class="caja_contenido_crud tabla_administradores">
            <h2 class="txt_titulo_lista">Lista de Administradores</h2>
            <div class="tabla_datos_usuarios">
                <table>
                    <tr>
                        <th>ObjectId</th> <!-- Agregar columna para ObjectId -->
                        <th>Nombre</th>
                        <th>Password</th>
                        <th>Rol</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($administradores as $admin) {
                    ?>
                        <tr>
                            <td><?php echo $admin['_id']; ?></td> <!-- Mostrar ObjectId -->
                            <td><?php echo $admin['nombre']; ?></td>
                            <td><?php echo $admin['password']; ?></td>
                            <td><?php echo $admin['rol']; ?></td>
                            <td>
                                <a href="javascript:void(0);"
                                    class="btn_eliminar"
                                    onclick="confirmarEliminacion('<?php echo $admin['nombre']; ?>', '<?php echo $admin['_id']; ?>');">
                                    Eliminar
                                </a>
                            </td>
                            <td>
                                <a href="?opcion=administradores&edit_id=<?php echo $admin['_id']; ?>">Editar</a>
                            </td>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- Formulario para ingresar un nuevo administrador -->
        <div class="caja_contenido_crud formulario_ingreso">
            <h2 class="txt_titulo_lista margin">Nuevo Administrador</h2>
            <?php if (isset($mensaje) && $mensaje) { ?>
                <div class="mensaje"><?php echo $mensaje; ?></div>
            <?php } ?>

            <form action="" method="POST" autocomplete="off" class="formulario_ingreso">
                <input type="hidden" name="nuevo_admin" value="true">

                <label for="nombre">Nombre:</label>
                <input class="txt_input" type="text" id="nombre" name="nombre" required>
                <br>

                <label for="password">Contraseña:</label>
                <input class="txt_input" type="text" id="password" name="password" required>
                <br>

                <label for="rol">Rol:</label>
                <input class="txt_input" type="text" id="rol" name="rol" required>
                <br>

                <button type="submit" class="btn_enviar">Ingresar Administrador</button>
            </form>
        </div>

        <script>
            function confirmarEliminacion(nombre, id) {
                Swal.fire({
                    title: `¿Estás seguro?`,
                    text: `El administrador "${nombre}" será eliminado permanentemente.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Obtener la URL actual y agregar el parámetro del_id
                        var url = window.location.href;
                        if (url.indexOf('?') !== -1) {
                            // Si ya hay parámetros en la URL, agrega el parámetro del_id con '&'
                            window.location.href = url + '&del_id=' + id;
                        } else {
                            // Si no hay parámetros, agrega del_id con '?'
                            window.location.href = url + '?del_id=' + id;
                        }
                    }
                });
            }
        </script>

    <?php
}
    ?>