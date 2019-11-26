let dirty = false;

function checkAdminLogin() {
	let username = document.querySelector('.username');
	let password = document.querySelector('.password');
	let formData = new FormData();
	formData.append('login', 'login');
	formData.append('username', username.value);
	formData.append('password', password.value);

	fetch('/utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			if (data.status === 200) {
				location.reload();
			}
		});
};

function loadProducts() {
	const productTable = document.querySelector('#products');

	let formData = new FormData();
	formData.append('getProducts', 'none');
	fetch('/utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( products ) {
			for (let product in products) {
				if (products.hasOwnProperty(product)) {
					productTable.innerHTML +=
						`<tr class="loaded-tr" onclick="selectField(${products[ product ][ 'id' ]})" id="product${products[ product ][ 'id' ]}">` +
						`<td>${products[ product ][ 'id' ]}</td>` +
						`<td>${products[ product ][ 'brand' ]}</td>` +
						`<td>${products[ product ][ 'category' ]}</td>` +
						`<td>${products[ product ][ 'gender' ]}</td>` +
						`<td>${products[ product ][ 'description' ]}</td>` +
						`<td>${products[ product ][ 'size' ]}</td>` +
						`<td>${products[ product ][ 'price' ]}</td>` +
						`<td>${products[ product ][ 'quantity' ]}</td>` +
						`<td>${products[ product ][ 'sale' ]}</td>` +
						`<td>${products[ product ][ 'image' ]}</td>` +
						`</tr>`;
				}
			}
		});
}

function addProduct() {
	fetch('/utilities/admin.php', {method: 'POST', body: fillFormData('insert')})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			reRenderTable();
			clearInputs(document.querySelector('.new-section').querySelectorAll('input'));
		});
}

function updateProduct() {
	let formData = fillFormData('update');
	console.log(formData.get('id'));
	fetch('/utilities/admin.php', {method: 'POST', body: fillFormData('update')})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			reRenderTable();
		});
}

function fillFormData( type ) {
	let names = ['id-input', 'brand-input', 'category-input', 'gender-input', 'description-input', 'size-input',
		'price-input', 'quantity-input', 'sale-input', 'image-input'];
	if (type === 'insert') {
		names.forEach(( element, index ) => {
			names[ index ] = 'new-' + element;
		})
	}

	let id = document.querySelector(`#${names[ 0 ]}`).value;
	let brand = document.querySelector(`#${names[ 1 ]}`).value;
	let category = document.querySelector(`#${names[ 2 ]}`).value;
	let gender = document.querySelector(`#${names[ 3 ]}`).value;
	let description = document.querySelector(`#${names[ 4 ]}`).value;
	let size = document.querySelector(`#${names[ 5 ]}`).value;
	let price = document.querySelector(`#${names[ 6 ]}`).value;
	let quantity = document.querySelector(`#${names[ 7 ]}`).value;
	let sale = document.querySelector(`#${names[ 8 ]}`).value;
	let image = document.querySelector(`#${names[ 9 ]}`);
	
	
	console.log(size, price);

	let formData = new FormData();
	formData.append('id', id);
	formData.append('brand', brand);
	formData.append('category', category);
	formData.append('gender', gender);
	formData.append('description', description);
	formData.append('size', size);
	formData.append('price', price);
	formData.append('quantity', quantity);
	formData.append('sale', sale);
	formData.append('image', image.files[ 0 ]);
	formData.append(type, type);
	return formData;
}

function deleteProduct( id ) {
	let formData = new FormData();
	formData.append('id', id);
	formData.append('delete', 'delete');
	fetch('/utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			console.log(data);
		});
}

function selectField( id ) {
	let content = [];
	let inputFields = document.querySelector('.edit-section').querySelectorAll("input");

	displayFields();
	let elements = document.querySelector('#product' + id).querySelectorAll('td');
	elements.forEach(( element, index ) => {
		if (index < elements.length - 1) {
			if (index === 0) {
				let deleteButton = document.querySelector('.delete-product');
				deleteButton.onclick = () => {
					deleteProduct(element.innerHTML);
				}
			}
			inputFields.item(index).value = element.innerHTML;
			content.push(inputFields.item(index).value);
			inputFields.item(index).addEventListener("change", () => {
				isDirty(content);
			});
		} else {
			document.querySelector('.image-preview').src = '../images/uploads/' + element.innerHTML;
		}
	});

	isDirty(content);
}

function displayFields() {
	let div = document.querySelector('.edit-section');
	div.className = "edit-section grid";
}

function isDirty( content ) {
	let edit = document.querySelector('.edit-section');
	let inputs = edit.querySelectorAll('input');

	inputs.forEach(( element, index ) => {
		dirty = !(element.value === content[ index ]);
	});
}

function reRenderTable() {
	let table = document.querySelector('table');
	table.className += "hide";
	window.setTimeout(() => {
		table.querySelectorAll('.loaded-tr').forEach(element => {
			element.remove();
		});
		loadProducts();

	}, 2000);
}

function clearInputs( list ) {
	list.forEach(( element ) => {
		element.value = "";
	});
}
