<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GameFameClothing</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dist/default.css">
    <script type="application/javascript" src="scripts/global.js"></script>
    <script type="application/javascript" src="scripts/index.js"></script>
    <script type="application/javascript" src="scripts/cart.js"></script>
    <script type="application/javascript" src="scripts/header.js"></script>
    <script type="application/javascript" src="scripts/login.js"></script>
    <script type="application/javascript" src="scripts/product.js"></script>
    <script type="application/javascript" src="scripts/register.js"></script>
    <script type="application/javascript" src="scripts/sidebar.js"></script>
    <script type="application/javascript" src="scripts/user.js"></script>
    <script type="application/javascript" src="scripts/checkout.js"></script>
    <link rel="icon" type="image/png" href="images/favicon.PNG" />
</head>
<body>
    <?php require_once('./utilities/helper.php'); ?>
    <?php include('./components/header.php'); ?>
    <?php include('./views/login.php'); ?>
    <?php
        $fn = "./views/$pageId.php";
        if (is_file($fn)) {
            include($fn);
            if($pageId != "home") {
                include('./components/sidebar.php');
            }
        }
    ?>
    <nav class="navigation-mobile hidden">
        <div class="close" onclick="toggleSidebar()"></div>
        <div id="menuToggle">
            <ul id="menu">
                <a href="/"><?php echo t("home") ?></a>
                <a href='?site=products&type=caps'><?php echo t("caps") ?></a>
                <a href='?site=products&type=shirts'><?php echo t("shirts") ?></a>
                <a href='?site=products&type=sweatshirts'><?php echo t("sweatshirts") ?></a>
                <a href='?site=products&type=socks'><?php echo t("socks") ?></a>
                <a href='?site=products&type=shoes'><?php echo t("shoes") ?></a>
            </ul>
        </div>
    </nav>
  <?php include('./components/footer.php'); ?>
</body>
</html>
