<header class='header'>
    <img class='burger' src='/images/burger.png' alt='burger' onclick="showSidebar()">
    <a href='/'>
        <img class='home-logo' src='/images/home.png' alt='home'>
    </a>
    <h2>GameFameClothing</h2>
    <div class="dropdown-button">
        <img class='user-logo' onclick="toggleDropDown()" src='/images/user.png' alt='user'>
        <div id="user-dropdown" class="user-dropdown">
            <button class="user-login-button" onclick="toggleLoginPopup(); toggleDropDown()">Login</button>
            <a class="register-label" href="/views/register.php">New? Register Now</a>
            <hr class="horizontal-line">
            <div class="navs">
                <a class="nav-label" href="/views/user.php">My Profile</a>
                <a class="nav-label" href="#">My Orders</a>
                <a class="nav-label" href="#">Help & Contact</a>
            </div>
        </div>
    </div>
    <a href='/views/cart.php'>
        <img class='shopping-cart-logo' src='/images/shoppingcart.png' alt='shoppingcart'>
    </a>
    <link rel='stylesheet' href='/styles/header.css'>

    <section class='search-section'>
        <section class='inner-search-section'>
            <label>
                <input type='text' placeholder='What are you looking for?' alt='search-bar'>
                <img class='search-icon' src='/images/search.png'>
            </label>
        </section>
    </section>
    <script src="/scripts/header.js"> </script>
</header>
