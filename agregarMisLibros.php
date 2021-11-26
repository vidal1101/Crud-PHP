<?php



session_start();
$varsession= $_SESSION['usuariosession'];

if($varsession == null || $varsession= '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}


include("conexion.php");
$con = Getconectarse();

$user = $_SESSION['usuariosession'];

$sqliduser = "SELECT idUsuario FROM Usuarios WHERE Usuario = '$user' ";

$query = mysqli_query($con, $sqliduser);

$row= mysqli_fetch_array($query);

$idUsuario = $row["idUsuario"];
$idlibro = $_GET["idLibro"];

#echo $idUsuario. "  ".$idlibro;

$sqlinsert = "INSERT INTO UsuariosLibros (idLibro , idUsuario ) VALUES ('$idlibro' , '$idUsuario' ) ";

$queryInsert = mysqli_query($con , $sqlinsert);

if($queryInsert){
    echo $queryInsert;

    Header("Location: menu.php");

}




?>