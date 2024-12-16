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
        // Unir detalle_orden con filtro y limitar resultados a uno por seguridad
        [
            '$lookup' => [
                'from' => 'detalle_orden',
                'let' => ['id_detalle' => '$id_detalle_orden'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_detalle_orden', '$$id_detalle']]]],

                ],
                'as' => 'detalle'
            ]
        ],
        ['$unwind' => ['path' => '$detalle', 'preserveNullAndEmptyArrays' => true]],

        // Unir productos con filtro y limitar resultados
        [
            '$lookup' => [
                'from' => 'productos',
                'let' => ['id_producto' => '$detalle.id_producto'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_producto', '$$id_producto']]]],
                    
                ],
                'as' => 'producto'
            ]
        ],
        ['$unwind' => ['path' => '$producto', 'preserveNullAndEmptyArrays' => true]],

        // Unir ordenes_compra
        [
            '$lookup' => [
                'from' => 'ordenes_compra',
                'let' => ['id_orden' => '$detalle.id_orden_compra'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_orden_compra', '$$id_orden']]]],
                    ['$limit' => 1]
                ],
                'as' => 'orden'
            ]
        ],
        ['$unwind' => ['path' => '$orden', 'preserveNullAndEmptyArrays' => true]],

        // Unir cliente
        [
            '$lookup' => [
                'from' => 'clientes',
                'let' => ['id_cliente' => '$orden.id_cliente'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_cliente', '$$id_cliente']]]],
                    
                ],
                'as' => 'cliente'
            ]
        ],
        ['$unwind' => ['path' => '$cliente', 'preserveNullAndEmptyArrays' => true]],

        // Unir datos personales del cliente
        [
            '$lookup' => [
                'from' => 'persona',
                'let' => ['id_persona' => '$cliente.id_persona'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_persona', '$$id_persona']]]],
                    ['$limit' => 1]
                ],
                'as' => 'cliente.persona'
            ]
        ],
        ['$unwind' => ['path' => '$cliente.persona', 'preserveNullAndEmptyArrays' => true]],

        // Unir vendedor
        [
            '$lookup' => [
                'from' => 'vendedores',
                'let' => ['id_vendedor' => '$orden.id_vendedor'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_vendedor', '$$id_vendedor']]]],
                    
                ],
                'as' => 'vendedor'
            ]
        ],
        ['$unwind' => ['path' => '$vendedor', 'preserveNullAndEmptyArrays' => true]],

        // Unir datos personales del vendedor
        [
            '$lookup' => [
                'from' => 'persona',
                'let' => ['id_persona' => '$vendedor.id_persona'],
                'pipeline' => [
                    ['$match' => ['$expr' => ['$eq' => ['$id_persona', '$$id_persona']]]],
                        
                ],
                'as' => 'vendedor.persona'
            ]
        ],
        ['$unwind' => ['path' => '$vendedor.persona', 'preserveNullAndEmptyArrays' => true]],

        // Proyección final
        [
            '$project' => [
                '_id' => 5,
                'fecha' => 1,
                'cliente' => '$cliente.persona',
                'vendedor' => '$vendedor.persona',
                'producto' => '$producto.nombre',
                'total' => '$total',
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
