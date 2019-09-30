<section id="login" class="login">
    <div class="login-popup">
        <form class="login-form" method="post">
            <h2 class="login-title">Login</h2>
            <img class="close-form" onclick="toggleLoginPopup()" src="/images/close.png" alt="close form">
            <label>
                <p class="title">Email</p>
                <input type="email" name="email">
            </label>
            <label>
                <p class="title">Password</p>
                <input type="password" name="password">
            </label>
            <input type="submit" name="login" class="button" value="Send" />
        </form>
    </div>
    <link rel="stylesheet" href="/styles/login.css">
</section>
