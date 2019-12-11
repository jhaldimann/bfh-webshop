// Load the information of the user
let loadUserInfo = () => {
	// Fill form data
	let rootElement = document.querySelector('.user-info');
	let id = getUrlParam('user');
	let formData = new FormData;
	formData.append('id', id);
	formData.append('getUser', 'getUser');
	// Send request to backend
	fetch('./utilities/helper.php', {method: 'POST', body: formData})
		.then(( resp ) => resp.json())
		.then(function ( user ) {
			// Create the html elements
			rootElement.innerHTML =
				`<h1>Logged in as: ${user[ 0 ][ 'prename' ] + " " + user[ 0 ][ 'name' ]}</h1>` +
				`<p>Email: ${user[ 0 ][ 'email' ]}</p>`
		});
};
