<?php
    require_once __DIR__ . '/conexion.php';

    //SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array(
        'status'  => 'Error',
        'message' => 'Ya existe una cuenta con ese correo'
    );

    $fecha = date('d-m-Y H-m-s');

    if(isset($_POST['nombre'])) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );

        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "SELECT * FROM cuenta WHERE correo = '{$jsonOBJ->correo}' AND eliminado = 0";
	    $result = $con->query($sql);
        
        if ($result->num_rows == 0) {
            $con->set_charset("utf8");
            $sql = "INSERT INTO cuenta VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->apellido}', '{$jsonOBJ->correo}', '{$jsonOBJ->tipo}', '{$jsonOBJ->pais}', '{$jsonOBJ->numTarjeta}', '{$jsonOBJ->periodicidad}', '$fecha', 0)";
            if($con->query($sql)){
                $data['status'] =  "Success";
                $data['message'] =  "La cuenta ha sido agregada exitosamente";
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