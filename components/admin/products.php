<section class="admin-products">
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th><?php echo t('brand') ?></th>
            <th><?php echo t('category') ?></th>
            <th><?php echo t('description') ?></th>
            <th><?php echo t('size') ?></th>
            <th><?php echo t('price') ?></th>
            <th><?php echo t('gender') ?></th>
            <th><?php echo t('quantity') ?></th>
            <th><?php echo t('sale') ?></th>
            <th><?php echo t('percent') ?></th>
            <th><?php echo t('image') ?></th>
        </tr>
        </thead>
        <tbody id="products">
            <?php
                $products = getProducts('none');

                foreach ($products as $product) {
                    $product->render_admin();
                }
            ?>
        </tbody>
    </table>
</section>
<section class="edit-or-create">
    <section class="new-section grid">
        <label>Id</label>
        <input type="text" id="new-id-input">
        <label><?php echo t('brand') ?></label>
        <input type="text" id="new-brand-input">
        <label><?php echo t('category') ?></label>
        <input type="text" id="new-category-input">
        <label><?php echo t('description') ?></label>
        <input type="text" id="new-description-input">
        <label><?php echo t('size') ?></label>
        <input type="text" id="new-size-input">
        <label><?php echo t('price') ?></label>
        <input type="text" id="new-price-input">
        <label><?php echo t('gender') ?></label>
        <input type="text" id="new-gender-input">
        <label><?php echo t('quantity') ?></label>
        <input type="text" id="new-quantity-input">
        <label><?php echo t('sale') ?></label>
        <input type="text" id="new-sale-input">
        <label><?php echo t('percent') ?></label>
        <input type="text" id="new-percent-input">
        <label><?php echo t('image') ?></label>
        <input type="file" id="new-image-input">
        <div class="op-buttons">
            <button class="op-button" onclick="addProduct()"><?php echo t("newProduct") ?></button>
        </div>
    </section>
    <section class="edit-section hidden grid">
        <label>ID</label>
        <input type="text" id="id-input">
        <label><?php echo t('brand') ?></label>
        <input type="text" id="brand-input">
        <label><?php echo t('category') ?></label>
        <input type="text" id="category-input">
        <label><?php echo t('description') ?></label>
        <input type="text" id="description-input">
        <label><?php echo t('size') ?></label>
        <input type="text" id="size-input">
        <label><?php echo t('price') ?></label>
        <input type="text" id="price-input">
        <label><?php echo t('gender') ?></label>
        <input type="text" id="gender-input">
        <label><?php echo t('quantity') ?></label>
        <input type="text" id="quantity-input">
        <label><?php echo t('sale') ?></label>
        <input type="text" id="sale-input">
        <label><?php echo t('percent') ?></label>
        <input type="text" id="percent-input">
        <label><?php echo t('image') ?></label>
        <img src="" class="image-preview" alt="preview">
        <input type="file" id="image-input">
        <button onclick="updateProduct()">Update</button>
        <button class="delete-product">Delete Product</button>
    </section>
</section>
