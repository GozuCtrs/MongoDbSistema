<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexionMongo.php';

class modeloFacturas
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtenerConexion();
    }

    public function listarFacturas()
{
    $coleccion = $this->conexion->facturas;

    return $coleccion->aggregate([
        [
            '$lookup' => [
                'from' => 'detalle_orden',
                'localField' => 'id_detalle_orden',
                'foreignField' => 'id_detalle_orden',
                'as' => 'detalle'
            ]
        ],
        ['$unwind' => [
            'path' => '$detalle', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'productos',
                'localField' => 'detalle.id_producto',
                'foreignField' => 'id_producto',
                'as' => 'producto'
            ]
        ],
        ['$unwind' => [
            'path' => '$producto', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'ordenes_compra',
                'localField' => 'detalle.id_orden',
                'foreignField' => 'id_orden',
                'as' => 'orden'
            ]
        ],
        ['$unwind' => [
            'path' => '$orden', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'clientes',
                'localField' => 'orden.id_cliente',
                'foreignField' => 'id_cliente',
                'as' => 'cliente_info'
            ]
        ],
        ['$unwind' => [
            'path' => '$cliente_info', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'persona',
                'localField' => 'cliente_info.id_persona',
                'foreignField' => 'id_persona',
                'as' => 'cliente'
            ]
        ],
        ['$unwind' => [
            'path' => '$cliente', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'vendedores',
                'localField' => 'orden.id_vendedor',
                'foreignField' => 'id_vendedor',
                'as' => 'vendedor_info'
            ]
        ],
        ['$unwind' => [
            'path' => '$vendedor_info', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'persona',
                'localField' => 'vendedor_info.id_persona',
                'foreignField' => 'id_persona',
                'as' => 'vendedor'
            ]
        ],
        ['$unwind' => [
            'path' => '$vendedor', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$lookup' => [
                'from' => 'metodo_pago',
                'localField' => 'id_metodo_pago',
                'foreignField' => 'id_metodo_pago',
                'as' => 'metodo_pago'
            ]
        ],
        ['$unwind' => [
            'path' => '$metodo_pago', 
            'preserveNullAndEmptyArrays' => true
        ]],
    
        [
            '$group' => [
                '_id' => '$_id',
                'fecha' => ['$first' => '$fecha'],
                'cliente' => ['$first' => '$cliente'],
                'vendedor' => ['$first' => '$vendedor'],
                'producto' => ['$first' => '$producto.nombre'],
                'tipo_magnitud' => ['$first' => '$producto.tipo_magnitud'],
                'cantidad' => ['$first' => '$detalle.cantidad'],
                'precio_magnitud' => ['$first' => '$producto.precio_magnitud'],
                'precio_unitario' => ['$first' => '$producto.precio_unitario'],
                'total' => ['$first' => '$total'],
                'metodo_pago' => ['$first' => '$metodo_pago.nombre_metodo']
            ]
        ],
    
        [
            '$project' => [
                '_id' => 1,
                'fecha' => 1,
                'cliente' => 1,
                'vendedor' => 1,
                'producto' => 1,
                'tipo_magnitud' => 1,
                'cantidad' => 1,
                'precio_magnitud' => 1,
                'precio_unitario' => 1,
                'total' => 1,
                'metodo_pago' => 1
            ]
        ]
    ])->toArray();
}




    

    public function obtenerFacturaPorId($id)
    {
        $coleccion = $this->conexion->facturas;
        return $coleccion->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }

    public function modificarFactura($id, $datos)
    {
        $coleccion = $this->conexion->facturas;
        return $coleccion->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => $datos]
        );
    }

    public function eliminarFactura($id)
    {
        $coleccionFacturas = $this->conexion->facturas;
        $coleccionOrdenesCompra = $this->conexion->ordenes_compra;
        $coleccionDetalleOrden = $this->conexion->detalle_orden;

        // Eliminar detalle_orden relacionado
        $coleccionDetalleOrden->deleteMany(['factura_id' => $id]);
        // Eliminar ordenes_compra relacionado
        $coleccionOrdenesCompra->deleteMany(['factura_id' => $id]);
        // Eliminar factura
        return $coleccionFacturas->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
}
?>
