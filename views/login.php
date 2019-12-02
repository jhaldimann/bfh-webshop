<section id="login" class="login">
    <div class="login-popup">
        <form onsubmit="login(); return false;">
            <section class="login-form">
                <img class="close-form" onclick="toggleLoginPopup()" src="./images/close.png" alt="close form">
                <h1 class="title">Login</h1>
                <div class="field">
                    <input type="email" name="email" class="email" placeholder="Email" required>
                </div>
                <div class="field">
                    <input type="password" name="password" class="password" placeholder="Password" required>
                </div>
                <input class="login-button" type="submit" <?php echo "value='";
                echo t("login");
                echo "'" ?>>
                <div class="alert alert-warning"> <?php echo t("loginwrong") ?> </div>
            </section>
        </form>
    </div>
</section>
