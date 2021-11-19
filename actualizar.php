<?php

include("conexion.php");
$con = Getconectarse();

$id = $_POST["idlibro"];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria  = $_POST['categoria'];
$fecha = $_POST["fecha"];
$resumen = $_POST['resumen'];
$imagen = "not image at the moment";


$sql = "UPDATE Libros SET Titulo= '$titulo' , Autor= '$autor' , Categoria='$categoria' , Fecha = '$fecha' , Resumen= '$resumen' , Imagen= '$imagen' WHERE idLibro = $id ";

$query = mysqli_query($con , $sql);

if($query){
    Header("location: index.php ");
}

echo $id;




?>