<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexionMongo.php';

class modeloUsuario {

    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerConexion();
    }

    // Validar usuario
    public function ValidadUsuario($nombre, $password) {
        $collection = $this->conexion->administradores;  // Acceder a la colección 'administradores'
        
        // Buscar el usuario por nombre y password
        $usuario = $collection->findOne([
            'nombre' => $nombre,
            'password' => $password
        ]);

        return $usuario;  // Devuelve el usuario si se encuentra, o null si no
    }

    // Obtener administradores
    public function listarAdministradores()
    {
        $coleccion = $this->conexion->administradores; // Referencia a la colección de administradores
        return $coleccion->find()->toArray(); // Devolver como array
    }

    // Obtener un administrador por su ObjectId
    public function obtenerAdministradorPorId($id)
    {
        $coleccion = $this->conexion->administradores;
        return $coleccion->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }

    // Insertar un nuevo administrador
    public function ingresarAdministrador($nombre, $password, $rol)
    {
        $coleccion = $this->conexion->administradores;
        $resultado = $coleccion->insertOne([
            'nombre' => $nombre,
            'password' => $password,
            'rol' => $rol
        ]);
        return $resultado->getInsertedCount() > 0;
    }

    // Modificar un administrador
    public function modificarAdministrador($id, $nombre, $password, $rol)
    {
        $coleccion = $this->conexion->administradores;
        $resultado = $coleccion->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => ['nombre' => $nombre, 'password' => $password, 'rol' => $rol]]
        );
        return $resultado->getModifiedCount() > 0;
    }

    // Eliminar un administrador
    public function eliminarAdministrador($id)
    {
        $coleccion = $this->conexion->administradores;
        $resultado = $coleccion->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount() > 0;
    }
}
?>
