<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../../../includes/materialize.inc.php"; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/index.css">
    <title>Southwest Air Quality</title>
</head>
<nav>
  <link rel="stylesheet" href="styles/nav.css" />
  <div class="nav-wrapper blue darken-4">
    <a href="/index.php" class="brand-logo" style="margin-left: 15px;">Southwest&nbsp;Air&nbsp;Quality</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="../../schema">Schema</a></li>
      <li><a href="../../index.php">Home</a></li>
      <li><a href="../../data.php">Data</a></li>
    </ul>
  </div>
</nav>
<nav>
    <div class="nav-wrapper blue darken-3">
        <div class="col s12">
            <a href="/schema" class="breadcrumb">Schema</a>
            <a href="/schema/aq" class="breadcrumb">aq</a>
            <a href="/schema" class="breadcrumb">pm2_5</a>
        </div>
    </div>
</nav>

<body>
    <main>
        <div class="app">
            <h2>pm2_5</h2>
            <p>Type: <a target="_blank" href="https://schema.org/Float">Float</a></p>
            <p>Description: The number of particulate material smaller than 2.5 Micrometers per m<sup>3</sup></p>
        </div>
    </main>
</body>
<?php include "../../../includes/footer.inc.php" ?>

</html>