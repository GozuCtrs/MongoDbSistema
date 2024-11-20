<?php 
// include carga el recurso, y si hay fallas no dice nada
// require carge el recurso, y si hay fallas, emite mensajes

// include_once cargar solo una vez
// require_once

//http://127.0.0.1/sistema/test/testConfig.php
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
    echo $_urlBase;
    echo get_urlBase('pagina.php');

?>