<?php


/**
 * funcion para subir imagenes y guardalas en la carpeta /img, 
 * le concateno uno nunero randon antes del nombre para evitar errores con otras imagenes 
 * 
 * @return nuevoNombre  el nuevo nombre de la imagen 
 */
function subirImagen(){

    if (isset($_FILES["imagen"]) ) {

        $extension = explode('.',$_FILES["imagen"]['name'] );
        $nuevoNombre = rand().'.'.$extension[1];
        $ubicacion = './img/'.$nuevoNombre;

        move_uploaded_file( $_FILES["imagen"]['tmp_name'],$ubicacion);
        
        return $nuevoNombre;

    }
}




function obtenerNombreImagen($idLibro){

    $conexion = new Conexion();
    $stmt = $conexion->prepare("SELECT Imagen FROM Libros WHERE idLibro ='$idLibro' ");
    $stmt->execute();
    $resultado = $stmt->fetchAll();
    foreach ($resultado as $fila) {
        return $fila["Imagen"];
    }
}




?>