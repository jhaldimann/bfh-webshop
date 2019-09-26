<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
    <?php
        include('./header.php');
        include('./sidebar.php');
        include('./login.php');
        include('../utilities/helper.php');
        $isLoggedIn = true;
    ?>
    <section class="product">
        <?php
            $result = getProduct($_GET['id']);
            if ($row = mysqli_fetch_assoc($result))
            {
                echo "<img class='product-image' src='".$row['image']."' alt='product'>"
                    ."<section class='information'>"
                        ."<h2 class='description-title'>Product Description</h2>"
                        ."<p class='product-description'>".$row['description']."</p>"
                        ."<label class='product-brand'>".$row['brand']."</label>"
                        ."<select class='size-selector'>"
                            ."<option value='".$row['size']."'>".strtoupper($row['size'])."</option>"
                        ."</select>"
                        ."<label class='product-price'>Price: ".$row['price']."</label>"
                        ."<button class='add-to-cart' type='submit' name='add-to-cart'>"
                            ."<img class='add-to-cart-img' src='/images/shoppingcart.png' alt='add to cart'>"
                            ."<label class='add-to-cart-label'>Add to cart</label>"
                        ."</button>"
                    ."</section>";
        } ?>
    </section>

    <?php
        include('./footer.php');
    ?>
    </body>
    <link href="/styles/product.css" rel="stylesheet">
    <link href="/styles/global.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>