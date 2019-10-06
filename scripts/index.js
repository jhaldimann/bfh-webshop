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
};

let getSaleProducts = () => {
  let rootElement = document.querySelector('.sale');
  let formData = new FormData;
  formData.append('getSaleProducts','getSaleProducts');
  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(products) {
      products.forEach((product, index) => {
          // create product div
          let productEl = document.createElement('div');
          productEl.className = 'product';
          productEl.id =`sale${index+1}`;
          productEl.innerHTML =
            `<img src="${product.image}" alt="${product.description}" />`+
            `<h3>${product.brand} ${product.category}</h3>`+
            `<p class='percent'>Sale: <label>${product.percent}%</label></p>` +
            `<p>Price: <label>${ (product.price / 100 * (100 - product.percent)) } CHF</label></p>` +
            `<p>Size: <label>${product.size}</label></p>` +
            `<p>Quantity: <label>${product.quantity}</label></p>`;
          rootElement.appendChild(productEl);
      });
    });
};


// Slideshow
let images = new Map();

let getProductImages = () => {
  let imagesPerSlide = 5;
  let nrOfSlides = 3;
  let formData = new FormData;
  formData.append('getProductImages','getProductImages');
  formData.append('nrOfImages', imagesPerSlide * nrOfSlides);
  fetch('/utilities/helper.php', {method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(imgs) {
      let i = 0;
      imgs.forEach((image, index) => {
        if(index % 5 === 0) {
          images.set(`slide${++i}`, []);
        }
        images.get(`slide${i}`).push(image);
      });
      console.log(images);
    });
};

let createSlideshow = () => {

};
