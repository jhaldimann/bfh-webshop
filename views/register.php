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
            <div>
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
                <button onclick="register()" class="button">Login</button>
            </div>
        </section>
        <?php include './footer.php'; ?>
    </body>
    <link rel="stylesheet" href="../styles/register.css">
    <script type="application/javascript" src="/scripts/register.js"></script>
</html>

