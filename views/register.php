<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body style="text-align:center;">
        <?php include './header.php'; ?>
        <?php include './sidebar.php'; ?>
        <section class="register-form">
            <form method="post">
                <label>
                    <p class="title">Prename</p>
                    <input type="text" name="prename">
                </label>
                <label>
                    <p class="title">Name</p>
                    <input type="text" name="name">
                </label>
                <label>
                    <p class="title">Email</p>
                    <input type="email" name="email">
                </label>
                <label>
                    <p class="title">Password</p>
                    <input type="password" name="password">
                </label>
                <input type="submit" name="register" class="button" value="Send" />
            </form>
        </section>
        <?php include './footer.php'; ?>
    </body>
    <link rel="stylesheet" href="../styles/register.css">
</html>
<?php include '../utilities/register_process.php'; ?>
