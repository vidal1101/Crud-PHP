<?php

session_start();
$varsession = $_SESSION['usuariosession'];

if($varsession == null || $varsession = '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}

include("conexion.php");
$con = Getconectarse();

if( guardarImageBD($con) ){
    #echo "se edito con exito";
    #guardarImagen($id);
    Header("location: menu.php ");
}



function  guardarImageBD($con ){



    if( isset($_FILES["archivo"]["name"]) ){

        $archivosPermitidos = array( "image/gif", "image/png" , "image/svg", "image/jpeg" , "image/jpg");

        $tipoArchivo = $_FILES['archivo']['type'];

        if( in_array($tipoArchivo,$archivosPermitidos) ==false ){
            die("Archivo no permitido");
        }

        $tamanoArchivo  = $_FILES["archivo"]["size"];
        $imagenSubida  = fopen( $_FILES["archivo"]["tmp_name"], 'r' );
        
        $binariosImagen = fread($imagenSubida , $tamanoArchivo);

        $binariosImagen = mysqli_escape_string($con ,  $binariosImagen);


        $id = $_POST["idlibro"];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categoria  = $_POST['categoria'];
        $fecha = $_POST["fecha"];
        $resumen = $_POST['resumen'];



        $sql = "UPDATE Libros SET Titulo= '$titulo' , Autor= '$autor' , Categoria='$categoria' , Fecha = '$fecha' , Resumen= '$resumen' , Imagen= '$binariosImagen' , TipoImagen = '$tipoArchivo' WHERE idLibro = $id ";
    
        $query = mysqli_query($con , $sql );

        return $query;

    }

}







?>