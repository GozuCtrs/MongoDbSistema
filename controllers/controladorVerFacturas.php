<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';  
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloVerFacturas.php';

$modeloFacturas = new modeloFacturas();
$mensaje = '';

// Eliminar factura
if (isset($_GET['del_id'])) {
    try {
        $resultado = $modeloFacturas->eliminarFactura($_GET['del_id']);
        $mensaje = $resultado->getDeletedCount() > 0 ? 'Factura eliminada correctamente.' : 'No se pudo eliminar la factura.';
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
    }
}

// Listar facturas
$facturas = [];
try {
    $facturas = $modeloFacturas->listarFacturas();
} catch (Exception $e) {
    $mensaje = $e->getMessage();
}

// Renderizar vista
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/vistaVerFacturas.php';
mostrarListaFacturas($facturas, $mensaje);
?>
