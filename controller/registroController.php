<?php
//esta es epara crear el usuario y contraseña
  $name   = $_POST['name'];
  $clave  = $_POST['clave'];
  $clave2 = $_POST['clave2'];

  if( empty($clave) || empty($clave2))
  {

    echo 'error_1'; // Un campo esta vacio y es obligatorio

  }else{

    if($clave == $clave2){

      if($name!='') {
      //Incluimos la clase usuario
        require_once('../model/usuario.php');
      //Creamos un objeto de la clase usuario
        $usuario = new Usuario();
      // Llamamos al metodo login para validar los datos en la base de datos
        $usuario->registroUsuario($name, $clave);
      }else{
        echo 'error_4';
      }
    }else{
      echo 'error_2';
    }

  }




?>
