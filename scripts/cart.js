const itemsInCart = document.querySelector('#items-in-cart');
const totalPriceLabel = document.querySelector('.total-price');

function populateCart() {
  let cart = localStorage.getItem('cart');

  itemsInCart.innerHTML = '';

  cart = JSON.parse(cart);

  cart.forEach((item) => {
    itemsInCart.innerHTML +=
    `<li class="cart-item">` +
        `<img class="item-image" src="${item.image}" alt="product">` +
        `<label class="item-name">${item.brand} ${item.description}</label>` +
        `<label class="item-price">${item.price} CHF</label>` +
        `<label class="item-total-price">${item.price} CHF</label>` +
        `<input class="item-quantity" type="number" name="quantity" min="1" step="1" value="1">` +
        `<img class="item-remove" src="/images/remove.png" alt="remove" onclick="removeItem(${item.id})">` +
    `</li>`
  });

  totalPriceLabel.innerHTML = `${calculateTotalPrice()} CHF`;
}

function removeItem(id) {
  let cart = localStorage.getItem('cart');
  cart = JSON.parse(cart);

  let item = cart.find(x => Number(x.id) === Number(id));
  if(item !== undefined) {
    console.log(`Item deleted: ${item}`);
    cart.splice(cart.indexOf(item), 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    populateCart();
  }
}

function calculateTotalPrice() {
  let cart = localStorage.getItem('cart');
  cart = JSON.parse(cart);
  let priceTotal = 0;

  cart.forEach((item) => {
    priceTotal += Number(item.price);
  });

  return priceTotal;
}


populateCart();
