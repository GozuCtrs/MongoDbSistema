<?php
function mostrarListaFacturas($facturas, $mensaje = '')
{
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
    <div class="contenedor_cajas">
        <div class="caja_contenido_crud tabla_facturas">
            <h2 class="txt_titulo_lista">Lista de Facturas</h2>
            <?php if ($mensaje) { ?>
                <div class="mensaje"><?php echo $mensaje; ?></div>
            <?php } ?>
            <div class="tabla_datos_usuarios">
                <table>
                    <tr>
                        <th>Id_Factura</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Producto</th>
                        <th>Tipo magnitud</th>
                        <th>Precio magnitud</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Total Factura</th>
                        <th>Metodo Pago</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($facturas as $factura) { 
                        $cliente = isset($factura['cliente']) ? $factura['cliente']['nombre'] . ' ' . $factura['cliente']['apellidos'] : 'No disponible';
                        $vendedor = isset($factura['vendedor']) ? $factura['vendedor']['nombre'] . ' ' . $factura['vendedor']['apellidos'] : 'No disponible';
                        $producto = $factura['producto'] ?? 'No especificado';
                        $tipo_magnitud = $factura['tipo_magnitud'] ?? 'unidad';
                        $precio_magnitud = $factura['precio_magnitud'] ?? '-';
                        $precio_unitario = $factura['precio_unitario'] ?? '-';
                        $cantidad = $factura['cantidad'] ?? '--.--';
                        $total = $factura['total'] ?? '0.00';
                        $metodo_pago = $factura['metodo_pago'] ?? 'No especificado';
                        


                    ?>
                        <tr>
                            <td><?php echo $factura['_id']; ?></td>
                            <td><?php echo $factura['fecha']; ?></td>
                            <td><?php echo $cliente; ?></td>
                            <td><?php echo $vendedor; ?></td>
                            <td><?php echo $producto; ?></td>
                            <td><?php echo $tipo_magnitud; ?></td>
                            <td><?php echo $precio_magnitud; ?></td>
                            <td><?php echo $precio_unitario; ?></td>
                            <td><?php echo $cantidad; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $metodo_pago; ?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn_eliminar" onclick="confirmarEliminacion('<?php echo $factura['_id']; ?>');">Eliminar</a>
                                <a href="?opcion=ver_facturas&edit_id=<?php echo $factura['_id']; ?>">Editar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmarEliminacion(id) {
            Swal.fire({
                title: `¿Estás seguro?`,
                text: `La factura será eliminada permanentemente.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = window.location.href;
                    if (url.indexOf('?') !== -1) {
                        window.location.href = url + '&del_id=' + id;
                    } else {
                        window.location.href = url + '?del_id=' + id;
                    }
                }
            });
        }
    </script>
<?php
}
?>
