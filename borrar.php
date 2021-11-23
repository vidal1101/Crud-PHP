<?php

session_start();
$varsession = $_SESSION['usuariosession'];

if($varsession == null || $varsession = '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}

include("conexion.php");
$con = Getconectarse();

$idlibro = $_GET["idlibro"];

$sql = "DELETE FROM Libros WHERE idLibro = $idlibro";

$query = mysqli_query($con, $sql);

if($query){
    Header("Location: menu.php");
}



?>