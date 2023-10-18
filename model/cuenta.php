<?php
require_once __DIR__ . '/conexion.php';

    //DATOS DE SESION PARA OBTENER LOS PERFILES CORRECTOS
    session_start();
    $nombre = $_SESSION['user'];

    //SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array();

    if(isset($_POST['usuario'])) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );

        //CONSULTA OARA OBTENER NUMERO DE PERFILES Y ID DE LA CUENTA CON LA QUE SE ESTA INGRESANDO
        $sql = "SELECT p.idCuenta FROM perfil AS p JOIN cuenta AS c ON p.idCuenta = c.id JOIN usuario AS u ON
        u.idCuenta = c.id WHERE u.user = '{$nombre}'";
        $result = $con->query($sql); 

        $row = $result->fetch_assoc();

        //EXTRACCIÓN DE LOS RESULTADOS
        $ids = array();
        if(!is_null($row)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            foreach($row as $key => $value) {
                $ids[$key] = $value;
            }
        }

        //LLAVE FORANEA QUE SERVIRÁ DE AYUDA EN INSERSIÓN DEL PERFIL
        $foranea = $ids['idCuenta']; 

        if($result->num_rows < 7){
            $con->set_charset("utf8");
            $sql = "INSERT INTO perfil VALUES (null, '{$jsonOBJ->idioma}', '{$jsonOBJ->edad}', '{$jsonOBJ->imagen}', 0, '{$foranea}', '{$jsonOBJ->usuario}')";
            if($con->query($sql)){
                $data['status'] =  "Success";
                $data['message'] =  "La cuenta ha sido agregada exitosamente";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($con);
            }
        } else {
            $data['status'] =  "Error";
            $data['message'] =  "Ha excedido el número de perfiles";
        }

        //SE LIBERA
        $result->free();
        // Cierra la conexion
        $con->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);

?>
