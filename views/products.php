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
                echo"<div class='product'>".$row['brand'].$row['prize']."</div>";
            }

            ?>
        </section>
        <?php
            include('./footer.php');
            ?>
    </body>
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/products.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>

