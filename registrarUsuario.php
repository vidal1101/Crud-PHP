<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!--datatables js -->

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
    <!--icons-bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />

    <!-- hoja de estilos-->
    <link rel="stylesheet" href="static/estilos.css" />


    <title>Registrar Usuario</title>
</head>

<body>

    <div class="container-fluid">

        <h1 class="text-center">Registrarse</h1>

        <br>

        <div class="container fondo">

            <form class="needs-validation" action="guardarUsuario.php" method="POST" id="formulario" enctype="multipart/form-data">
                <br>
                <div class="col-12">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                    <br>
                </div>

                <div class="col-12">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control" required>
                    <br>
                </div>

                <div class="col-12">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                    <br>
                </div>



                <div class="col-12">
                    <label for="contrasena2">Confirmar contraseña</label>
                    <input type="password" name="contrasena2" id="fecha" class="form-control" required>
                    <br>
                </div>


                <br>

                <div class="modal-footer">
                    <input type="hidden" name="idLibro" id="idLibro">
                    <input type="hidden" name="opercaion" id="operacion">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">limpiar</button>
                    <button type="submit" class="btn btn-success" id="action" name="action">Guardar</button>
                </div>

            </form>



        </div>


    </div>

</body>

</html>