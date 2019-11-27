<section id="login" class="login">
    <div class="login-popup">
        <section class="login-form">
            <img class="close-form" onclick="toggleLoginPopup()" src="./images/close.png" alt="close form">
            <h1 class="title">Login</h1>
            <div class="field">
                <input type="text" name="email" class="email" placeholder="Email">
            </div>
            <div class="field">
                <input type="password" name="password" class="password" placeholder="Password">
            </div>
            <input class="login-button" type="button" onclick="login()" <?php echo "value='";
            echo t("login");
            echo "'" ?>>
            <div class="alert alert-warning"> <?php echo t("loginwrong") ?> </div>
        </section>
    </div>
</section>
