<?php

session_start();
$varsession = $_SESSION['usuariosession'];

if($varsession == null || $varsession = '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}

include("conexion.php");
$con = Getconectarse();

$id = $_POST["idlibro"];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$categoria  = $_POST['categoria'];
$fecha = $_POST["fecha"];
$resumen = $_POST['resumen'];
$imagen = "not image at the moment";

#echo $id;

$sql = "UPDATE Libros SET Titulo= '$titulo' , Autor= '$autor' , Categoria='$categoria' , Fecha = '$fecha' , Resumen= '$resumen' , Imagen= '$imagen' WHERE idLibro = $id ";

$query = mysqli_query($con , $sql);




if($query){
    guardarImagen($id);
    #Header("location: menu.php ");
}




/**
 * funcion para guardar imagen directamente en el proyecto, 
 * se crea una carpeta con el numero de id de la insercion para luego ejecutar el guardado
 *
 * @param 
 * @return
 */
function guardarImagen ($row ){

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