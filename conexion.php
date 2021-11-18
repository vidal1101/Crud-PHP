<?php

/*
clase de conexion a mysql con PDO, clase que salio a partir de la version 5.1 de php
importante los caracteres uft8Mb4, para poder usarlo en un cms , 
los atriubutos privados, y el contructor publico,  
se realiza una instancia y se conecta a la base de datos. 
*/
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
            echo "conexion exitosa.. ";

        } catch (Exception $e) {
            $this->connect = 'error de conexion ';
            echo "ERROR: ".$e->getMessage();
            
        }
    }



}

$conectando = new Conexion();


    
?>