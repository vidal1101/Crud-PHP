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


    /**
     * proceso de guardar imagen .. 
     */
    
    $idInsert = "SELECT idLibro FROM Libros ORDER BY idLibro   DESC limit 1 ";

    $id = mysqli_query($con , $idInsert );

    $row = mysqli_fetch_array($id);



    if( $_FILES["archivo"]["error"] >0 ){
        echo "error al cargar archivo";
    }else{
        #se procede a guardar
        $archivosPermitidos = array( "image/gif", "image/png" , "image/svg", "image/jpeg" , "image/jpg");

        if( in_array( $_FILES["archivo"]["type"], $archivosPermitidos )  ){
            
            $rutaarchivo = 'img/'.$_FILES["archivo"]["name"];

            $moverArchivo = @move_uploaded_file(  $_FILES["archivo"]["tmp_name"] , $rutaarchivo );

            if($moverArchivo){
                echo "se guardo el archivo";
            }else {
                echo "no se guardo ".$moverArchivo;
            }
            


        }else{
            echo "el formato de archivo no esta permitido";
        }
    }



    
    if($query){

        #Header("Location: menu.php");
    }
} catch(Throwable $thro) {
    echo($thro->getMessage());
}

?>

