let dirty = false;
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
			for(let product in products) {
        if (products.hasOwnProperty(product)) {
          productTable.innerHTML +=
						`<tr onclick="selectField(${products[product]['id']})" id="product${products[product]['id']}">` +
							`<td>${products[product]['id']}</td>` +
							`<td>${products[product]['brand']}</td>` +
							`<td>${products[product]['category']}</td>` +
							`<td>${products[product]['gender']}</td>` +
							`<td>${products[product]['description']}</td>` +
							`<td>${products[product]['image']}</td>` +
							`<td><button class="op-button" onclick="deleteProduct()">x</button></td>` +
						`</tr>`;
        }
      }
		});
}

function addProduct() {
	let title = document.querySelector('.edit-title');
	title.innerHTML = 'Neues Produkt';
}

function updateProduct() {
	let id = document.querySelector('#id-input').value;
	let brand = document.querySelector('#brand-input').value;
	let category = document.querySelector('#category-input').value;
	let gender = document.querySelector('#gender-input').value;
	let description = document.querySelector('#description-input').value;
	let image = document.querySelector('#image-input').value;
	
	let formData = new FormData();
	formData.append('id', id);
	formData.append('brand', brand);
	formData.append('category', category);
	formData.append('gender', gender);
	formData.append('description', description);
	formData.append('image', image);
	formData.append('update', 'update');
	fetch('/utilities/admin.php', {method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(data) {
			console.log(data);
		});
}

function deleteProduct(id) {
	let formData = new FormData();
	formData.append('id', id);
	formData.append('delete', 'delete');
	fetch('/utilities/admin.php', {method: 'POST', body: formData})
		.then((resp) => resp.json())
		.then(function(data) {
			console.log(data);	
		});
}

function selectField(id) {
	let content = [];
	let inputFields = document.querySelector('.edit-section').querySelectorAll("input");
	
	displayFields();
	let elements = document.querySelector('#product'+id).querySelectorAll('td');
	elements.forEach((element, index) => {
		if(index < elements.length -1) {
			inputFields.item(index).value = element.innerHTML;
			content.push(inputFields.item(index).value);
			inputFields.item(index).addEventListener("change", () => {
				isDirty(content);
			});
		}
	});
	
	isDirty(content);
}

function displayFields() {
	let div = document.querySelector('.edit-section');
	div.className = "edit-section";
}

function isDirty(content) {
	let edit = document.querySelector('.edit-section');
	let inputs = edit.querySelectorAll('input');
	
	inputs.forEach((element, index) => {
		dirty = !(element.value === content[index]); 
	});
}
