function checkAdminLogin() {
	let username = document.querySelector('.username');
	let password = document.querySelector('.password');
	let formData = new FormData();
	formData.append('login','login');
	formData.append('username', username.value);
	formData.append('password', password.value);

	fetch('/utilities/admin.php',{method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(data) {
			if(data.status === 200) {
				location.reload();
			}
		});
};

function loadProducts() {
	const productTable = document.querySelector('#products');

	let formData = new FormData();
	formData.append('getProducts', 'none');
	fetch('/utilities/helper.php', {method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(products) {
			console.log(products);
			for(let product in products) {
        if (products.hasOwnProperty(product)) {
          productTable.innerHTML +=
						`<tr>` +
							`<td>${products[product]['id']}</td>` +
							`<td>${products[product]['brand']}</td>` +
							`<td>${products[product]['category']}</td>` +
							`<td>${products[product]['gender']}</td>` +
							`<td>${products[product]['description']}</td>` +
							`<td>${products[product]['image']}</td>` +
						`</tr>`;
        }
      }
		});
}
