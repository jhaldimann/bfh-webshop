<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
        <?php include './views/header.php';?>

        <section class="gender-section main-section">
            <h3>Select a category</h3> <br/>
            <a href="views/products.php?type=women">
                <div class="section">
                    <h3 class="section-title">Women</h3>
                </div>
            </a>
            <a href="views/products.php?type=men">
                <div class="section">
                    <h3 class="section-title">Men</h3>
                </div>
            </a>
            <a href="views/products.php?type=kids">
                <div class="section">
                    <h3 class="section-title">Kids</h3>
                </div>
            </a>
        </section>
        <section class="special-offers main-section">
            <div class="title">
                <img class="lightning" src="/images/lightning.png" alt="lightning">
                <h2>Special Offers</h2>
                <img class="lightning" src="/images/lightning.png" alt="lightning">
            </div>
        </section>
        <?php include 'views/footer.php'; ?>
    </body>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/index.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>


