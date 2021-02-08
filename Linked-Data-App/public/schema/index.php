<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../../src/includes/materialize.inc.php"; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../styles/index.css">
    <title>Southwest Air Quality</title>
</head>
<nav>
  <link rel="stylesheet" href="styles/nav.css" />
  <div class="nav-wrapper blue darken-4">
    <a href="../index.php" class="brand-logo" style="margin-left: 15px;">Southwest&nbsp;Air&nbsp;Quality</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="../schema">Schema</a></li>
      <li><a href="../index.php">Home</a></li>
      <li><a href="../data.php">Data</a></li>
    </ul>
  </div>
</nav>
<nav>
    <div class="nav-wrapper blue darken-3">
        <div class="col s12">
            <a href="/schema" class="breadcrumb">Schema</a>
        </div>
    </div>
</nav>

<body>
    <main>
        <div class="app">
            <h2>Schema</h2>
            <table>
                <thead>
                    <th>Property</th>
                    <th>Type</th>
                    <th>Description</th>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="https://schema.org/Place" target="_blank">Place</a></td>
                        <td><a href="https://schema.org/Place" target="_blank">Place</a></td>
                        <td>The object containing data about the place</td>
                    </tr>
                    <tr>
                        <td><a href="https://schema.org/GeoCoordinates" target="_blank">geo</a></td>
                        <td><a href="https://schema.org/GeoCoordinates" target="_blank">Geo Coordinates</a></td>
                        <td>The object containing the longitude and latitude of the place</td>
                    </tr>
                    <tr>
                        <td><a href="./aq">aq</a></td>
                        <td><a href="./aq">Air Quality</a></td>
                        <td>The object containing the Air Quality data</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
<?php include "../../src/includes/footer.inc.php" ?>

</html>