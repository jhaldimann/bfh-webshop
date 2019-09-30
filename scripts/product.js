function addToCart(item) {
    let cart = localStorage.getItem('cart');

    // TODO: get quantity

    if(cart === null) {
      cart = [];
      cart.push(item);
    } else {
      let isInCart = false;
      cart = JSON.parse(cart);
      if(cart.find(x => x.id === item.id) === undefined) {
        cart.push(item);
      } else {
        console.log('Item already in cart!');
      }
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}
