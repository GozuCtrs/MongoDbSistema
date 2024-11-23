<?php
define('URL_base', "http://MC_Contreras_Coronel.test/");
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbsistema');
define('DB_USER', 'root');
define('DB_PASS','');

function get_path($type, $arg1) {
    $basePaths = [
        'base' => URL_base,
        'views' => URL_base . 'views/',
        'models' => URL_base . 'models/',
        'controllers' => URL_base . 'controllers/'];
    return $basePaths[$type].$arg1;
}



function get_urlBase($arg1)
{
    return get_path('base',$arg1);
}

function get_views($arg1)
{
    return get_path('views',$arg1);
}

function get_models($arg1)
{
    return get_path('models',$arg1);
}

function get_controllers($arg1)
{
    return get_path('controllers',$arg1);
}

//echo 'kcha perros juan';
//echo URL_base;
//echo get_urlBase('');
//echo get_models('modeloUsuario.php');
//echo get_urlBase('pagina.html');
