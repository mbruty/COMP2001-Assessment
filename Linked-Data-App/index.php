<?php require "includes/server_details.inc.php"; ?>
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

  <link rel="stylesheet" href="css/index.css">

</head>

<body>
  <?php include "includes/nav.inc.php" ?>
  <main>
    <div class="app">
      <h1>Welcome</h1>
      <p>This project aims to display air quality data from the area surrounding Plymouth, England in both Human and machiene readable ways.</p>
      <p>View the original dataset provided by <a href="https://plymouth.thedata.place/dataset/air-quality-data">Open Data Plymouth.</a></p>
      <h2>The Data</h2>
      <table class="responsive-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>PM2.5</td>
            <td>Number</td>
            <td>The number of particulate material smaller than 2.5 Micrometers per m<sup>3</sup></td>
          </tr>
          <tr>
            <td>Longitude</td>
            <td>Number</td>
            <td>The longitudeinal position of the site</td>
          </tr>
          <tr>
            <td>Latitude</td>
            <td>Number</td>
            <td>The latitudinal position of the site</td>
          </tr>
          <tr>
            <td>Type</td>
            <td>String</td>
            <td>Where the data came from (Hospital | GP)</td>
          </tr>
        </tbody>
      </table>
      <a class="btn waves-effect view-btn waves-light" href="data.php">View Data
        <i class="material-icons right">keyboard_arrow_right</i>
      </a>
      <p>Get data in JSON-LD format</p>
      <code>[HTTP GET] <a href="airquality"><?php echo getDetails(); ?>airquality</a></code>
    </div>
  </main>
  <?php include "includes/footer.inc.php" ?>
</body>

</html>