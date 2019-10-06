<?php
    include('./header.php');
    include('./sidebar.php');
    include('./footer.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
    </head>
    <body onload="getProducts()">
        <section class="products">
            <?php
            $result = getProducts($_GET['type']);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<a class='product-link' href='./product.php?id=".$row['id']."'>"
                        ."<div class='product'>"
                            ."<img src=".$row['image']." alt="."'".$row['description']."'".">"
                            ."<h3 class='hover-underline'>".$row['brand']." ".$row['category']."</h3>"
                            ."<p>Price: <label>".$row['price']." CHF</label></p>"
                            ."<p>Size: <label>".$row['size']."</label></p>"
                            ."<p>Quantity: <label>".$row['quantity']."</label></p>"
                        ."</div>".
                    "</a>";
            } ?>
        </section>
    </body>
    <script type="application/javascript" src="/scripts/product.js"></script>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/products.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>
