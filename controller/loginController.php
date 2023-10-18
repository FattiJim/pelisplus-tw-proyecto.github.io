<?php

  //Leemos las variables enviadas mediante Ajax
  $user = $_POST['user_php'];
  $clave = $_POST['clave_php'];

  //verificacion que los campos no esten vacios
  if(empty($user) || empty($clave)){
  //Respuesta al error impresa en la alerta
    echo 'error_1';

  }else{
    //Incluimos la clase usuario
    require_once('../model/usuario.php');
    // Creamos un objeto de la clase usuario
    $usuario = new Usuario();
    //Llamamos al metodo login para validar los datos en la base de datos
    $usuario -> login($user, $clave);
  }


?>
