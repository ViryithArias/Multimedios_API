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

switch ($request_method) {
    case 'PUT':
        http_response_code(200);
        actualizarReserva();
        break;
    
    case 'POST':
        insertarReserva();
        break;
    
    case 'DELETE':
        http_response_code(200);
        cancelarReserva();
        break;
    
    case 'GET':
        if (!empty($_GET["idReserva"])) {
            $idReserva = intval($_GET["idReserva"]);
            obtenerReserva($idReserva);
        } else {
            obtenerReservas();
        }
        break;
    
    case 'OPTIONS':
        http_response_code(200);
        break;
    
    default:
        http_response_code(200);
        break;
}

function obtenerReservas() {
    global $db;
    $query = "SELECT `idReserva`, `idCliente`,`idHabitacion`, `fechaEntrada`, `fechaSalida`, `idEstado`,`fechaReserva`, `estado` FROM `MAV_Reservas`";
    $stm = $db->prepare($query);
    $stm->execute();
    $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
}

function obtenerReserva($idReserva) {
    global $db;
    $query = "
        SELECT 
            r.idReserva, r.idCliente, 
            r.idHabitacion, r.fechaEntrada, 
            r.fechaSalida, r.idEstado, r.fechaReserva, 
            r.estado, h.tipoHabitacion 
        FROM  MAV_Reservas r 
        JOIN MAV_Habitaciones h 
        ON r.idHabitacion = h.idHabitacion 
        WHERE  r.idReserva = ?";
    $stm = $db->prepare($query);
    $stm->bindParam(1, $idReserva);
    $stm->execute();
    $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
}

function insertarReserva() {
    global $db;
    $data = json_decode(file_get_contents("php://input"));
    $query = "INSERT INTO `MAV_Reservas` (`idCliente`,`idHabitacion`,`fechaEntrada`, `fechaSalida`, `idEstado`, `fechaReserva`, `estado`) VALUES (:idCliente, :idHabitacion, :fechaEntrada, :fechaSalida, :idEstado, :fechaReserva, :estado)";
    $stm = $db->prepare($query);
    $stm->bindParam(":idCliente", $data->idCliente);
    $stm->bindParam(":idHabitacion", $data->idHabitacion);
    $stm->bindParam(":fechaEntrada", $data->fechaEntrada);
    $stm->bindParam(":fechaSalida", $data->fechaSalida);
    $stm->bindParam(":fechaReserva", $data->fechaReserva);
    $stm->bindParam(":idEstado", $data->idEstado);
    $stm->bindParam(":estado", $data->estado);

    if ($stm->execute()) {
        echo json_encode(array("message" => "Datos ingresados correctamente", "code" => "success"));
    } else {
        echo json_encode(array("message" => "Datos ingresados incorrectamente", "code" => "danger"));
    }
}

function actualizarReserva() {
    global $db;
    $data = json_decode(file_get_contents("php://input"));
    $query = "UPDATE `MAV_Reservas` SET `idCliente`= :idCliente, `idHabitacion`= :idHabitacion, `fechaEntrada`= :fechaEntrada, `fechaSalida`= :fechaSalida, `idEstado`= :idEstado, `fechaReserva`= :fechaReserva ,`estado`= :estado WHERE `idReserva`= :idReserva";
    $stm = $db->prepare($query);
    $stm->bindParam(":idReserva", $data->idReserva);
    $stm->bindParam(":idCliente", $data->idCliente);
    $stm->bindParam(":idHabitacion", $data->idHabitacion);
    $stm->bindParam(":fechaEntrada", $data->fechaInicio);
    $stm->bindParam(":fechaSalida", $data->fechaSalida);
    $stm->bindParam(":idEstado", $data->idEstado);
    $stm->bindParam(":fechaReserva", $data->fechaReserva);
    $stm->bindParam(":estado", $data->estado);

    if ($stm->execute()) {
        echo json_encode(array("message" => "Datos actualizados correctamente", "code" => "success"));
    } else {
        echo json_encode(array("message" => "Datos actualizados incorrectamente", "code" => "danger"));
    }
}

function cancelarReserva() {
    global $db;
    $data = json_decode(file_get_contents("php://input"));
    
    $query = "UPDATE `MAV_Reservas` SET `estado` = 'Inactiva' WHERE `idReserva` = :idReserva";
    
    $stm = $db->prepare($query);            
    $stm->bindParam(":idReserva", $data->idReserva, PDO::PARAM_INT);

    if ($stm->execute()) {
        echo json_encode(array("message" => "Reserva cancelada correctamente", "code" => "success"));
    } else {
        echo json_encode(array("message" => "Error al cancelar la reserva", "code" => "danger"));
    }
}

?>
