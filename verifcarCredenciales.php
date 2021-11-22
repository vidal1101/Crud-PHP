<?php

include("conexion.php");
$con = Getconectarse();

$usuario = $_POST["nombreusuario"];
$contra = $_POST["contrasena"];

#echo $usuario.$contra;

$sql = "SELECT * FROM Usuarios WHERE Conttrasena = '$contra' AND  Usuario = '$usuario' ";

$query = mysqli_query($con , $sql);

$row = mysqli_fetch_array($query);


#echo $row["Correo"]


if($usuario == $row["Usuario"] && $contra == $row["Conttrasena"] ){

    #echo $row["Correo"];
    Header("Location: index.php");
}else{
    Header("Location: login.php");
}

?>