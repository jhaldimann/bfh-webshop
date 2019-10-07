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


// Temp
var slideIndex = 1;
// Slideshow
let images = new Map();
let slideshow = new Map();
let currentSlide = 1;
let maxSlides;
const slideShowImages = document.querySelector('.slideshow-images');

let getProductImagesByCategory = () => {
  let imagesPerSlide = 5;
  let formData = new FormData;
  formData.append('getProductImagesByCategory','getProductImagesByCategory');
  formData.append('nrOfImages', imagesPerSlide);
  fetch('/utilities/helper.php', {method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then((res) => {
      console.log(res);
      let i = 1;
      for(let category in res) {
        let key = `slide${i++}`;
        images.set(key, []);
        res[category].forEach((image) => {
          images.get(key).push(image);
        });
      }
    }).then(() => {
      createSlideshow();
      showSlide(currentSlide);
  });
};

let createSlideshow = () => {
    if(images.size > 0) {
        console.log(images);
        images.forEach((element, key) => {
            let myArray = [];
            element.forEach((image) => {
                let img = document.createElement('img');
                img.src = image.image;
                img.alt = 'slideshow image';
                img.className = 'slideshow-image';
                myArray.push(img);
            });
            slideshow.set(key, myArray);
        });
        maxSlides = slideshow.size;
    }
};

let showSlide = (n) => {
    currentSlide = n;
    let key = `slide${n}`;
    slideShowImages.innerHTML = '';
    slideshow.get(key).forEach((img) => {
       slideShowImages.append(img);
    });
    console.log(slideShowImages.innerHTML);
};

let changeSlide = (v) => {
  if(currentSlide + v > maxSlides) {
    currentSlide = 1;
  } else if(currentSlide + v < 1) {
    currentSlide = maxSlides;
  } else {
    currentSlide += v;
  }
  showSlide(currentSlide);
};
