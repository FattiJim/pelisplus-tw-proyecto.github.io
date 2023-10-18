<?php
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 1){
   
    header('location: ../../index.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registro Series</title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="icon" href="../../img/Icono.png">
    <style type="text/css">
      form .exito {color: #839496; border: 1px; }
      /*Diseño para los campos no válidos*/
      input:invalid{ border-color: #900; background-color: #FDD;}
      input:focus:invalid { outline: none; }
      /* Este es el diseño para nuestros mensajes de error */
      .error { width : 100%; height: 20%; padding: 0px; font-size: 80%; color: #900; 
      border-radius: 0 0 0 0; box-sizing: border-box; }
      form .error {color: #839496; border: 1px; }
    </style>
  </head>
  <body>

    <!-- BARRA DE NAVEGACIÓN  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href=".">Hola administrador <?php echo ucfirst($_SESSION['user']); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto"></ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Titulo, categoría, país o clasificación" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
      </div>
    </nav>

    <div class="container">
      <div class="row p-4">
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <!-- FORMULARIO PARA AGREGAR PRODUCTO -->
              <form id="series-form" novalidate>
                <div class="form-group">
                  <input class="form-control" type="text" id="titulo" placeholder="Nombre de la serie" minlength="5" maxlength="100" required>
                  <span class="error" aria-live="polite"></span>
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" id="numTemporadas" min="1" placeholder="Numero de temporadas" required>
                  <span class="error" aria-live="polite"></span>
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" id="numCapitulos" min="1" placeholder="Numero de capitulos" required>
                  <span class="error" aria-live="polite"></span>
                </div>
                <div class="form-group">
                  <select class="form-control" id="genero" required>
                    <option value="">Seleccione un Genero</option>
                    <option value="1">Acción</option>
                    <option value="2">Aventuras</option>
                    <option value="3">Ciencia Ficción</option>
                    <option value="4">Comedia</option>
                    <option value="5">Documental</option>
                    <option value="6">Drama</option>
                    <option value="7">Fantasía</option>
                    <option value="8">Musical</option>
                    <option value="9">Suspenso</option>
                    <option value="10">Terror</option>
                  </select>
                  <span class="error" aria-live="polite"></span>
                </div>
                <div class="form-group">
                  <select class="form-control" id="clasificacion" required>
                    <option value="">Seleccione la clasificacion</option>
                    <option value="1">AA</option>
                    <option value="2">A</option>
                    <option value="3">B</option>
                    <option value="4">B15</option>
                    <option value="5">C</option>
                    <option value="6">D</option>
                  </select>
                  <span class="error" aria-live="polite"></span>
                </div>
                <div class="form-group">
                  <select class="form-control" id="region" required>
                    <option value="">Seleccione la región</option>
                    <option value="1">Región 0</option>
                    <option value="2">Región 1</option>
                    <option value="3">Región 2</option>
                    <option value="4">Región 3</option>
                    <option value="5">Región 4</option>
                    <option value="6">Región 5</option>
                    <option value="7">Región 6</option>
                    <option value="8">Región 7</option>
                    <option value="9">Región 8</option>
                  </select>
                  <span class="error" aria-live="polite"></span>
                </div>
                <div class="form-group">
                  <input class="form-control" type="text" id="imagen" placeholder="img/imagen.png">
                  <span class="exito" aria-live="polite"></span>
                </div>
                <input type="hidden" id="seriesId">
                <button class="btn btn-primary btn-block text-center" type="submit">
                  Guardar
                </button>
                <button class="btn btn-primary btn-block text-center" type="reset">
                  Cancelar
                </button>
              </form>
              <br>
              <a href="index.php"><i class="bi bi-arrow-left-circle"></i>&nbsp;&nbsp;Regresar&nbsp;&nbsp;</a>
            </div>
          </div>
        </div>


        <!-- TABLA  -->
        <div class="col-md-7">
          <div class="card my-4" id="series-result">
            <div class="card-body">
              <!-- RESULTADO -->
              <ul id="container"></ul>
            </div>
          </div>

          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <td>Id</td>
                <td>Titulo</td>
                <td>Descripción</td>
              </tr>
            </thead>
            <tbody id="series"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!--FOOTER DE LA PÁGINA-->
    <footer class="text-center text-white" style="background-color: #f1f1f1;">
      <!-- Grid container -->
      <div class="container pt-4">
        <!-- Section: Social media -->
        <section class="mb-4">
        <!-- Facebook -->
        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="#!"
          role="button"
          data-mdb-ripple-color="dark">
          <i class="fab fa-facebook-f"></i>
        </a>

        <!-- Twitter -->
        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="#!"
          role="button"
          data-mdb-ripple-color="dark">
          <i class="fab fa-twitter"></i>
        </a>

        <!-- Google -->
        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="#!"
          role="button"
          data-mdb-ripple-color="dark">
          <i class="fab fa-google"></i>
        </a>

        <!-- Instagram -->
        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="#!"
          role="button"
          data-mdb-ripple-color="dark">
          <i class="fab fa-instagram"></i>
        </a>

        <!-- Linkedin -->
        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="#!"
          role="button"
          data-mdb-ripple-color="dark">
          <i class="fab fa-linkedin"></i>
        </a>

        <!-- Github -->
        <a
          class="btn btn-link btn-floating btn-lg text-dark m-1"
          href="#!"
          role="button"
          data-mdb-ripple-color="dark">
          <i class="fab fa-github"></i>
        </a>
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright:
      <a class="text-dark" href="#">Syntax Error by FJ & IC</a>
    </div>
    <!-- Copyright -->
  </footer>

  <!--REFERENCIA A ICONOS-->
  <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!--Referencia web a JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <!-- Lógica del Frontend -->
    <script src="app_series.js"></script>
  </body>

</html>