<?php require_once "classes/AirQualityView.class.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>South West Air Quality</title>
    <?php include "includes/materialize.inc.php";
    include "includes/mapbox.inc.php";
    ?>
    <link rel="stylesheet" href="styles/index.css">
</head>

<?php include "includes/nav.inc.php"; ?>

<body>
    <main>
        <div class="app">
            <?php
            $AQView = new AirQualityView();
            $AQView->showPlace($_GET["query"]);
            ?>
            <div id="map">
                <div id='map' style='width: 100%; height: 600px;'></div>
            </div>
            <script>
                mapboxgl.accessToken = 'pk.eyJ1IjoibWJydXR5MSIsImEiOiJja2o3cGVhZ3kwcG1tMnBydTF2cnJpNjJ1In0.K1w4Xw2C5Y_pYSqWC0kALw';
                var map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/light-v10',
                    center: [data[1], data[0]],

                    zoom: 14
                });
                new mapboxgl.Marker({
                        color: "#0D47A1",
                        draggable: false
                    }).setLngLat([data[1], data[0]])
                    .setPopup(new mapboxgl.Popup().setHTML(
                        `<h3 class="center-align">${data[3]}</h3><p class="center-align">Particulates: ${data[2]} PM2.5m<sup>-3</sup></p>`
                        ))
                    .addTo(map);
            </script>
        </div>
    </main>
</body>
<?php include "includes/footer.inc.php"; ?>

</html>