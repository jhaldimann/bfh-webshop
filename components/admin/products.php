<div class="admin-porducts">
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th><?php echo t('brand') ?></th>
            <th><?php echo t('category') ?></th>
            <th><?php echo t('gender') ?></th>
            <th><?php echo t('description') ?></th>
            <th><?php echo t('image') ?></th>
            <th> </th>
        </tr>
        </thead>
        <tbody id="products"></tbody>
    </table>
</div>

<div class="op-buttons">
    <button class="op-button" onclick="(displayFields())"><?php echo t("newProduct") ?></button>
</div>
<div class="edit-section hidden">
    <label>ID</label>
    <input type="text" id="id-input">
    <label><?php echo t('brand') ?></label>
    <input type="text" id="brand-input">
    <label><?php echo t('category') ?></label>
    <input type="text" id="category-input">
    <label><?php echo t('gender') ?></label>
    <input type="text" id="gender-input">
    <label><?php echo t('description') ?></label>
    <input type="text" id="description-input">
    <label><?php echo t('image') ?></label>
    <input type="text" id="image-input">
    <button onclick="updateProduct()">Send</button>
</div>
<script>
  loadProducts();
</script>
