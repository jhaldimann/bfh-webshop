// Load the information of the orders
let loadOrders = ( id ) => {
	let rootElement = document.querySelector('.orders');
	let formData = new FormData;

	formData.append('order', 'order');
	formData.append('id', id);
	// Send request to backend
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( orders ) {
			if (orders.length !== 0) {
				orders.forEach(element => {
					let row = document.createElement('tr');
					let name = document.createElement('td');
					let lastname = document.createElement('td');
					let address = document.createElement('td');
					let housenumber = document.createElement('td');
					let hash = document.createElement('td');
					name.innerHTML = element.prename;
					lastname.innerHTML = element.name;
					address.innerHTML = element.address;
					housenumber.innerHTML = element.housenumber;
					hash.innerHTML = element.hash;
					row.appendChild(name);
					row.append(lastname);
					row.append(address);
					row.append(housenumber);
					row.append(hash);
					rootElement.append(row);
				});
			} else {
				rootElement.remove();
				let info = document.createElement('h1');
				info.innerHTML = "No Orders";
				document.body.append(info);
			}
		});
};
