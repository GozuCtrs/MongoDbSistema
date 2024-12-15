<?php
// Incluir el autoload de Composer
require_once 'C:/laragon/www/MongoDbSistema/vendor/autoload.php';

 // Subir un nivel para acceder al directorio raíz
  // Asegúrate de que el path sea correcto

use MongoDB\Client;

// Configuración de la conexión (conéctate a tu base de datos MongoDB)
$mongoClient = new Client("mongodb://localhost:27017"); // Cambia la URI según sea necesario

// Seleccionar la base de datos
$db = $mongoClient->FerreteriaLuchito; // Cambia el nombre de la base de datos

// Probar la conexión
try {
    // Lista de colecciones
    $collections = $db->listCollections();
    echo "Conexión exitosa a la base de datos MongoDB. Colecciones:\n";
    foreach ($collections as $collection) {
        echo $collection->getName() . "\n";
    }
} catch (Exception $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
