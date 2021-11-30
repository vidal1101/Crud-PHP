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
    $binariosExtraidos = '';

    $binariosExtraidos = guardarImageBD($con);

    #echo $binariosExtraidos;

    
    $sql = "INSERT INTO Libros ( Titulo, Autor , Categoria, Fecha, Resumen , Imagen) VALUES ( '$titulo' , '$autor' , '$categoria' , '$fecha' , '$resumen', '$binariosExtraidos' )";
    
    $query = mysqli_query($con , $sql );


    /**
     * proceso de guardar imagen de forma local  .. 
     */
    
    $idInsert = "SELECT idLibro FROM Libros ORDER BY idLibro   DESC limit 1 ";

    $id = mysqli_query($con , $idInsert );

    $row = mysqli_fetch_array($id);


    
    if($query){
        echo 'insertado';

        #guardarImagenLocal($row);
        Header("Location: menu.php");
    }
} catch(Throwable $thro) {
    echo($thro->getMessage());
}


function  guardarImageBD($con ){

    if( isset($_FILES["archivo"]["name"]) ){

        $tamanoArchivo  = $_FILES["archivo"]["size"];
        $imagenSubida  = fopen( $_FILES["archivo"]["tmp_name"], 'r' );
        
        $binariosImagen = fread($imagenSubida , $tamanoArchivo);

        $binariosImagen = mysqli_escape_string($con ,  $binariosImagen);

        return $binariosImagen;

    }

}



/**
 * funcion para guardar imagen directamente en el proyecto, 
 * se crea una carpeta con el numero de id de la insercion para luego ejecutar el guardado
 *
 * @param 
 * @return
 */
function guardarImagenLocal ($row ){

    try {

        if( $_FILES["archivo"]["error"] >0 ){
            echo "error al cargar archivo";
        }else{
            #se procede a guardar
            $archivosPermitidos = array( "image/gif", "image/png" , "image/svg", "image/jpeg" , "image/jpg");

            #verificar que el archivo sean de los permitidos en el arrays
            if( in_array( $_FILES["archivo"]["type"], $archivosPermitidos )  ){
                
                #creo la ruta del archivo 
                $ruta = 'img/'.$row["idLibro"].'/';

                $archivo = $ruta.$_FILES["archivo"]["name"];
    
                mkdir($ruta);
    
                $moverArchivo = @move_uploaded_file(  $_FILES["archivo"]["tmp_name"] , $archivo );
    
                if($moverArchivo){
                    echo "se guardo el archivo";
                }else {
                    echo "no se guardo ".$moverArchivo;
                }
                
    
    
            }else{
                echo "el formato de archivo no esta permitido";
            }
        }
        
    } catch (\Throwable $thro) {

       echo($thro->getMessage());
    }

}



?>

