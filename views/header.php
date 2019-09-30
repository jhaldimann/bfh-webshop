<?php include($_SERVER['DOCUMENT_ROOT'].'/utilities/helper.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/views/login.php'); ?>
<header class='header'>
    <img class='burger' src='/images/burger.png' alt='burger' onclick="showSidebar()">
    <a href='/'>
        <img class='home-logo' src='/images/home.png' alt='home'>
    </a>
    <h2>GameFameClothing</h2>
    <div class="dropdown-button">
        <img class='user-logo' onclick="toggleDropDown()" src='/images/user.png' alt='user'>
        <div id="user-dropdown" class="user-dropdown">
            <?php
                if(!isset($_SESSION['logged_in'])) {
                    echo"<button class=\"user-login-button\" onclick=\"toggleLoginPopup(); toggleDropDown()\">Login</button>";
                    echo"<a class=\"register-label\" href=\"/views/register.php\">New? Register Now</a>";
                } else {
                    echo "<p class='user-details'> Hello ".$_SESSION['prename']." ".$_SESSION['name']."</p>";
                }
            ?>
            <hr class="horizontal-line">
            <?php
                if (isset($_SESSION['logged_in'])) {
                    echo"<div class=\"navs logged-in-user\">";
                } else {
                    echo"<div class=\"navs\">";
                }
            ?>
                <?php if(isset($_SESSION['logged_in'])) {
                    echo "<a class=\"nav-label\" href=\"/views/user.php\">My Profile</a>";
                    echo "<a class=\"nav-label\" href=\"#\">My Orders</a>";
                    echo "<input type=\"submit\" name=\"logout\" class=\"user-login-button\" value=\"Logout\" />";
                }?>
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
