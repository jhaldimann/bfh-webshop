<body onload="populateCart();">
    <section class="cart">
        <h2><?php echo t("cart") ?></h2>
        <ol id="items-in-cart">
        </ol>
        <section class="checkout-section">
            <label><?php echo t("totalprice") ?>: </label>
            <label class="total-price"></label>
            <button class="checkout-button" onclick="redirect('checkout')"><?php echo t("checkout") ?></button>
        </section>
    </section>
</body>
