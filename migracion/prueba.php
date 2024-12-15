<?php
try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    echo "Conexión exitosa a MongoDB!";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error: ", $e->getMessage();
}
?>
