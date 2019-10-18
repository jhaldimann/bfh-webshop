<body onload="populateCart();">
    <section id="special-offers">
        <div id="special-offers-title">
            <img class="lightning" src="/images/lightning.png" alt="lightning">
            <h2>Special Offers</h2>
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
            <button class="checkout-button" onclick="getRandomPicks()">Go to checkout</button>
        </section>
    </section>
</body>
