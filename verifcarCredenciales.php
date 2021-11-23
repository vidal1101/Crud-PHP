<?php

include("conexion.php");
$con = Getconectarse();
session_start();

$usuario = $_POST["nombreusuario"];
$contra = $_POST["contrasena"];

#echo $usuario.$contra;

$sql = "SELECT * FROM Usuarios WHERE  Usuario = '$usuario' ";

$query = mysqli_query($con , $sql);

$row = mysqli_fetch_array($query);


#echo $row["Correo"]


if( ($usuario == $row["Usuario"]) &&  (password_verify($contra, $row["Conttrasena"] ))  ){


    /**
     * aqui se crea la sesion y le asigna el valor del usuario 
     */
    $_SESSION['usuariosession'] = $usuario;
    #echo $row["Correo"];
    Header("Location: menu.php");
}else{
    Header("Location: index.php");
}

?>