<?php
require_once "classes/Location.class.php";
class AirQualityModel {

    protected function getData() {
        $array = array();
        $csv = file_get_contents("https://plymouth.thedata.place/dataset/772613d4-21ee-406e-a694-4a1dab88e268/resource/cd162ad1-d7d5-42a9-b1ab-0edbcd697f1e/download/air-quality-by-pm2.5-score-blf.org.uk.csv");
        $data = preg_split("/\n/" , $csv);
        foreach($data  as $row) {
            array_push($array, new Location($row));
        }
        return $array;
    }
}