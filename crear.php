<?php 

include("conexion.php");
$con = Getconectarse();

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria  = $_POST['categoria'];
$fecha = "2021-11-11";
$resumen = $_POST['resumen'];
$imagen = "not image";


$sql = "INSERT INTO Libros (idLibro, Titulo, Autor , Categoria, Fecha, Resumen , Imagen )
VALUES ( '$titulo' , '$autor' , '$categoria' , $fecha , $resumen, $imagen  )";

$query = mysqli_query($con , $sql );
echo $query;



if($query){
    Header("Location: index.php");
}

?>

