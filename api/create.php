<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/html; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config/database.php';
    include_once '../class/gps.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new GPS($db);
    $item->latitude = $_GET['lt'];
    $item->longitude = $_GET['lg'];

    
    if($item->createGPS()){
        echo('GPS Data created successfully.');
    } else{
        echo('GPS Data NOT created!');
    }
?>