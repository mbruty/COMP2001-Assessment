<?php
require "../src/includes/server_details.inc.php";
require "../src/classes/AirQualityView.class.php";
$requestType = $_SERVER['REQUEST_METHOD'];
$AQView = new AirQualityView();
if ($requestType == "GET") {
    $context = (object)array(
        "@context" => array(
            "Place" => "https://schema.org/Place",
            "aq" => getDetails() . "schema/aq/"
        ),
        "Place" => $AQView->showArray()
    );
    header('Content-type: application/json');
    echo json_encode($context, JSON_PRETTY_PRINT);
}
