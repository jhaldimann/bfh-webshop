let getOrders = () => {
	const orderTable = document.querySelector('#orders');
	// Fill form data
	let formData = new FormData();
	formData.append('getOrders', 'getOrders');
	// Send request to the backend
	fetch('../utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( orders ) {
			for (let order in orders) {
				if (orders.hasOwnProperty(order)) {
					// Create table rows with the result data
					orderTable.innerHTML +=
						`<tr class="loaded-tr" onclick="fillOrderFields(${orders[ order ][ 'id' ]})" id="order${orders[ order ][ 'id' ]}">` +
						`<td>${orders[ order ][ 'id' ]}</td>` +
						`<td>${orders[ order ][ 'prename' ]}</td>` +
						`<td>${orders[ order ][ 'name' ]}</td>` +
						`<td>${orders[ order ][ 'address' ]}</td>` +
						`<td>${orders[ order ][ 'housenumber' ]}</td>` +
						`<td>${orders[ order ][ 'zip' ]}</td>` +
						`<td>${orders[ order ][ 'city' ]}</td>` +
						`<td>${orders[ order ][ 'country' ]}</td>` +
						`<td>${orders[ order ][ 'hash' ]}</td>` +
						`<td>${orders[ order ][ 'uid' ]}</td>` +
						`</tr>`;
				}
			}
		});
};

let fillOrderFields = (id) => {
	let content = [];
	let inputFields = document.querySelector('.edit-order-section').querySelectorAll("input");

	let tds = document.querySelector('#order' + id).querySelectorAll('td');
	tds.forEach(( element, index ) => {
		if(index < tds.length - 1) {
			inputFields.item(index).value = element.innerHTML;
			content.push(inputFields.item(index).value);	
		}
	});
};

let updateOrder = () => {
	let inputFields = document.querySelector('.edit-order-section').querySelectorAll("input");
	let formData = new FormData;
	formData.append('id',inputFields[0].value);
	formData.append('prename',inputFields[1].value);
	formData.append('name',inputFields[2].value);
	formData.append('address',inputFields[3].value);
	formData.append('housenumber',inputFields[4].value);
	formData.append('zip',inputFields[5].value);
	formData.append('city',inputFields[6].value);
	formData.append('country',inputFields[7].value);
	formData.append('updateOrder','updateOrder');

	fetch('../utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			reRenderOrderTable()
		});
};

function reRenderOrderTable() {
	// Hide the table
	let table = document.querySelector('.orders-table');
	table.className += " hide";
	// Make a timeout to remove all products and reload them
	window.setTimeout(() => {
		table.querySelectorAll('.loaded-tr').forEach(element => {
			element.remove();
		});
		getOrders();
		// 2000ms = 2s timeout
	}, 2000);
}

