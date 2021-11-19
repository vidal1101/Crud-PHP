<?php


     
/**
 * funcion para conectarse a mysql y retorna la conexion para hacer uso en las consultas
 *
 * @return 
 */
function Getconectarse(){

    $host = "localhost";
    $user ="root";
    $password = "";
    $db = "Crud-php";
        
        
    try {
        $connectionString  = mysqli_connect($host, $user , $password);

        mysqli_select_db($connectionString, $db);
        
        return $connectionString;

    } catch (Exception $e) {
         echo "<h1> Error: </h1>".$e->getMessage();
            
    }
}

   

#$con = Getconectarse();


