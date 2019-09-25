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
            include('./views/login.php');
            ?>
        <section id="special-offers">
            <div id="special-offers-title">
                <img class="lightning" src="/images/lightning.png" alt="lightning">
                <h2 >Special Offers</h2>
                <img class="lightning" src="/images/lightning.png" alt="lightning">
            </div>
        </section>
        <section id="cart">
            <h2>Shopping Cart</h2>
            <ol id="items-in-cart">
                <li class="cart-item">
                    <img class="item-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrvn5FHHEUeWRTtLIG0SMjHbla700rHzxdpw-edXUKf6YAojxE" alt="product">
                    <label class="item-name">Item 1</label>
                    <label class="item-price">30$</label>
                    <label class="item-total-price">30£</label>
                    <input class="item-quantity" type="number" name="quantity" min="1" step="1" value="1">
                    <img class="item-remove" src="/images/remove.png" alt="remove">
                </li>
                <li class="cart-item">
                    <img class="item-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Wr3klat-GAlzEzNtVVbnl8qRC0-UdGYuUABn-TYOgpnf3MnH" alt="product">
                    <label class="item-name">Item 2</label>
                    <label class="item-price">30£</label>
                    <label class="item-total-price">30£</label>
                    <input class="item-quantity" type="number" name="quantity" min="1" step="1" value="1">
                    <img class="item-remove" src="/images/remove.png" alt="remove">
                </li>
            </ol>
            <section class="checkout-section">
                <label>Total Price: </label>
                <label class="total-price">60$</label>
                <button id="checkout-button">Go to checkout</button>
            </section>
        </section>
        <?php
            include('./footer.php');
        ?>
    </body>
    <link href="/styles/cart.css" rel="stylesheet">
    <link href="/styles/global.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>