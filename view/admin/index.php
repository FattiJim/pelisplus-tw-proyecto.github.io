<?php
session_start();

// Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 1) {

    header('location: ../../index.php');
}

?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="../../css/adminDiseño.css" media="screen" />
  <link rel="icon" href="../../img/Icono.png">
  <script src="movimiento.js"></script>
    <meta charset="utf-8">
    <title>Admininistrador</title>
  </head>
  <body>

<header role="banner">
  <h1>Hola administrador <?php echo ucfirst($_SESSION['user']); ?></h1>
  <ul class="utilities">
    <br>
    <li class="users"><a href="#">My Account</a></li>
    <li class="logout warn"><a href="../../controller/cerrarSesion.php">Cerrar sesion</a></li>
  </ul>
</header>

<nav role='navigation'>
  <ul class="main">
    <li class="dashboard"><a href="#">Ver peliculas y series</a></li>
    <li class="edit"><a href="#">Editar sitio web</a></li>
    <li class="write"><a href="#">Agregar datos</a></li>
    <li class="comments"><a href="#">Mensajear</a></li>
    <li class="users"><a href="#">Ver los usuarios</a></li>
  </ul>
</nav>

<main role="main">
  <section class="panel important">
  <div class="grids">
    <!--Tarjeta 1 Peliculas-->
    <a href="peliculas.php">
    <div class="card-three">
        <div class="card">
          <div class="card__side card__side--front" id="front-3">
            <div class="text-box">
              <h3 class="text-box-top">Agregar</h3>
              <h1 class="text-box-middle">Peliculas</h1>
              <h3 class="text-box-lower">Editar y eliminar</h3>
            </div>
          </div>
        </div>
      </div>
    </a>
      <!--Tarjeta 2 series-->
      <a href="series.php">
      <div class="card-four">
        <div class="card">
          <div class="card__side card__side--front" id="front-4">
            <div class="text-box">
              <h3 class="text-box-top">Agregar</h3>
              <h1 class="text-box-middle">Series</h1>
              <h3 class="text-box-lower">Editar y eliminar</h3>
            </div>
          </div>
        </div>
      </div>
      </a>
  </div>
  </section>
</main>
  </body>
</html>
