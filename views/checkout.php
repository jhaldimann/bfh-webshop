<section class="checkout">
    <h2>Customer Information</h2>
    <section class="user-checkout-info">
        <label>
            <input type="text" id="name" placeholder="Name"/>
        </label>
        <label>
            <input type="text" id="prename" placeholder="Prename"/>
        </label>
        <label>
            <input type="text" id="address" placeholder="Address"/>
        </label>
        <label>
            <input type="number" id="housenr" placeholder="HouseNr"/>
        </label>
        <label>
            <input type="number" id="zip" placeholder="Zip"/>
        </label>
        <label>
            <input type="text" id="city" placeholder="City"/>
        </label>
        <label>
            <input type="text" id="country" placeholder="Country"/>
        </label>
    </section>

    <h2>Creditcard Information</h2>
    <section class="credit-card">
        <input type="text" id="cc-owner" placeholder="Owner"/>
        <input type="text" id="cc-number" placeholder="Card Number" minlength="16"/>
        <input type="text" id="cc-date" placeholder="Date" pattern="/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/"/>
        <input type="text" id="cc-ccv" placeholder="CCV" minlength="3"/>
    </section>

    <section>
        <button class="checkout-button" onclick="checkout()">Checkout</button>
        <div class="confirm"></div>
    </section>
</section>
