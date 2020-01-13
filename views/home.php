<section class="slideshow">
    <script type="text/javascript">
      getProductImagesByCategory();
    </script>
    <div class="slideshow-container">
        <span class="arrow-dot previous-arrow-dot" onclick="changeSlide(-1)"><svg
                    class="next-previous-arrow previous-arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/><path d="M0 0h24v24H0z"
                                                                                                       fill="none"/></svg></span>
        <a class="slideshow-link" href="">
            <label class="slideshow-category"></label>
            <div class="slideshow-images"></div>
        </a>
        <span class="arrow-dot next-arrow-dot" onclick="changeSlide(1)"><svg class="next-previous-arrow next-arrow"
                                                                             xmlns="http://www.w3.org/2000/svg"
                                                                             width="24" height="24" viewBox="0 0 24 24"><path
                        d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/><path d="M0 0h24v24H0z" fill="none"/></svg></span>
    </div>
    <div class="nav-dots">
    </div>
</section>
<section class="special-offers main-section">
    <div id="title" class="title">
        <img class="lightning" src="./images/lightning.png" alt="lightning">
        <h2>Special Offers</h2>
        <img class="lightning" src="./images/lightning.png" alt="lightning">
    </div>
    <div class="down-arrow bounce">
        <a href="#sales">
            <img class="down-arrow-image" src="./images/down_arrow.png" alt="down arrow">
        </a>
    </div>
    <section id="sales" class="main-section sale">
        <?php
            $products = getSaleProducts();

            foreach ($products as $product) {
                $product->render();
            }
        ?>
    </section>
</section>

