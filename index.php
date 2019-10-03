<?php include('./views/header.php'); ?>
<?php include('./views/footer.php'); ?>
<?php include('./views/sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body onload="getRandomPicks()">
        <h2>Random Picks</h2>
        <section class="main-section random-picks">
        </section>
        <section class="special-offers main-section">
            <div class="title">
                <img class="lightning" src="/images/lightning.png" alt="lightning">
                <h2>Special Offers</h2>
                <img class="lightning" src="/images/lightning.png" alt="lightning">
            </div>
            <div class="down-arrow bounce">
              <a href="#sales">
                <img class="down-arrow-image" src="/images/down_arrow.png" alt="down arrow">
              </a>
            </div>
            <section id="sales" class="main-section sale">
            </section>
        </section>
    </body>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/products.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <script type="application/javascript" src="scripts/index.js"></script>
</html>
