<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Methods: PUT, POST, DELETE, GET, OPTIONS');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../config/database.php';

    $database = new DatabasesConexion();
    $db = $database->obtenerConexion();


    $request_method = $_SERVER["REQUEST_METHOD"];

    switch ($request_method){

        case 'PUT':
            http_response_code(200);  
            actualizarHabitacion();
            break;

        case 'POST':          
            insertarHabitacion();
            break;
                
        case 'DELETE':
            http_response_code(200);
            eliminarHabitacion();
            break;
                    
        case 'GET':
                if (!empty($_GET["idHabitacion"])){
                    $idHabitacion = intval($_GET["idHabitacion"]);
                    obtenerHabitacion($idHabitacion);
                }
                else{
                    obtenerHabitaciones();
                }
            break;
                                            
        case 'OPTIONS':
            http_response_code(200);
            break;
                            
        default:
            http_response_code(200);
            break;


    }


    //-------------------Obtener Cliente------------------------
    function obtenerHabitaciones(){
        global $db;

            $query = "SELECT `idHabitacion`, `numeroHabitacion`, `tipoHabitacion`, `descripcion`, `precioPorNoche`, `estado` FROM `MAV_Habitaciones`";
            $stm = $db->prepare($query);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        
    }

    function obtenerHabitacion($idHabitacion){
        global $db;

            $query = "SELECT `idHabitacion`, `numeroHabitacion`, `tipoHabitacion`, `descripcion`, `precioPorNoche`, `estado` FROM `MAV_Habitaciones` WHERE  `idHabitacion`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $idHabitacion);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        
    }


    function insertarHabitacion(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO `MAV_Habitaciones` (`numeroHabitacion`, `tipoHabitacion`, `descripcion`, `precioPorNoche`, `estado`) VALUES ( :numeroHabitacion, :tipoHabitacion, :descripcion, :precioPorNoche, :estado)";
        $stm = $db->prepare($query);            
        $stm->bindParam(":numeroHabitacion", $data->numeroHabitacion);
        $stm->bindParam(":tipoHabitacion", $data->tipoHabitacion);
        $stm->bindParam(":descripcion", $data->descripcion);
        $stm->bindParam(":precioPorNoche", $data->precioPorNoche);
        $stm->bindParam(":estado", $data->estado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos ingresados incorrectamente", "code" => "danger"));
        }

    }


    function actualizarHabitacion(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `MAV_Habitaciones` SET `numeroHabitacion`= :numeroHabitacion, `tipoHabitacion`=:tipoHabitacion, `descripcion`=:descripcion, `precioPorNoche`=:precioPorNoche, `estado`=:estado WHERE `idHabitacion`=:idHabitacion";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":numeroHabitacion", $data->numeroHabitacion);
        $stm->bindParam(":tipoHabitacion", $data->tipoHabitacion);
        $stm->bindParam(":descripcion", $data->descripcion);
        $stm->bindParam(":precioPorNoche", $data->precioPorNoche);
        $stm->bindParam(":estado", $data->estado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos actualizados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos actualizados incorrectamente", "code" => "danger"));
        }

    }


    function eliminarHabitacion(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `MAV_Habitaciones` WHERE `idHabitacion`=:idHabitacion";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idHabitacion", $data->idHabitacion);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos eliminados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos eliminados incorrectamente", "code" => "danger"));
        }
    }



?>

