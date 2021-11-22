<?php






    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,
                initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

        <!--datatables js -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

        <!--icons-bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />

        <!-- hoja de estilos-->
        <link rel="stylesheet" href="static/estilos.css" />

        <title>Login</title>
    </head>

    <body>

        <div class="container-fluid">

            <div class="container ">

                <div class="row fondo">

                    <div class="col-12 col-sm-6 col-md-4 mx-auto">


                        <form class="needs-validation" action="verifcarCredenciales.php" method="POST" novalidate>

                            <div class="mb-3">
                                <label for="ced">Usuario</label>
                                <input type="text" class="form-control" name="nombreusuario" id="ced" required>
                                <div class="valid-feedback">
                                    Formato correcto.
                                </div>
                                <div class="invalid-feedback">
                                    Incorrecto, no puede quedar vacio!!
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="contr">Contraseña</label>
                                <input type="password" class="form-control" name="contrasena" id="contr" required>
                                <div class="invalid-feedback">
                                    No puede dejar este campo vacío.
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-12 mb-3">
                                    <button class="btn btn-primary btn-lg col-12" type="submit">Iniciar Sesión</button>
                                </div>


                                <div class="col-12  mb-3">
                                <button id="botonCrear" type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modaluser">
                                    Registrar Usuario
                                </button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>


        </div>

        </div>





        <div class="modal fade" id="modaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form class="needs-validation" action="" method="POST" id="formulario" enctype="multipart/form-data">


            <div class="col-12">
              <label for="user">Usuario</label>
              <input type="text" name="user" id="user" class="form-control" required>
              <br>
            </div>

            <div class="col-12">
              <label for="correo">Correo</label>
              <input type="text" name="correo" id="correo" class="form-control" required>
              <br>
            </div>

            

            <div class="col-12">
              <label for="contrasena">Contraseña</label>
              <input type="password" name="contrasena" id="contrasena" class="form-control">
              <br>
            </div>

            <div class="col-12">
              <label for="contrasena2">Confirme su Contraseña</label>
              <input type="password" name="contrasena2" id="contrasena2" class="form-control">
              <br>
            </div>
           

            <div class="modal-footer">
              <input type="hidden" name="idLibro" id="idLibro">
              <input type="hidden" name="opercaion" id="operacion">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success" id="action" name="action">Guardar</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

    </body>
    <script>

(function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>

    </html>