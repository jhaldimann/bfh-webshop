<section id="login" class="login">
    <div class="login-popup">
        <div class="login-form">
            <h2 class="login-title"><?php echo t("login") ?></h2>
            <img class="close-form" onclick="toggleLoginPopup()" src="/images/close.png" alt="close form">
            <label>
                <p class="title">Email</p>
                <input type="email" name="email" class="email">
            </label>
            <label>
                <p class="title"><?php echo t("password") ?>/p>
                <input type="password" name="password" class="password">
            </label>
            <button class="button" onclick="login()"><?php echo t("login") ?></button>
            <div class="alert alert-warning"> <?php echo t("loginwrong") ?> </div>
        </div>
    </div>
</section>
