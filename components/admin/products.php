<section class="admin-porducts">
  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th><?php echo t('brand') ?></th>
        <th><?php echo t('category') ?></th>
        <th><?php echo t('gender') ?></th>
        <th><?php echo t('description') ?></th>
        <th><?php echo t('image') ?></th>
      </tr>
    </thead>
    <tbody id="products">

    </tbody>
  </table>
  <div class="op-buttons">
    <button class="op-button" onclick="addProduct()"><?php echo t("addProduct") ?></button>
    <button class="op-button" onclick="deleteProduct()" disabled><?php echo t("deleteProduct") ?></button>
    <button class="op-button" onclick="updateProduct()" disabled><?php echo t("updateProduct") ?></button>
  </div>
</section>
<script>
  loadProducts();
</script>
