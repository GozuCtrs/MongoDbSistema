<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloCrearFacturas.php';

class ControladorCrearFacturas {
    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloVerFacturas();
    }

    public function mostrarFormulario() {
        $productos = $this->modelo->obtenerProductos();
        $vendedores = $this->modelo->obtenerVendedores();
        $clientes = $this->modelo->obtenerClientes();
        $metodosPago = $this->modelo->obtenerMetodosPago();

        include get_views_disk('vistaCrearFacturas.php');
    }

    public function procesarFactura($datosPost) {
        // Verificar y procesar cliente
        $nombreCliente = explode(' ', $datosPost['cliente'], 2);
        $nombre = $nombreCliente[0];
        $apellidos = isset($nombreCliente[1]) ? $nombreCliente[1] : '';
        
        // Verificar si el cliente existe, si no, crearlo
        $idCliente = null;
        $clientes = $this->modelo->obtenerClientes();
        $clienteExistente = array_filter($clientes, function($cliente) use ($datosPost) {
            return $cliente['nombre_completo'] === $datosPost['cliente'];
        });

        if (empty($clienteExistente)) {
            // Crear nuevo cliente
            $idCliente = $this->modelo->insertarPersona($nombre, $apellidos);
        } else {
            $clienteExistente = reset($clienteExistente);
            $idCliente = $clienteExistente['id_cliente'];
        }

        // Procesar vendedor
        $nombreVendedor = explode(' ', $datosPost['vendedor'], 2);
        $vendedores = $this->modelo->obtenerVendedores();
        $vendedorEncontrado = array_filter($vendedores, function($vendedor) use ($datosPost) {
            return $vendedor['nombre_completo'] === $datosPost['vendedor'];
        });
        $vendedorEncontrado = reset($vendedorEncontrado);
        $idVendedor = $vendedorEncontrado['id_vendedor'];

        // Obtener datos del producto
        $productos = $this->modelo->obtenerProductos();
        $productoSeleccionado = array_filter($productos, function($producto) use ($datosPost) {
            return $producto['nombre'] === $datosPost['producto'];
        });
        $productoSeleccionado = reset($productoSeleccionado);

        // Obtener método de pago
        $metodosPago = $this->modelo->obtenerMetodosPago();
        $metodoPagoEncontrado = array_filter($metodosPago, function($metodo) use ($datosPost) {
            return $metodo['nombre_metodo'] === $datosPost['metodo_pago'];
        });
        $metodoPagoEncontrado = reset($metodoPagoEncontrado);

        // Generar nuevo ID de factura
        $nuevoIdFactura = $this->modelo->obtenerUltimoIdFactura() + 1;

        // Calcular total
        $total = $datosPost['cantidad'] * 
            ($productoSeleccionado['precio_unitario'] ?? $productoSeleccionado['precio_magnitud']);

        // Insertar orden de compra
        $datosOrdenCompra = [
            'id_orden' => $nuevoIdFactura,
            'id_cliente' => $idCliente,
            'id_vendedor' => $idVendedor
        ];
        $this->modelo->insertarOrdenCompra($datosOrdenCompra);

        // Insertar detalle de orden
        $datosDetalleOrden = [
            'id_detalle_orden' => $nuevoIdFactura,
            'id_orden' => $nuevoIdFactura,
            'id_producto' => $productoSeleccionado['id_producto'],
            'cantidad' => $datosPost['cantidad']
        ];
        $this->modelo->insertarDetalleOrden($datosDetalleOrden);

        // Insertar factura
        $datosFactura = [
            'id_factura' => $nuevoIdFactura,
            'id_detalle_orden' => $nuevoIdFactura,
            'fecha' => date('Y-m-d\TH:i:s\Z'),
            'id_metodo_pago' => $metodoPagoEncontrado['id_metodo_pago'],
            'total' => $total
        ];
        $this->modelo->insertarFactura($datosFactura);

        // Redirigir o mostrar mensaje de éxito
        header('Location: ?opcion=crear_facturas&mensaje=Factura creada exitosamente');
        exit();
    }
}

// Lógica de controlador
$controlador = new ControladorCrearFacturas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador->procesarFactura($_POST);
} else {
    $controlador->mostrarFormulario();
}
?>