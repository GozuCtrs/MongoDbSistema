<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexionMongo.php';

class ModeloVerFacturas {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerConexion();
    }

    // Obtener el último ID de factura
    public function obtenerUltimoIdFactura() {
        $coleccion = $this->conexion->facturas;
        $ultimaFactura = $coleccion->findOne([], [
            'sort' => ['id_factura' => -1],
            'projection' => ['id_factura' => 1]
        ]);

        return $ultimaFactura ? $ultimaFactura['id_factura'] : 0;
    }

    // Obtener último ID de persona
    public function obtenerUltimoIdPersona() {
        $coleccion = $this->conexion->persona;
        $ultimaPersona = $coleccion->findOne([], [
            'sort' => ['id_persona' => -1],
            'projection' => ['id_persona' => 1]
        ]);

        return $ultimaPersona ? $ultimaPersona['id_persona'] : 0;
    }

    // Obtener lista de productos para el formulario
    public function obtenerProductos() {
        $coleccion = $this->conexion->productos;
        return $coleccion->find()->toArray();
    }

    // Obtener lista de vendedores
    public function obtenerVendedores() {
        $coleccion = $this->conexion->vendedores;
        $vendedores = $coleccion->aggregate([
            ['$lookup' => [
                'from' => 'persona',
                'localField' => 'id_persona',
                'foreignField' => 'id_persona',
                'as' => 'detalles_persona'
            ]],
            ['$unwind' => '$detalles_persona'],
            ['$project' => [
                'id_vendedor' => 1,
                'nombre_completo' => [
                    '$concat' => ['$detalles_persona.nombre', ' ', '$detalles_persona.apellidos']
                ]
            ]]
        ])->toArray();

        return $vendedores;
    }

    // Obtener lista de clientes
    public function obtenerClientes() {
        $coleccion = $this->conexion->clientes;
        $clientes = $coleccion->aggregate([
            ['$lookup' => [
                'from' => 'persona',
                'localField' => 'id_persona',
                'foreignField' => 'id_persona',
                'as' => 'detalles_persona'
            ]],
            ['$unwind' => '$detalles_persona'],
            ['$project' => [
                'id_cliente' => 1,
                'nombre_completo' => [
                    '$concat' => ['$detalles_persona.nombre', ' ', '$detalles_persona.apellidos']
                ]
            ]]
        ])->toArray();

        return $clientes;
    }

    // Obtener métodos de pago
    public function obtenerMetodosPago() {
        $coleccion = $this->conexion->metodo_pago;
        return $coleccion->find()->toArray();
    }

    // Insertar nueva persona
    public function insertarPersona($nombre, $apellidos) {
        $ultimoId = $this->obtenerUltimoIdPersona() + 1;
        
        $coleccion = $this->conexion->persona;
        $resultado = $coleccion->insertOne([
            'id_persona' => $ultimoId,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'documento_identidad' => null,
            'id_tipo_documento' => null,
            'direccion' => null,
            'telefono' => null,
            'email' => null
        ]);

        // Insertar también en la colección de clientes
        if ($resultado->getInsertedCount() > 0) {
            $coleccionClientes = $this->conexion->clientes;
            $coleccionClientes->insertOne([
                'id_cliente' => $ultimoId,
                'id_persona' => $ultimoId
            ]);
        }

        return $ultimoId;
    }

    // Insertar nueva factura
    public function insertarFactura($datosFactura) {
        $coleccion = $this->conexion->facturas;
        $resultado = $coleccion->insertOne($datosFactura);
        
        return $resultado->getInsertedCount() > 0;
    }

    // Insertar detalle de orden
    public function insertarDetalleOrden($datosDetalleOrden) {
        $coleccion = $this->conexion->detalle_orden;
        $resultado = $coleccion->insertOne($datosDetalleOrden);
        
        return $resultado->getInsertedCount() > 0;
    }

    // Insertar orden de compra
    public function insertarOrdenCompra($datosOrdenCompra) {
        $coleccion = $this->conexion->ordenes_compra;
        $resultado = $coleccion->insertOne($datosOrdenCompra);
        
        return $resultado->getInsertedCount() > 0;
    }
}
?>