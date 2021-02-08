<?php

use function PHPSTORM_META\map;

require_once "AirQualityModel.class.php";
class AirQualityView extends AirQualityModel
{

    public function showArray()
    {
        $data = $this->getData();
        $array = array();
        array_shift($data);
        foreach ($data as $row) {
            array_push($array, (object)array(
                "@type" => "Place",
                "geo" => array(
                    "@type" => "GeoCoordinates",
                    "latitude" => $row->lat,
                    "longitude" => $row->lon,
                ),
                "name" => $row->name,
                "aq:pm2_5" => $row->pm2_5,
                "aq:place_type" => $row->type
            ));
        }
        return $array;
    }

    public function showTable()
    {
        $data = $this->getData();
        // First row contains the headdings
        echo "
        <table class=\"white\">
            <thead>
                <tr>
                    <th class=\"sticky-th\">{$data[0]->name}</th>
                    <th class=\"sticky-th\">{$data[0]->type}</th>
                    <th class=\"sticky-th\">{$data[0]->pm2_5}</th>
                    <th class=\"sticky-th\">{$data[0]->lat}</th>
                    <th class=\"sticky-th\">{$data[0]->lon}</th>
                </tr> 
            </thead>
            <tbody>
        ";
        // Remove the first row
        array_shift($data);
        foreach ($data as $row) {
            echo "
                <tr>
                    <td>
                        <a href=\"search.php?query={$row->name}\">
                        {$row->name}
                        </a>
                    </td>
                    <td>
                        {$row->type}
                    </td>
                    <td>
                        {$row->pm2_5}
                    </td>
                    <td>
                        {$row->lat}
                    </td>
                    <td>
                        {$row->lon}
                    </td
                </tr>
                ";
        }

        echo "</tbody></table>";
    }

    public function showMarkers()
    {
        $data = $this->getData();
        array_shift($data);
        foreach ($data as $row) {
            echo "[" . $row->lat . "," . $row->lon . "," . $row->pm2_5 . "," . "\"" . $row->name . "\"" . "],";
        }
    }

    public function showPlace($name)
    {
        $data = $this->getPlace($name);
        if($data != null) {
            echo "
            <table>
                <thead>
                    <th>Attribute</th>
                    <th>Value</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{$data->name}</td>
                    </tr>
                    <tr>
                        <td>PM2.5</td>
                        <td>{$data->pm2_5}</td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td>{$data->lat}</td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td>{$data->lon}</td>
                    </tr>
                </tbody>
            </table>";
            echo "<script>var data = [" . $data->lat . "," . $data->lon . "," . $data->pm2_5 . "," . "\"" . $data->name . "\"" . "]; </script>";
        } else {
            echo "<h1>Location not found</h1>";
        }
        
    }
}
