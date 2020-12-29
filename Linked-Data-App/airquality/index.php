<?php

require_once("../models/AirQualityModel.class.php");
$requestType = $_SERVER['REQUEST_METHOD'];
if($requestType == "GET") {
    $data = new AirQualityModel();
    $json = new \stdClass();
    $context = (object)array(
        "@context" => array(
            "Place" => "https://schema.org",
        ),
        "Places" => $data->getData()
    );
    header('Content-type: application/json');
    echo json_encode($context);
}