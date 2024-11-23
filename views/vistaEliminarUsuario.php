<?php
function mostrarFormularioEliminar($mensaje = '')
{
    if (empty($mensaje)) {

?>
        <script src="<?php echo get_UrlBase('js/cargarusuariosdatalist.js'); ?>" defer></script>
        <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
        
        <body onload="cargarUsuarios()">
            <form action="" method="POST" class="caja_contenido_crud">
                <p class="txt_subtitulo_accion_crud">ELIMINAR DATOS DEL USUARIO</p>
                <label for="datusuario">A quién debo eliminar</label>
                <input type="text" class="txt_input" name="datusuario" id="datusuario" list="usuariosList" autocomplete="off" required>
                <datalist id="usuariosList"></datalist>
                <button type="submit" class="btn_enviar">Eliminar usuario</button>
            </form>
        </body>

<?php
    } else {
        echo $mensaje;
    }
}
?>