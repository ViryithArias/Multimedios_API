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
            actualizarEstado();
            break;

        case 'POST':          
            insertarEstado();
            break;
                
        case 'DELETE':
            http_response_code(200);
            eliminarEstado();
            break;
                    
        case 'GET':
                if (!empty($_GET["idEstado"])){
                    $idCliente = intval($_GET["idEstado"]);
                    obtenerEstado($idEstado);
                }
                else{
                    obtenerEstados();
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
    function obtenerEstados(){
        
        global $db;

            $query = "SELECT `idEstado`, `descripcion` FROM `MAV_Estados`";
            $stm = $db->prepare($query);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        
    }

    function obtenerEstado($idEstado){
        global $db;

            $query = "SELECT `idEstado`, `descripcion` FROM `MAV_Estados` WHERE  `idEstado`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $idEstado);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        
    }


    function insertarEstado(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO `MAV_Estados` ( `descripcion`) VALUES ( :descripcion)";
        $stm = $db->prepare($query);            
        $stm->bindParam(":descripcion", $data->descripcion);
       
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos ingresados incorrectamente", "code" => "danger"));
        }

    }


    function actualizarEstado(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `MAV_Estadoo` SET `descripcion`= :descripcion WHERE `idEstado`=:idEstado";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idEstado", $data->idEstado);
        $stm->bindParam(":descripcion", $data->descripcion);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos actualizados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos actualizados incorrectamente", "code" => "danger"));
        }

    }


    function eliminarEstado(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `MAV_Estados` WHERE `idEstado`=:idEstado";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idEstado", $data->idEstado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos eliminados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos eliminados incorrectamente", "code" => "danger"));
        }
    }



?>