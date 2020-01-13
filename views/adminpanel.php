<?php
session_start();
?>
<?php require_once('../classes/Product.class.php'); ?>
<?php require_once('../utilities/helper.php'); ?>
<?php require_once('../utilities/admin.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../dist/admin.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <script type="application/javascript" src="../scripts/admin/admin.js"></script>
        <script type="application/javascript" src="../scripts/admin/admin-products.js"></script>
        <script type="application/javascript" src="../scripts/admin/admin-users.js"></script>
        <script type="application/javascript" src="../scripts/admin/admin-orders.js"></script>
    </head>
    <body>
    <?php
    if (!isset($_SESSION['admin_logged_in'])) { ?>
        <section class="admin-login-form">
            <h1 class="admin-login-title">Admin Panel Login</h1>
            <form onsubmit="checkAdminLogin(); return false;">
                <div class="field">
                    <input type="text" class="username" name="username" placeholder="Username" required>
                </div>
                <div class="field">
                    <input type="password" class="password" name="password" placeholder="Password" required>
                </div>
                <input class="login-button" type="submit" value="Login">
            </form>
        </section>
    <?php } else { ?>
        <div class="navigation">
            <button onclick="selectPage('products')">Products</button>
            <button onclick="selectPage('orders')">Orders</button>
            <button onclick="selectPage('users')">Users</button>
        </div>
        <section class="product-form">
            <div class="admin-products-page hidden">
                <?php include('../components/admin/products.php') ?>
            </div>
            <div class="admin-orders-page hidden">
                <?php include('../components/admin/orders.php') ?>
            </div>
            <div class="admin-users-page hidden">
                <?php include('../components/admin/users.php') ?>
            </div>
        </section>
        <script>
            loadPage();
        </script>
    <?php } ?>
    </body>
</html>

<script>

</script>
