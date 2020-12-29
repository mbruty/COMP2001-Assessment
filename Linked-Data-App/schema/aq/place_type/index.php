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
<?php include "../../../includes/nav.inc.php"; ?>
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
<?php include "../../../includes/footer.inc.php" ?>

</html>