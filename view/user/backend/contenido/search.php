<?php
    include_once __DIR__.'/../../../../model/conexion.php';

    //DATO DE SESION PARA OBTENER LOS PERFILES CORRECTOS
    session_start();
    $nombre = $_SESSION['user'];

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    $peliculas = array();
    $series = array();

    function rescatar($string){
        //Asignamos los parametros de busqueda
        $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');
        $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');

        $res = str_replace($buscar, $reemplazar, $string);

        return $res;
    }

    if( isset($_GET['search']) ) {
        $search = $_GET['search'];
        // SE REALIZA LA QUERY DE BÚSQUEDA DE PELICULAS Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $con->query("SELECT *, R.descripcion, C.clave, C.publico, G.nombre as 'Genero' FROM pelicula P 
        JOIN region R ON P.idRegion = R.id JOIN clasificacion C ON P.idClasificacion = C.id 
        JOIN genero G ON P.idGenero = G.id WHERE
        (P.titulo LIKE '%{$search}%' OR R.descripcion LIKE '%{$search}%' OR C.clave LIKE '%{$search}%' OR C.publico LIKE '%{$search}%') AND P.eliminado = 0") ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $peliculas[$num][$key] = rescatar($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($con));
        }

        // SE REALIZA LA QUERY DE BÚSQUEDA DE PELICULAS Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if($result2 = $con->query("SELECT *, R.descripcion, C.clave, C.publico, G.nombre as 'Genero' FROM serie S
        JOIN region R ON S.idRegion = R.id JOIN clasificacion C ON S.idClasificacion = C.id 
        JOIN genero G ON S.idGenero = G.id WHERE
        (S.titulo LIKE '%{$search}%' OR R.descripcion LIKE '%{$search}%' OR C.clave LIKE '%{$search}%' OR C.publico LIKE '%{$search}%') AND S.eliminado = 0")){
            $rows2 = $result2->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows2)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows2 as $num => $row) {
                    foreach($row as $key => $value) {
                        $series[$num][$key] = rescatar($value);
                    }
                }
            }
            $result2->free();
        } else {
            die('Query Error: '.mysqli_error($con));
        }
        $con->close();
    }

    //UNIENDO AMBOS ARREGLOS PARA SER MANDADOS
    $data = array_merge($peliculas, $series);
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>