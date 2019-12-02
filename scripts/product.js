let getProductDetail = () => {
	let rootElement = document.querySelector('.product-details');
	let formData = new FormData;
	formData.append('getProduct', getUrlParam('id'));
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			rootElement.innerHTML =
				`<img class='product-image' src="./images/uploads/${data[ 'image' ]}" alt="${data[ 'description' ]}"/>` +
				`<div class="information">` +
				`<h2 class="description-title">${data[ 'brand' ] + data[ 'description' ]}</h2>` +
				`<label class='product-brand'><b>Brand: </b> ${data[ 'brand' ]} </label>` +
				`<label class='product-description'><b>Description: </b> ${data[ 'description' ]} </label>` +
				`<label class='size-selector-label'>Size: </label>` +
				`<select class="size-selector">` +
				`<option value="${data[ 'size' ]}">${data[ 'size' ]}</option>` +
				`</select>` +
				`<div class='quantity-selection'>` +
				`<button class='quantity-count quantity-count-minus' onclick='updateQuantity(-1)'>-</button>` +
				`<input class='quantity-field' type='number' name='quantity' min='1' max='${data[ 'quantity' ]}' value='1'>` +
				`<button class='quantity-count quantity-count-plus' onclick='updateQuantity(1)'>+</button>` +
				`</div>` +
				`</br>` +
				`<button class='add-to-cart' onclick='addToCart(${JSON.stringify(data)}); openDropDownWithTimeout("cart-dropdown")'>` +
				`<img class='add-to-cart-img' src='./images/shoppingcart.png' alt='add to cart'>` +
				`<label class='add-to-cart-label'>Add to cart</label></button>` +
				`</div>`;
		});
};

let getUrlParam = ( identifier ) => {
	let url = window.location.href;
	return new URL(url).searchParams.get(identifier);
};

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

let updateQuantity = ( value ) => {
	const quantityField = document.querySelector('.quantity-field');
	let newQuantity = Number(quantityField.value) + Number(value);

	if (newQuantity <= Number(quantityField.max) && newQuantity >= Number(quantityField.min)) {
		quantityField.value = newQuantity;
	}
};

let getProducts = () => {
	let rootElement = document.querySelector('.products');
	let formData = new FormData;
	formData.append('searchstring', getUrlParam('searchstring'));
	formData.append('getProducts', getUrlParam('type'));
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( products ) {
			if(products.length >= 1) {
				for (let product in products) {
					if (products.hasOwnProperty(product)) {
						rootElement.innerHTML +=
							`<a class='product-link' href='?site=product&id=${products[ product ][ 'id' ]}' >` +
							`<div class='product'>` +
							`<img src='./images/uploads/${products[ product ][ 'image' ]}' alt='${products[ product ][ 'description' ]}'>` +
							`<h3>${products[ product ][ 'brand' ]} ${products[ product ][ 'category' ]}</h3>` +
							`<p>Price: <label>${products[ product ][ 'price' ]} CHF</label></p>` +
							`<p>Size: <label>${products[ product ][ 'size' ]} </label></p>` +
							`<p>Quantity: <label>${products[ product ][ 'quantity' ]} </label></p>` +
							`</div>` +
							`</a>`;
					}
				}	
			} else {
				changePage('?site=404');
			}
		});
};
