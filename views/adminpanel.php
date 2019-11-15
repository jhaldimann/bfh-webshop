<?php require_once('../utilities/admin.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../dist/admin.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php if (!isset($_SESSION['admin_logged_in'])) { ?>
            <section class="admin-login-form">
                <h1 class="admin-login-title">Admin Panel Login</h1>
                <div class="field">
                    <input type="text" class="username" name="username" placeholder="Username">
                </div>
                <div class="field">
                    <input type="password" class="password" name="password" placeholder="Password">
                </div>
                <input class="login-button" type="button" onclick="checkAdminLogin()" value="Login">
          </section>
        <?php } else {?>

        <section class="product-form">
            <div>

            </div>
            <div>

            </div>
        </section>

        <?php }?>
    </body>
    <script type="application/javascript" src="../scripts/admin.js"></script>
</html>


