<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../../../../src/includes/materialize.inc.php"; ?>
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
            <a href="/schema" class="breadcrumb">place_type</a>
        </div>
    </div>
</nav>

<body>
    <main>
        <div class="app">
            <h2>place_type</h2>
            <p>Type: <a target="_blank" href="https://schema.org/Text">Text</a></p>
            <p>The type of place where the data was collected. Can be either GP Practice or Hospital</p>
        </div>
    </main>
</body>
<?php include "../../../../src/includes/footer.inc.php" ?>

</html>