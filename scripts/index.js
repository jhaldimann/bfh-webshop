let getRandomPicks = () => {
  let rootElement = document.querySelector('.random-picks');
  let formData = new FormData;
  formData.append('getRandomPicks','getRandomPicks');
  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(products) {
        for(let product in products) {
          if(products.hasOwnProperty(product)) {
            // create product div
            let productEl = document.createElement('a');
            productEl.className = 'product-link';
            productEl.href = `./views/product.php?id=${products[product]['id']}`;
            productEl.innerHTML =
              `<div class="product">`+
              `<img src="${products[product]['image']}" alt="${products[product]['description']}" />`+
              `<h3>${products[product]['brand']} ${products[product]['category']}</h3>`+
              `${products[product]['sale'] ? `<p class='percent'>Sale: <label>${products[product]['percent']}%</label></p>` : '' }` +
              `<p>Price: <label>${ products[product]['price'] / 100 * (100 - products[product]['percent'])} CHF</label></p>` +
              `<p>Size: <label>${products[product]['size']}</label></p>` +
              `<p>Quantity: <label>${products[product]['quantity']}</label></p>` +
              `</div>`;
            rootElement.appendChild(productEl);
          }
        }
    });
  getSaleProducts();
};

let getSaleProducts = () => {
  let rootElement = document.querySelector('.sale');
  let formData = new FormData;
  formData.append('getSaleProducts','getSaleProducts');
  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(products) {
      for(let product in products) {
        if(products.hasOwnProperty(product)) {
          // create product div
          let productEl = document.createElement('div');
          productEl.className = 'product';
          productEl.innerHTML =
            `<img src="${products[product]['image']}" alt="${products[product]['description']}" />`+
            `<h3>${products[product]['brand']} ${products[product]['category']}</h3>`+
            `<p class='percent'>Sale: <label>${products[product]['percent']}%</label></p>` +
            `<p>Price: <label>${ (products[product]['price'] / 100 * (100 - products[product]['percent'])) } CHF</label></p>` +
            `<p>Size: <label>${products[product]['size']}</label></p>` +
            `<p>Quantity: <label>${products[product]['quantity']}</label></p>`;
          rootElement.appendChild(productEl);
        }
      }
    });
};


