<?php

    $usuario = "root";
    $password = "";
    $conexion  ;
    try {
        $conexion = new PDO("mysql:host=localhost;dbname=Crud-php", $usuario, $password);
        echo "<h1>conexion exitosa</h1> ";
    } catch (Exception $e) {
        #$this->conexion = 'error de conexion ';
        echo "<h1> Error: </h1>".$e->getMessage();
    }