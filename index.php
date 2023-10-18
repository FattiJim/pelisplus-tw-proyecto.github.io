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
    <title>Inicia Sesion</title>
    <link rel="icon" href="img/Icono.png"> 
    <!-- Font Awesome: para los iconos -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sweet Alert: alertas JavaScript presentables para el usuario (más bonitas que el alert) -->
    <link rel="stylesheet" href="css/sweetalert.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/loginDiseño.css" media="screen" />
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
    <div class="login-wrap">
        <div class="login-html">
          <div class='img'>
            <img src="img/LOGO .png"  height="100px" />
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Entrar</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registro</label>
            <div class="login-form">
              <div class="sign-in-htm">
                <form class="formulario1" id="formulario1">

                <div class="group">
                  <label class=" label" for="user">Usuario</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
              <input type="text" class="form-control input" id="user" placeholder="Ingresa tu usuario">
            </div>
                  </div>

            <div class="group">
                  <label class="label" for="pass">Contraseña</label>
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-lock"></i></div>
              <input type="password" autocomplete="off" class="form-control input" id="clave" placeholder="Ingresa tu contraseña">
            </div>
                  </div>

            <!-- Animación d espera-->
            <div class="row" id="load" hidden="hidden">
              <div class="col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">
                <img src="img/load.gif" width="100%" alt="">
              </div>
              <div class="col-xs-12 center text-accent">
                <span>Validando información...</span>
              </div>
            </div>

            <div class="row group">
              <div class="col-xs-8 col-xs-offset-2">
                <div class="spacing-2"></div>
                <button type="button" class=" button btn btn-primary btn-block" name="button" id="login">Iniciar sesion</button>
              </div>
            </div>
          </form>
          <div class="hr"></div>
            <div class="foot-lnk">
                  <a href="#forgot">Olvide mi contraseña</a>
            </div>
            </div>

              <div class="sign-up-htm">
                <div class="group">
                  <label for="user"> </label>
                    <button class="button"><a href="RegistroCuenta.html">Iniciar Registro</a></button>
              </div>

                <div class="hr"></div>
                <div class="foot-lnk">
                  <label for="tab-1"><a>Ya estoy registrado</a>
                </div>
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
  </body>
</html>