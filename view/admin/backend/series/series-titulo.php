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

    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['search']) ) {
        $search = $_GET['search'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT *, R.descripcion, C.clave, C.publico, G.nombre as 'Genero' FROM serie S
        JOIN region R ON S.idRegion = R.id JOIN clasificacion C ON S.idClasificacion = C.id 
        JOIN genero G ON S.idGenero = G.id WHERE
        (S.titulo LIKE '%{$search}%') AND S.eliminado = 0";
        if ( $result = $con->query($sql) ) {
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
		$con->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>