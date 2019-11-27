<header class='header'>
    <img class='burger' src='./images/burger.png' alt='burger' onclick="showSidebar()">
    <a href='/'>
        <img class='home-logo' src='./images/home.png' alt='home'>
    </a>
    <div id="cart-dropdown" class="cart-dropdown">
        <div class="cart"></div>
        <button class="user-button cart-button" onclick="changePage('?site=cart')">Shopping cart</button>
        <button class="user-button go-checkout-button">Go to checkout</button>
    </div>
    <div class="user-dropdown-button">
        <img class='user-logo' onclick="toggleDropDown('user-dropdown')" src='./images/user.png' alt='user'>
        <div id="user-dropdown" class="user-dropdown">
            <?php
            if (!isset($_SESSION['logged_in'])) {
                echo "<button class=\"user-button\" onclick=\"toggleLoginPopup(); toggleDropDown('user-dropdown')\">"; echo t('login'); echo "</button>";
                echo "<button class=\"user-button user-register-button\" onclick=\"changePage('?site=register')\">"; echo t('register'); echo "</button>";
            } else {
                echo "<p class='user-details'>"; echo t("hello"); echo $_SESSION['prename'] . " " . $_SESSION['name'] . "</p>";
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
                echo "<a class=\"nav-label\" href=\"?site=user\">";echo t("myprofil");"</a>";
                echo "<a class=\"nav-label\" href=\"#\">"; echo t("myorders");"</a>";
                echo "<a class=\"nav-label\" href=\"#\">"; echo t("helpandcontact"); "</a>";
                echo "<input type=\"submit\" onclick='logout()' value=\" "; echo t("logout"); echo"\" class=\"user-logout-button\"/>";
            } ?>
        </div>
    </div>
    <a href='?site=cart'>
        <img class='shopping-cart-logo' src='./images/shoppingcart.png' alt='shoppingcart'>
    </a>

    <section class='search-section'>
        <section class='inner-search-section'>
            <div class="search-box">
                <?php echo"<input class=\"search-text\" type=\"text\" onkeyup=\"changeLink(event)\" placeholder='"; echo t("lookingfor"); echo"' alt='search-bar'></input>"; ?>
                <a class="search-link">
                    <img class='search-icon' src='./images/search.png' alt="search"/>
                </a>
            </div>
        </section>
    </section>
    <section class="categories">
        <a href='?site=products&type=caps' class="hover-underline-animation"><p><?php echo t('caps') ?></p></a>
        <a href='?site=products&type=shirts' class="hover-underline-animation"><p><?php echo t('shirts') ?></p></a>
        <a href='?site=products&type=sweatshirts' class="hover-underline-animation"><p><?php echo t('sweatshirts') ?></p></a>
        <a href='?site=products&type=socks' class="hover-underline-animation"><p><?php echo t('socks') ?></p></a>
        <a href='?site=products&type=shoes' class="hover-underline-animation"><p><?php echo t('shoes') ?></p></a>
    </section>
</header>
