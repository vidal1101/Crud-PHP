<?php


session_start();
$varsession = $_SESSION['usuariosession'];

if($varsession == null || $varsession = '' ){
  echo 'no tiene permisos, inicie sesion';
  die();

}

include("conexion.php");
$con = Getconectarse();

$sql = "SELECT idLibro, Titulo, Autor , Categoria, Fecha, Resumen , Imagen  FROM Libros ORDER BY idLibro DESC ";

$query = mysqli_query($con, $sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!--datatables js -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

  <!--icons-bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />

  <!-- hoja de estilos-->
  <link rel="stylesheet" href="static/estilos.css" />

  <title>Crud-PHP</title>
</head>

<body>
  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="menu.php">Administración de libros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

    <h2 class="text-center">Usuario: <?php echo $_SESSION['usuariosession'];  ?></h2>

    <div class="row">

      <div class="col-2 offset-10">

        <div class="text-center">
          <!-- Button trigger modal -->
          <button id="botonCrear" type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalLibro">
            <i class="bi bi-plus-circle-fill"></i>Crear
          </button>
        </div>

      </div>

      <div class="col-4 offset-4">

        <div class="text-center">
          <!-- Button trigger modal -->
          <h1> Todos los libros</h1>
        </div>

      </div>


    </div>
    

    <!-- tabla -->
    <div class="container fondo">

      <div class="text-center">
        <input id="filtrar" name="consulta" type="text" class="form-control" placeholder="Buscar libro...">
      </div>
      <br>

      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">id Libro</th>
              <th scope="col">Titulo</th>
              <th scope="col">Autor</th>
              <th scope="col">Categoria</th>
              <th scope="col">Fecha</th>
              <th scope="col">Resumen</th>
              <th scope="col">Imagen Libro</th>
              <th scope="col"><i class="bi bi-layout-text-sidebar-reverse"> Editar</th>
              <th scope="col"><i class="bi bi-trash-fill"> Borrar</th>
            </tr>
          </thead>

          <tbody class="buscar">
            <?php
            while ($row = mysqli_fetch_array($query)) {

            ?>

              <tr>
                <td> <?php echo $row["idLibro"] ?> </td>
                <td><?php echo $row["Titulo"] ?> </td>
                <td> <?php echo $row["Autor"] ?> </td>
                <td> <?php echo $row["Categoria"] ?></td>
                <td><?php echo $row["Fecha"] ?></td>
                <td><?php echo $row["Resumen"] ?></td>
                <td> 
                <?php 
                  /**
                   * mostrar imagen de cada libro
                   */
                  $id = $row["idLibro"];
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
                  <a href="obtenerRegistro.php?id=<?php echo $row["idLibro"] ?>">
                    <button type="button" name="editar" id="'<?php echo $row["idLibro"] ?>'" class="btn btn-warning">Editar </button>
                  </a>
                </td>

                <td>
                  <a href="borrar.php?idlibro=<?php echo $row["idLibro"] ?>">
                    <button type="button" name="eliminar" id="'<?php echo $row["idLibro"] ?>'" class="btn btn-danger">Eliminar </button>
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

    <footer class="bg-primary text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 :
            <a class="text-dark" href="https://gruporolosa.com/">
              <span>Crud-PHP, Rolosa</span>
            </a>
        </div>
        <!-- Copyright -->
    </footer>

  </div>






  <!--Modal-->
  <div class="modal fade" id="modalLibro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Libro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form class="needs-validation" action="crear.php" method="POST" id="formulario" enctype="multipart/form-data">


            <div class="col-12">
              <label for="titulo">Titulo</label>
              <input type="text" name="titulo" id="titulo" class="form-control" required>
              <br>
            </div>

            <div class="col-12">
              <label for="autor">Autor</label>
              <input type="text" name="autor" id="autor" class="form-control" required>
              <br>
            </div>

            <div class="col-12">
              <label for="categoria">Categoria</label>
              <select class="custom-select" name="categoria" id="categoria" value="" required>
                <option selected disabled value="Sin estado">Seleccionar..</option>
                <!-- Dinamico -->
                <option>Acción</option>
                <option>Aventura</option>
                <option>Literatura</option>
                <option>Ficción</option>
                <option>Arte</option>
                <option>Cine</option>
                <option>Terror</option>
              </select>

              <br>
            </div>

            <div class="col-12">
              <label for="fecha">Fecha</label>
              <input type="date" name="fecha" id="fecha" class="form-control" required>
              <br>
            </div>

            <div class="col-12">
              <label for="resumen">Resumén</label>
              <input type="text" name="resumen" id="resumen" class="form-control">
              <br>
            </div>

            <div class="col-12">
              <label for="archivo">Imagen</label>
              <input type="file" name="archivo" id="archivo" class="form-control">
              <span id="imagen-subida"></span>
              <br>
            </div>
            <br>

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






  <!-- jQuery 3.5   VERSION ESTABLE-->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  <!-- funcionabilidades-->

  <script type="text/javascript">
    $(document).ready(function() {
        console.log("se cargo el documento... ");
        

        (function ($) {
 
        $('#filtrar').keyup(function () {
 
             var rex = new RegExp($(this).val(), 'i');
 
             $('.buscar tr').hide();
 
             $('.buscar tr').filter(function () {
               return rex.test($(this).text());
             }).show();
 
        })
 
        }(jQuery));

      }

    );
  </script>






</body>

</html>