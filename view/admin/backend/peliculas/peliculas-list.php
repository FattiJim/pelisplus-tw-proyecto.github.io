<?php
    include_once __DIR__.'/../../../../model/conexion.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    function rescatar($string){
        //Asignamos los parametros de busqueda
        $buscar = array('&aacute','&eacute', '&iacute', '&oacute', '&uacute', '&Aacute', '&Eacute', '&Iacute', '&Oacute', '&Uacute', '&ntilde', '&Ntilde');
        $reemplazar = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');

        $res = str_replace($buscar, $reemplazar, $string);

        return $res;
    }

    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    if ( $result = $con->query("SELECT * FROM pelicula WHERE eliminado = 0") ) {
        // SE OBTIENEN LOS RESULTADOS
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if(!is_null($rows)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            foreach($rows as $num => $row) {
                foreach($row as $key => $value) {
                    if($key == "idGenero"){
                        if($gen = $con->query("SELECT G.nombre as 'Genero' FROM pelicula P JOIN genero G ON P.idGenero = G.id AND  P.eliminado = 0")){
                            $res = $gen->fetch_all(MYSQLI_ASSOC);
                            if(!is_null($res)){
                                foreach($res as $numi => $rowi) {
                                    foreach($rowi as $key => $valu) {
                                            $data[$numi][$key] = rescatar($valu); 
                                    }
                                }
                            }
                        }
                        $gen->free();
                    }
                    else if($key == "idRegion"){
                        if($reg = $con->query("SELECT R.descripcion as 'Region' FROM pelicula P JOIN region R ON P.idRegion = R.id AND  P.eliminado = 0")){
                            $res = $reg->fetch_all(MYSQLI_ASSOC);
                            if(!is_null($res)){
                                foreach($res as $numi => $rowi) {
                                    foreach($rowi as $key => $valu) {
                                            $data[$numi][$key] = rescatar($valu); 
                                    }
                                }
                            }
                        }
                        $reg->free();
                    }
                    else if($key == "idClasificacion"){
                        if($clas = $con->query("SELECT C.clave, C.publico FROM pelicula P JOIN clasificacion C ON P.idClasificacion = C.id AND  P.eliminado = 0")){
                            $res = $clas->fetch_all(MYSQLI_ASSOC);
                            if(!is_null($res)){
                                foreach($res as $numi => $rowi) {
                                    foreach($rowi as $key => $valu) {
                                            $data[$numi][$key] = rescatar($valu); 
                                    }
                                }
                            }
                        } 
                        $clas->free();
                    }
                    else{
                        $data[$num][$key] = rescatar($value); 
                    }
                }
            }
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($con));
    }
    $con->close();
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>