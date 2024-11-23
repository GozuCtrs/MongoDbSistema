<?php
function mostrarFormularioIngreso($mensaje)
{
    if (empty($mensaje)) {
?>
        <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
        <form method="POST" class="caja_contenido_crud">
            <p class="txt_subtitulo_accion_crud">INGRESAR DATOS DEL USUARIO</p>
            <label for="datusuario"> Usuario</label>
            <input type="text" class="txt_input" name="datusuario" id="datusuario" autocomplete="off" required>
            <label for="datpassword"> Password</label>
            <input type="password" class="txt_input" name="datpassword" id="datpassword" autocomplete="off" required>
            <label for="datperfil"> Perfil</label>
            <input type="text" class="txt_input" name="datperfil" id="datperfil" autocomplete="off">
            <button type="submit" class="btn_enviar"> Registrar usuario </button>
        </form>

<?php
    } else {
        echo $mensaje;
    }
}
?>
