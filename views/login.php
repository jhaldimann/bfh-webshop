<section id="login" class="login">
    <div class="login-popup">
        <div class="login-form">
            <h2 class="login-title">Login</h2>
            <img class="close-form" onclick="toggleLoginPopup()" src="/images/close.png" alt="close form">
            <label>
                <p class="title">Email</p>
                <input type="email" name="email" class="email">
            </label>
            <label>
                <p class="title">Password</p>
                <input type="password" name="password" class="password">
            </label>
            <button class="button" onclick="login()">Login</button>
            <div class="alert alert-warning"> Login not possible </div>
        </div>
    </div>
</section>
