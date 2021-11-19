<?php

include("conexion.php");
$con = Getconectarse();

$idlibro = $_GET["idlibro"];

$sql = "DELETE FROM Libros WHERE idLibro = $idlibro";

$query = mysqli_query($con, $sql);

if($query){
    Header("Location: index.php");
}



?>