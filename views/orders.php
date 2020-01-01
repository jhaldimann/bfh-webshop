<body onload="loadOrders(<?php echo print_r($_SESSION['id'], TRUE) ?>)">
    <table class="orders">
        <tr>
            <th><?php echo t("name") ?></th>
            <th><?php echo t("lastname") ?></th>
            <th><?php echo t("address") ?></th>
            <th><?php echo t("housenumber") ?></th>
            <th><?php echo t("hash") ?></th>
        </tr>

    </table>
</body>
