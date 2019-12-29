// Load the product details of a single product
let getProductDetail = () => {
	let rootElement = document.querySelector('.product-details');
	let formData = new FormData;
	formData.append('getProduct', getUrlParam('id'));
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			// Create the html elements with the data inside
			rootElement.innerHTML =
				`<img class='product-image' src="./images/uploads/${data[ 'image' ]}" alt="${data[ 'description' ]}"/>` +
				`<div class="information">` +
				`<h2 class="description-title">${data[ 'brand' ] + " " + data[ 'description' ]}</h2>` +
				`<label class='product-brand'><b>Brand: </b> ${data[ 'brand' ]} </label>` +
				`<p>Price: <label>${(data[ 'price' ] / 100 * (100 - data[ 'percent' ]))} CHF</label></p>` +
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
				`</div>` +
				`<h2 class="you-may-also-like"> You may also like</h2>` +
				`<div class="same-prod"></div>`;
			productsFromSameBrand(data[ 'brand' ], data[ 'id' ]);
		}).catch(() => {
			redirect('404');
		});
};

// Add an item to the cart
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

// Get all products that match the search string or the category 
let getProducts = () => {
	let rootElement = document.querySelector('.products');
	let formData = new FormData;
	// Add the searchstring and the type of the product to the form data 
	formData.append('searchstring', getUrlParam('searchstring'));
	formData.append('getProducts', getUrlParam('type'));
	// Send request to the backend
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( products ) {
			// If there is no product to display redirect them to the 404 page
			if(products.length >= 1) {
				// Loop over all products and create html elements
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
				// Redirect to 404 page
				changePage('?site=404');
			}
		});
};

let productsFromSameBrand = (name, id) => {
	let rootElement = document.querySelector('.same-prod');
	console.log(rootElement);
	let formData = new FormData;
	formData.append('searchstring', name);
	formData.append('getProducts', 'search');
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( products ) {
			products.forEach((e, index) => {
				if(e.id !== id) {
					if(index < 4) {
						rootElement.innerHTML +=
							`<a class='product-link' href='?site=product&id=${e[ 'id' ]}' >` +
							`<div class='product'>` +
							`<img src='./images/uploads/${e[ 'image' ]}' alt='${e[ 'description' ]}'>` +
							`<h3>${e[ 'brand' ]} ${e[ 'category' ]}</h3>` +
							`<p>Price: <label>${e[ 'price' ]} CHF</label></p>` +
							`</div>` +
							`</a>`;
					}	
				}
			})
		});
};
