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

$idmislibros = $_GET["myidLibro"];

echo $idmislibros;

$sql = "DELETE FROM Libros WHERE idLibro = $idlibro";

$sqlmylibro = "DELETE FROM UsuariosLibros WHERE idUsuarioLibro = $idmislibros ";

$query = mysqli_query($con, $sql);

$queryMylibro = mysqli_query($con, $sqlmylibro);

if($query){
    Header("Location: menu.php");
}


if($queryMylibro){
  Header("Location: mislibros.php");
}



?>