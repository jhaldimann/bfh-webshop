const quantityField = document.querySelector('.quantity-field');

let getProductDetail = () => {
  console.log(getUrlParam());
  let rootElement = document.querySelector('.user-info');
  let formData = new FormData;
  formData.append('getUser','getUser');
  fetch('/utilities/helper.php',{method: 'POST', body: formData})
    .then((resp) => resp.json())
    .then(function(user) {
      console.log(user);
      /*      rootElement.innerHTML =
              `<h1>Logged in as: ${user[0]['prename'] + " " + user[0]["name"]}</h1>`+
              `<p>Email: ${user[0]['email']}</p>`*/
    });
}

let getUrlParam = () => {
  let url = window.location.href;
  return new URL(url).searchParams.get('id');
};

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

let abc = () => {
  console.log("Hallo");
  getProductDetail();
}
