<?php

  session_start();
  //Iniciamos la sesion y la redirige a lapagina correcta
  if($_SESSION['nivel'] == 1){
    header('location: ../view/admin/index.php');
  }else if($_SESSION['nivel'] == 2){
    header('location: ../view/user/Perfiles.php');
  }

 ?>
