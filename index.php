<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
        <?php include './views/header.php';?>
        <section class="search-section">
            <label>
                <input type="text" placeholder="What are you looking for?" alt="search-bar">
                <img src="images/search.png">
            </label>
        </section>
        <section class="gender-section main-section">
            <h3>Select a category</h3> <br/>
            <a href="views/products.php">
                <div class="section"></div>
            </a>
            <a href="views/products.php">
                <div class="section"></div>
            </a>
            <a href="views/products.php">
                <div class="section"></div>
            </a>
        </section>
        <section class="special-offers main-section">
            <div class="title">
                <img class="lightning" src="/images/lightning.png">
                <h2>Special Offers</h2>
                <img class="lightning" src="/images/lightning.png">
            </div>
        </section>
    </body>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>


