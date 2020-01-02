<div class="admin-users">
    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th><?php echo t('name') ?></th>
            <th><?php echo t('lastname') ?></th>
            <th>Email</th>
            <th><?php echo t('password') ?></th>
        </tr>
        </thead>
        <tbody id="users"></tbody>
    </table>
</div>

<script>
  loadUsers();
</script>
