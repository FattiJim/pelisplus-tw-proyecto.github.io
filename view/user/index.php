<?php
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 2){
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="icon" href="../../img/Icono.png">
    <style type="text/css">
        body { background: black;}
        .navbar { background: rgba(0,0,0, 0.5); }
        .navbar .nav-item:not(:last-child) { margin-right: 35px; }
        .dropdown-toggle::after { transition: transform 0.15s linear; }
        .show.dropdown .dropdown-toggle::after { transform: translateY(3px); }
        .dropdown-menu { margin-top: 0; }
        .carousel-inner img { width: 100%; max-height: 725px;}
        .carousel-inner{ height: 725px;}
        #carousel-inner {height: 200px; margin-bottom: 15px; display: flex;}
        .cards-wrapper { display: flex; justify-content: bottom; margin: 10px; margin-top: 10px; margin-bottom: 15px; }
        #contenedorSearch img {height: 250px; width: 400px;}
        .card img { max-width: 100%; max-height: 100%; }
        .btn { background: rgba(0,0,0, 0.5); border: none; border-radius: 0.31em; color: #fff; 
        cursor: pointer; transition: .3s ease all;}
        .btn:hover { background: #fff; color: #000; }
        .btn a { text-decoration: none; color: #FFF; }
        .btn a:hover { background: #fff; color: #000; }
        .card { margin: 0; box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18); border: none; border-radius: 0; }
        /*.carousel-inner { padding: 1em; }*/
        #carousel-control-prev, #carousel-control-next { background-color: #e1e1e1; width: 5vh; height: 5vh;
        border-radius: 50%; top: 60%; transform: translateY(-50%); }
        @media (min-width: 300px) { .card img { height: 250px;}}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img class="logo horizontal-logo" width="100" height="50" src="../../img/LOGO .png" alt="forecastr logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Series</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Peliculas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Mi lista</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!--img id width="35" height="35" src="../../img/Imagen1.png" alt="perfil"-->
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                <a class="dropdown-item" id="edicion" href="RegistroPerfil.php"><p id="idPerfil"><?php echo ucfirst($_SESSION['user']); ?></p>Editar perfil</a>
                <a class="dropdown-item" href="Perfiles.php">Cambiar de perfil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../../controller/cerrarSesion.php">Cerrar sesión</a>
              </div>
            </li>
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Buscar contenido" aria-label="Search">
              <!--button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button-->
            </form>
          </ul>
        </div>
      </div>
    </nav>

    <!--Carousel De peliculas principales-->
    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-2" data-slide-to="1"></li>
        <li data-target="#carousel-example-2" data-slide-to="2"></li>
        <li data-target="#carousel-example-2" data-slide-to="3"></li>
      </ol>
      <!--/.Indicators-->
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <div class="view">
            <img class="d-block w-100 h-50" src="../../img/BannerBTTF.png"
            alt="First slide">
            <div class="mask rgba-black-light"></div>
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Volver al Futuro</h3>
            <p>AA ‧ Comedia/Ciencia ficción ‧ 1h 56m</p>
          </div>
        </div>
        <div class="carousel-item">
          <!--Mask color-->
          <div class="view">
            <img class="d-block w-100 h-50" src="../../img/BannerST.webp"
              alt="Second slide">
            <div class="mask rgba-black-strong"></div>
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Stranger Things</h3>
            <p>AA ‧ Drama ‧ 4 temporadas</p>
          </div>
        </div>
        <div class="carousel-item">
          <!--Mask color-->
          <div class="view">
            <img class="d-block w-100 h-50" src="../../img/BannerTR.jpg"
              alt="Third slide">
            <div class="mask rgba-black-slight"></div>
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Turning Red</h3>
            <p>A ‧ Infantil/Comedia ‧ 1h 40m</p>
          </div>
        </div>
        <div class="carousel-item">
          <!--Mask color-->
          <div class="view">
            <img class="d-block w-100 h-50" src="../../img/Banner13RW.jpg"
              alt="Third slide">
            <div class="mask rgba-black-slight"></div>
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Por trece razones</h3>
            <p>B ‧ Drama ‧ 4 temporadas</p>
          </div>
        </div>
      </div>
      <!--/.Slides-->
      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
      <!--/.Controls-->
    </div>
    <!--/.Carousel Wrapper-->

    <!--CARRUSEL DE CARDS CONTENIDO DE BÚSQUEDA-->
    <div id="seccion-0" style="margin-top: 30px; height: 20%;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">B&uacute;squeda</h2>
      <div id="contenidoSearch"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
        </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

        <br><br>

    <!--CARRUSEL DE CARDS CONTENIDO RECOMENDADO RECOMENDADAS-->
    <div id="seccion-1" style="margin-top: 30px;" class="d-block">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Contenido Recomendadas</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-recom"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-recom">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

    <!--CARRUSEL DE CARDS CONTENIDO AA-->
    <div id="seccion-2" style="margin-top: 30px;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Clasificaci&oacute;n AA</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-aa"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-aa">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

    <!--CARRUSEL DE CARDS CONTENIDO A-->
    <div id="seccion-3" style="margin-top: 30px;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Clasificaci&oacute;n A</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-a"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-a">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

    <!--CARRUSEL DE CARDS CONTENIDO B-->
    <div id="seccion-4" style="margin-top: 30px;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Clasificaci&oacute;n B</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-b"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-b">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

    <!--CARRUSEL DE CARDS CONTENIDO B15-->
    <div id="seccion-5" style="margin-top: 30px;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Clasificaci&oacute;n B15</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-b15"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-b15">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

    <!--CARRUSEL DE CARDS CONTENIDO C-->
    <div id="seccion-6" style="margin-top: 30px;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Clasificaci&oacute;n C</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-c"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-c">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

    <!--CARRUSEL DE CARDS CONTENIDO D-->
    <div id="seccion-7" style="margin-top: 30px;">
      <h2 style="margin-left: 50px; margin-bottom: 20px; text-size: 30px;">Clasificaci&oacute;n D</h2>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="carousel-inner">
          <div class="carousel-item active">
            <div class="cards-wrapper" id="peliculas-d"> 
              <!--SUPONE INSERSION DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <div class="carousel-item">
            <div class="cards-wrapper" id="series-d">
              <!--SUPONE INSERCIÓN DE DATOS TRAIDOS DESDE LA BD-->
            </div>
          </div>
          <a class="carousel-control-prev" id="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" id="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <!--FIN CARRUSEL DE CARDS-->

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


    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    
    <!--Referencia web a JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    
    <!-- load Bootstrap JS -->
    <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    <!-- Lógica del Frontend -->
    <script src="main.js"></script>
  </body>
</html>