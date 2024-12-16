<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Factura</title>
    <link rel="stylesheet" href="<?php echo get_urlBase('css/estilo_crud.css') ?>">
</head>
<body>
    <div class="caja_contenido_crud">
        <h2 class="txt_titulo_lista margin">Crear Nueva Factura</h2>
        
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="mensaje_exito"><?php echo htmlspecialchars($_GET['mensaje']); ?></div>
        <?php endif; ?>

        <form action="" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="cliente">Cliente (Nombre Completo):</label>
                <input type="text" id="cliente" name="cliente" list="clientes_lista" required>
                <datalist id="clientes_lista">
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?php echo htmlspecialchars($cliente['nombre_completo']); ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <div class="form-group">
                <label for="vendedor">Vendedor:</label>
                <input type="text" id="vendedor" name="vendedor" list="vendedores_lista" required>
                <datalist id="vendedores_lista">
                    <?php foreach ($vendedores as $vendedor): ?>
                        <option value="<?php echo htmlspecialchars($vendedor['nombre_completo']); ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <div class="form-group">
                <label for="producto">Producto:</label>
                <input type="text" id="producto" name="producto" list="productos_lista" required>
                <datalist id="productos_lista">
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?php echo htmlspecialchars($producto['nombre']); ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" min="1" required>
            </div>

            <div class="form-group">
                <label for="metodo_pago">Método de Pago:</label>
                <input type="text" id="metodo_pago" name="metodo_pago" list="metodos_pago_lista" required>
                <datalist id="metodos_pago_lista">
                    <?php foreach ($metodosPago as $metodo): ?>
                        <option value="<?php echo htmlspecialchars($metodo['nombre_metodo']); ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <button type="submit" class="btn_enviar">Crear Factura</button>
        </form>
    </div>
</body>
</html>