<?php

class Conexion{

    private $host = "localhost";
    private $user ="root";
    private $password = "";
    private $db = "Crud-php";
    private $connect = "";

    public function __construct(){
        $connectionString  = "mysql:hos=".$this->host.";dbname=".$this->db.";charset=utf8";

        try {

            $this->connect = new PDO($connectionString, $this->user,$this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            echo "success conection";

        } catch (Exception $e) {
            $this->connect = 'error de conexion ';
            echo "ERROR: ".$e->getMessage();
            
        }
    }


}

$conect = new Conexion();

    
?>