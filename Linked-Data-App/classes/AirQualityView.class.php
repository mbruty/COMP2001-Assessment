<?php
require_once "classes/AirQualityModel.class.php";
class AirQualityView extends AirQualityModel{
    public function showTable() {
        $data = $this->getData();
        // First row contains the headdings
        echo "
        <table>
            <thead>
                <tr>
                    <th>{$data[0]->type}</th>
                    <th>{$data[0]->pm2_5}</th>
                    <th>{$data[0]->lat}</th>
                    <th>{$data[0]->lon}</th>
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
}