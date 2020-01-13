// Add an item to the cart
// Used in PHP do not delete!
let addToCart = ( item ) => {
	const quantityField = document.querySelector('.quantity-field');
	let cart = localStorage.getItem('cart');

	let quantity = quantityField.value;

	if (cart === null) {
		cart = [];
		item.selectedQuantity = quantity;
		cart.push(item);
	} else {
		let isInCart = false;
		item.selectedQuantity = quantity;
		cart = JSON.parse(cart);
		if (cart.find(x => x.id === item.id) === undefined) {
			cart.push(item);
		} else {
			console.log('Item already in cart!');
		}
	}

	localStorage.setItem('cart', JSON.stringify(cart));
};

// Used in PHP do not delete!
let updateQuantity = ( value ) => {
	const quantityField = document.querySelector('.quantity-field');
	let newQuantity = Number(quantityField.value) + Number(value);

	if (newQuantity <= Number(quantityField.max) && newQuantity >= Number(quantityField.min)) {
		quantityField.value = newQuantity;
	}
};
