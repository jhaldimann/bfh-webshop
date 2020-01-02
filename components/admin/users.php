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

<section class="edit-or-create">
    <div class="edit-user-section grid">
        <label>ID</label>
        <input type="text" id="id-user-input">
        <label><?php echo t('name') ?></label>
        <input type="text" id="name-user-input">
        <label><?php echo t('lastname') ?></label>
        <input type="text" id="lastname-user-input">
        <label>Email</label>
        <input type="text" id="email-user-input">
        <label><?php echo t('password') ?></label>
        <input type="text" id="password-user-input">
        <button onclick="updateUser()">Update</button>
    </div>
</section>

<script>
  loadUsers();
</script>
