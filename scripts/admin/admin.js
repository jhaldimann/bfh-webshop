// Change the content of the admin page
let selectPage = (page) => {
	let orders = document.querySelector('.admin-orders-page');
	let users = document.querySelector('.admin-users-page');
	let products = document.querySelector('.admin-products-page');
	
	let divs = [orders, users, products];
	let element = document.querySelector('.admin-'+page+"-page");
		
	divs.forEach(el => {
		if(el === element) {
			element.classList.remove('hidden')
		} else {
			if(!el.classList.contains('hidden')){
				el.classList.add('hidden');
			}
		}
	})
	
	localStorage.setItem('page', page); 
};

let loadPage = () => {
	let page = localStorage.getItem('page');
	if(page !== null) {
		selectPage(page);
	} else {
		selectPage('products');
	}
};
