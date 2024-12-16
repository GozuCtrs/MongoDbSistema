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
        // Add $unwind with preserveNullAndEmptyArrays and includeArrayIndex
        ['$unwind' => [
            'path' => '$detalle', 
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'detailIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'productIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'orderIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'clienteInfoIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'clienteIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'vendedorInfoIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'vendedorIndex'
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
            'preserveNullAndEmptyArrays' => true,
            'includeArrayIndex' => 'metodoPagoIndex'
        ]],
    
        // Add $group stage to remove duplicates
        [
            '$group' => [
                '_id' => '$_id',
                'fecha' => ['$first' => '$fecha'],
                'cliente' => ['$first' => '$cliente'],
                'vendedor' => ['$first' => '$vendedor'],
                'producto' => ['$first' => '$producto.nombre'],
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
