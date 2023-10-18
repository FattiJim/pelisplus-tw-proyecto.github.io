<?php

session_start();
if (isset($_SESSION['id'])) {
    header('location: controller/redirec.php');
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro Usuario</title>
    <!-- Font Awesome: para los iconos -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sweet Alert: alertas JavaScript presentables para el usuario (más bonitas que el alert) -->
    <link rel="stylesheet" href="css/sweetalert.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Icono.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/loginDiseño.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/cuentadis.css" media="screen" />


  </head>
  <body>
    <header>
    <footer id="footer">
      <div class="ftr-content">
          <div class="contact">
              <a href="#">© 2022 Sintax Error, Inc ITAFA.</a>
          </div>
      </div>
  </footer>
    </header>
    <!-- Formulario Login -->
    <div class="login-wrapa">
        <div class="login-htmla">
    
        <div class="col-xs-12 col-md-4 col-md-offset-4">
          <!-- Margen superior (css personalizado )-->
          <div class="spacing-1"></div>
          <div class="login-form">
          <div class="login-box">
          <h2>Crea tu usuario</h2>
          <form id="formulario_registro" >
              <div class="group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input type="text" class="form-control input" name="name" id="nombre" placeholder="Ingresa tu usuario">
              </div>
              <label class="sr-only label" for="user">Usuario</label>
              </div>

              <!-- Div espaciador -->
              <div class="spacing-2"></div>
              <div class="group">
             
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input type="password" autocomplete="off" class="form-control input" name="clave" id="pass" placeholder="Ingresa tu contraseña">
              </div>
              <label class="sr-only label" for="clave">Contraseña</label>
              </div>

              <!-- Div espaciador -->
              <div class="spacing-2"></div>
              <div class="group">
              <label class="sr-only label" for="clave">Verificar contraseña</label>
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input type="password" autocomplete="off" class="form-control input" name="clave2" id="pass2" placeholder="Verificar contraseña">
              </div>
              <label class="sr-only label" for="clave">Verificar contraseña</label>
              </div>

              <!-- Animacion -->
              <div class="row" id="load" hidden="hidden">
                <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                  <img src="img/load.gif" width="100%" alt="">
                </div>
                <div class="col-xs-12 center text-accent">
                  <span>Validando información...</span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                  <div class="spacing-2"></div>
                  <button type="button" class="btn btn-primary btn-block" name="button" id="registro">Registrate</button>
                </div>
          </form>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Jquery -->
    <script src="js/jquery.js"></script>
    <!-- SweetAlert js -->
    <script src="js/sweetalert.min.js"></script>
    <!-- Logica -->
    <script src="js/operaciones.js"></script>
    <!-- este es el de creando usuario y contraseña-->
  </body>
</html>

