<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../../includes/materialize.inc.php"; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../styles/index.css">
    <title>Southwest Air Quality</title>
</head>
<?php include "../../includes/nav.inc.php"; ?>
<nav>
    <div class="nav-wrapper blue darken-3">
        <div class="col s12">
            <a href="/schema" class="breadcrumb">Schema</a>
            <a href="/schema/aq" class="breadcrumb">aq</a>
        </div>
    </div>
</nav>

<body>
    <main>
        <div class="app">
            <h2>AQ</h2>
            <table>
                <thead>
                    <th>Property</th>
                    <th>Type</th>
                    <th>Description</th>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="aq/pm2_5">pm2_5</a></td>
                        <td><a target="_blank" href="https://schema.org/Float">Float</a></td>
                        <td>The number of particulate material smaller than 2.5 Micrometers per m<sup>3</sup></td>
                    </tr>
                    <tr>
                        <td><a href="aq/place_type">place_type</a></td>
                        <td><a target="_blank" href="https://schema.org/Text">Text</a></td>
                        <td>The type of place where the data was collected. Can be either GP Practice or Hospital</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
<?php include "../../includes/footer.inc.php" ?>

</html>