<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
        <?php
            include('./header.php');
            include('./sidebar.php');
            include('./login.php');
            ?>
        <section id="special-offers">
            <div id="special-offers-title">
                <img class="lightning" src="/images/lightning.png" alt="lightning">
                <h2 >Special Offers</h2>
                <img class="lightning" src="/images/lightning.png" alt="lightning">
            </div>
        </section>
        <section class="cart">
            <h2>Shopping Cart</h2>
            <ol id="items-in-cart">
            </ol>
            <section class="checkout-section">
                <label>Total Price: </label>
                <label class="total-price"></label>
                <button class="checkout-button">Go to checkout</button>
            </section>
        </section>
        <?php
            include('./footer.php');
        ?>
    </body>
    <script type="application/javascript" src="/scripts/cart.js"></script>
    <link href="/styles/cart.css" rel="stylesheet">
    <link href="/styles/global.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>
