<?php


include("Database.php");
include("funciones.php");


$query = "";
$salida = array();
$query = "  SELECT * FROM Libros ";

if( isset( $_POST["search"]["value"] )){
    $query .= ' WHERE Titulo LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= ' OR Categoria LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= ' OR Autor LIKE "%' . $_POST["search"]["value"] . '%" ';
}


if( isset( $_POST["order"] )){
    $query .= 'ORDER  BY ' . $_POST["order"]['0']["column"] .' '. $_POST["order"][0]['dir'] . ' ';
}else{
    $query .= 'ORDER BY idLibro DESC ';
}


if($_POST["length"] != -1 ){

    $query .= 'LIMIT' . $_POST["start"] . ',' . $_POST["length"];

}



$stmt = $conexion ->prepare($query);
$stmt -> execute();
$result = $stmt -> fetchAll();
$datos = array();
$filtered_rows = $stmt -> rowCount();

foreach ($result as $fila ) {

    $imagen =  '';
    if($fila["Imagen"] != '' ){
        $imagen = '<img src="img/"'.$fila["Imagen"].'" class="img-thumbnail" width="50" height="50" >';

    }else{
        $imagen = "";
    }


    $sub_array = array();
    $sub_array[] = $fila["idLibro"];
    $sub_array[] = $fila["Titulo"];
    $sub_array[] = $fila["Autor"];
    $sub_array[] = $fila["Categoria"];
    $sub_array[] = $fila["Fecha"];
    $sub_array[] = $fila["Resumen"];
    $sub_array[] = $imagen;

    $sub_array[] = '<button type="button" name="editar" id="'.$fila["idLibro"].'"  
    class="btn btn-darger"  >Editar </button>';

    $sub_array[] = '<button type="button" name="Borrar" id="'.$fila["idLibro"].'"  
    class="btn btn-Warning"  >borrar </button>';


    $datos = $sub_array;
}


$salida = array(
    "draw"              => intval($_POST["draw"]),
    "recordsTotal"      => $filtered_rows,
    "recordsFiltered"   => $obtenerLibros(),
    "data"              => $datos

);


echo json_encode($salida);




?>