<div class="admin-orders">
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th><?php echo t('prename') ?></th>
            <th><?php echo t('name') ?></th>
            <th><?php echo t('address') ?></th>
            <th><?php echo t('housenumber') ?></th>
            <th><?php echo t('zip') ?></th>
            <th><?php echo t('city') ?></th>
            <th><?php echo t('country') ?></th>
            <th><?php echo t('hash') ?></th>
            <th>UID</th>
        </tr>
        </thead>
        <tbody id="orders"></tbody>
    </table>
</div>

<section class="edit-or-create">
    <div class="edit-order-section grid">
        <label>ID</label>
        <input type="text" id="id-order-input">
        <label><?php echo t('name') ?></label>
        <input type="text" id="name-order-input">
        <label><?php echo t('prename') ?></label>
        <input type="text" id="prename-order-input">
        <label><?php echo t('address') ?></label>
        <input type="text" id="address-user-input">
        <label><?php echo t('housenumber') ?></label>
        <input type="text" id="housenumber-order-input">
        <label><?php echo t('zip') ?></label>
        <input type="text" id="zip-order-input">
        <label><?php echo t('city') ?></label>
        <input type="text" id="city-order-input">
        <label><?php echo t('country') ?></label>
        <input type="text" id="country-order-input">
        <button onclick="updateOrder()">Update</button>
    </div>
</section>

<script>
  getOrders();
</script>
