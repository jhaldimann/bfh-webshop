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
						`<tr class="loaded-tr" onclick="selectField(${users[ user ][ 'id' ]})" id="user${users[ user ][ 'id' ]}">` +
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
