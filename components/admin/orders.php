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
            <th><?php echo t('country') ?></th>
            <th><?php echo t('hash') ?></th>
            <th>UID</th>
        </tr>
        </thead>
        <tbody id="orders"></tbody>
    </table>
</div>

<script>
  getOrders();
</script>
