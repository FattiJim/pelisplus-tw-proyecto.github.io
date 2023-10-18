<?php
    include_once __DIR__.'/../../../../model/conexion.php';

    //SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );

    if(isset($_POST['titulo'])) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );

        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "SELECT * FROM serie WHERE titulo = '{$jsonOBJ->titulo}' AND eliminado = 0";
	    $result = $con->query($sql);
        
        if ($result->num_rows == 0) {
            $con->set_charset("utf8");
            $sql = "INSERT INTO serie VALUES (null, '{$jsonOBJ->titulo}', '{$jsonOBJ->numTemporadas}', '{$jsonOBJ->totalCapitulos}', 0 ,
            '{$jsonOBJ->rutaPortada}' , '{$jsonOBJ->idRegion}', '{$jsonOBJ->idClasificacion}', '{$jsonOBJ->idGenero}')";
            if($con->query($sql)){
                $data['status'] =  "success";
                $data['message'] =  "Producto agregado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($con);
            }
        }

        $result->free();
        // Cierra la conexion
        $con->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>