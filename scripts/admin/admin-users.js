function loadUsers() {
	const userTable = document.querySelector('#users');
	// Fill form data
	let formData = new FormData();
	formData.append('getUsers', 'getUsers');
	// Send request to the backend
	fetch('../utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( users ) {
			for (let user in users) {
				if (users.hasOwnProperty(user)) {
					// Create table rows with the result data
					userTable.innerHTML +=
						`<tr class="loaded-tr" onclick="fillFields(${users[ user ][ 'id' ]})" id="user${users[ user ][ 'id' ]}">` +
						`<td>${users[ user ][ 'id' ]}</td>` +
						`<td>${users[ user ][ 'prename' ]}</td>` +
						`<td>${users[ user ][ 'name' ]}</td>` +
						`<td>${users[ user ][ 'email' ]}</td>` +
						`<td>${users[ user ][ 'password' ]}</td>` +
						`</tr>`;
				}
			}
		});
}

let fillFields = (id) => {
	let content = [];
	let inputFields = document.querySelector('.edit-user-section').querySelectorAll("input");

	let tds = document.querySelector('#user' + id).querySelectorAll('td');
	tds.forEach(( element, index ) => {
		inputFields.item(index).value = element.innerHTML;
		content.push(inputFields.item(index).value);
	});
};

let updateUser = () => {
	let inputFields = document.querySelector('.edit-user-section').querySelectorAll("input");
	console.log(inputFields);
	let formData = new FormData;
	formData.append('id',inputFields[0].value);
	formData.append('prename',inputFields[1].value);
	formData.append('name',inputFields[2].value);
	formData.append('email',inputFields[3].value);
	formData.append('password',inputFields[4].value);
	formData.append('updateUser','UpdateUser');
	
	fetch('../utilities/admin.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( data ) {
			console.log(data);
		});
};
