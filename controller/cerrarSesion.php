<?php

  // Elimina la sesion y la destruye
  session_start();
  session_destroy();

  header('location: ../index.php');

?>
