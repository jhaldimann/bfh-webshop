<header class='header'>
    <img class='burger' src='/images/burger.png' alt='burger' onclick="showSidebar()">
    <a href='/'>
        <img class='home-logo' src='/images/home.png' alt='home'>
    </a>
    <h2>GameFameClothing</h2>
    <div id="cart-dropdown" class="cart-dropdown">
        <div class="cart"></div>
        <button class="user-button cart-button" onclick="changePage('/views/cart.php')">Shopping cart</button>
        <button class="user-button go-checkout-button">Go to checkout</button>
    </div>
    <div class="user-dropdown-button">
        <img class='user-logo' onclick="toggleDropDown('user-dropdown')" src='/images/user.png' alt='user'>
        <div id="user-dropdown" class="user-dropdown">
            <?php
            if (!isset($_SESSION['logged_in'])) {
                echo "<button class=\"user-button\" onclick=\"toggleLoginPopup(); toggleDropDown('user-dropdown')\">Login</button>";
                echo "<button class=\"user-button user-register-button\" onclick=\"changePage('/views/register.php')\">Register</button>";
            } else {
                echo "<p class='user-details'> Hello " . $_SESSION['prename'] . " " . $_SESSION['name'] . "</p>";
            }
            ?>

            <?php
            if (isset($_SESSION['logged_in'])) {
                echo "<div class=\"navs logged-in-user\"></div>";
            } else {
                echo "<div class=\"navs\"></div>";
            }
            ?>
            <?php
            if (isset($_SESSION['logged_in'])) {
                echo "<hr class=\"horizontal-line-logged-in\">";
                echo "<a class=\"nav-label\" href=\"/views/user.php\">My Profile</a>";
                echo "<a class=\"nav-label\" href=\"#\">My Orders</a>";
                echo "<a class=\"nav-label\" href=\"#\">Help & Contact</a>";
                echo "<input type=\"submit\" onclick='logout()' class=\"user-logout-button\"/>";
            } ?>
        </div>
    </div>
    <a href='/views/cart.php'>
        <img class='shopping-cart-logo' src='/images/shoppingcart.png' alt='shoppingcart'>
    </a>

    <section class='search-section'>
        <section class='inner-search-section'>
            <label>
                <input type='text' placeholder='What are you looking for?' alt='search-bar'>
                <img class='search-icon' src='/images/search.png' alt="search"/>
            </label>
        </section>
    </section>
</header>
