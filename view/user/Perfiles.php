<?php
  session_start();

  // Validamos que exista una session y ademas que el cargo que exista sea igual a 1 (Administrador)
  if(!isset($_SESSION['nivel']) || $_SESSION['nivel'] != 2){
    header('location: ../../index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/cssPerfiles.css">
    <link rel="icon" href="../../img/Icono.png">
    <title>Perfiles</title>
</head>
<header>
  <div class="nuestro-logo">
    <img src="../../img/LOGO .png" height="150px" width="100"/>
  </div>
</header>
<body>
    <div class="list-profile" >
        <h1 class="list-profile-title">¿Quién esta viendo?</h1>
        
        <div class="list-profile" id="lista-perfiles">
        </div>
    </div>

    <!--Referencia web a JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <!-- Lógica del Frontend -->
    <script src="app_perfiles.js"></script>
</body>
</html>