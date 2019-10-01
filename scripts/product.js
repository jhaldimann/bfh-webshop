const quantityField = document.querySelector('.quantity-field');

function addToCart(item) {
    let cart = localStorage.getItem('cart');

    let quantity = quantityField.value;

    if(cart === null) {
      cart = [];
      item.selectedQuantity = quantity;
      cart.push(item);
    } else {
      let isInCart = false;
      item.selectedQuantity = quantity;
      cart = JSON.parse(cart);
      if(cart.find(x => x.id === item.id) === undefined) {
        cart.push(item);
      } else {
        console.log('Item already in cart!');
      }
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}

function countQuantity(value) {
    let newQuantity = Number(quantityField.value) + Number(value);

    if(newQuantity <= Number(quantityField.max) && newQuantity >= Number(quantityField.min)) {
      quantityField.value = newQuantity;
  }
}
