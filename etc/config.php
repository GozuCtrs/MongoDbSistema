<?php
define('URL_base', "http://MongoDbSistema.test/");
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbsistema');  // Esta configuración ya no será utilizada directamente
define('DB_USER', 'root');        // Lo mismo para el usuario
define('DB_PASS','');             // Lo mismo para la contraseña

function get_path($type, $arg1) {
    $basePaths = [
        'base' => URL_base,
        'views' => URL_base . 'views/',
        'models' => URL_base . 'models/',
        'controllers' => URL_base . 'controllers/'];
    return $basePaths[$type].$arg1;
}


function get_urlBase($arg1) {
    return get_path('base',$arg1);
}

function get_views($arg1) {
    return get_path('views',$arg1);
}

function get_models($arg1) {
    return get_path('models',$arg1);
}

function get_controllers($arg1) {
    return get_path('controllers',$arg1);
}

function get_views_disk($arg1) {
    return $_SERVER['DOCUMENT_ROOT'] . '/views/'.$arg1;
}

function get_controllers_disk($arg1) {
    return $_SERVER['DOCUMENT_ROOT'] . '/controllers/'.$arg1;
}
?>
