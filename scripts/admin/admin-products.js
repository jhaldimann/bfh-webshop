let dirty = false;

// Send a request with the username and password to the backend
function checkAdminLogin() {
	// Get the input fields
	let username = document.querySelector('.username');
	let password = document.querySelector('.password');
	// Create and fill the form data
	let formData = new FormData();
	formData.append('login', 'login');
	formData.append('username', username.value);
	formData.append('password', password.value);

	// Send a request to the backend
	fetch('../utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			if (data.status === 200) {
				location.reload();
			}
		});
}

// Add new product
function addProduct() {
	// Send request to the backend 
	fetch('../utilities/admin.php', {method: 'POST', body: fillFormData('insert')})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			// Render the new data inside and clear all inputs
			reRenderTable();
			clearInputs(document.querySelector('.new-section').querySelectorAll('input'));
		});
}

// Update a single product
function updateProduct() {
	fetch('../utilities/admin.php', {method: 'POST', body: fillFormData('update')})
		.then(( resp ) => resp.text())
		.then(function ( data ) {
			console.log(data);
			reRenderTable();
		});
}

// Auto fill the form data
function fillFormData( type ) {
	// Define the names of the input fields
	let names = ['id-input', 'brand-input', 'category-input', 'description-input', 'size-input',
		'price-input', 'gender-input', 'quantity-input', 'sale-input', 'percent-input', 'image-input'];
	if (type === 'insert') {
		names.forEach(( element, index ) => {
			names[ index ] = 'new-' + element;
		})
	}

	// Get the values of the input fields
	let id = document.querySelector(`#${names[ 0 ]}`).value;
	let brand = document.querySelector(`#${names[ 1 ]}`).value;
	let category = document.querySelector(`#${names[ 2 ]}`).value;
	let description = document.querySelector(`#${names[ 3 ]}`).value;
	let size = document.querySelector(`#${names[ 4 ]}`).value;
	let price = document.querySelector(`#${names[ 5]}`).value;
	let gender = document.querySelector(`#${names[ 6]}`).value;
	let quantity = document.querySelector(`#${names[ 7 ]}`).value;
	let sale = document.querySelector(`#${names[ 8 ]}`).value;
	let percent = document.querySelector(`#${names[ 9 ]}`).value;
	let image = document.querySelector(`#${names[ 10 ]}`);

	// Append the data to the formData
	let formData = new FormData();
	formData.append('id', id);
	formData.append('brand', brand);
	formData.append('category', category);
	formData.append('description', description);
	formData.append('size', size);
	formData.append('price', price);
	formData.append('gender', gender);
	formData.append('quantity', quantity);
	formData.append('sale', sale);
	formData.append('percent', percent);
	formData.append('image', image.files[ 0 ]);
	formData.append(type, type);
	console.log(image.files);
	return formData;
}

// Delete a single product by id
function deleteProduct( id ) {
	// Fill form data
	let formData = new FormData();
	formData.append('id', id);
	formData.append('delete', 'delete');
	// Send request to backend
	fetch('../utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			console.log(data);
			window.location.reload();
		});
}

// Select a field in the table
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

// Check if form is dirty
function isDirty( content ) {
	let edit = document.querySelector('.edit-section');
	let inputs = edit.querySelectorAll('input');

	inputs.forEach(( element, index ) => {
		dirty = !(element.value === content[ index ]);
	});
}

// Rerender the existing table
function reRenderTable() {
	// Hide the table
	let table = document.querySelector('table');
	table.className += "hide";
	// Make a timeout to remove all products and reload them
	/*window.setTimeout(() => {
		table.querySelectorAll('.loaded-tr').forEach(element => {
			element.remove();
		});
		loadProducts();
		// 2000ms = 2s timeout
	}, 2000);*/
	console.log(table.className);
	window.location.reload();
}

// Clear all input fields
function clearInputs( list ) {
	list.forEach(( element ) => {
		element.value = "";
	});
}
