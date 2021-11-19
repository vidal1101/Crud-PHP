<?php

include("conexion.php");
$con = Getconectarse();

$id = $_GET["id"];

$sql = "SELECT * FROM Libros WHERE idLibro = $id ";

$query = mysqli_query($con , $sql);

$row =  mysqli_fetch_array($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <!--icons-bootstrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" />

  <!-- hoja de estilos-->
  <link rel="stylesheet" href="static/estilos.css" />
    <title>Obtener Registro</title>
</head>
<body>
    <div class="container">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Administración de libros</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
          <form class="d-flex">
            <button class="btn btn-outline-success" type="submit">
              Cerrar sesión
            </button>
          </form>
        </div>
      </div>
    </nav>

    <h1 class="text-center">Editar Libro</h1>

    <div class="row">

      <div class="col-2 ">

        <div class="text-center">
          <!-- Button trigger modal -->
          <a href="index.php">

              <button id="botonCrear"  type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalLibro">
                <i class="bi bi-arrow-return-left"></i>Regresar
              </button>
          </a>
        </div>
      </div>

    </div>
    <br><br>

    <div class="container fondo">

        <form class="needs-validation" action="actualizar.php" method="POST" id="formulario" enctype="multipart/form-data">
    
                <div class="col-12">
                  <label for="idlibro">IdLibro</label>
                  <input type="text" value="<?php echo $row["idLibro"] ?>" name="idlibro" id="idlibro"  class="form-control" readonly>
                  <br>
                </div>
    
                <div class="col-12">
                  <label for="titulo">Titulo</label>
                  <input type="text" value="<?php echo $row["Titulo"] ?>" name="titulo" id="titulo" class="form-control" required>
                  <br>
                </div>
    
                <div class="col-12">
                  <label for="autor">Autor</label>
                  <input type="text" name="autor" id="autor" value="<?php echo $row["Autor"] ?>" class="form-control" required>
                  <br>
                </div>
    
                <div class="col-12">
                  <label for="categoria">Categoria</label>
                  <select class="custom-select" name="categoria" id="categoria" value="<?php echo $row["Titulo"] ?>"  required>
                    <option selected disabled  >Seleccionar..</option>
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
                  <input type="date" value="<?php echo $row["Fecha"] ?>" name="fecha" id="fecha" class="form-control" required>
                  <br>
                </div>
    
                <div class="col-12">
                  <label for="resumen">Resumén</label>
                  <input type="text" value="<?php echo $row["Resumen"] ?>" name="resumen" id="resumen" class="form-control">
                  <br>
                </div>
    
                <div class="col-12">
                  <label for="imagen">Imagen</label>
                  <input type="file" name="imagen" value="<?php echo $row["Imagen"] ?>" id="imagen" class="form-control">
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

        
    </div>">


    </div>


    
</body>
</html>