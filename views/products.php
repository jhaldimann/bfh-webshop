<body>
    <section class="products">
        <?php

            if(isset($_GET['type']) && $_GET['type'] == 'search') {
                $products = getProducts($_GET['type'], $_GET['searchstring']);

            } else {
                $products = getProducts($_GET['type']);
            }

            if(isset($products)) {
                foreach ($products as $product) {
                    $product->render();
                }
            } else {
                echo "<h2>".t('no-products-found')."</h2>";
            }
        ?>
    </section>
</body>
