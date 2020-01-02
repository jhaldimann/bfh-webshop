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
						`<tr class="loaded-tr" onclick="selectField(${orders[ order ][ 'id' ]})" id="order${orders[ order ][ 'id' ]}">` +
						`<td>${orders[ order ][ 'id' ]}</td>` +
						`<td>${orders[ order ][ 'prename' ]}</td>` +
						`<td>${orders[ order ][ 'name' ]}</td>` +
						`<td>${orders[ order ][ 'address' ]}</td>` +
						`<td>${orders[ order ][ 'housenumber' ]}</td>` +
						`<td>${orders[ order ][ 'zip' ]}</td>` +
						`<td>${orders[ order ][ 'country' ]}</td>` +
						`<td>${orders[ order ][ 'hash' ]}</td>` +
						`<td>${orders[ order ][ 'uid' ]}</td>` +
						`</tr>`;
				}
			}
		});
}
