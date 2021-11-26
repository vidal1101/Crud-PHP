<?php


session_start();
$varsession= $_SESSION['usuariosession'];

if($varsession == null || $varsession= '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}



#conexion y traer los libros solo del usuario 
include("conexion.php");
$con = Getconectarse();

$user = $_SESSION['usuariosession'];

$sqliduser = "SELECT idUsuario FROM Usuarios WHERE Usuario = '$user' ";

$query = mysqli_query($con, $sqliduser);

$row= mysqli_fetch_array($query);

#extracion de libros con este usuarios 

$sql = " SELECT UsuariosLibros.idUsuario , Usuarios.Usuario ,Libros.idLibro , Libros.Titulo , Libros.Autor , Libros.Categoria , Libros.Resumen FROM UsuariosLibros INNER JOIN Libros on UsuariosLibros.idLibro = Libros.idLibro INNER JOIN Usuarios on UsuariosLibros.idUsuario = Usuarios.idUsuario WHERE UsuariosLibros.idUsuario = 7 ";

$querylibro  = mysqli_query($con , $sql);





?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!--datatables js -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
  <!--icons-bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />

  <!-- hoja de estilos-->
  <link rel="stylesheet" href="static/estilos.css" />
  <title>Mis Libros</title>
</head>

<body>


  <div class="container-fluid">



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="menu.php">Administración de libros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="mislibros.php">Mis libros</a>
            </li>
          </ul>
          <form class="d-flex">
            <a href="cerrar_session.php" class="btn btn-outline-success" type="submit">
              Cerrar sesión
            </a>
          </form>
        </div>
      </div>
    </nav>

    <br>




    <div class="row">

      <div class="col-2 offset-10">

        <div class="text-center">
          <!-- Button trigger modal -->

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus-circle-fill"></i> Añadir
          </button>


        </div>

      </div>

      <div class="col-4 offset-4">

        <div class="text-center">
          <!-- Button trigger modal -->
          <h1> Mis libros <?php echo $rowlibro["Categoria"] ?> </h1>
        </div>

      </div>
    </div>
    <br>





  <div class="container fondo">

    <div class="text-center">
      <input id="filtrar" name="consulta" type="text" class="form-control" placeholder="Buscar libro...">
    </div>
    <br>

    <div class="table-responsive">

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">id Usuario</th>
            <th scope="col">Usuario</th>
            <th scope="col">id Libro</th>
            <th scope="col">Titulo</th>
            <th scope="col">Autor</th>
            <th scope="col">Categoria</th>
            <th scope="col">Resumen</th>
            <th scope="col">Imagen Libro</th>
            <th scope="col"><i class="bi bi-layout-text-sidebar-reverse"> Editar</th>
            <th scope="col"><i class="bi bi-trash-fill"> Borrar</th>
          </tr>
        </thead>

        <tbody class="buscar">
          <?php
          while ( $rowlibro  = mysqli_fetch_array($querylibro) ) {

          ?>

            <tr>
              <td><?php echo $rowlibro["idUsuario"] ?></td>
              <td><?php echo $rowlibro["Usuario"] ?></td>
              <td> <?php echo $rowlibro["idLibro"] ?> </td>
              <td><?php echo $rowlibro["Titulo"] ?> </td>
              <td> <?php echo $rowlibro["Autor"] ?> </td>
              <td> <?php echo $rowlibro["Categoria"] ?></td>
              <td><?php echo $rowlibro["Resumen"] ?></td>
              <td> 
              <?php 
                /**
                 * mostrar imagen de cada libro
                 */
                $id = $rowlibro["idLibro"];
                $path = "img/".$id;

                if(file_exists($path) ){

                  $directorio = opendir($path);
                  
                  while ($archivo = readdir($directorio) ) {

                    #reviso que no sea un directorio
                    if(!is_dir($archivo) ){

                      try {
                        echo " <img src='img/$id/$archivo'  width='100px' height='100px' >";
                        //code...
                      } catch (\Throwable $th) {
                        echo $th->getMessage();
                      }

                    }

                  }

                }
              
              ?>

              </td>

              <td>
                <a href="">
                  <button type="button" name="editar" id="" class="btn btn-warning">Editar </button>
                </a>
              </td>

              <td>
                <a href="">
                  <button type="button" name="eliminar" id="" class="btn btn-danger">Eliminar </button>
                </a>
              </td>


            </tr>

          <?php
          }
          ?>

        </tbody>

      </table>

    </div>

  </div>
    <br><br>






</div>




  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Agregar mas libros
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">



        </div>
        <div class="modal-footer">
          <button type="button" class="btn
                                    btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" id="action" name="action" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>





  <!-- jQuery 3.5   VERSION ESTABLE-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>


  <!-- funcionabilidades-->


</body>

</html>