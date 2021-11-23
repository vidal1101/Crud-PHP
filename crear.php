<?php 

session_start();
$varsession = $_SESSION['usuariosession'];

if($varsession == null || $varsession = '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}

try {

    include("conexion.php");
    $con = Getconectarse();
    
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria  = $_POST['categoria'];
    $fecha = $_POST["fecha"];
    $resumen = $_POST['resumen'];
    $imagen = "not image at the moment";
    
    
    $sql = "INSERT INTO Libros ( Titulo, Autor , Categoria, Fecha, Resumen , Imagen) VALUES ( '$titulo' , '$autor' , '$categoria' , '$fecha' , '$resumen', '$imagen' )";
    
    $query = mysqli_query($con , $sql );
    
    
    if($query){
        Header("Location: menu.php");
    }
} catch(Throwable $thro) {
    echo($thro->getMessage());
}

?>

