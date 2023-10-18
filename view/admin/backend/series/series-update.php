<?php
    include_once __DIR__.'/../../../../model/conexion.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );

    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['idSerie']) ) {
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql =  "UPDATE serie SET titulo='{$jsonOBJ->titulo}', numTemporadas='{$jsonOBJ->numTemporadas}',
        totalCapitulos='{$jsonOBJ->totalCapitulos}', rutaPortada='{$jsonOBJ->rutaPortada}', 
        idRegion={$jsonOBJ->idRegion}, idClasificacion='{$jsonOBJ->idClasificacion}',
        idGenero='{$jsonOBJ->idGenero}' WHERE idSerie='{$jsonOBJ->idSerie}'";
        $con->set_charset("utf8");
        if ( $con->query($sql) ) {
            $data['status'] =  "success";
            $data['message'] =  "Producto actualizado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($con);
        }
		$con->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>