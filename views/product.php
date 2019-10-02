<?php
    include('./header.php');
    include('./sidebar.php');
    include('./login.php');
?>
!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
    <section class="product">
        <?php
            $result = getProduct($_GET['id']);
            if ($row = mysqli_fetch_assoc($result)) {
              $quantity = $row['quantity'];
                echo "<img class='product-image' src='".$row['image']."' alt='product'>"
                    ."<section class='information'>"
                        ."<h2 class='description-title'>Product Description</h2>"
                        ."<p class='product-description'>".$row['description']."</p>"
                        ."<label class='product-brand'>".$row['brand']."</label>"
                        ."<label class='size-selector-label'>Size: </label>"
                        ."<select class='size-selector'>"
                            ."<option value='".$row['size']."'>".strtoupper($row['size'])."</option>"
                        ."</select>"
                        ."<div class='quantity-selection'>"
                          ."<button class='quantity-count quantity-count-minus' onclick='countQuantity(-1)'>-</button>"
                          ."<input class='quantity-field' type='number' name='quantity' min='1' max='".$row['quantity']."' value='1'>"
                          ."<button class='quantity-count quantity-count-plus' onclick='countQuantity(1)'>+</button>"
                        ."</div>"
                        ."<label class='product-price'>Price: ".$row['price']."</label>"
                        ."<button class='add-to-cart' onclick='addToCart(".json_encode($row).")'>"
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
    <script type="application/javascript" src="/scripts/product.js"></script>
    <link rel="stylesheet" href="/styles/quantity-selection.css">
    <link href="/styles/product.css" rel="stylesheet">
    <link href="/styles/global.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>
