<?php
class Location {
    public $type; 
    public $pm2_5; 
    public $lat; 
    public $lon; 
    public $name;

    public function __construct($row) {
        // Extract the address as it contains ','
        $data = preg_split("/\"/", $row);
        // Split the data without the address
        $arr = preg_split("/,/", $data[0] . $data[2]);
        $this->name = $arr[0];
        $this->type = $arr[4];
        $this->pm2_5 = $arr[5];
        $this->lat = $arr[7];
        $this->lon = str_replace("\r", "", $arr[8]);
    }
}