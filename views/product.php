<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>GameFameClothing</title>
    </head>
    <body>
    <?php
        include('./header.php');
        include('./sidebar.php');
        include('./login.php');
    ?>
    <section class="product">
        <img id="product-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrvn5FHHEUeWRTtLIG0SMjHbla700rHzxdpw-edXUKf6YAojxE" alt="product">
        <section id="information">
            <h2 id="description-title">Description</h2>
            <p id="product-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi asperiores ducimus eos odio perspiciatis placeat quidem reprehenderit similique soluta ullam. A ab dolorem et in iusto modi, pariatur rerum veritatis.</p>
            <label id="size-selector-label" for="size-selector">Size:</label>
            <select id="size-selector">
                <option value="na">N/A</option>
            </select>
            <button id="add-to-cart">
                <img id="add-to-cart-img" src="/images/shoppingcart.png" alt="add to cart">
                <label id="add-to-cart-label"l>Add to cart</label>
            </button>
        </section>
    </section>

    <?php
        include('./footer.php');
    ?>
    </body>
    <link href="/styles/product.css" rel="stylesheet">
    <link href="/styles/global.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>