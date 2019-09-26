<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
    </head>
    <body>
        <?php
            include('./header.php');
            include('./sidebar.php');
            include('./login.php');
            include('../utilities/helper.php');
            echo "<h1>".$_GET['type']."</h1>";
            ?>
        <section class="products">
            <?php
            $result = getProducts($_GET['type']);
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<a class='product-link' href='./product.php?id=".$row['id']."'>"
                        ."<div class='product'>"
                            ."<img src=".$row['image']." alt="."'".$row['description']."'".">"
                            ."<h3>".$row['brand']." ".$row['category']."</h3>"
                            ."<p>Price: <label>".$row['price']."</label></p>"
                            ."<p>Size: <label>".$row['size']."</label></p>"
                            ."<p>Quantity: <label>".$row['quantity']."</label></p>"
                        ."</div>".
                    "</a>";
            } ?>
        </section>
        <?php
            include('./footer.php');
            ?>
    </body>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/products.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>

