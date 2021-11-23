<?php 

include("conexion.php");
$con = Getconectarse();

$contra1 = $_POST["contrasena"];
$contra2 = $_POST["contrasena2"];

#echo $contra1." ".$contra2 ;

/**
 * valido que la contrasena1 y contraseña2 sean iguales. 
 * sino devuelvo a la pagina de registrar. 
 */
if( $contra1 == $contra2){
    #echo "es correcto";
    verificarCredenciales($contra1 , $con);
}else{
    echo "<script> 
            window.location='registrarUsuario.php'
            alert('las contraseñas no son iguales');
         </script>";
}


/**
 * verificar que el form este lleno, luego procede a encriptar con password_hash ,
 * se registra el nuevo usuario, y redirecciona al index.php
 *
 * @param #contrasena
 * @param  #conexion
 * @return 
 */
function verificarCredenciales($pass , $conetar ){

    if(isset($_POST["action"])){

        try {
            
            
            $usuario = $_POST["usuario"];
            $correo = $_POST["correo"];
    
            $pass_encrip = password_hash( $pass , PASSWORD_DEFAULT);
    
            #echo $pass_encrip." ".$usuario. " ".$correo;
            $sql = "INSERT INTO  Usuarios ( Usuario , Correo , Conttrasena ) VALUES ('$usuario' , '$correo' , '$pass_encrip'  ) ";
            $query = mysqli_query($conetar , $sql );
    
            if($query){
                echo "<script> 
                    window.location='index.php'
                    alert('Registrado: $usuario ');
                </script>";
            }


        } catch (\Throwable $th) {
            echo($th->getMessage());
        }


    }

}
