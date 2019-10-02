<?php include('./views/header.php'); ?>
<?php include('./views/footer.php'); ?>
<?php include('./views/sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
        <h2>Random Picks</h2>
        <section class="main-section random-picks">
            <?php
            $result = pickRandomItem();
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a class='product-link' href='./views/product.php?id=".$row['id']."'>"
                    ."<div class='product'>"
                    ."<img src=".$row['image']." alt="."'".$row['description']."'".">"
                    ."<h3>".$row['brand']." ".$row['category']."</h3>"
                    ."<p>Price: <label>".$row['price']." CHF</label></p>"
                    ."<p>Size: <label>".$row['size']."</label></p>"
                    ."<p>Quantity: <label>".$row['quantity']."</label></p>"
                    ."</div>".
                    "</a>";
            } ?>
        </section>
        <section class="special-offers main-section">
            <div class="title">
                <img class="lightning" src="/images/lightning.png" alt="lightning">
                <h2>Special Offers</h2>
                <img class="lightning" src="/images/lightning.png" alt="lightning">
            </div>
            <section class="main-section sale">
                <?php
                $result = getSaleProducts();
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a class='product-link' href='./views/product.php?id=".$row['id']."'>"
                        ."<div class='product'>"
                        ."<img src=".$row['image']." alt="."'".$row['description']."'".">"
                        ."<h3>".$row['brand']." ".$row['category']."</h3>"
                        ."<p class='percent'>Sale: <label>".$row['percent']."%</label></p>"
                        ."<p>Price: <label>".($row['price']/100 * (100-$row['percent']))." CHF</label></p>"
                        ."<p>Size: <label>".$row['size']."</label></p>"
                        ."<p>Quantity: <label>".$row['quantity']."</label></p>"
                        ."</div>".
                        "</a>";
                } ?>
            </section>
        </section>
    </body>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/products.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>


