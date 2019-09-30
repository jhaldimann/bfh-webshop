const itemsInCart = document.querySelector('#items-in-cart');
const totalPriceLabel = document.querySelector('.total-price');

function populateCart() {
  let cart = localStorage.getItem('cart');

  itemsInCart.innerHTML = '';

  cart = JSON.parse(cart);

  if(cart !== null) {
    cart.forEach((item) => {
      itemsInCart.innerHTML +=
        `<li class="cart-item">` +
        `<img class="item-image" src="${item.image}" alt="product">` +
        `<label class="item-name">${item.brand} ${item.description}</label>` +
        `<label class="item-price">${item.price} CHF</label>` +
        `<label class="item-total-price">${item.price} CHF</label>` +
        `<input onclick="calculateTotalPrice()" class="item-quantity" type="number" name="quantity" min="1" step="1" value="1">` +
        `<img class="item-remove" src="/images/remove.png" alt="remove" onclick="removeItem(${item.id})">` +
        `</li>`
    });
  } else {
    itemsInCart.innerHTML += ""
  }

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
  let quantities = document.querySelectorAll('.item-quantity');
  console.log(quantities[1].value);
  let cart = localStorage.getItem('cart');
  cart = JSON.parse(cart);
  let priceTotal = 0;

  if(cart !== null) {
    cart.forEach((item, index) => {
      priceTotal += Number(item.price) * quantities[index].value;
    });
  } else {
    totalPriceLabel.innerHTML = "0 CHF";
  }
  totalPriceLabel.innerHTML = `${priceTotal} CHF`;
  return priceTotal
}


populateCart();
