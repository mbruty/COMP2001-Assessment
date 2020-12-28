<?php require_once "classes/AirQualityView.class.php";?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Michael Bruty</title>
    <meta name="description" content="Linked Data App">
    <meta name="author" content="Michael Bruty">
    <link rel="stylesheet" href="styles/index.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php include "includes/materialize.inc.php"; ?>
    <?php include "includes/mapbox.inc.php"; ?>
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <?php include "includes/nav.inc.php"; ?>
    <main>
        <div class="app">
            <?php 
            $AQView = new AirQualityView();
            $AQView->showTable();
            ?>
            <div id='map' style='width: 400px; height: 400px;'></div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoibWJydXR5MSIsImEiOiJja2o3cGVhZ3kwcG1tMnBydTF2cnJpNjJ1In0.K1w4Xw2C5Y_pYSqWC0kALw';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/light-v10',
                    center: [-4.14305, 50.37153],

                    zoom: 7
                });
                // Set options
                new mapboxgl.Marker({
                        color: "#FFFFFF",
                        draggable: false
                    }).setLngLat([-4.14305, 50.37153])
                    .addTo(map);
            </script>
        </div>
    </main>
    <?php include "includes/footer.inc.php"; ?>
</body>