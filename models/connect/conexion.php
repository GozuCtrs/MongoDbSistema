<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';

class Conexion {
    //public
    
    //protegida
    
    //privada
    private $host;
    private $namedb;
    private $userdb;
    private $passwordb;
    private $charset;

    private static $pdo = null;

    public function __construct() {
        $this->host = DB_HOST;
        $this->namedb = DB_NAME;
        $this->userdb = DB_USER;
        $this->passwordb = DB_PASS;
        $this->charset = 'utf8';
        if(self::$pdo == null){
            $this->conectar();
        }
    }

    private function conectar(){
        $dsn = "mysql:host={$this->host};dbname={$this->namedb};charset={$this->charset}";

        try {
            self::$pdo = new PDO($dsn, $this->userdb, $this->passwordb);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("hubo un error". $e->getMessage());
        }
    }

    public static function obtenerConexion() {
        if (self::$pdo == null){
            new self;
        }
        return self::$pdo;
    }

    public function contesta() {
        $dsn = "mysql:host={$this->host};dbname={$this->namedb};charset={$this->charset}";
        return $dsn;
    }

    }

?>
