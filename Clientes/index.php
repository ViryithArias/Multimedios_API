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
            actualizarCliente();
            break;

        case 'POST':          
            insertarCliente();
            break;
                
        case 'DELETE':
            http_response_code(200);
            eliminarCliente();
            break;
                    
        case 'GET':
                if (!empty($_GET["idCliente"])){
                    $idCliente = intval($_GET["idCliente"]);
                    obtenerCliente($idCliente);
                }
                else{
                    obtenerClientes();
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
    function obtenerClientes(){
        
        global $db;

            $query = "SELECT `idCliente`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `pais` FROM `MAV_Clientes`";
            $stm = $db->prepare($query);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        
    }

    function obtenerCliente($idCliente){
        global $db;

            $query = "SELECT `idCliente`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `pais` FROM `MAV_Clientes` WHERE  `idCliente`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $idCliente);
            $stm->execute();
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        
    }


    function insertarCliente(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO `MAV_Clientes` ( `nombre`, `apellido`, `email`, `telefono`, `direccion`, `pais`) VALUES ( :nombre, :apellido, :email, :telefono, :direccion, :pais)";
        $stm = $db->prepare($query);            
        $stm->bindParam(":nombre", $data->nombre);
        $stm->bindParam(":apellido", $data->apellido);
        $stm->bindParam(":email", $data->email);
        $stm->bindParam(":telefono", $data->telefono);
        $stm->bindParam(":direccion", $data->direccion);
        $stm->bindParam(":pais", $data->pais);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos ingresados incorrectamente", "code" => "danger"));
        }

    }


    function actualizarCliente(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `MAV_Clientes` SET `nombre`= :nombre, `apellido`=:apellido, `email`=:email, `telefono`=:telefono, `direccion`=:direccion, `pais`=:pais WHERE `idCliente`=:idCliente";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idCliente", $data->idCliente);
        $stm->bindParam(":nombre", $data->nombre);
        $stm->bindParam(":apellido", $data->apellido);
        $stm->bindParam(":email", $data->email);
        $stm->bindParam(":telefono", $data->telefono);
        $stm->bindParam(":direccion", $data->direccion);
        $stm->bindParam(":pais", $data->pais);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Cliente actualizado correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Cliente actualizado incorrectamente", "code" => "danger"));
        }

    }


    function eliminarCliente(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `MAV_Clientes` WHERE `idCliente`=:idCliente";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idCliente", $data->idCliente);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Cliente eliminado correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Cliente eliminado incorrectamente", "code" => "danger"));
        }
    }



?>













