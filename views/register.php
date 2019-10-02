<?php
    include('./header.php');
    include('./sidebar.php');
    include('./login.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
        <section class="register-form">
            <form method="post">
                <label>
                    <p class="title">Firstname</p>
                    <input type="text" name="prename" required>
                </label>
                <label>
                    <p class="title">Name</p>
                    <input type="text" name="name" required>
                </label>
                <label>
                    <p class="title">Email</p>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <p class="title">Password</p>
                    <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                </label>
                <label>
                    <p class="title">Password confirm</p>
                    <input type="password" name="password-confirm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                </label>
                <input type="submit" name="register" class="button" value="Send" />
            </form>
        </section>
        <?php include './footer.php'; ?>
    </body>
    <link rel="stylesheet" href="../styles/register.css">
</html>

