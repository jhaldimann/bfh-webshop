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

            foreach($products as $i => $p) {
                if($i == 3) {
                    break;
                }
                $p->render();
            }
            ?>
        </div>
    </section>
</body>
