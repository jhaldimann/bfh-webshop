<section class="checkout">
    <h2><?= t("customer-info") ?></h2>
    <form onsubmit="checkout(); return false;">
        <section class="user-checkout-info"> <?php
            if(isset($_SESSION['id'])) {
                echo '<input class="hidden" id="id" value="' . print_r($_SESSION['id'], TRUE) . '"/>';
            } else {
                echo '<input class="hidden" id="id" value="0"/>';
            }?>
            <label>
                <?= "<input type='text' id='firstname' placeholder='". t("firstname") ."' required/>" ?>
            </label>
            <label>
                <?= "<input type='text' id='lastname' placeholder='". t("lastname") ."' required/>" ?>
            </label>
            <label>
               <?= " <input type='text' id='address' placeholder='". t("address") ."' required/>" ?>
            </label>
            <label>
                <?= "<input type='number' id='housenr' placeholder='". t("housenumber") ."' required/>"?>
            </label>
            <label>
                <?= "<input type='number' id='zip' placeholder='". t("zip") ."' required/>"?>
            </label>
            <label>
                <?= "<input type='text' id='city' placeholder='". t("city") ."' required/>" ?>
            </label>
            <label>
                <?= "<input type='text' id='country' placeholder='". t("country")."' required/>"?>
            </label>
        </section>

        <h2><?= t("cc-info") ?></h2>
        <section class="credit-card">
            <?= "<input type='text' id='cc-owner' placeholder='". t("owner") ."' required/>" ?>
            <?= "<input type='text' id='cc-number' placeholder='". t("cc-number") ."' minlength='16' required/>" ?>
            <?= "<input type='text' id='cc-date' placeholder='". t("cc-date") ."' pattern='(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})' required/>"?>
            <input type="text" id="cc-ccv" placeholder="CCV" minlength="3" pattern="[1-9]\d\d" required/>
        </section>

        <section>
            <button class="checkout-button" type="submit">Checkout</button>
            <div class="confirm"></div>
        </section>
    </form>
</section>
