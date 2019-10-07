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


// Temp
var slideIndex = 1;

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
