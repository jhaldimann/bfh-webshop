<section class="register-form">
    <div>
        <form onsubmit="register(); return false;">
        <label>
            <p class="title"><?php echo t("firstname") ?></p>
            <input type="text" name="firstname" id="firstname" required>
        </label>
        <label>
            <p class="title"><?php echo t("lastname") ?></p>
            <input type="text" name="name" id="name" required>
        </label>
        <label>
            <p class="title">Email</p>
            <input type="email" name="email" id="email" required>
        </label>
        <label>
            <p class="title"><?php echo t("password") ?></p>
            <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </label>
        <label>
            <p class="title"><?php echo t("passwordconfirm") ?></p>
            <input type="password" name="password-confirm" id="password-confirm"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </label>
        <input type="submit" class="button">
        </form>
    </div>
</section>

