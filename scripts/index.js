let getRandomPicks = () => {
	let rootElement = document.querySelector('.random-picks');
	let formData = new FormData;
	formData.append('getRandomPicks', 'getRandomPicks');
	fetch('/utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( products ) {
			for (let product in products) {
				if (products.hasOwnProperty(product)) {
					// create product div
					let productEl = document.createElement('a');
					productEl.className = 'product-link';
					productEl.href = `?site=product&id=${products[ product ][ 'id' ]}`;
					productEl.innerHTML =
						`<div class="product">` +
						`<img src="./images/uploads/${products[ product ][ 'image' ]}" alt="${products[ product ][ 'description' ]}" />` +
						`<h3>${products[ product ][ 'brand' ]} ${products[ product ][ 'category' ]}</h3>` +
						`${products[ product ][ 'sale' ] ? `<p class='percent'>Sale: <label>${products[ product ][ 'percent' ]}%</label></p>` : ''}` +
						`<p>Price: <label>${products[ product ][ 'price' ] / 100 * (100 - products[ product ][ 'percent' ])} CHF</label></p>` +
						`<p>Size: <label>${products[ product ][ 'size' ]}</label></p>` +
						`<p>Quantity: <label>${products[ product ][ 'quantity' ]}</label></p>` +
						`</div>`;
					rootElement.appendChild(productEl);
				}
			}
		});
};

let getSaleProducts = () => {
	let formData = new FormData;
	formData.append('getSaleProducts', 'getSaleProducts');
	fetch('/utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( products ) {
			products.forEach(( product, index ) => {
				// create product div
				let productEl = document.createElement('a');
				productEl.href = `?site=product&id=${product.id}`;
				productEl.innerHTML =
					`<div id="sale${index + 1}" class="product">` +
					`<img src="./images/uploads/${product.image}" alt="${product.description}" />` +
					`<h3>${product.brand} ${product.category}</h3>` +
					`<p class='percent'>Sale: <label>${product.percent}%</label></p>` +
					`<p>Price: <label>${(product.price / 100 * (100 - product.percent))} CHF</label></p>` +
					`<p>Size: <label>${product.size}</label></p>` +
					`<p>Quantity: <label>${product.quantity}</label></p>` +
					`</div>`;
				let rootElement = document.querySelector('.sale');
				rootElement.appendChild(productEl);
			});
		});
};

// Temp
var slideIndex = 1;
// Slideshow
let images = new Map();
let slideshow = new Map();
let categories = [];
let currentSlide = 1;
let timeout;

let getProductImagesByCategory = () => {
	let imagesPerSlide = 5;
	let formData = new FormData;
	formData.append('getProductImagesByCategory', 'getProductImagesByCategory');
	formData.append('nrOfImages', imagesPerSlide);
	fetch('/utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(( res ) => {
			let i = 1;
			for (let category in res) {
				categories.push(category);
				images.set(category, []);
				res[ category ].forEach(( image ) => {
					images.get(category).push(image);
				});
			}
		}).then(() => {
		createSlideshow();
		showSlide(currentSlide);
	});
};

let createSlideshow = () => {
	if (images.size > 0) {
		const navDots = document.querySelector('.nav-dots');
		let i = 0;
		images.forEach(( element, key ) => {
			let myArray = [];
			navDots.innerHTML += `<span class='dot' onclick='changeSlideTo(${i++})'>`;

			element.forEach(( image ) => {
				let img = document.createElement('img');
				img.src = 'images/uploads/' + image.image;
				img.alt = 'slideshow image';
				img.className = 'slideshow-image';
				myArray.push(img);
			});
			slideshow.set(key, myArray);
		});
		maxSlides = slideshow.size;
	}
};

let showSlide = ( n ) => {
	const slideShowImages = document.querySelector('.slideshow-images');
	clearTimeout(timeout);
	timeout = setTimeout(() => {
		changeSlide(1);
	}, 3000);
	const slideshowLink = document.querySelector('.slideshow-link');
	const slideshowCategory = document.querySelector('.slideshow-category');
	const dots = document.querySelectorAll('.dot');
	dots.forEach(( dot ) => {
		if (dot.classList.contains('active')) {
			dot.classList.remove('active');
		}
	});

	currentSlide = n;
	slideshowLink.href = `?site=products&type=${categories[ currentSlide ]}`;
	slideshowCategory.innerHTML = `${categories[ currentSlide ]}`;
	const key = categories[ currentSlide ];
	slideShowImages.innerHTML = '';
	slideshow.get(key).forEach(( img ) => {
		slideShowImages.append(img);
	});
	dots[ currentSlide ].classList.add('active');
};

let changeSlide = ( v ) => {
	if (currentSlide + v > categories.length - 1) {
		currentSlide = 0;
	} else if (currentSlide + v < 0) {
		currentSlide = categories.length - 1;
	} else {
		currentSlide += v;
	}
	showSlide(currentSlide);
};

let changeSlideTo = ( v ) => {
	if (v < categories.length && v >= 0) {
		showSlide(v);
	} else {
		console.log(`Invalid slide index: ${v}, available indecies: 0-${categories.length - 1}`);
	}
};
