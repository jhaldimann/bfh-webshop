<section class="checkout">
    <h2>Customer Information</h2>
    <form onsubmit="checkout(); return false;">
        <section class="user-checkout-info">
            <label>
                <input type="text" id="firstname" placeholder="Firstname" required/>
            </label>
            <label>
                <input type="text" id="lastname" placeholder="Lastname" required/>
            </label>
            <label>
                <input type="text" id="address" placeholder="Address" required/>
            </label>
            <label>
                <input type="number" id="housenr" placeholder="HouseNr" required/>
            </label>
            <label>
                <input type="number" id="zip" placeholder="Zip" required/>
            </label>
            <label>
                <input type="text" id="city" placeholder="City" required/>
            </label>
            <label>
                <input type="text" id="country" placeholder="Country" required/>
            </label>
        </section>

        <h2>Creditcard Information</h2>
        <section class="credit-card">
            <input type="text" id="cc-owner" placeholder="Owner" required/>
            <input type="text" id="cc-number" placeholder="Card Number" minlength="16" required/>
            <input type="text" id="cc-date" placeholder="Date" pattern="(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})" required/>
            <input type="text" id="cc-ccv" placeholder="CCV" minlength="3" pattern="[1-9]\d\d" required/>
        </section>

        <section>
            <button class="checkout-button" type="submit">Checkout</button>
            <div class="confirm"></div>
        </section>
    </form>
</section>
