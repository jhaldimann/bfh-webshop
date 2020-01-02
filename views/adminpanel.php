<?php
session_start();
?>
<?php require_once('../utilities/helper.php'); ?>
<?php require_once('../utilities/admin.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../dist/admin.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <script type="application/javascript" src="../scripts/admin-products.js"></script>
        <script type="application/javascript" src="../scripts/admin-users.js"></script>
        <script type="application/javascript" src="../scripts/admin-orders.js"></script>
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
        <div>
            <a href="#">Products</a>
            <a href="#">Users</a>
            <a href="#">Orders</a>
        </div>
        <section class="product-form">
            <?php include('../components/admin/users.php') ?>
        </section>
    <?php } ?>
    </body>
</html>
