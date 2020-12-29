<?php require_once "classes/AirQualityView.class.php"; ?>
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
            <?php include "includes/autocomplete.inc.php"; ?>
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#table" class="active">Table</a></li>
                    <li class="tab col s3"><a href="#map">Map</a></li>
                </ul>
            </div>
            <div id="table" class="col s12">
                <?php
                $AQView = new AirQualityView();
                $AQView->showTable();
                ?>
            </div>
            <div id="map" class="col s12">
                <div id='map' class="map"></div>
            </div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoibWJydXR5MSIsImEiOiJja2o3cGVhZ3kwcG1tMnBydTF2cnJpNjJ1In0.K1w4Xw2C5Y_pYSqWC0kALw';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/light-v10',
                    center: [-4.24305, 50.47153],

                    zoom: 9
                });
                // Get the data
                var data = [<?php $AQView->showMarkers(); ?>];

                // Get min and max
                let max = data.reduce((acc, curr) => curr[2] > acc[2] ? curr : acc)[2];
                let min = data.reduce((acc, curr) => curr[2] < acc[2] ? curr : acc)[2];

                const calcPercent = (val) => (val - min) / (max - min);

                const color1 = [255, 0, 0];
                const color2 = [0, 255, 0];
                const pickHex = (val) => {
                    let weight = calcPercent(val);
                    var w1 = weight;
                    var w2 = 1 - w1;
                    var rgb = [Math.round(color1[0] * w1 + color2[0] * w2).toString(16),
                        Math.round(color1[1] * w1 + color2[1] * w2).toString(16),
                        Math.round(color1[2] * w1 + color2[2] * w2).toString(16)];
                    rgb = rgb.map(item => item.length == 2 ? item : `0${item}` );
                    return "#" + rgb.reduce((prev, curr) => prev += curr);
                }
                data.forEach(item => {
                    item.push(pickHex(item[2]));
                });
                console.table(data);
                // Set options
                data.forEach(point => new mapboxgl.Marker({
                        color: point[4],
                        draggable: false
                    }).setLngLat([point[1], point[0]])
                    .setPopup(new mapboxgl.Popup().setHTML(`<h3 class="center-align">${point[3]}</h3><p class="center-align">Particulates: ${point[2]} PM2.5m<sup>-3</sup></p>`))
                    .addTo(map));
            </script>
        </div>
    </main>
    <?php include "includes/footer.inc.php"; ?>
    <script>
        var instance = M.Tabs.init(document.querySelector('.tabs'));
    </script>
</body>