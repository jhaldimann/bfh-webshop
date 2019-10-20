<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../dist/style.css">
    </head>
    <body>
        <?php if (!isset($_SESSION['admin_logged_in'])) { ?>
            <section class="admin-login-form">
                <h1 class="title">Login</h1>
                <div class="field">
                    <input type="text" name="username">
                    <span data-placeholder="Username"></span>
                </div>
                <div class="field">
                    <input type="password" name="password">
                    <span data-placeholder="Password"></span>
                </div>
                <input class="login-button" type="button" onclick="" value="Login">
          </section>
        <?php }?>
    </body>
</html>


