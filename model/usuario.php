<?php
  require_once __DIR__ . '/conexion.php';


  class Usuario extends Conexion
  {
    //Funcion de inicio de sesion
    public function login($user, $clave)
    {
      //Conexión a la base de datos
      parent::conectar();

      // El metodo salvar sirve para escapar cualquier comillas doble o simple y otros caracteres que pueden vulnerar nuestra consulta SQL
      $user  = parent::salvar($user);
      $clave = parent::salvar($clave);

      // Para filtrar las mayusculas y los acentos habilitar las lineas 18 y 19 recuerda que en la base de datos debe estar filtrado tambien para una validacion correcta
      /*$user  = parent::filtrar($user);
      $clave = parent::filtrar($clave);*/

      // traemos el id y el nombre de la tabla usuarios donde el usuario sea igual al usuario ingresado y ademas la clave sea igual a la ingresada para ese usuario.
      $consulta = 'select id, user, nivel from usuario where user="'.$user.'" and pass= MD5("'.$clave.'")';
     
      /*
        Verificamos si el usuario existe, la funcion verificarRegistros
        retorna el número de filas afectadas, en otras palabras si el
        usuario existe retornara 1 de lo contrario retornara 0
      */
      $verificar_usuario = parent::verificarRegistros($consulta);

      // si la consulta es mayor a 0 el usuario existe
      if($verificar_usuario > 0){
        //Consulta para confirmar que los datos ingresados se encuentren en la base de datos
        $user = parent::consultaArreglo($consulta); 
        session_start();

        $_SESSION['id'] = $user['id'];
        $_SESSION['user'] = $user['user'];
        $_SESSION['nivel']  = $user['nivel'];

        // Verificamos que cargo tiene l usuario y asi mismo dar la respuesta a ajax para que redireccione
        if($_SESSION['nivel'] == 1){
          echo 'view/admin/index.php';
        }else if($_SESSION['nivel'] == 2){
          echo 'view/user/Perfiles.php';
        }
    }else{
        // El usuario y la clave son incorrectos
        echo 'error_3';
      }


      //cerramos la base de datos
      parent::cerrar();
    }

    //Esta es la función para registro de usuario
    public function registroUsuario($name, $clave)
    {
      parent::conectar();

      $name  = parent::filtrar($name);
      $clave = parent::filtrar($clave);


      // validar que el user no exista
      $verificarUser = parent::verificarRegistros('select id from usuario where user="'.$name.'" ');

      //los usuario deben ser diferentes
      if($verificarUser > 0){
        echo 'error_3';
      }else{
        //Consulta oara obtener la ultima cuenta registrada, misma que nos servirá de apoyo para insertar un usuario
        $llaveforanea = parent::query('SELECT id FROM cuenta WHERE id=(SELECT max(id) FROM cuenta)');
        $row = $llaveforanea->fetch_assoc();

        //Extracciones de los resultados
        $ids = array();
        if(!is_null($row)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            foreach($row as $key => $value) {
                $ids[$key] = $value;
            }
        }

        $foranea = $ids['id']; 

        //este es el query para insertar el usuario nuevo, el 2 no se quita, por ser cliente por defecto
        parent::query('insert into usuario (id, user, pass, nivel, eliminado, idCuenta) values(null,"'.$name.'", MD5("'.$clave.'"), 2, 0,"'.$foranea.'")');
        //Cada que se crea una cuenta y por lo tanto usuario, se crea por defecto un perfil con el nombre del usuario
        //el resultado se muestra en la página de perfiles
        parent::query("INSERT INTO perfil VALUES (null, 'Español', '18', 'img/imagen1.png', 0, '{$foranea}', '{$name}')"); 
        
        
        session_start();

        $_SESSION['user'] = $name;
        $_SESSION['nivel']  = 2;

        echo 'view/user/Perfiles.php'; //Una vez que se carga la cuenta y se crea el perfil por defecto, se visualizan los perfiles

      }

      parent::cerrar();
    }

  }


?>
