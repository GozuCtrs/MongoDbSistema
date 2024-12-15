<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once 'C:/laragon/www/MongoDbSistema/vendor/autoload.php';
// Asegúrate de que MongoDB esté correctamente instalado

class Conexion {
    private static $client = null;
    private static $db = null;

    // Conectar a MongoDB
    public function __construct() {
        if (self::$client === null) {
            self::$client = new MongoDB\Client('mongodb://localhost:27017');  // Dirección de MongoDB
            self::$db = self::$client->FerreteriaLuchito;  // Base de datos
        }
    }

    // Obtener la conexión a la base de datos
    public static function obtenerConexion() {
        if (self::$client === null) {
            new self;
        }
        return self::$db;
    }
}
?>
