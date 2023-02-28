<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/gps.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new GPS($db);
    $stmt = $items->getGPS();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        $gpsArr= array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idGPS" => $idGPS,
                "latitude" => $latitude,
                "longitude" => $longitude,
                "date" => $date
            );
            array_push($gpsArr, $e);
        }
        echo json_encode($gpsArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>