<?php
    include_once __DIR__.'/../../../../../model/conexion.php';

    //DATO DE SESION PARA OBTENER LOS PERFILES CORRECTOS
    session_start();
    $nombre = $_SESSION['user'];

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    function rescatar($string){
        //Asignamos los parametros de busqueda
        $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');
        $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');

        $res = str_replace($buscar, $reemplazar, $string);

        return $res;
    }

    // SE REALIZA LA QUERY DE BÚSQUEDA DE PELICULAS Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    if ( $result = $con->query("SELECT p.titulo, p.rutaPortada FROM pelicula AS p WHERE p.idClasificacion = 4") ) {
        // SE OBTIENEN LOS RESULTADOS
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if(!is_null($rows)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            foreach($rows as $num => $row) {
                foreach($row as $key => $value) {
                    $data[$num][$key] = rescatar($value);
                }
            }
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($con));
    }
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>