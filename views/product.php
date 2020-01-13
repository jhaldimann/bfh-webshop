<body>
    <section class="product-details">
        <?php
            $product = getProduct($_GET['id']);

            $product->render_details();
        ?>
    </section>
    <section class="other-products">
        <h2 class="you-may-also-like"><?php echo t('you-may-also-like') ?></h2>
        <div class="same-brand">
            <?php
            $products = getProducts('search', $product->brand);
            $productsAdded = 0;

            foreach($products as $p) {
                if($p->id == $_GET['id']) {
                    continue;
                }
                if($productsAdded == 3) {
                    break;
                }
                $p->render();
                $productsAdded++;
            }
            ?>
        </div>
    </section>
</body>
