const itemsInCart = document.querySelector('#items-in-cart');
const totalPriceLabel = document.querySelector('.total-price');

function populateCart() {
  let cart = localStorage.getItem('cart');

  itemsInCart.innerHTML = '';

  cart = JSON.parse(cart);

  if(cart !== null && cart.length >= 1) {
    cart.forEach((item, index) => {
      itemsInCart.innerHTML +=
        `<li class="cart-item">` +
        `<img class="item-image" src="${item.image}" alt="product">` +
        `<label class="item-name">${item.brand} ${item.description}</label>` +
        `<label class="item-price">${item.price} CHF</label>` +
        `<label class="item-total-price">${calculateTotalPriceForItem(item)} CHF</label>` +
        `<div class="quantity-selection">` +
          `<button class="quantity-count quantity-count-minus" onclick="countQuantity(-1, ${index})">-</button>` +
          `<input class="quantity-field" type="number" name="quantity" min="1" max="${item.quantity}" value="${item.selectedQuantity}">` +
          `<button class="quantity-count quantity-count-plus" onclick="countQuantity(1, ${index})">+</button>` +
        `</div>` +
        `<img class="item-remove" src="/images/remove.png" alt="remove" onclick="removeItem(${item.id})">` +
        `</li>`
    });


  } else {
    itemsInCart.innerHTML += "";
    let checkoutSection = document.querySelector('.checkout-section');

    checkoutSection.innerHTML = 'Shopping cart is empty.';
  }

  totalPriceLabel.innerHTML = `${calculateTotalPrice()} CHF`;
}

function removeItem(id) {
  let cart = localStorage.getItem('cart');
  cart = JSON.parse(cart);

  let item = cart.find(x => Number(x.id) === Number(id));
  if(item !== undefined) {
    console.log(`Item removed from cart: ${item}`);
    cart.splice(cart.indexOf(item), 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    populateCart();
  }
}

function calculateTotalPrice() {
  let cart = localStorage.getItem('cart');
  cart = JSON.parse(cart);

  let priceTotal = 0;

  if(cart !== null) {
    cart.forEach((item, index) => {
      priceTotal += Number(item.price) * Number(item.selectedQuantity);
    });
  } else {
    totalPriceLabel.innerHTML = "0 CHF";
  }

  return priceTotal;
}

function calculateTotalPriceForItem(item) {
  return Number(item.price) * Number(item.selectedQuantity);
}

function updateQuantities() {
  let cart = localStorage.getItem('cart');
  let quantities = document.querySelectorAll('.quantity-field');

  cart = JSON.parse(cart);

  cart.forEach((item, index) => {
    item.selectedQuantity = quantities[index].value;
  });

  localStorage.setItem('cart', JSON.stringify(cart));

  updateTotalPrice();
}

function countQuantity(value, id) {
  let quantityField = document.querySelectorAll('.quantity-field')[id];

  let newQuantity = Number(quantityField.value) + Number(value);

  if(newQuantity <= Number(quantityField.max) && newQuantity >= Number(quantityField.min)) {
    quantityField.value = newQuantity;
  }

  updateQuantities();
}

function updateTotalPrice() {
  let totalPrices = document.querySelectorAll('.item-total-price');
  let cart = localStorage.getItem('cart');
  cart = JSON.parse(cart);

  totalPrices.forEach((item, index) => {
    item.innerHTML = `${calculateTotalPriceForItem(cart[index])} CHF`;
  });

  totalPriceLabel.innerHTML = `${calculateTotalPrice()} CHF`
}
